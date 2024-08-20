import Url from "./Url.js";
import Notification from "./Notification.js";

export default class AreaDelete {
    constructor() {
        Array.from($('.area-delete')).forEach((element) => {
            element.addEventListener('click', () => {
                $.ajax({
                    url: Url.link(null, {path: 'areas/deletar'}),
                    data: {
                        area: element.dataset.area
                    },
                    headers: {
                        Accept: 'application/json'
                    },
                    method: 'POST',
                    success: (response) => {
                        Notification.success(response.message, 1000).overwrite().fire();

                        setTimeout(() => {
                            Url.reload()
                        }, 1000);
                    },
                    error: (xhr, status, error) => {
                        const response = xhr.responseJSON.data.errors;
                        Notification.error(response[Object.keys(response)[0]]).fire();
                    }
                })
            });
        });
    }
}