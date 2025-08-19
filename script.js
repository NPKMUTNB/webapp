// Login form functionality
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.querySelector('.login-btn');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    // Form submission handler
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = emailInput.value.trim();
        const password = passwordInput.value;
        
        // Basic validation
        if (!email || !password) {
            showMessage('Please fill in all fields', 'error');
            return;
        }
        
        if (!isValidEmail(email) && !isValidUsername(email)) {
            showMessage('Please enter a valid email or username', 'error');
            return;
        }
        
        if (password.length < 6) {
            showMessage('Password must be at least 6 characters long', 'error');
            return;
        }
        
        // Simulate login process
        simulateLogin(email, password);
    });

    // Email/username validation
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function isValidUsername(username) {
        const usernameRegex = /^[a-zA-Z0-9_]{3,20}$/;
        return usernameRegex.test(username);
    }

    // Simulate login process
    function simulateLogin(email, password) {
        // Add loading state
        loginBtn.classList.add('loading');
        loginBtn.textContent = 'Signing In...';
        
        // Simulate API call delay
        setTimeout(() => {
            // Remove loading state
            loginBtn.classList.remove('loading');
            loginBtn.textContent = 'Sign In';
            
            // In a real application, you would send credentials to your backend
            // For demo purposes, we'll show a success message
            showMessage('Login successful! Redirecting...', 'success');
            
            // Simulate redirect after success
            setTimeout(() => {
                showMessage('This is a demo. In a real app, you would be redirected to the dashboard.', 'info');
            }, 2000);
            
        }, 1500);
    }

    // Show message function
    function showMessage(message, type = 'info') {
        // Remove existing messages
        const existingMessage = document.querySelector('.message');
        if (existingMessage) {
            existingMessage.remove();
        }
        
        // Create message element
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type}`;
        messageDiv.textContent = message;
        
        // Insert message at the top of the form
        const loginHeader = document.querySelector('.login-header');
        loginHeader.insertAdjacentElement('afterend', messageDiv);
        
        // Auto remove message after 5 seconds
        setTimeout(() => {
            if (messageDiv.parentNode) {
                messageDiv.remove();
            }
        }, 5000);
    }

    // Add real-time validation feedback
    emailInput.addEventListener('blur', function() {
        const email = this.value.trim();
        if (email && !isValidEmail(email) && !isValidUsername(email)) {
            this.style.borderColor = '#e74c3c';
        } else if (email) {
            this.style.borderColor = '#27ae60';
        }
    });
    
    emailInput.addEventListener('input', function() {
        this.style.borderColor = '#e1e5e9';
    });

    passwordInput.addEventListener('blur', function() {
        if (this.value && this.value.length < 6) {
            this.style.borderColor = '#e74c3c';
        } else if (this.value) {
            this.style.borderColor = '#27ae60';
        }
    });
    
    passwordInput.addEventListener('input', function() {
        this.style.borderColor = '#e1e5e9';
    });

    // Handle "Remember me" functionality
    const rememberCheckbox = document.getElementById('remember');
    const storedEmail = localStorage.getItem('rememberedEmail');
    
    if (storedEmail) {
        emailInput.value = storedEmail;
        rememberCheckbox.checked = true;
    }
    
    loginForm.addEventListener('submit', function() {
        if (rememberCheckbox.checked) {
            localStorage.setItem('rememberedEmail', emailInput.value);
        } else {
            localStorage.removeItem('rememberedEmail');
        }
    });
});

// Add CSS for message styling
const messageStyles = document.createElement('style');
messageStyles.textContent = `
    .message {
        padding: 12px 16px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
        text-align: center;
    }
    
    .message.success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .message.error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    .message.info {
        background: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }
`;
document.head.appendChild(messageStyles);