import Notification from "./Notification.js";

window.onload = () => {
    if (location.href.includes('notification-message')) {
        let message = location.href.substring(location.href.indexOf("notification-message=") + 21);

        if (message.indexOf('&') !== -1) {
            message = message.substring(0, message.indexOf('&'));
        }

        let type = location.href.substring(location.href.indexOf("notification-type=") + 17);

        if (type.indexOf('&') !== -1) {
            type = type.substring(0, type.indexOf('&'));
        }

        new Notification(message, type).fire();
    }
}