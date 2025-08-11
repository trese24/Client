document.getElementById('commentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    const notificationArea = document.getElementById('notificationArea');
    
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            notificationArea.innerHTML = '<div class="success-message">'+data.message+'</div>';
            
            // Clear the form
            form.reset();
            
            // Reload comments after a short delay
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            // Show error message
            notificationArea.innerHTML = '<div class="error-message">'+data.message+'</div>';
        }
    })
    .catch(error => {
        notificationArea.innerHTML = '<div class="error-message">An error occurred. Please try again.</div>';
    });
});