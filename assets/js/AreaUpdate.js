import Url from "./Url.js";
import Notification from "./Notification.js";
import Element from "./Element.js";

export default class AreaCreate {
    constructor() {
        const descriptionElement = $('#descricao')[0];
        const areaElement = $('#area')[0];
        const updateAreaForm = $('#area_update_form')[0];

        $('#area_update')[0].onclick = (event) => {
            Element.cleanValidationStyleFromFields(updateAreaForm);
            let description = descriptionElement.value;
            let area = areaElement.value;

            if (description.length > 0) {
                $.ajax({
                    url: Url.link(null, {path: 'areas/atualizar'}),
                    data: {
                        descricao: description,
                        area: area
                    },
                    headers: {
                        Accept: 'application/json'
                    },
                    method: 'POST',
                    success: (response) => {
                        Notification.success(response.message, 2000).overwrite().fire();
                        event.target.disabled = true;

                        setTimeout(() => {
                            Url.redirect(Url.link(null, {path: 'agenda', meses: '1-3'}));
                        }, 2000);
                    },
                    error: (xhr, status, error) => {
                        const response = xhr.responseJSON.data.errors;

                        Notification.error(response[Object.keys(response)[0]]).fire();

                        Object.keys(response).forEach((field) => {
                            document.getElementById(field).classList.add('is-invalid');
                        })
                    }
                })
            } else {
                Notification.error('O campo descrição é obrigatório.').fire();
            }
        }
    }
}