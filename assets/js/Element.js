export default class Element {
    static cleanValidationStyleFromFields(form) {
        Array.from(form.getElementsByClassName('field')).forEach((element) => {
            element.classList.remove('is-invalid');
        });
    }
}