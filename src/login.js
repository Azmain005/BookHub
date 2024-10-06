const containerlogin = document.getElementById('containerlogin');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    containerlogin.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    containerlogin.classList.remove("active");
});

function togglePasswordVisibility(passwordFieldId, iconElement) {
  const passwordField = document.getElementById(passwordFieldId);
  const icon = iconElement.querySelector('i');
  if (passwordField.type === "password") {
    passwordField.type = "text";
    icon.classList.remove('fa-eye');
    icon.classList.add('fa-eye-slash');
  } else {
    passwordField.type = "password";
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
  }
}
