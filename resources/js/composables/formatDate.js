function useFormatDateTime(date) {
    return new Date(date).toLocaleString("en-GB", {
        day: "2-digit",
        year: "numeric",
        month: "2-digit",
        hour12: true,
        hour: "numeric",
        minute: "numeric",
    });
}
function useFormatDate(date) {
    return new Date(date).toLocaleString("en-GB", {
        day: "2-digit",
        year: "numeric",
        month: "2-digit",
    });
}
export { useFormatDateTime, useFormatDate };
