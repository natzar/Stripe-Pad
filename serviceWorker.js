// https://css-tricks.com/creating-scheduled-push-notifications/

self.addEventListener('install', event => console.log('ServiceWorker installed'));

this.addEventListener('message', function(e) {

    postMessage("I'm done!");
});

self.addEventListener('notificationclick', event => {
  event.waitUntil(self.clients.matchAll().then(clients => {
    if (clients.length){ // check if at least one tab is already open
      clients[0].focus();
        clients[0].postMessage('Push notification clicked!');
        
    } else {
      self.clients.openWindow('/');
    }
  }));
});


self.addEventListener('notificationclick', event => {
  if (event.action === 'close') {
    event.notification.close();
  } else {
    self.clients.openWindow('/');
  }
});
