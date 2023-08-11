import { defineStore } from "pinia";
export const useSettingStore = defineStore("setting", {
    state: () => ({
        page_loading: {
            status: true,
            text: "Checking Account",
        },
        is_from_login: false,
        pms_settings: [],
    }),
    getters: {
        isFromLogin: (state) => state.is_from_login,
        pageLoading: (state) => state.page_loading,
        pmsSettings: (state) => state.pms_settings,
    },
    actions: {
        filteredSetting(company_id) {
            let filteredArray = this.pms_settings.filter(
                (ps) => ps.company_id == company_id
            );
            if (filteredArray && filteredArray.length > 0) {
                return filteredArray[0];
            }
            return false;
        },
        async setPmsSettings(res) {
            this.pms_settings = Object.assign([], res);
        },
        async setPageLoading(status, msg = null) {
            this.page_loading = {
                ...this.page_loading,
                ...{
                    status: status,
                    text: msg ? msg : "checking account",
                },
            };
        },
        async setIsFromLogin(status) {
            this.is_from_login = status;
        },
    },
});
