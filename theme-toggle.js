function toggleMode() {
    document.body.classList.toggle("dark-mode");

    // Save preference in local storage
    const mode = document.body.classList.contains("dark-mode") ? "dark" : "light";
    localStorage.setItem("mode", mode);
}

// Apply saved mode on page load
window.addEventListener("DOMContentLoaded", () => {
    const savedMode = localStorage.getItem("mode");
    if (savedMode === "dark") {
        document.body.classList.add("dark-mode");
    }
});
