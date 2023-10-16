document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("submit").addEventListener("click", function () {
        var role = document.querySelector('input[name="rol"]:checked').value;
        var code = document.querySelector('input[name="password"]').value;

        switch (role) {
            case "admin":
                if (code === 'admin') {
                    alert("Welkom admin");
                } else {
                    alert("Code ongeldig");
                }
                break;

            case "student":
                if (code === 'student') {
                    alert("Welkom student");
                } else {
                    alert("Code ongeldig");
                }
                break;

            default:
                alert("Rol ongeldig");
        }
    });
});
