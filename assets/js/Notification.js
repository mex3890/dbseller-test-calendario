export default class Notification {
    constructor(message, type = 'info', duration = 9500) {
        this.message = message;
        this.type = type;
        this.duration = duration;

        return this;
    }
    static success(message, duration = 9500) {
        return new Notification(message, 'success', duration);
    }

    static error(message, duration = 9500) {
        return new Notification(message, 'error', duration);
    }

    static info(message, duration = 9500) {
        return new Notification(message, 'info', duration);
    }

    fire() {
        if (window.displayng_notification === true) {
            return;
        }

        window.displayng_notification = true;

        if (!window.hasOwnProperty('notificationElement')) {
            window.notificationElement = document.getElementById('notification');
        }

        window.notificationElement.getElementsByTagName('p')[0].innerText = this.message;
        window.notificationElement.classList.add(this.type, 'active');

        setTimeout(() => {
            window.notificationElement.classList.remove('active', this.type);
            window.displayng_notification = false;
        }, this.duration);
    }
}