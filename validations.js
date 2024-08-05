document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('form');
  
  form.addEventListener('submit', function(event) {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    if (username.trim() === '' || password.trim() === '') {
      alert('Por favor, complete todos los campos.');
      event.preventDefault();
    }
  });
});
