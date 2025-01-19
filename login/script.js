// Validasi form login
document.getElementById("loginForm").addEventListener("submit", function(event) {
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    if (username === "" || password === "") {
        alert("Harap isi semua bidang!");
        event.preventDefault(); // Mencegah pengiriman form
    }
});
