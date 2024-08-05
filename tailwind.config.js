import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                palette: {
                    10: "#F3F3F3",
                    20: "#E7E7E7",
                    30: "#DBDBDB",
                    40: "#3F3F3F",
                    50: "#333333",
                    60: "#272727",
                    70: "#1B1B1B",
                    80: "#0F0F0F",
                    100: "#fbfafb",
                    150: "#097FE5",
                    160: "#065294",
                    200: "#0765B8",
                    300: "#254663",
                    400: "#B80F07",
                    500: "#ADB807",
                    600: "#243C52",
                    700: "#2B2F33",
                    800: "#212A33",
                },

                azul: {
                    700: "#0D2642",
                    600: "#143D6B",
                    500: "#2B7FE0",
                    400: "#1C5494",
                    300: "#246BBD",
                    200: "#CCE0F8",
                    100: "#DEEBFA",
                    50: "#EEF4FC",
                },
                gris: {
                    700: "#292E33",
                    600: "#383F47",
                    500: "#48607A",
                },
            },
        },
    },

    plugins: [forms, typography, require("flowbite/plugin")],
};
