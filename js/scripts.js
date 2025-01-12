document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.getElementById('registerForm');
    const loginForm = document.getElementById('loginForm');

    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            const username = document.getElementById('registerUsername').value;
            const password = document.getElementById('registerPassword').value;
            const email = document.getElementById('registerEmail').value;

            if (!username || !password || !email) {
                event.preventDefault();
                alert('Please fill in all fields.');
            }
        });
    }

    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            const username = document.getElementById('loginUsername').value;
            const password = document.getElementById('loginPassword').value;

            if (!username || !password) {
                event.preventDefault();
                alert('Please enter both username and password.');
            }
        });
    }
});