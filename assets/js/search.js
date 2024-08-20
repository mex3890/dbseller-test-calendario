import Notification from "./Notification.js";

document.querySelector('#btn_buscar').addEventListener('click', () => {
    let mesInicio = null;
    let mesFinal = null;
    let area = null;

    for (let field of document.querySelector('form').elements) {
        switch (field.id) {
            case 'area': {
                if (field.value !== '0') {
                    area = field.value;
                }

                break;
            }
            case 'mes_inicio': {
                if (field.value !== '0') {
                    mesInicio = field.value;
                }

                break;
            }
            case 'mes_fim': {
                if (field.value !== '0') {
                    mesFinal = field.value;
                }

                break;
            }
            default: {
                break;
            }
        }
    }

    mesInicio = mesInicio === null ? '1' : mesInicio;

    if (mesFinal !== null && parseInt(mesInicio) > parseInt(mesFinal)) {
        Notification.error('O mês de início não pode ser posterior ao de término.').fire();
        return;
    }

    let query = '?path=agenda';

    if (area !== null) {
        query += `&area=${area}`;
    }

    query += `&meses=${mesInicio}`;
    query += mesFinal !== null ? `-${mesFinal}` : '-12';

    location.href = query;
})
