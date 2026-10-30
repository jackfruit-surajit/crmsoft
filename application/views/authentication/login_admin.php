<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view('authentication/includes/head.php'); ?>

<body class="login_admin modern-auth-page">

    <!-- Ambient glowing light orbs matching screenshot -->
    <div class="ambient-glow glow-top-left"></div>
    <div class="ambient-glow glow-bottom-right"></div>
    <div class="ambient-glow glow-bottom-left"></div>

    <div class="auth-center-container">
        <!-- Main Dark Glassmorphism Card -->
        <div class="auth-card">
            <!-- Neon gradient accent top line -->
            <div class="card-accent-top"></div>

            <!-- Logo -->
            <div class="auth-logo-wrap text-center">
                <?php get_dark_company_logo(); ?>
            </div>

            <!-- Super Admin Portal Pill Badge -->
            <div class="text-center auth-portal-badge-wrap">
                <span class="auth-portal-badge">
                    <svg class="portal-shield-icon" width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-3zm0 2.18l7 2.33v4.49c0 4.54-3.14 8.78-7 9.9-3.86-1.12-7-5.36-7-9.9V6.51l7-2.33z"/>
                        <path d="M10 12.5l-2-2-1.41 1.41L10 15.33l6-6-1.41-1.41z"/>
                    </svg>
                    SUPER ADMIN PORTAL
                </span>
            </div>

            <!-- Welcome Back Heading -->
            <h1 class="auth-main-title text-center">
                Welcome Back
            </h1>

            <!-- Subtitle -->
            <p class="auth-subtitle text-center">
                Sign in with your administrative credentials to manage your dashboard.
            </p>

            <?php $this->load->view('authentication/includes/alerts'); ?>

            <?php echo form_open($this->uri->uri_string(), ['class' => 'auth-form']); ?>

            <?php echo validation_errors('<div class="alert alert-danger text-center">', '</div>'); ?>

            <?php hooks()->do_action('after_admin_login_form_start'); ?>

            <!-- Email Field -->
            <div class="form-group auth-form-group">
                <label for="email" class="auth-label">
                    <?php echo _l('admin_auth_login_email'); ?>
                </label>
                <div class="auth-input-wrapper">
                    <span class="auth-input-icon left-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </span>
                    <input type="email" id="email" name="email" class="auth-input" placeholder="admin@admin.com" autofocus="1" required>
                </div>
            </div>

            <!-- Password Field -->
            <div class="form-group auth-form-group">
                <label for="password" class="auth-label">
                    <?php echo _l('admin_auth_login_password'); ?>
                </label>
                <div class="auth-input-wrapper">
                    <span class="auth-input-icon left-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>
                    <input type="password" id="password" name="password" class="auth-input" placeholder="••••••••" required>
                    <button type="button" class="auth-input-icon right-icon toggle-password-btn" onclick="togglePasswordVisibility()" aria-label="Toggle password">
                        <svg id="eye-icon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
            </div>

            <?php if (show_recaptcha()) { ?>
            <div class="g-recaptcha tw-mb-4" data-sitekey="<?php echo get_option('recaptcha_site_key'); ?>"></div>
            <?php } ?>

            <!-- Options Row (Remember me + TLS Secured) -->
            <div class="auth-options-row">
                <label class="auth-remember-label">
                    <input type="checkbox" value="estimate" id="remember" name="remember" class="auth-checkbox">
                    <span>Remember this device</span>
                </label>
                <div class="auth-tls-secured">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                    <span>TLS Secured</span>
                </div>
            </div>

            <!-- Sign In Button -->
            <div class="form-group tw-mb-2">
                <button type="submit" class="auth-submit-btn">
                    <span>Sign In to Dashboard</span>
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </div>

            <!-- Forgot Password -->
            <div class="text-center auth-fp-wrap">
                <a href="<?php echo admin_url('authentication/forgot_password'); ?>" class="auth-fp-link">
                    <?php echo _l('admin_auth_login_fp'); ?>
                </a>
            </div>

            <?php hooks()->do_action('before_admin_login_form_close'); ?>

            <?php echo form_close(); ?>
        </div>

        <!-- Footer Security Badge -->
        <div class="auth-footer-security text-center">
            <span class="ssl-security-pill">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-3zm-2 16l-4-4 1.41-1.41L10 15.17l6.59-6.59L18 10l-8 8z"/>
                </svg>
                256-Bit SSL Encrypted Admin Connection
            </span>
            <div class="auth-copyright-text">
                &copy; <?php echo date('Y'); ?> <strong><?php echo e(get_option('companyname')); ?></strong> | Official Admin Portal. All Rights Reserved.
            </div>
        </div>
    </div>

    <script>
    function togglePasswordVisibility() {
        var pwd = document.getElementById('password');
        var eye = document.getElementById('eye-icon');
        if (pwd.type === 'password') {
            pwd.type = 'text';
            eye.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
        } else {
            pwd.type = 'password';
            eye.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
        }
    }
    </script>
</body>
</html>
