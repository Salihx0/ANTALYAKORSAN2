/**
 * ADMİN PANELİ JAVASCRIPT
 * Antalya Korsan Taksi
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

(function() {
    'use strict';

    // ============================================
    // SIDEBAR TOGGLE (Mobile)
    // ============================================
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            sidebarOverlay.classList.toggle('show');
        });
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });
    }

    // ============================================
    // DROPDOWN MENUS
    // ============================================
    const dropdowns = document.querySelectorAll('.header-item.dropdown');
    
    dropdowns.forEach(dropdown => {
        const btn = dropdown.querySelector('.header-btn');
        const menu = dropdown.querySelector('.dropdown-menu');
        
        if (btn && menu) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                
                // Close other dropdowns
                dropdowns.forEach(d => {
                    if (d !== dropdown) {
                        const m = d.querySelector('.dropdown-menu');
                        if (m) m.classList.remove('show');
                    }
                });
                
                // Toggle current dropdown
                menu.classList.toggle('show');
            });
        }
    });

    // Close dropdowns on outside click
    document.addEventListener('click', function() {
        document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
            menu.classList.remove('show');
        });
    });

    // Prevent dropdown close on inside click
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        menu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    });

    // ============================================
    // GLOBAL SEARCH
    // ============================================
    const globalSearch = document.getElementById('globalSearch');
    
    if (globalSearch) {
        // Keyboard shortcut (Ctrl/Cmd + K)
        document.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                globalSearch.focus();
            }
            
            // ESC to clear
            if (e.key === 'Escape' && document.activeElement === globalSearch) {
                globalSearch.value = '';
                globalSearch.blur();
            }
        });

        // Search functionality (can be enhanced with AJAX)
        globalSearch.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            // Implement search logic here
            console.log('Searching for:', query);
        });
    }

    // ============================================
    // MARK NOTIFICATIONS AS READ
    // ============================================
    const markReadBtn = document.querySelector('.mark-read');
    
    if (markReadBtn) {
        markReadBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove unread class from all notifications
            document.querySelectorAll('.notification-item.unread').forEach(item => {
                item.classList.remove('unread');
            });
            
            // Remove badge dot
            const badgeDot = document.querySelector('.header-btn .badge-dot');
            if (badgeDot) {
                badgeDot.remove();
            }
            
            // Show success message
            showToast('Tüm bildirimler okundu olarak işaretlendi', 'success');
        });
    }

    // ============================================
    // DATA TABLE ACTIONS
    // ============================================
    const actionButtons = document.querySelectorAll('.btn-icon');
    
    actionButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const icon = this.querySelector('i');
            
            if (icon.classList.contains('fa-eye')) {
                // View action
                console.log('View clicked');
            } else if (icon.classList.contains('fa-edit')) {
                // Edit action
                console.log('Edit clicked');
            } else if (icon.classList.contains('fa-trash')) {
                // Delete action
                if (confirm('Bu öğeyi silmek istediğinizden emin misiniz?')) {
                    console.log('Delete confirmed');
                    showToast('Öğe başarıyla silindi', 'success');
                }
            }
        });
    });

    // ============================================
    // TOAST NOTIFICATIONS
    // ============================================
    function showToast(message, type = 'info') {
        // Create toast container if not exists
        let toastContainer = document.querySelector('.toast-container');
        
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'toast-container';
            toastContainer.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
            `;
            document.body.appendChild(toastContainer);
        }

        // Create toast
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.style.cssText = `
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 300px;
            animation: slideIn 0.3s ease;
        `;

        // Icon based on type
        const icons = {
            success: '<i class="fas fa-check-circle" style="color: #43e97b; font-size: 20px;"></i>',
            error: '<i class="fas fa-exclamation-circle" style="color: #f5576c; font-size: 20px;"></i>',
            warning: '<i class="fas fa-exclamation-triangle" style="color: #ffa726; font-size: 20px;"></i>',
            info: '<i class="fas fa-info-circle" style="color: #4facfe; font-size: 20px;"></i>'
        };

        toast.innerHTML = `
            ${icons[type] || icons.info}
            <span style="flex: 1; font-size: 14px;">${message}</span>
            <button onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; font-size: 18px; color: #999;">
                <i class="fas fa-times"></i>
            </button>
        `;

        toastContainer.appendChild(toast);

        // Auto remove after 5 seconds
        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }

    // Add animation styles
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);

    // Make showToast globally available
    window.showToast = showToast;

    // ============================================
    // FORM VALIDATION
    // ============================================
    const forms = document.querySelectorAll('form[data-validate]');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            
            // Check required fields
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    
                    // Show error message
                    let errorMsg = field.nextElementSibling;
                    if (!errorMsg || !errorMsg.classList.contains('error-message')) {
                        errorMsg = document.createElement('span');
                        errorMsg.className = 'error-message';
                        errorMsg.style.cssText = 'color: #f5576c; font-size: 12px; margin-top: 5px; display: block;';
                        errorMsg.textContent = 'Bu alan zorunludur';
                        field.parentNode.insertBefore(errorMsg, field.nextSibling);
                    }
                } else {
                    field.classList.remove('error');
                    const errorMsg = field.nextElementSibling;
                    if (errorMsg && errorMsg.classList.contains('error-message')) {
                        errorMsg.remove();
                    }
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                showToast('Lütfen tüm zorunlu alanları doldurun', 'error');
            }
        });
    });

    // ============================================
    // AUTO-SAVE DRAFT
    // ============================================
    const autoSaveForms = document.querySelectorAll('form[data-autosave]');
    
    autoSaveForms.forEach(form => {
        const formId = form.getAttribute('data-autosave');
        
        // Load saved data
        const savedData = localStorage.getItem(`draft_${formId}`);
        if (savedData) {
            try {
                const data = JSON.parse(savedData);
                Object.keys(data).forEach(key => {
                    const field = form.querySelector(`[name="${key}"]`);
                    if (field) field.value = data[key];
                });
            } catch (e) {
                console.error('Error loading draft:', e);
            }
        }
        
        // Auto-save on input
        let saveTimeout;
        form.addEventListener('input', function() {
            clearTimeout(saveTimeout);
            saveTimeout = setTimeout(() => {
                const formData = new FormData(form);
                const data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });
                localStorage.setItem(`draft_${formId}`, JSON.stringify(data));
                console.log('Draft saved');
            }, 1000);
        });
    });

    // ============================================
    // CONFIRM DIALOGS
    // ============================================
    const confirmButtons = document.querySelectorAll('[data-confirm]');
    
    confirmButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            const message = this.getAttribute('data-confirm');
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });

    // ============================================
    // COPY TO CLIPBOARD
    // ============================================
    const copyButtons = document.querySelectorAll('[data-copy]');
    
    copyButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const text = this.getAttribute('data-copy');
            navigator.clipboard.writeText(text).then(() => {
                showToast('Panoya kopyalandı', 'success');
            }).catch(err => {
                console.error('Copy failed:', err);
                showToast('Kopyalama başarısız', 'error');
            });
        });
    });

    // ============================================
    // INITIALIZE
    // ============================================
    console.log('Admin panel initialized');
    
    // Show welcome message on first load
    if (sessionStorage.getItem('welcomeShown') !== 'true') {
        setTimeout(() => {
            showToast('Admin paneline hoş geldiniz!', 'success');
            sessionStorage.setItem('welcomeShown', 'true');
        }, 500);
    }

})();
