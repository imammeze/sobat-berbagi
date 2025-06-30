const CACHE_NAME = 'my-pwa-cache-v1'; // Update the cache name for versioning
const filesToCache = [
    '/',
    '/offline.html',
    // Add other assets (e.g., CSS, JS, images) to cache here
];



// Pre-cache important assets during installation
self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open(CACHE_NAME).then(function (cache) {
            return cache.addAll(filesToCache);
        })
    );
});

// Intercept network requests and serve from cache if available
self.addEventListener('fetch', function (event) {
    // Respond with cached resources if available, otherwise fetch from the network
    event.respondWith(
        caches.match(event.request).then(function (response) {
            return response || fetch(event.request);
        }).catch(function () {
            // If both cache and network fail, serve an offline page
            return caches.match('/offline.html');
        })
    );

    // Cache new requests (excluding HTTPS requests)
    if (!event.request.url.startsWith('https://')) {
        event.waitUntil(
            caches.open(CACHE_NAME).then(function (cache) {
                return fetch(event.request).then(function (response) {
                    return cache.put(event.request, response);
                });
            })
        );
    }
});

// Clean up old caches when a new service worker is activated
self.addEventListener('activate', function (event) {
    event.waitUntil(
        caches.keys().then(function (cacheNames) {
            return Promise.all(
                cacheNames.map(function (name) {
                    if (name !== CACHE_NAME) {
                        return caches.delete(name);
                    }
                })
            );
        })
    );
});

