// Vuetify
// Ensure you are using css-loader
import "@mdi/font/css/materialdesignicons.css";
import "vuetify/styles";
import { createVuetify } from "vuetify";
// import * as components from "vuetify/components";
// import * as directives from "vuetify/directives";

const vuetify = createVuetify({
    // components,
    // directives,
    theme: {
        defaultTheme: "gag",
        themes: {
            gag: {
                dark: false,
                colors: {
                    primary: "#000000",
                    secondary: "#C6A92D",
                    // textcolor: "#5a5b5c",
                    // textgrey: "#818181",
                    // white: "#FFFFFF",
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
    // https://vuetifyjs.com/en/features/icon-fonts/
    icons: {}
});

export default vuetify;
