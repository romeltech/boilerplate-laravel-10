function printInitials(name) {
    return name
        ? name
              .split(" ")
              .slice(0, 2)
              .join(" ")
              .split(" ")
              .map((n) => n[0])
              .join("")
              .toUpperCase()
        : "?";
}
export { printInitials };
