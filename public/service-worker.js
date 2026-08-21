// Service Worker for Apogee Agrotech
// Network-first for HTML/pages so content updates show without hard refresh.
const CACHE_VERSION = 'v4-20260821';
const STATIC_CACHE = 'apogee-static-' + CACHE_VERSION;

const PRECACHE_ASSETS = [
  '/uploads/logo/favicon.png',
  '/front/css/bootstrap.css',
  '/front/css/styles.css',
  '/front/js/jquery.min.js',
  '/front/js/bootstrap.min.js',
  '/front/js/main.js'
];

function isNavigationRequest(request) {
  return request.mode === 'navigate' ||
    (request.headers.get('accept') || '').includes('text/html');
}

function shouldBypassCache(url) {
  const path = url.pathname;
  return (
    path.startsWith('/admin') ||
    path.startsWith('/api') ||
    path.startsWith('/uploads/blog') ||
    path.includes('/blog') ||
    path.includes('/media') ||
    path.endsWith('.php') ||
    path === '/service-worker.js'
  );
}

function isStaticAsset(url) {
  // Never treat the service worker script itself as a cacheable asset
  if (url.pathname === '/service-worker.js') {
    return false;
  }
  return /\.(css|js|woff2?|ttf|eot|png|jpe?g|gif|webp|svg|ico|map)(\?.*)?$/i.test(url.pathname);
}

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(STATIC_CACHE)
      .then((cache) => cache.addAll(
        PRECACHE_ASSETS.map((url) => new Request(url, { credentials: 'same-origin', cache: 'reload' }))
      ).catch(() => undefined))
      .then(() => self.skipWaiting())
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((names) =>
      Promise.all(
        names
          .filter((name) => name !== STATIC_CACHE)
          .map((name) => caches.delete(name))
      )
    ).then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', (event) => {
  if (event.request.method !== 'GET') {
    return;
  }

  const url = new URL(event.request.url);
  if (url.origin !== self.location.origin) {
    return;
  }

  // Always hit the network for HTML / admin / dynamic pages / blog uploads
  if (isNavigationRequest(event.request) || shouldBypassCache(url)) {
    event.respondWith(
      fetch(event.request, { cache: 'no-store' }).catch(() => caches.match(event.request))
    );
    return;
  }

  // Static assets: network first, fall back to cache (offline)
  if (isStaticAsset(url)) {
    event.respondWith(
      fetch(event.request)
        .then((response) => {
          if (response && response.status === 200 && response.type === 'basic') {
            const copy = response.clone();
            caches.open(STATIC_CACHE).then((cache) => cache.put(event.request, copy));
          }
          return response;
        })
        .catch(() => caches.match(event.request))
    );
    return;
  }

  // Everything else: network only (do not cache)
  event.respondWith(fetch(event.request, { cache: 'no-store' }));
});
