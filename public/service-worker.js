importScripts("https://js.pusher.com/beams/service-worker.js");

// https://pusher.com/docs/beams/guides/handle-incoming-notifications/web/
// https://pusher.com/docs/beams/reference/publish-payloads/#web-format
PusherPushNotifications.onNotificationReceived = ({
    pushEvent,
    payload,
    handleNotification,
}) => {
    console.log("PusherPushNotifications payload", payload);
    // Your custom notification handling logic here 🛠️
    // This method triggers the default notification handling logic offered by
    // the Beams SDK. This gives you an opportunity to modify the payload.
    // E.g. payload.notification.title = "A client-determined title!"
    pushEvent.waitUntil(handleNotification(payload));

    // pushEvent.waitUntil(
    //     self.registration.showNotification(payload.notification.title, {
    //       body: payload.notification.body,
    //       icon: payload.notification.icon,
    //       data: payload.data,
    //     })
    //   );
};
