document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("input.currency").forEach((input) => {
        input.addEventListener("input", function () {
            let value = this.value.replace(/\D/g, ""); // ambil angka mentah
            this.value = value
                ? new Intl.NumberFormat("id-ID").format(value)
                : "";
        });

        // sebelum submit, hapus titik
        input.form?.addEventListener("submit", function () {
            input.value = input.value.replace(/\D/g, "");
        });
    });
});
