function usePrintInitials(fullName) {
    return fullName ? fullName.split(' ').map(word => word[0]).join('') : '?';
    // return fullName
    //     .split(" ")
    //     .slice(0, 2)
    //     .join(" ")
    //     .split(" ")
    //     .map((n) => n[0])
    //     .join("");
}
export { usePrintInitials };
