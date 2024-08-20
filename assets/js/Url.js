export default class Url {
    static link(additional_path = null, query_params = {}) {
        let path = `${location.protocol}//${location.host}`;

        if (additional_path !== null) {
            if (additional_path.substring(0, 1) === '/') {
                additional_path = additional_path.substring(1);
            }

            if (additional_path.slice(-1) === '/') {
                additional_path = additional_path.substring(0, additional_path.length - 1);
            }

            path += `/${additional_path}`;
        }
        if (query_params instanceof Object) {
            path += '?';

            Object.keys(query_params).forEach(function(key) {
                path += `${key}=${query_params[key]}&`;
            });

            path = path.substring(0, path.length - 1);
        }

        return path;
    }

    static redirect(path) {
        location.href = path;
    }

    static current() {
        return location.href;
    }

    static reload() {
        location.reload()
    }
}