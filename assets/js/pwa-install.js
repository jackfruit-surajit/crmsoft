/**
 * BEETRX CRM - PWA Install Manager & Service Worker Registration
 */
(function () {
    'use strict';

    var deferredInstallPrompt = null;
    var isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    var isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;

    // Detect baseUrl from current script location or site
    var baseUrl = (function() {
        var script = document.querySelector('script[src*="pwa-install.js"]');
        if (script && script.src) {
            return script.src.split('assets/js/pwa-install.js')[0];
        }
        return window.location.origin + (window.location.pathname.indexOf('/crmsoft/') !== -1 ? '/crmsoft/' : '/');
    })();

    // Mark body if running as installed standalone app
    if (isStandalone) {
        document.documentElement.classList.add('pwa-standalone');
        if (document.body) document.body.classList.add('pwa-standalone');
        return; // No need to show install prompts in standalone mode
    }

    // 1. Register Service Worker
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
            var swUrl = baseUrl + 'sw.js';
            navigator.serviceWorker.register(swUrl, { scope: baseUrl })
                .then(function (registration) {
                    // Service worker registered successfully
                })
                .catch(function (error) {
                    console.warn('BEETRX PWA: Service Worker registration failed', error);
                });
        });
    }

    // 2. Handle beforeinstallprompt (Chrome, Edge, Android, Opera)
    window.addEventListener('beforeinstallprompt', function (e) {
        // Prevent default mini-infobar on mobile
        e.preventDefault();
        deferredInstallPrompt = e;

        // Reveal header buttons and floating banner
        showInstallButtons();

        // Check if user previously dismissed banner in last 5 days
        var lastDismissed = localStorage.getItem('beetrx_pwa_banner_dismissed');
        var now = new Date().getTime();
        var fiveDays = 5 * 24 * 60 * 60 * 1000;

        if (!lastDismissed || (now - parseInt(lastDismissed, 10)) > fiveDays) {
            setTimeout(function () {
                showFloatingBanner();
            }, 2500); // Wait 2.5s after load for smooth presentation
        }
    });

    // 3. Handle iOS devices
    if (isIOS && !isStandalone) {
        window.addEventListener('load', function () {
            showInstallButtons();
        });
    }

    // 4. Handle successful installation
    window.addEventListener('appinstalled', function () {
        deferredInstallPrompt = null;
        hideInstallButtons();
        hideFloatingBanner();
        showToast('BEETRX CRM App installed successfully!');
    });

    // Helper: Show install buttons across desktop & mobile headers
    function showInstallButtons() {
        var desktopNav = document.getElementById('pwa-install-nav');
        if (desktopNav) desktopNav.style.display = 'inline-block';

        var mobileIcon = document.getElementById('pwa-install-mobile-icon');
        if (mobileIcon) mobileIcon.style.display = 'inline-block';

        var mobileMenu = document.getElementById('pwa-install-mobile-menu');
        if (mobileMenu) mobileMenu.style.display = 'block';

        // Bind click events to triggers
        var triggers = document.querySelectorAll('.btn-install-pwa-trigger');
        triggers.forEach(function (btn) {
            btn.removeEventListener('click', triggerInstallFlow);
            btn.addEventListener('click', triggerInstallFlow);
        });
    }

    function hideInstallButtons() {
        var desktopNav = document.getElementById('pwa-install-nav');
        if (desktopNav) desktopNav.style.display = 'none';

        var mobileIcon = document.getElementById('pwa-install-mobile-icon');
        if (mobileIcon) mobileIcon.style.display = 'none';

        var mobileMenu = document.getElementById('pwa-install-mobile-menu');
        if (mobileMenu) mobileMenu.style.display = 'none';
    }

    // Trigger installation flow
    function triggerInstallFlow(e) {
        if (e) e.preventDefault();

        if (deferredInstallPrompt) {
            // Native prompt available
            deferredInstallPrompt.prompt();
            deferredInstallPrompt.userChoice.then(function (choiceResult) {
                if (choiceResult.outcome === 'accepted') {
                    hideInstallButtons();
                    hideFloatingBanner();
                    showToast('Installing BEETRX CRM Web App...');
                }
                deferredInstallPrompt = null;
            });
        } else if (isIOS) {
            // Show iOS instruction modal
            showIOSModal();
        } else {
            // Browser might already show icon in address bar (e.g. desktop Chrome / Edge)
            showDesktopHelpModal();
        }
    }

    // 5. Floating Install Banner
    function showFloatingBanner() {
        if (document.getElementById('pwa-install-banner')) return;

        var banner = document.createElement('div');
        banner.id = 'pwa-install-banner';
        banner.className = 'pwa-floating-banner animated fadeInUp';
        banner.innerHTML = [
            '<div class="pwa-banner-content">',
            '  <div class="pwa-banner-icon">',
            '    <img src="' + baseUrl + 'assets/images/icons/icon-96x96.png" alt="BEETRX App Icon">',
            '  </div>',
            '  <div class="pwa-banner-text">',
            '    <div class="pwa-banner-title">Install BEETRX Web App</div>',
            '    <div class="pwa-banner-sub">Install on device for fast, app-like CRM access</div>',
            '  </div>',
            '  <div class="pwa-banner-actions">',
            '    <button type="button" class="pwa-btn-install" id="pwa-banner-install-btn">Install</button>',
            '    <button type="button" class="pwa-btn-dismiss" id="pwa-banner-close-btn" aria-label="Close">&times;</button>',
            '  </div>',
            '</div>'
        ].join('');

        document.body.appendChild(banner);

        document.getElementById('pwa-banner-install-btn').addEventListener('click', function () {
            triggerInstallFlow();
        });

        document.getElementById('pwa-banner-close-btn').addEventListener('click', function () {
            hideFloatingBanner();
            localStorage.setItem('beetrx_pwa_banner_dismissed', new Date().getTime().toString());
        });
    }

    function hideFloatingBanner() {
        var banner = document.getElementById('pwa-install-banner');
        if (banner) {
            banner.classList.remove('fadeInUp');
            banner.classList.add('fadeOutDown');
            setTimeout(function () {
                if (banner.parentNode) banner.parentNode.removeChild(banner);
            }, 400);
        }
    }

    // 6. iOS Instructions Modal
    function showIOSModal() {
        if (document.getElementById('pwa-ios-modal')) return;

        var modal = document.createElement('div');
        modal.id = 'pwa-ios-modal';
        modal.className = 'pwa-modal-backdrop';
        modal.innerHTML = [
            '<div class="pwa-modal-card animated fadeIn">',
            '  <div class="pwa-modal-header">',
            '    <div class="pwa-modal-title"><i class="fa-solid fa-mobile-screen-button" style="color:#d4af37; margin-right:8px;"></i> Install on iPhone / iPad</div>',
            '    <button type="button" class="pwa-modal-close" onclick="document.getElementById(\'pwa-ios-modal\').remove()">&times;</button>',
            '  </div>',
            '  <div class="pwa-modal-body">',
            '    <p style="color:#cbd5e1; font-size:14px; margin-bottom:16px;">To install BEETRX CRM on your iOS home screen:</p>',
            '    <ol class="pwa-ios-steps">',
            '      <li>Tap the <strong>Share</strong> button <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline; vertical-align:middle; color:#38bdf8;"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path><polyline points="16 6 12 2 8 6"></polyline><line x1="12" y1="2" x2="12" y2="15"></line></svg> in the Safari toolbar.</li>',
            '      <li>Scroll down the menu and tap <strong>"Add to Home Screen"</strong> <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline; vertical-align:middle; color:#f5d77f;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>.</li>',
            '      <li>Tap <strong>"Add"</strong> at the top right corner.</li>',
            '    </ol>',
            '  </div>',
            '  <div class="pwa-modal-footer">',
            '    <button type="button" class="pwa-modal-btn" onclick="document.getElementById(\'pwa-ios-modal\').remove()">Got it</button>',
            '  </div>',
            '</div>'
        ].join('');

        modal.addEventListener('click', function(e) {
            if (e.target === modal) modal.remove();
        });

        document.body.appendChild(modal);
    }

    // 7. Desktop Fallback Help Modal
    function showDesktopHelpModal() {
        if (document.getElementById('pwa-desktop-modal')) return;

        var modal = document.createElement('div');
        modal.id = 'pwa-desktop-modal';
        modal.className = 'pwa-modal-backdrop';
        modal.innerHTML = [
            '<div class="pwa-modal-card animated fadeIn">',
            '  <div class="pwa-modal-header">',
            '    <div class="pwa-modal-title"><i class="fa-solid fa-desktop" style="color:#d4af37; margin-right:8px;"></i> Install BEETRX Web App</div>',
            '    <button type="button" class="pwa-modal-close" onclick="document.getElementById(\'pwa-desktop-modal\').remove()">&times;</button>',
            '  </div>',
            '  <div class="pwa-modal-body">',
            '    <p style="color:#cbd5e1; font-size:14px; margin-bottom:14px;">You can install BEETRX CRM directly from your browser:</p>',
            '    <div style="background:rgba(212,175,55,0.08); border:1px solid rgba(212,175,55,0.25); border-radius:10px; padding:14px; margin-bottom:14px; font-size:13.5px; color:#e2e8f0;">',
            '      <p style="margin:0 0 8px 0;"><i class="fa-solid fa-arrow-up-right-from-square" style="color:#ffd700; margin-right:6px;"></i> <strong>Chrome / Edge:</strong> Look for the <strong>Install</strong> icon in the address bar (top right) or press the browser menu <i class="fa-solid fa-ellipsis-vertical"></i> and select <strong>"Install BEETRX CRM..."</strong>.</p>',
            '    </div>',
            '  </div>',
            '  <div class="pwa-modal-footer">',
            '    <button type="button" class="pwa-modal-btn" onclick="document.getElementById(\'pwa-desktop-modal\').remove()">Understood</button>',
            '  </div>',
            '</div>'
        ].join('');

        modal.addEventListener('click', function(e) {
            if (e.target === modal) modal.remove();
        });

        document.body.appendChild(modal);
    }

    // Simple toast notification
    function showToast(msg) {
        var toast = document.createElement('div');
        toast.className = 'pwa-toast-notification animated fadeInDown';
        toast.innerHTML = '<i class="fa-solid fa-circle-check" style="color:#10b981; margin-right:8px;"></i> ' + msg;
        document.body.appendChild(toast);
        setTimeout(function () {
            toast.classList.remove('fadeInDown');
            toast.classList.add('fadeOutUp');
            setTimeout(function () {
                if (toast.parentNode) toast.parentNode.removeChild(toast);
            }, 400);
        }, 3500);
    }

    // Expose trigger globally if needed
    window.installBeetrxPWA = triggerInstallFlow;

})();

