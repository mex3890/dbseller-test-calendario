import Notification from "./Notification.js";
import AreaCreate from "./AreaCreate.js";
import Url from "./Url.js";
import ModalMelhoria from "./ModalMelhoria.js";
import AreaDelete from "./AreaDelete.js";
import AreaUpdate from "./AreaUpdate.js";
import MelhoriaDelete from "./MelhoriaDelete.js";

window.onload = () => {
    if (Url.current().includes('?path=areas/criar')) {
        new AreaCreate();
    }

    if (Url.current().includes('?path=areas/edit')) {
        new AreaUpdate();
    }

    if (Url.current().includes('?path=agenda')) {
        new AreaDelete();
        new ModalMelhoria;
        new MelhoriaDelete()
    }

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