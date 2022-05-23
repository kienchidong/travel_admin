var routes = window.Laravel.router;

serialize = function (obj) {
    var str = [];
    for (var p in obj)
        if (obj.hasOwnProperty(p)) {
            str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
        }
    return str.join("&");
};

module.exports = (name, param = null, query = null) => {
    if (routes[name] === undefined) {
        console.error('Route not found ', name);
    } else {
        let route = window.Laravel.baseUrl + '/' + routes[name];
        if (param != null && typeof param == 'object') {
            for (const [key, value] of Object.entries(param)) {
                if ((route.includes(`{${key}}`))) {
                    route = route.replace(`{${key}}`, value)
                }
            }
        }

        if (query != null && typeof query == 'object') {
            route += `?${serialize(query)}`;
        }

        return route;
    }
};
