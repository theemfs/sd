var components = {
    "packages": [
        {
            "name": "jquery",
            "main": "jquery-built.js"
        },
        {
            "name": "bootstrap-datetimepicker",
            "main": "bootstrap-datetimepicker-built.js"
        },
        {
            "name": "moment",
            "main": "moment-built.js"
        },
        {
            "name": "select2",
            "main": "select2-built.js"
        },
        {
            "name": "bootstrap",
            "main": "bootstrap-built.js"
        },
        {
            "name": "bootstrap-datepicker",
            "main": "bootstrap-datepicker-built.js"
        }
    ],
    "shim": {
        "bootstrap": {
            "deps": [
                "jquery"
            ]
        }
    },
    "baseUrl": "components"
};
if (typeof require !== "undefined" && require.config) {
    require.config(components);
} else {
    var require = components;
}
if (typeof exports !== "undefined" && typeof module !== "undefined") {
    module.exports = components;
}