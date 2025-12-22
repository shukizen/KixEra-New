<!-- Footer -->
    <footer class="bg-white border-t border-gray-200 p-6 mt-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="text-sm text-gray-600 mb-2 md:mb-0">
                © 2025 Kixera. All rights reserved.
            </div>
            <div class="text-sm text-gray-500">
                Version 1.0.0 | Last Login: 
                <?php if($this->session->userdata('user_id')): ?>
                    <?= date('d M Y H:i') ?>
                <?php endif; ?>
            </div>
        </div>
    </footer>
</main>

</div> <!-- End of main-layout -->

<!-- Mobile Menu Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide Icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
    
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    
    if (mobileMenuBtn && sidebar && mainContent) {
        mobileMenuBtn.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            mainContent.classList.toggle('sidebar-open');
        });
    
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                if (sidebar && mainContent && mobileMenuBtn) {
                    if (!sidebar.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                        sidebar.classList.remove('open');
                        mainContent.classList.remove('sidebar-open');
                    }
                }
            }
        });
    
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768 && sidebar && mainContent) {
                sidebar.classList.remove('open');
                mainContent.classList.remove('sidebar-open');
            }
        });
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Global function to refresh icons (useful after AJAX content loads)
function refreshIcons() {
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
}

// Helper function for showing notifications
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500 text-white' : 
        type === 'error' ? 'bg-red-500 text-white' : 
        'bg-blue-500 text-white'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.remove();
    }, 5000);
    
    // Click to close
    notification.addEventListener('click', () => {
        notification.remove();
    });
}

// Handle form submissions with loading states
document.addEventListener('submit', function(e) {
    const form = e.target;
    const submitBtn = form.querySelector('button[type="submit"]');
    
    if (submitBtn && !form.hasAttribute('data-no-loading')) {
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 mr-2 animate-spin"></i>Processing...';
        refreshIcons();
        
        // Re-enable button after 10 seconds as fallback
        setTimeout(() => {
            submitBtn.disabled = false;
            submitBtn.textContent = originalText;
        }, 10000);
    }
});
</script>

</body>
</html>