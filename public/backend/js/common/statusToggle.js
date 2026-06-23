document.getElementById("status").addEventListener("change", function () {
    document.getElementById("statusLabel").textContent = this.checked
        ? "Active"
        : "Inactive";
});
