document.addEventListener('DOMContentLoaded', function() {
    // Simulate loading (since POWr doesn't provide a load event)
    const simulateLoading = () => {
        const loadingElement = document.getElementById('loading-comments');
        if (loadingElement) {
            // Hide loading after 3 seconds (simulate real loading)
            setTimeout(() => {
                loadingElement.style.opacity = '0';
                setTimeout(() => {
                    loadingElement.style.display = 'none';
                }, 500);
            }, 3000);
        }
    };
    
    // Add hover effect to header
    const header = document.querySelector('.header-content');
    if (header) {
        header.addEventListener('mouseenter', () => {
            header.style.boxShadow = '0 10px 40px rgba(67, 97, 238, 0.2)';
        });
        
        header.addEventListener('mouseleave', () => {
            header.style.boxShadow = 'var(--card-shadow)';
        });
    }
    
    // Add click effect to buttons
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('mousedown', () => {
            button.style.transform = 'translateY(1px)';
        });
        
        button.addEventListener('mouseup', () => {
            button.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', () => {
            button.style.transform = 'translateY(0)';
        });
    });
    
    // Initialize
    simulateLoading();
    
    // Add animation to bubbles
    const bubbles = document.querySelectorAll('.bubble');
    bubbles.forEach((bubble, index) => {
        // Random movement parameters
        const duration = 20 + Math.random() * 20;
        const delay = Math.random() * 5;
        const xMovement = 10 + Math.random() * 30;
        const yMovement = 10 + Math.random() * 30;
        
        bubble.style.animation = 
            `float ${duration}s ease-in-out ${delay}s infinite alternate`;
        
        // Generate keyframes dynamically
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes float {
                0% { transform: translate(0, 0); }
                50% { transform: translate(${xMovement}px, ${yMovement}px); }
                100% { transform: translate(0, 0); }
            }
        `;
        document.head.appendChild(style);
    });
});