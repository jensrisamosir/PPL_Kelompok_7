document.getElementById('show-password').addEventListener('click', function() {
    var passwordInput = document.getElementById('password');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  });

  document.getElementById('show-password-confirmation').addEventListener('click', function() {
    var passwordConfirmationInput = document.getElementById('password-confirm');
    if (passwordConfirmationInput.type === 'password') {
      passwordConfirmationInput.type = 'text';
    } else {
      passwordConfirmationInput.type = 'password';
    }
  });

  
  
  
  