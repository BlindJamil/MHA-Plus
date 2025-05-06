// resources/js/demo-viewer.js

/**
 * Simple iframe-based demo viewer component
 * This allows showcasing static HTML demos of offline websites
 */
class DemoViewer {
    constructor() {
        this.modalElement = document.getElementById('demo-modal');
        this.iframeElement = document.getElementById('demo-iframe');
        this.closeButton = document.getElementById('close-demo');
        this.title = document.getElementById('demo-title');
        
        // Initialize event listeners
        this.init();
    }
    
    init() {
        // Get all demo buttons
        const demoButtons = document.querySelectorAll('.view-demo');
        
        // Add click event to each button
        demoButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                
                const demoId = button.getAttribute('data-demo-id');
                const demoTitle = button.getAttribute('data-demo-title');
                
                this.openDemo(demoId, demoTitle);
            });
        });
        
        // Close button event
        if (this.closeButton) {
            this.closeButton.addEventListener('click', () => {
                this.closeDemo();
            });
        }
        
        // Close when clicking outside
        if (this.modalElement) {
            this.modalElement.addEventListener('click', (e) => {
                if (e.target === this.modalElement) {
                    this.closeDemo();
                }
            });
        }
    }
    
    openDemo(demoId, demoTitle) {
        if (!this.modalElement || !this.iframeElement) return;
        
        // Set the iframe source to the demo folder
        this.iframeElement.src = `/demos/${demoId}/index.html`;
        
        // Set title
        if (this.title) {
            this.title.textContent = demoTitle;
        }
        
        // Show modal
        this.modalElement.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    
    closeDemo() {
        if (!this.modalElement) return;
        
        // Hide modal
        this.modalElement.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        
        // Clear iframe after a short delay to prevent flicker
        setTimeout(() => {
            if (this.iframeElement) {
                this.iframeElement.src = 'about:blank';
            }
        }, 300);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new DemoViewer();
});