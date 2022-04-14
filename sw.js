const CACHE_NAME = 'Borir_V1';
const urlToCache = [
	'./',
	'./assets/css/main.css',
	'./assets/css/uikit.min.css',
	'./assets/img/cart.png',
	'./assets/img/clock.png',
	'./assets/img/package.png',
	'./assets/img/shopping.png',
	'./assets/img/logo.png',
	'./assets/js/jquery.min.js',
	'./assets/js/uikit-icons.min.js',
	'./assets/js/uikit.min.js'
];


self.addEventListener('install', (event) => {
	event.waitUntil(
		caches.open(CACHE_NAME).then((cache) => {
			return cache.addAll(urlToCache);
		})
	);
});


self.addEventListener('activate', function (event) {
	event.waitUntil(
		caches.keys().then(function (cacheNames) {
			return Promise.all(
				cacheNames.filter(function (cacheName) {
					return cacheName != CACHE_NAME;
				}).map(function (cacheName) {
					return caches.delete(cacheName);
				})
			)
		})
	);
});

self.addEventListener('fetch', function (event) {
	event.respondWith(
		caches.match(event.request).then(function (response) {
			if (response) {
				return response;
			}

			return fetch(event.request);
		})
	)
});
