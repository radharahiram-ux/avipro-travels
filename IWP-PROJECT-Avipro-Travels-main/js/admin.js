// Admin Panel JavaScript for Avipro Travels

document.addEventListener('DOMContentLoaded', function() {
    initializeAdminPanel();
    setupAdminEventListeners();
    loadDashboardStats();
});

// Initialize admin panel
function initializeAdminPanel() {
    // Set active menu item based on current page
    const currentPage = window.location.pathname.split('/').pop();
    const menuItems = document.querySelectorAll('.admin-menu a');
    
    menuItems.forEach(item => {
        if (item.getAttribute('href') === currentPage) {
            item.classList.add('active');
        }
    });
    
    // Initialize data tables if they exist
    initializeDataTables();
}

// Setup admin event listeners
function setupAdminEventListeners() {
    // Package management form
    const packageForm = document.getElementById('package-form');
    if (packageForm) {
        packageForm.addEventListener('submit', handlePackageSubmit);
    }
    
    // Image upload handling
    const imageUploads = document.querySelectorAll('input[type="file"]');
    imageUploads.forEach(upload => {
        upload.addEventListener('change', handleImageUpload);
    });
    
    // Delete confirmation
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', handleDelete);
    });
}

// Initialize data tables with sample data
function initializeDataTables() {
    // This would typically load data from an API
    console.log('Initializing admin data tables...');
}

// Load dashboard statistics
function loadDashboardStats() {
    // Simulate loading stats from API
    setTimeout(() => {
        const stats = {
            totalPackages: 24,
            totalBookings: 156,
            pendingEnquiries: 42,
            revenue: 45800
        };
        
        updateStatsDisplay(stats);
    }, 1000);
}

// Update stats display
function updateStatsDisplay(stats) {
    const statElements = {
        totalPackages: document.querySelector('.stat-total-packages'),
        totalBookings: document.querySelector('.stat-total-bookings'),
        pendingEnquiries: document.querySelector('.stat-pending-enquiries'),
        revenue: document.querySelector('.stat-revenue')
    };
    
    for (const [key, element] of Object.entries(statElements)) {
        if (element) {
            element.textContent = stats[key];
        }
    }
}

// Handle package form submission
function handlePackageSubmit(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const packageData = {
        title: formData.get('title'),
        description: formData.get('description'),
        price: formData.get('price'),
        duration: formData.get('duration'),
        destination: formData.get('destination'),
        image: formData.get('image')
    };
    
    // Validate form data
    if (!validatePackageData(packageData)) {
        showNotification('Please fill in all required fields correctly', 'error');
        return;
    }
    
    // Simulate API call
    simulateAdminAjax('packages', packageData)
        .then(response => {
            showNotification('Package saved successfully!', 'success');
            this.reset();
            // Refresh packages list
            loadPackagesList();
        })
        .catch(error => {
            showNotification('Error saving package: ' + error.message, 'error');
        });
}

// Validate package data
function validatePackageData(data) {
    if (!data.title || !data.description || !data.price || !data.duration) {
        return false;
    }
    
    if (isNaN(parseFloat(data.price)) || parseFloat(data.price) <= 0) {
        return false;
    }
    
    return true;
}

// Handle image upload
function handleImageUpload(e) {
    const file = e.target.files[0];
    if (!file) return;
    
    // Validate file type
    const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!validTypes.includes(file.type)) {
        showNotification('Please select a valid image file (JPEG, PNG, GIF)', 'error');
        e.target.value = '';
        return;
    }
    
    // Validate file size (max 5MB)
    if (file.size > 5 * 1024 * 1024) {
        showNotification('Image size must be less than 5MB', 'error');
        e.target.value = '';
        return;
    }
    
    // Show preview if possible
    const previewContainer = e.target.closest('.form-group').querySelector('.image-preview');
    if (previewContainer) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 200px; max-height: 150px;">`;
        };
        reader.readAsDataURL(file);
    }
    
    showNotification('Image selected successfully', 'success');
}

// Handle delete operations
function handleDelete(e) {
    e.preventDefault();
    
    const itemType = e.target.closest('tr').querySelector('td:nth-child(2)').textContent;
    const itemId = e.target.closest('tr').querySelector('td:nth-child(1)').textContent;
    
    if (confirm(`Are you sure you want to delete ${itemType} (${itemId})? This action cannot be undone.`)) {
        // Simulate delete operation
        simulateAdminAjax('delete', { id: itemId, type: 'package' })
            .then(response => {
                showNotification('Item deleted successfully', 'success');
                e.target.closest('tr').remove();
            })
            .catch(error => {
                showNotification('Error deleting item: ' + error.message, 'error');
            });
    }
}

// Simulate admin AJAX calls
function simulateAdminAjax(endpoint, data) {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            // Simulate successful operation 90% of the time
            if (Math.random() > 0.1) {
                resolve({
                    success: true,
                    message: 'Operation completed successfully',
                    data: data
                });
            } else {
                reject(new Error('Server error occurred'));
            }
        }, 1500);
    });
}

// Load packages list (simulated)
function loadPackagesList() {
    // This would typically make an API call to get packages
    console.log('Refreshing packages list...');
}

// Logout functionality
function adminLogout() {
    if (confirm('Are you sure you want to logout?')) {
        // Simulate logout API call
        simulateAdminAjax('logout', {})
            .then(() => {
                showNotification('Logged out successfully', 'success');
                setTimeout(() => {
                    window.location.href = 'admin-login.html';
                }, 1000);
            })
            .catch(error => {
                showNotification('Error during logout', 'error');
            });
    }
}

// Export for use in other files
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initializeAdminPanel,
        handlePackageSubmit,
        adminLogout
    };
}