// Form handling for Avipro Travels

document.addEventListener('DOMContentLoaded', function() {
    // Booking Form Handling
    const bookingForm = document.getElementById('booking-form');
    if (bookingForm) {
        bookingForm.addEventListener('submit', handleBookingSubmit);
        setupFormValidation(bookingForm);
    }

    // Contact Form Handling
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', handleContactSubmit);
        setupFormValidation(contactForm);
    }

    // Admin Login Form Handling
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLoginSubmit);
        setupFormValidation(loginForm);
    }
});

// Setup real-time form validation
function setupFormValidation(form) {
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    
    inputs.forEach(input => {
        // Validate on blur
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        // Clear error on input
        input.addEventListener('input', function() {
            FormValidator.clearError(this);
        });
    });
}

// Validate individual field
function validateField(field) {
    const value = field.value.trim();
    
    switch (field.type) {
        case 'email':
            if (!FormValidator.isValidEmail(value)) {
                FormValidator.showError(field, 'Please enter a valid email address');
                return false;
            }
            break;
            
        case 'tel':
            if (!FormValidator.isValidPhone(value)) {
                FormValidator.showError(field, 'Please enter a valid phone number');
                return false;
            }
            break;
            
        case 'date':
            if (!FormValidator.isNotEmpty(value)) {
                FormValidator.showError(field, 'Please select a travel date');
                return false;
            }
            break;
            
        default:
            if (!FormValidator.isNotEmpty(value)) {
                FormValidator.showError(field, 'This field is required');
                return false;
            }
    }
    
    FormValidator.clearError(field);
    return true;
}

// Validate entire form
function validateForm(form) {
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!validateField(input)) {
            isValid = false;
        }
    });
    
    return isValid;
}

// Handle booking form submission
function handleBookingSubmit(e) {
    e.preventDefault();
    
    if (!validateForm(this)) {
        showNotification('Please fix the errors in the form', 'error');
        return;
    }
    
    const formData = new FormData(this);
    const bookingData = {
        name: formData.get('name') || document.getElementById('name').value,
        email: formData.get('email') || document.getElementById('email').value,
        phone: formData.get('phone') || document.getElementById('phone').value,
        destination: formData.get('destination') || document.getElementById('destination').value,
        travelDate: formData.get('travel-date') || document.getElementById('travel-date').value,
        persons: formData.get('persons') || document.getElementById('persons').value,
        message: formData.get('message') || document.getElementById('message').value
    };
    
    // Simulate AJAX submission
    simulateAjaxSubmission(bookingData, 'booking')
        .then(response => {
            showNotification('Booking submitted successfully! We will contact you shortly.', 'success');
            this.reset();
        })
        .catch(error => {
            showNotification('There was an error submitting your booking. Please try again.', 'error');
        });
}

// Handle contact form submission
function handleContactSubmit(e) {
    e.preventDefault();
    
    if (!validateForm(this)) {
        showNotification('Please fix the errors in the form', 'error');
        return;
    }
    
    const formData = new FormData(this);
    const contactData = {
        name: formData.get('name') || document.getElementById('contact-name').value,
        email: formData.get('email') || document.getElementById('contact-email').value,
        subject: formData.get('subject') || document.getElementById('contact-subject').value,
        message: formData.get('message') || document.getElementById('contact-message').value
    };
    
    // Simulate AJAX submission
    simulateAjaxSubmission(contactData, 'contact')
        .then(response => {
            showNotification('Message sent successfully! We will get back to you soon.', 'success');
            this.reset();
        })
        .catch(error => {
            showNotification('There was an error sending your message. Please try again.', 'error');
        });
}

// Handle admin login submission
function handleLoginSubmit(e) {
    e.preventDefault();
    
    if (!validateForm(this)) {
        showNotification('Please fix the errors in the form', 'error');
        return;
    }
    
    const formData = new FormData(this);
    const loginData = {
        username: formData.get('username') || document.getElementById('username').value,
        password: formData.get('password') || document.getElementById('password').value
    };
    
    // Simulate AJAX submission
    simulateAjaxSubmission(loginData, 'login')
        .then(response => {
            showNotification('Login successful! Redirecting to admin panel...', 'success');
            // In real implementation, redirect to admin panel
            setTimeout(() => {
                window.location.href = 'admin-panel.html';
            }, 1500);
        })
        .catch(error => {
            showNotification('Invalid username or password. Please try again.', 'error');
        });
}

// Simulate AJAX submission (to be replaced with real AJAX)
function simulateAjaxSubmission(data, type) {
    return new Promise((resolve, reject) => {
        // Simulate network delay
        setTimeout(() => {
            // Simulate successful submission 90% of the time
            if (Math.random() > 0.1) {
                resolve({
                    success: true,
                    message: `${type} submitted successfully`,
                    data: data
                });
            } else {
                reject({
                    success: false,
                    message: 'Network error occurred'
                });
            }
        }, 1000);
    });
}

// Show notification message
function showNotification(message, type = 'info') {
    // Remove existing notification
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    // Style the notification
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 4px;
        color: white;
        font-weight: 500;
        z-index: 10000;
        max-width: 400px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    // Set background color based on type
    const colors = {
        success: '#34a853',
        error: '#ea4335',
        warning: '#fbbc05',
        info: '#1a73e8'
    };
    
    notification.style.backgroundColor = colors[type] || colors.info;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 5000);
    
    // Allow manual dismissal
    notification.addEventListener('click', function() {
        this.style.transform = 'translateX(100%)';
        setTimeout(() => {
            if (this.parentNode) {
                this.parentNode.removeChild(this);
            }
        }, 300);
    });
}

// Enhanced Mobile Menu Functionality
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenu = document.querySelector('.mobile-menu');
    const navMenu = document.querySelector('.nav-menu');
    
    // Mobile menu toggle
    if (mobileMenu && navMenu) {
        mobileMenu.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            mobileMenu.textContent = navMenu.classList.contains('active') ? '✕' : '☰';
        });
    }
    
    // Set active navigation link based on current page
    function setActiveNavLink() {
        const currentPage = window.location.pathname.split('/').pop();
        const navLinks = document.querySelectorAll('.nav-link');
        
        navLinks.forEach(link => {
            const linkPage = link.getAttribute('href');
            if (linkPage === currentPage) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }
    
    setActiveNavLink();
    
    // Close mobile menu when clicking on a link
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                mobileMenu.textContent = '☰';
            }
        });
    });
});