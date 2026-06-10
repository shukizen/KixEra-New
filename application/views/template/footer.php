<!-- Footer -->
    <footer class="bg-white border-t border-gray-200 p-6 mt-auto">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="text-sm text-gray-600 mb-2 md:mb-0">
                © 2026 Kixera. All rights reserved.
            </div>
            <div class="text-sm text-gray-500">
                Version 2.0.26 | Last Login: 
                <?php if($this->session->userdata('id_user') && $this->session->userdata('login_time')): ?>
                    <?= date('d M Y H:i', $this->session->userdata('login_time')) ?>
                <?php else: ?>
                    <?= date('d M Y H:i') ?>
                <?php endif; ?>
            </div>
        </div>
    </footer>
</main>

</div> <!-- End of main-layout -->

<!-- Mobile Menu Script & Theme Toggle -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide Icons
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // ==========================================
    // Dark Mode Theme Toggle Implementation
    // ==========================================
    const themeToggleBtn = document.getElementById('themeToggleBtn');
    const themeToggleCheckbox = document.getElementById('themeToggleCheckbox');
    const themeToggleIcon = document.getElementById('themeToggleIcon');
    const themeToggleText = document.getElementById('themeToggleText');
    
    // Set initial UI state of the switch based on active theme
    function updateThemeToggleUI(isDark) {
        if (themeToggleCheckbox) {
            themeToggleCheckbox.checked = isDark;
        }
        if (themeToggleIcon) {
            if (isDark) {
                themeToggleIcon.classList.remove('fa-moon');
                themeToggleIcon.classList.add('fa-sun');
                if (themeToggleText) themeToggleText.textContent = 'Mode Terang';
            } else {
                themeToggleIcon.classList.remove('fa-sun');
                themeToggleIcon.classList.add('fa-moon');
                if (themeToggleText) themeToggleText.textContent = 'Mode Gelap';
            }
        }
    }

    // Function to dynamically update Chart.js colors in real-time
    function updateChartJsColors(isDark) {
        if (typeof Chart !== 'undefined') {
            // Update global defaults for any new charts
            Chart.defaults.color = isDark ? '#94a3b8' : '#64748b';
            Chart.defaults.borderColor = isDark ? '#334155' : '#e2e8f0';
            if (Chart.defaults.scale && Chart.defaults.scale.grid) {
                Chart.defaults.scale.grid.color = isDark ? '#334155' : '#e2e8f0';
            }
            
            // Loop through existing Chart.js instances and update them live
            if (Chart.instances) {
                Object.keys(Chart.instances).forEach(key => {
                    const chart = Chart.instances[key];
                    
                    // Update scales
                    if (chart.options.scales) {
                        Object.keys(chart.options.scales).forEach(scaleKey => {
                            const scale = chart.options.scales[scaleKey];
                            if (scale.ticks) {
                                scale.ticks.color = isDark ? '#94a3b8' : '#64748b';
                            }
                            if (scale.grid) {
                                scale.grid.color = isDark ? '#334155' : '#e2e8f0';
                            }
                        });
                    }
                    
                    // Update legend label color
                    if (chart.options.plugins && chart.options.plugins.legend && chart.options.plugins.legend.labels) {
                        chart.options.plugins.legend.labels.color = isDark ? '#cbd5e1' : '#334155';
                    }
                    
                    chart.update();
                });
            }
        }
    }

    const currentThemeIsDark = document.documentElement.classList.contains('dark');
    updateThemeToggleUI(currentThemeIsDark);
    updateChartJsColors(currentThemeIsDark);

    if (themeToggleBtn && themeToggleCheckbox) {
        // Handle full button area click
        themeToggleBtn.addEventListener('click', function(e) {
            // If the target is the checkbox itself, let it handle the event
            if (e.target === themeToggleCheckbox) {
                return;
            }
            themeToggleCheckbox.click();
        });

        // Handle checkbox change event
        themeToggleCheckbox.addEventListener('change', function() {
            if (themeToggleCheckbox.checked) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                updateThemeToggleUI(true);
                updateChartJsColors(true);
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                updateThemeToggleUI(false);
                updateChartJsColors(false);
            }
        });
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