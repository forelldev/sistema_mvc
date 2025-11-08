function togglePasswordVisibility() {
  const passwordInput = document.getElementById('clave');
  const eyeIcon = document.getElementById('eye-icon');

  const isVisible = passwordInput.type === 'text';
  passwordInput.type = isVisible ? 'password' : 'text';

  eyeIcon.classList.toggle('fa-eye', isVisible);
  eyeIcon.classList.toggle('fa-eye-slash', !isVisible);
}
