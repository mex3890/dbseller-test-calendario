import Url from "./Url.js";
import Notification from "./Notification.js";

export default class MelhoriaAttach {
    constructor() {
        const prazoLegal = $('#prazo_legal')[0];

        $('#is_legal')[0].addEventListener('input', (event) => {
            prazoLegal.disabled = !event.target.checked;
            prazoLegal.focus();
        });

        const form = $('#create_area_form')[0];
        const submitButton = $('#melhoria_create')[0];

        submitButton.addEventListener('click', () => {
            let fieldBag = {};

            Array.from(form.getElementsByClassName('field')).forEach((element) => {
                if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA' || element.tagName === 'SELECT') {
                    if (element.type === 'checkbox') {
                        fieldBag[element.name] = element.checked;
                    } else {
                        if (element.tagName !== 'SELECT' || element.value !== '0') {
                            fieldBag[element.name] = element.value;
                        }
                    }
                }
            })

            $.ajax({
                url: Url.link(null, {path: 'melhorias/salvar'}),
                data: fieldBag,
                headers: {
                    Accept: 'application/json'
                },
                method: 'POST',
                success: (response) => {
                    Notification.success(response.message, 2000).overwrite().fire();
                    submitButton.disabled = true;

                    setTimeout(() => {
                        Url.redirect(Url.link(null, {
                            path: 'agenda',
                            meses: '1-12',
                            area: fieldBag.area
                        }));
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
        });
    }
}
