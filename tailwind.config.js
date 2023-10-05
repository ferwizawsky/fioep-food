/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#74C69D",
                secondary: "#FFC466",
                red: "#FF7474",
                brown: "#774E3B",
            },
        },
    },
    plugins: [],
};
