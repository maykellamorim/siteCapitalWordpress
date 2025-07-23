// CAPITAL - Agro Investors - Service Worker

const CACHE_NAME = 'capital-agro-v1';
const ASSETS_TO_CACHE = [
  '/',
  '/index.html',
  '/manifest.json',
  '/assets/css/style.css',
  '/assets/js/main.js',
  '/assets/img/logo.jpg',
  '/assets/img/logo-footer.svg',
  '/assets/img/favicon.svg',
  '/assets/img/favicon.ico',
  '/assets/img/hero-bg.svg',
  '/assets/img/sobre.svg',
  'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
  'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js',
  'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
  'https://unpkg.com/aos@2.3.1/dist/aos.css',
  'https://unpkg.com/aos@2.3.1/dist/aos.js'
];

// Instalação do Service Worker
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        console.log('Cache aberto');
        return cache.addAll(ASSETS_TO_CACHE);
      })
      .then(() => self.skipWaiting())
  );
});

// Ativação do Service Worker
self.addEventListener('activate', (event) => {
  const cacheWhitelist = [CACHE_NAME];
  
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            // Deletar caches antigos que não estão na whitelist
            return caches.delete(cacheName);
          }
        })
      );
    }).then(() => self.clients.claim())
  );
});

// Estratégia de cache: Cache First, falling back to Network
self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request)
      .then((response) => {
        // Cache hit - retorna a resposta do cache
        if (response) {
          return response;
        }
        
        // Clone da requisição
        const fetchRequest = event.request.clone();
        
        return fetch(fetchRequest).then(
          (response) => {
            // Verifica se a resposta é válida
            if (!response || response.status !== 200 || response.type !== 'basic') {
              return response;
            }
            
            // Clone da resposta
            const responseToCache = response.clone();
            
            caches.open(CACHE_NAME)
              .then((cache) => {
                // Adiciona a resposta ao cache
                cache.put(event.request, responseToCache);
              });
            
            return response;
          }
        );
      })
  );
});

// Evento de sincronização em segundo plano
self.addEventListener('sync', (event) => {
  if (event.tag === 'sync-form-data') {
    event.waitUntil(syncFormData());
  }
});

// Função para sincronizar dados de formulário
async function syncFormData() {
  try {
    // Aqui você pode implementar a lógica para enviar dados armazenados localmente
    // quando o usuário estiver offline e recuperar a conexão
    console.log('Sincronizando dados do formulário...');
    
    // Exemplo: obter dados do IndexedDB e enviar para o servidor
    // const db = await openDB('formData', 1);
    // const data = await db.getAll('outbox');
    // await Promise.all(data.map(item => sendToServer(item)));
    // await db.clear('outbox');
  } catch (error) {
    console.error('Erro ao sincronizar dados:', error);
  }
}

// Evento de notificação push
self.addEventListener('push', (event) => {
  const data = event.data.json();
  
  const options = {
    body: data.body,
    icon: '/assets/img/favicon.svg',
    badge: '/assets/img/favicon.svg',
    vibrate: [100, 50, 100],
    data: {
      url: data.url || '/'
    }
  };
  
  event.waitUntil(
    self.registration.showNotification(data.title, options)
  );
});

// Evento de clique na notificação
self.addEventListener('notificationclick', (event) => {
  event.notification.close();
  
  event.waitUntil(
    clients.openWindow(event.notification.data.url)
  );
});