/**
 * BEETRX CRM - Progressive Web App Service Worker
 * Version: 1.0.0
 */

const CACHE_NAME = 'beetrx-pwa-v1';
const OFFLINE_URL = './offline.html';

const PRECACHE_ASSETS = [
  './manifest.json',
  './offline.html',
  './uploads/company/logo.png',
  './uploads/company/logo-dark.png',
  './uploads/company/favicon.png',
  './assets/images/icons/icon-72x72.png',
  './assets/images/icons/icon-96x96.png',
  './assets/images/icons/icon-128x128.png',
  './assets/images/icons/icon-144x144.png',
  './assets/images/icons/icon-152x152.png',
  './assets/images/icons/icon-192x192.png',
  './assets/images/icons/icon-384x384.png',
  './assets/images/icons/icon-512x512.png',
  './assets/images/icons/maskable-icon-512x512.png',
  './assets/images/icons/apple-touch-icon.png'
];

// Install Event: Pre-cache core shell & offline fallback
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(PRECACHE_ASSETS);
    }).then(() => self.skipWaiting())
  );
});

// Activate Event: Cleanup stale caches
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheName !== CACHE_NAME) {
            return caches.delete(cacheName);
          }
        })
      );
    }).then(() => self.clients.claim())
  );
});

// Fetch Event
self.addEventListener('fetch', (event) => {
  // Only handle GET requests; never intercept POST/PUT/DELETE
  if (event.request.method !== 'GET') {
    return;
  }

  const url = new URL(event.request.url);

  // 1. Navigation requests (HTML pages) -> Network first, fallback to offline.html
  if (event.request.mode === 'navigate') {
    event.respondWith(
      fetch(event.request).catch(() => {
        return caches.match(OFFLINE_URL);
      })
    );
    return;
  }

  // 2. Static Images, Icons, Manifest -> Stale-while-revalidate
  if (
    url.pathname.match(/\.(png|jpg|jpeg|svg|gif|webp|ico|json)$/i) ||
    url.pathname.includes('/assets/images/icons/')
  ) {
    event.respondWith(
      caches.match(event.request).then((cachedResponse) => {
        const fetchPromise = fetch(event.request)
          .then((networkResponse) => {
            if (networkResponse && networkResponse.status === 200) {
              const responseToCache = networkResponse.clone();
              caches.open(CACHE_NAME).then((cache) => {
                cache.put(event.request, responseToCache);
              });
            }
            return networkResponse;
          })
          .catch(() => cachedResponse);

        return cachedResponse || fetchPromise;
      })
    );
    return;
  }

  // 3. All other requests -> Network with fallback
  event.respondWith(
    fetch(event.request).catch(() => {
      return caches.match(event.request);
    })
  );
});

