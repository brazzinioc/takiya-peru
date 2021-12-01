// tailwind.config.js
module.exports = {
    purge: {
        content: [
            "./storage/framework/views/*.php",
            "./resources/**/*.blade.php",
            "./resources/**/*.js",
            "./resources/**/*.vue",
        ],
    },
    darkMode: false, // or 'media' or 'class'
    theme: {
        fontFamily: {
            'opsans': [ 'Open Sans' ]
        },

        container: {
            center: true,
        },

        extend: {},
    },
    variants: {},
    plugins: [],
};
