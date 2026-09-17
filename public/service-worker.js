const CACHE_NAME = "pmb-cache-v1";
const urlsToCache = [
  "/",
  "/css/app.css",
  "/js/app.js",
  "/manifest.json",
  "/assets/icons/unpas.png",
  "/assets/icons/unpas.png"
];

// Install service worker
self.addEventListener("install", event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});

// Fetch event
self.addEventListener("fetch", event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request))
  );
});
