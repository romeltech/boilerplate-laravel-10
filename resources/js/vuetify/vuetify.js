// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as directives from "vuetify/directives";

// components
// import components from "./components"; // manual imports
import * as components from "vuetify/components";

// icon library - https://pictogrammers.com/library/mdi/
import { aliases, mdi } from "vuetify/iconsets/mdi-svg";

const vuetify = createVuetify({
    components,
    directives,
    theme: {
        defaultTheme: "light",
        themes: {
            light: {
                colors: {
                    primary: "#000000",
                    secondary: "#C6A92D",
                    background: "#fafafa",
                    white: "#FFFFFF",
                },
            },
            dark: {
                colors: {
                    primary: "#FFFFFF",
                    secondary: "#C6A92D",
                    background: "#3c3c3c",
                    white: "#000000",
                },
            },
        },
    },
    icons: {
        defaultSet: "mdi",
        aliases,
        sets: {
            mdi,
        },
    },
});

export default vuetify;
