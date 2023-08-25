importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js");

firebase.initializeApp({
    apiKey: "AIzaSyBbSEk8U21SAh0z8Od6p9n-T6wCVNlJ2Ak",
    projectId: "push-notification-7f303",
    messagingSenderId: "451607915135",
    appId: "1:451607915135:web:0e8049b2f05d6535d7ed4a",
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    console.log("FCM Service Worker Loaded");
    return self.registration.showNotification(title,{body,icon});
});


// messaging.onBackgroundMessage(({ notification }) => {
//     console.log("[firebase-messaging-sw.js] Received background message ");
//     // Customize notification here
//     const notificationTitle = notification.title;
//     const notificationOptions = {
//         body: notification.body,
//     };

//     if (notification.icon) {
//         notificationOptions.icon = notification.icon;
//     }

//     self.registration.showNotification(notificationTitle, notificationOptions);
// });
