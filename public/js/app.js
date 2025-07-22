// Common functions
function showAlert(message, type = 'success') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.role = 'alert';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    const container = document.querySelector('.container');
    container.insertBefore(alertDiv, container.firstChild);
    
    // Auto-dismiss after 5 seconds
    setTimeout(() => {
        const bsAlert = new bootstrap.Alert(alertDiv);
        bsAlert.close();
    }, 5000);
}

// Authentication
const loginForm = document.querySelector('form[action*="/login"]');
if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const email = formData.get('email');
        const password = formData.get('password');
        
        fetch('/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email, password }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.token) {
                // Store token
                localStorage.setItem('token', data.token);
                localStorage.setItem('user', JSON.stringify(data.user));
                
                // Redirect to dashboard
                window.location.href = '/';
            } else {
                showAlert('Login failed: ' + (data.message || 'Invalid credentials'), 'danger');
            }
        })
        .catch(error => {
            showAlert('Login failed: ' + error.message, 'danger');
        });
    });
}

// Logout functionality
const logoutForm = document.querySelector('form[action*="/logout"]');
if (logoutForm) {
    logoutForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch('/api/logout', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        })
        .then(() => {
            // Clear local storage
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            
            // Redirect to login
            window.location.href = '/login';
        })
        .catch(error => {
            showAlert('Logout failed: ' + error.message, 'danger');
        });
    });
}

// Setup AJAX requests with authorization
function setupAjaxAuth() {
    const token = localStorage.getItem('token');
    if (token) {
        $.ajaxSetup({
            headers: {
                'Authorization': 'Bearer ' + token
            }
        });
    }
}

// Setup token on page load
document.addEventListener('DOMContentLoaded', function() {
    setupAjaxAuth();
});

// Criteria form handling
const addCriteriaForm = document.getElementById('addCriteriaForm');
if (addCriteriaForm) {
    addCriteriaForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const data = {
            name: formData.get('name'),
            weight: parseFloat(formData.get('weight')),
            min_value: formData.get('min_value') ? parseFloat(formData.get('min_value')) : null
        };
        
        fetch('/api/criteria', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addCriteriaModal'));
            modal.hide();
            
            // Refresh page
            location.reload();
        })
        .catch(error => {
            showAlert('Failed to add criteria: ' + error.message, 'danger');
        });
    });
}

// Alternative form handling
const addAlternativeForm = document.getElementById('addAlternativeForm');
if (addAlternativeForm) {
    addAlternativeForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const name = formData.get('name');
        const criteriaValues = [];
        
        // Get all criteria values
        const criteriaInputs = this.querySelectorAll('input[name^="criteria_values"]');
        for (let i = 0; i < criteriaInputs.length; i += 2) {
            const criteriaId = parseInt(criteriaInputs[i].value);
            const value = parseFloat(criteriaInputs[i+1].value);
            criteriaValues.push({ criteria_id: criteriaId, value: value });
        }
        
        const data = {
            name: name,
            criteria_values: criteriaValues
        };
        
        fetch('/api/alternatives', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('addAlternativeModal'));
            modal.hide();
            
            // Refresh page
            location.reload();
        })
        .catch(error => {
            showAlert('Failed to add alternative: ' + error.message, 'danger');
        });
    });
}

// Calculate AHP
const calculateBtn = document.getElementById('calculateBtn');
if (calculateBtn) {
    calculateBtn.addEventListener('click', function() {
        const loading = document.getElementById('loading');
        const resultContainer = document.getElementById('result-container');
        
        loading.style.display = 'block';
        resultContainer.style.display = 'none';
        
        fetch('/api/calculate', {
            headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            }
        })
        .then(response => response.json())
        .then(data => {
            displayResults(data);
            loading.style.display = 'none';
            resultContainer.style.display = 'block';
        })
        .catch(error => {
            showAlert('Calculation failed: ' + error.message, 'danger');
            loading.style.display = 'none';
        });
    });
}

// Display AHP results
function displayResults(data) {
    const resultsTable = document.getElementById('results-table');
    if (!resultsTable) return;
    
    // Clear previous results
    resultsTable.innerHTML = '';
    
    // Add rows
    data.results.forEach(result => {
        const row = document.createElement('tr');
        if (!result.is_passed) {
            row.className = 'not-passed';
        }
        
        let rowHtml = `
            <td>${result.rank}</td>
            <td>${result.alternative_name}</td>
        `;
        
        // Add criteria values
        result.criteria_details.forEach(criterion => {
            const className = criterion.is_below_minimum ? 'below-minimum' : '';
            rowHtml += `<td class="${className}">${criterion.value.toFixed(2)}</td>`;
        });
        
        rowHtml += `
            <td>${result.score.toFixed(4)}</td>
            <td>${result.is_passed ? 'Lulus' : 'Tidak Lulus'}</td>
        `;
        
        row.innerHTML = rowHtml;
        resultsTable.appendChild(row);
    });
}