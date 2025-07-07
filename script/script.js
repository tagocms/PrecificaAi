function openLogin() {
    document.getElementById('login').style.display = 'block'; 
    document.getElementById('register').style.display = 'none';
}

function openRegister() {
    document.getElementById('register').style.display = 'block'; 
    document.getElementById('login').style.display = 'none';
}

function closeLogin() {
    document.getElementById('login').style.display='none'
}

function closeRegister() {
    document.getElementById('register').style.display='none'
}

function togglePasswordVisibility(element) {
    var loginPassword = document.getElementById("loginPassword");
    var password = document.getElementById("password");
    var confirmPassword = document.getElementById("confirmPassword");

    if (element.id == "showLogin") {
        if (loginPassword.type == "text") {
            loginPassword.type = "password";
        } else {
            loginPassword.type = "text";
        }
    } else if (element.id == "showRegister") {
        if (password.type == "text") {
            password.type = "password";
            confirmPassword.type = "password";
        } else {
            password.type = "text";
            confirmPassword.type = "text";
        }
    }
}

function validateRegisterForm() {
    var form = document.getElementById("registerForm");
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    form.onsub

    form.onsubmit = function(event) {
        if (password !== confirmPassword) {
            event.preventDefault();
            alert("As senhas não coincidem. Por favor, verifique.");
        } else {
            form.submit()
        }
    };
}