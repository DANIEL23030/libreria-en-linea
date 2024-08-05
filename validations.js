document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('loginForm');
  const username = document.getElementById('username');
  const password = document.getElementById('password');
  const passwordHelp = document.getElementById('passwordHelp');

  // Función para validar la contraseña
  function validatePassword() {
    const passwordValue = password.value;
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (!regex.test(passwordValue)) {
      passwordHelp.classList.add('text-danger');
      if (passwordValue.length < 8) {
        passwordHelp.textContent = 'La contraseña debe tener al menos 8 caracteres.';
      } else if (!/[A-Z]/.test(passwordValue)) {
        passwordHelp.textContent = 'La contraseña debe incluir al menos una letra mayúscula.';
      } else if (!/[a-z]/.test(passwordValue)) {
        passwordHelp.textContent = 'La contraseña debe incluir al menos una letra minúscula.';
      } else if (!/\d/.test(passwordValue)) {
        passwordHelp.textContent = 'La contraseña debe incluir al menos un número.';
      } else {
        passwordHelp.textContent = 'La contraseña debe incluir al menos un carácter especial.';
      }
      return false;
    } else {
      // Agregar una clase para indicar la fuerza de la contraseña
      if (passwordValue.length >= 12) {
        passwordHelp.classList.remove('text-warning');
        passwordHelp.classList.add('text-success');
        passwordHelp.textContent = 'Contraseña fuerte';
      } else if (passwordValue.length >= 8) {
        passwordHelp.classList.remove('text-danger');
        passwordHelp.classList.add('text-warning');
        passwordHelp.textContent = 'Contraseña moderada';
      } else {
        passwordHelp.classList.remove('text-danger');
        passwordHelp.textContent = 'Contraseña débil';
      }
      return true;
    }
  }

  // Validación en tiempo real de la contraseña
  password.addEventListener('input', validatePassword);

  // Validación del formulario al enviarlo
  form.addEventListener('submit', function(event) {
    if (username.value.trim() === '') {
      alert('Por favor, ingrese su nombre de usuario.');
      event.preventDefault();
    } else if (!validatePassword()) {
      alert('Por favor, ingrese una contraseña segura.');
      event.preventDefault();
    }
  });
});
