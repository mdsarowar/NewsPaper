<script>
    // Initialize Lucide icons
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });

    // Password visibility toggle
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById('toggle' + fieldId.charAt(0).toUpperCase() + fieldId.slice(1) + 'Icon');

        if (field.type === 'password') {
            field.type = 'text';
            icon.setAttribute('data-lucide', 'eye-off');
        } else {
            field.type = 'password';
            icon.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    }

    // Password strength checker
    function checkPasswordStrength(password) {
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        let strength = 0;
        let text = 'Weak';
        let className = 'strength-weak';
        let width = '25%';

        // Length check
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;

        // Character variety checks
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;

        if (strength <= 2) {
            text = 'Weak';
            className = 'strength-weak';
            width = '25%';
        } else if (strength <= 4) {
            text = 'Medium';
            className = 'strength-medium';
            width = '60%';
        } else {
            text = 'Strong';
            className = 'strength-strong';
            width = '100%';
        }

        strengthBar.className = 'progress-bar h-2 rounded-full ' + className;
        strengthBar.style.width = width;
        strengthText.textContent = text;
    }

    // Password match checker
    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const message = document.getElementById('passwordMatchMessage');

        if (confirmPassword.length > 0) {
            if (password === confirmPassword) {
                message.textContent = '✓ Passwords match';
                message.className = 'text-xs mt-1 text-green-400';
                message.classList.remove('hidden');
            } else {
                message.textContent = '✗ Passwords do not match';
                message.className = 'text-xs mt-1 text-red-400';
                message.classList.remove('hidden');
            }
        } else {
            message.classList.add('hidden');
        }
    }
</script>
