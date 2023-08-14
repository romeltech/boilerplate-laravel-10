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
    theme: {
        defaultTheme: "light",
        themes: {
            light: {
                // dark: false,
                colors: {
                    primary: "#000000",
                    secondary: "#C6A92D",
                    background: "#fafafa",
                    white: "#FFFFFF",
                    // textgrey: "#818181",
                    // screenBg: "#f8fafc",
                    // Vuetify Action Colors
                    // secondary: '#f5f5f5',
                    // accent: '#82B1FF',
                    // error: '#FF5252',
                    // info: '#2196F3',
                    // success: "#4CAF50",
                    // warning: '#FFC107',
                },
            },
            dark: {
                // dark: false,
                colors: {
                    primary: "#FFFFFF",
                    secondary: "#C6A92D",
                    background: "#3c3c3c",
                    white: "#000000",
                    // textgrey: "#818181",
                    // screenBg: "#f8fafc",
                    // Vuetify Action Colors
                    // secondary: '#f5f5f5',
                    // accent: '#82B1FF',
                    // error: '#FF5252',
                    // info: '#2196F3',
                    // success: "#4CAF50",
                    // warning: '#FFC107',
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
