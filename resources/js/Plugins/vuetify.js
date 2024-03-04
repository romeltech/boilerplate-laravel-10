// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

// icon library - https://pictogrammers.com/library/mdi/
import { aliases, mdi } from "vuetify/iconsets/mdi-svg";

const vuetify = createVuetify({
    components,
    directives,
    defaults: {
        VTextField: {
            variant: "outlined",
        },
        VCard: {
            rounded: "lg",
        }
    },
    theme: {
        defaultTheme: "light",
        themes: {
            // mel: {
            //     colors: {
            //         primary: "#000000",
            //         secondary: "#C6A92D",
            //         "app-bg": "#F7F8FC",
            //     },
            // },
            light: {
                colors: {
                    primary: "#000000",
                    secondary: "#C6A92D",
                    "app-background": "#F7F8FC",
                    white: "#FFFFFF",
                },
            },
            dark: {
                colors: {
                    primary: "#FFFFFF",
                    secondary: "#C6A92D",
                    "app-background": "#2f2f2f",
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
