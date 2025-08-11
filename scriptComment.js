// Database simulation (in a real app, you would use a backend API)
let users = JSON.parse(localStorage.getItem('users')) || [];
let comments = JSON.parse(localStorage.getItem('comments')) || [];
let currentUser = JSON.parse(localStorage.getItem('currentUser')) || null;

// DOM Elements
const authModal = document.getElementById('auth-modal');
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const loginTab = document.getElementById('login-tab');
const registerTab = document.getElementById('register-tab');
const closeAuth = document.querySelector('.close-auth');
const loginBtn = document.getElementById('login-btn');
const registerBtn = document.getElementById('register-btn');
const userInfo = document.getElementById('user-info');
const welcomeMessage = document.getElementById('welcome-message');
const logoutBtn = document.getElementById('logout-btn');
const commentForm = document.getElementById('comment-form');
const commentsList = document.getElementById('comments-list');
const submitCommentBtn = document.getElementById('submit-comment');

// Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    checkAuthStatus();
    renderComments();
    
    // Show auth modal if not logged in when trying to comment
    commentForm.addEventListener('submit', (e) => {
        e.preventDefault();
        if (!currentUser) {
            showAuthModal();
            return;
        }
        submitComment();
    });
});

// Auth Modal Functions
function showAuthModal() {
    authModal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function hideAuthModal() {
    authModal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

loginTab.addEventListener('click', () => {
    loginTab.classList.add('active');
    registerTab.classList.remove('active');
    loginForm.style.display = 'block';
    registerForm.style.display = 'none';
});

registerTab.addEventListener('click', () => {
    registerTab.classList.add('active');
    loginTab.classList.remove('active');
    registerForm.style.display = 'block';
    loginForm.style.display = 'none';
});

closeAuth.addEventListener('click', hideAuthModal);
window.addEventListener('click', (e) => {
    if (e.target === authModal) {
        hideAuthModal();
    }
});

// Auth Functions
loginBtn.addEventListener('click', (e) => {
    e.preventDefault();
    const email = document.getElementById('login-email').value;
    const password = document.getElementById('login-password').value;
    
    if (!email || !password) {
        showAlert('Please fill in all fields', 'error');
        return;
    }
    
    const user = users.find(u => u.email === email && u.password === password);
    if (user) {
        currentUser = user;
        localStorage.setItem('currentUser', JSON.stringify(currentUser));
        hideAuthModal();
        checkAuthStatus();
        showAlert('Logged in successfully!', 'success');
    } else {
        showAlert('Invalid email or password', 'error');
    }
});

registerBtn.addEventListener('click', (e) => {
    e.preventDefault();
    const firstName = document.getElementById('register-firstname').value;
    const lastName = document.getElementById('register-lastname').value;
    const email = document.getElementById('register-email').value;
    const password = document.getElementById('register-password').value;
    
    if (!firstName || !lastName || !email || !password) {
        showAlert('Please fill in all fields', 'error');
        return;
    }
    
    if (users.some(u => u.email === email)) {
        showAlert('Email already registered', 'error');
        return;
    }
    
    const newUser = {
        id: Date.now().toString(),
        firstName,
        lastName,
        email,
        password
    };
    
    users.push(newUser);
    localStorage.setItem('users', JSON.stringify(users));
    
    currentUser = newUser;
    localStorage.setItem('currentUser', JSON.stringify(currentUser));
    
    hideAuthModal();
    checkAuthStatus();
    showAlert('Account created successfully!', 'success');
    
    // Clear form
    document.getElementById('register-firstname').value = '';
    document.getElementById('register-lastname').value = '';
    document.getElementById('register-email').value = '';
    document.getElementById('register-password').value = '';
});

logoutBtn.addEventListener('click', () => {
    currentUser = null;
    localStorage.removeItem('currentUser');
    checkAuthStatus();
    showAlert('Logged out successfully', 'success');
});

// Comment Functions
function submitComment() {
    const title = document.getElementById('comment-title').value;
    const text = document.getElementById('comment-text').value;
    
    if (!title || !text) {
        showAlert('Please fill in all fields', 'error');
        return;
    }
    
    const newComment = {
        id: Date.now().toString(),
        userId: currentUser.id,
        userFirstName: currentUser.firstName,
        userLastName: currentUser.lastName,
        title,
        text,
        date: new Date().toISOString()
    };
    
    comments.unshift(newComment);
    localStorage.setItem('comments', JSON.stringify(comments));
    
    renderComments();
    showAlert('Comment posted successfully!', 'success');
    
    // Clear form
    document.getElementById('comment-title').value = '';
    document.getElementById('comment-text').value = '';
    
    // Add animation to the new comment
    const firstComment = document.querySelector('.comment-card');
    if (firstComment) {
        firstComment.classList.add('pulse-animation');
        setTimeout(() => {
            firstComment.classList.remove('pulse-animation');
        }, 1000);
    }
}

function renderComments() {
    commentsList.innerHTML = '';
    
    if (comments.length === 0) {
        commentsList.innerHTML = '<p class="no-comments">No comments yet. Be the first to share your thoughts!</p>';
        return;
    }
    
    comments.forEach(comment => {
        const commentElement = document.createElement('div');
        commentElement.className = 'comment-card';
        
        const isCurrentUserComment = currentUser && comment.userId === currentUser.id;
        
        commentElement.innerHTML = `
            <div class="comment-header">
                <span class="comment-author">${comment.userFirstName} ${comment.userLastName}</span>
                <span class="comment-date">${formatDate(comment.date)}</span>
            </div>
            <h3 class="comment-title">${comment.title}</h3>
            <p class="comment-text">${comment.text}</p>
            ${isCurrentUserComment ? `
            <div class="comment-actions">
                <button class="delete-btn" data-id="${comment.id}">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </div>
            ` : ''}
        `;
        
        commentsList.appendChild(commentElement);
    });
    
    // Add event listeners to delete buttons
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const commentId = e.target.closest('.delete-btn').getAttribute('data-id');
            deleteComment(commentId);
        });
    });
}

function deleteComment(commentId) {
    if (!confirm('Are you sure you want to delete this comment?')) return;
    
    comments = comments.filter(comment => comment.id !== commentId);
    localStorage.setItem('comments', JSON.stringify(comments));
    renderComments();
    showAlert('Comment deleted successfully', 'success');
}

// Helper Functions
function checkAuthStatus() {
    if (currentUser) {
        userInfo.style.display = 'block';
        welcomeMessage.textContent = `Welcome, ${currentUser.firstName}!`;
        commentForm.style.display = 'block';
    } else {
        userInfo.style.display = 'none';
        commentForm.style.display = 'block'; // Show form but will check on submit
    }
}

function formatDate(dateString) {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(dateString).toLocaleDateString('en-US', options);
}

function showAlert(message, type) {
    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    alert.textContent = message;
    document.body.appendChild(alert);
    
    setTimeout(() => {
        alert.classList.add('fade-out');
        setTimeout(() => {
            alert.remove();
        }, 500);
    }, 3000);
}

// Add CSS for alerts dynamically
const style = document.createElement('style');
style.textContent = `
    .alert {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 5px;
        color: white;
        z-index: 1000;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        animation: slideIn 0.3s ease-out;
    }
    
    .alert-error {
        background-color: var(--error-color);
    }
    
    .alert-success {
        background-color: var(--success-color);
    }
    
    .fade-out {
        animation: fadeOut 0.5s ease-out forwards;
    }
    
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    
    .pulse-animation {
        animation: pulse 0.5s ease-in-out;
    }
`;
document.head.appendChild(style);