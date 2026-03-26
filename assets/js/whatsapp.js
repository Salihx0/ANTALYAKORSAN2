/**
 * WHATSAPP WIDGET JAVASCRIPT
 * Antalya Korsan Taksi - WhatsApp Entegrasyonu
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

(function() {
    'use strict';

    // WhatsApp ayarları
    const WHATSAPP_CONFIG = {
        phone: '+905070073210',
        defaultMessage: 'Merhaba, Antalya Korsan Taksi hakkında bilgi almak istiyorum.',
        position: 'bottom-right', // bottom-right, bottom-left, top-right, top-left
        showDelay: 3000, // 3 saniye sonra göster
        pulseInterval: 10000, // 10 saniyede bir pulse animasyonu
        autoOpen: false // Otomatik chat penceresi açma
    };

    // Widget durumu
    let isWidgetVisible = false;
    let isChatOpen = false;
    let pulseIntervalId = null;

    /**
     * WhatsApp widget oluştur
     */
    function createWidget() {
        // Zaten varsa oluşturma
        if (document.querySelector('.whatsapp-widget')) return;

        const widget = document.createElement('div');
        widget.className = 'whatsapp-widget';
        widget.innerHTML = `
            <div class="whatsapp-float" id="whatsappFloat">
                <i class="fab fa-whatsapp"></i>
                <span class="whatsapp-badge">1</span>
            </div>
            
            <div class="whatsapp-chat" id="whatsappChat">
                <div class="whatsapp-chat-header">
                    <div class="whatsapp-chat-avatar">
                        <img src="assets/images/logo.png" alt="Antalya Korsan Taksi">
                        <span class="whatsapp-online-status"></span>
                    </div>
                    <div class="whatsapp-chat-info">
                        <h4>Antalya Korsan Taksi</h4>
                        <p>Genellikle birkaç dakika içinde yanıt verir</p>
                    </div>
                    <button class="whatsapp-chat-close" id="whatsappChatClose">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="whatsapp-chat-body">
                    <div class="whatsapp-message whatsapp-message-received">
                        <p>Merhaba! 👋</p>
                        <p>Antalya Korsan Taksi'ye hoş geldiniz. Size nasıl yardımcı olabiliriz?</p>
                        <span class="whatsapp-message-time">${getCurrentTime()}</span>
                    </div>
                    
                    <div class="whatsapp-quick-replies">
                        <button class="whatsapp-quick-reply" data-message="Araç çağırmak istiyorum">
                            🚕 Araç Çağır
                        </button>
                        <button class="whatsapp-quick-reply" data-message="Fiyat bilgisi almak istiyorum">
                            💰 Fiyat Bilgisi
                        </button>
                        <button class="whatsapp-quick-reply" data-message="Havalimanı transferi hakkında bilgi almak istiyorum">
                            ✈️ Havalimanı Transfer
                        </button>
                    </div>
                </div>
                
                <div class="whatsapp-chat-footer">
                    <input type="text" 
                           class="whatsapp-input" 
                           id="whatsappInput" 
                           placeholder="Mesajınızı yazın...">
                    <button class="whatsapp-send-btn" id="whatsappSendBtn">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        `;

        document.body.appendChild(widget);
        
        // Event listeners
        setupEventListeners();
        
        // Gecikmeli göster
        setTimeout(() => {
            showWidget();
        }, WHATSAPP_CONFIG.showDelay);
        
        // Pulse animasyonu başlat
        startPulseAnimation();
    }

    /**
     * Event listeners
     */
    function setupEventListeners() {
        const floatBtn = document.getElementById('whatsappFloat');
        const chatClose = document.getElementById('whatsappChatClose');
        const sendBtn = document.getElementById('whatsappSendBtn');
        const input = document.getElementById('whatsappInput');
        const quickReplies = document.querySelectorAll('.whatsapp-quick-reply');

        // Float button click
        if (floatBtn) {
            floatBtn.addEventListener('click', toggleChat);
        }

        // Close button click
        if (chatClose) {
            chatClose.addEventListener('click', closeChat);
        }

        // Send button click
        if (sendBtn) {
            sendBtn.addEventListener('click', sendMessage);
        }

        // Input enter key
        if (input) {
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    sendMessage();
                }
            });
        }

        // Quick replies
        quickReplies.forEach(btn => {
            btn.addEventListener('click', () => {
                const message = btn.getAttribute('data-message');
                openWhatsApp(message);
            });
        });
    }

    /**
     * Widget'ı göster
     */
    function showWidget() {
        const widget = document.querySelector('.whatsapp-widget');
        if (widget) {
            widget.classList.add('visible');
            isWidgetVisible = true;
        }
    }

    /**
     * Widget'ı gizle
     */
    function hideWidget() {
        const widget = document.querySelector('.whatsapp-widget');
        if (widget) {
            widget.classList.remove('visible');
            isWidgetVisible = false;
        }
    }

    /**
     * Chat'i aç/kapat
     */
    function toggleChat() {
        if (isChatOpen) {
            closeChat();
        } else {
            openChat();
        }
    }

    /**
     * Chat'i aç
     */
    function openChat() {
        const chat = document.getElementById('whatsappChat');
        const floatBtn = document.getElementById('whatsappFloat');
        
        if (chat && floatBtn) {
            chat.classList.add('open');
            floatBtn.classList.add('chat-open');
            isChatOpen = true;
            
            // Badge'i gizle
            const badge = floatBtn.querySelector('.whatsapp-badge');
            if (badge) badge.style.display = 'none';
            
            // Input'a focus
            const input = document.getElementById('whatsappInput');
            if (input) {
                setTimeout(() => input.focus(), 300);
            }
        }
    }

    /**
     * Chat'i kapat
     */
    function closeChat() {
        const chat = document.getElementById('whatsappChat');
        const floatBtn = document.getElementById('whatsappFloat');
        
        if (chat && floatBtn) {
            chat.classList.remove('open');
            floatBtn.classList.remove('chat-open');
            isChatOpen = false;
        }
    }

    /**
     * Mesaj gönder
     */
    function sendMessage() {
        const input = document.getElementById('whatsappInput');
        if (!input) return;
        
        const message = input.value.trim();
        if (!message) return;
        
        openWhatsApp(message);
        input.value = '';
    }

    /**
     * WhatsApp'ı aç
     */
    function openWhatsApp(message = WHATSAPP_CONFIG.defaultMessage) {
        const phone = WHATSAPP_CONFIG.phone.replace(/[^0-9]/g, '');
        const encodedMessage = encodeURIComponent(message);
        const url = `https://wa.me/${phone}?text=${encodedMessage}`;
        
        window.open(url, '_blank');
        
        // Analytics tracking
        if (typeof gtag !== 'undefined') {
            gtag('event', 'whatsapp_click', {
                'event_category': 'engagement',
                'event_label': message
            });
        }
    }

    /**
     * Pulse animasyonu başlat
     */
    function startPulseAnimation() {
        pulseIntervalId = setInterval(() => {
            const floatBtn = document.getElementById('whatsappFloat');
            if (floatBtn && !isChatOpen) {
                floatBtn.classList.add('pulse');
                setTimeout(() => {
                    floatBtn.classList.remove('pulse');
                }, 1000);
            }
        }, WHATSAPP_CONFIG.pulseInterval);
    }

    /**
     * Pulse animasyonu durdur
     */
    function stopPulseAnimation() {
        if (pulseIntervalId) {
            clearInterval(pulseIntervalId);
            pulseIntervalId = null;
        }
    }

    /**
     * Mevcut zamanı al
     */
    function getCurrentTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        return `${hours}:${minutes}`;
    }

    /**
     * Scroll durumuna göre widget pozisyonu
     */
    function handleScroll() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const widget = document.querySelector('.whatsapp-widget');
        
        if (widget) {
            if (scrollTop > 300) {
                widget.classList.add('scrolled');
            } else {
                widget.classList.remove('scrolled');
            }
        }
    }

    /**
     * Sayfa görünürlüğü değiştiğinde
     */
    function handleVisibilityChange() {
        if (document.hidden) {
            stopPulseAnimation();
        } else {
            startPulseAnimation();
        }
    }

    /**
     * Otomatik mesajlar
     */
    function setupAutoMessages() {
        // Sayfa 30 saniye açık kaldıysa mesaj göster
        setTimeout(() => {
            if (!isChatOpen) {
                showNotification('Yardıma mı ihtiyacınız var? 🚕');
            }
        }, 30000);
        
        // Sayfa 60 saniye açık kaldıysa özel teklif
        setTimeout(() => {
            if (!isChatOpen) {
                showNotification('Hemen rezervasyon yapın, %10 indirim kazanın! 🎉');
            }
        }, 60000);
    }

    /**
     * Bildirim göster
     */
    function showNotification(message) {
        const floatBtn = document.getElementById('whatsappFloat');
        if (!floatBtn) return;
        
        const notification = document.createElement('div');
        notification.className = 'whatsapp-notification';
        notification.textContent = message;
        
        floatBtn.parentElement.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }

    /**
     * CSS stilleri ekle
     */
    function addStyles() {
        const style = document.createElement('style');
        style.textContent = `
            .whatsapp-widget {
                position: fixed;
                ${WHATSAPP_CONFIG.position.includes('bottom') ? 'bottom: 20px;' : 'top: 20px;'}
                ${WHATSAPP_CONFIG.position.includes('right') ? 'right: 20px;' : 'left: 20px;'}
                z-index: 9999;
                opacity: 0;
                transform: scale(0);
                transition: all 0.3s ease;
            }
            
            .whatsapp-widget.visible {
                opacity: 1;
                transform: scale(1);
            }
            
            .whatsapp-float {
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, #25D366, #128C7E);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                box-shadow: 0 4px 20px rgba(37, 211, 102, 0.4);
                transition: all 0.3s ease;
                position: relative;
            }
            
            .whatsapp-float:hover {
                transform: scale(1.1);
                box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6);
            }
            
            .whatsapp-float.pulse {
                animation: whatsappPulse 1s ease-out;
            }
            
            @keyframes whatsappPulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.15); }
                100% { transform: scale(1); }
            }
            
            .whatsapp-float i {
                color: white;
                font-size: 2rem;
            }
            
            .whatsapp-badge {
                position: absolute;
                top: -5px;
                right: -5px;
                background: #FF0000;
                color: white;
                width: 24px;
                height: 24px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.75rem;
                font-weight: bold;
                animation: badgePulse 2s infinite;
            }
            
            @keyframes badgePulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.2); }
            }
            
            .whatsapp-chat {
                position: absolute;
                bottom: 80px;
                right: 0;
                width: 350px;
                max-height: 500px;
                background: white;
                border-radius: 15px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
                opacity: 0;
                visibility: hidden;
                transform: scale(0.8) translateY(20px);
                transition: all 0.3s ease;
                overflow: hidden;
            }
            
            .whatsapp-chat.open {
                opacity: 1;
                visibility: visible;
                transform: scale(1) translateY(0);
            }
            
            .whatsapp-notification {
                position: absolute;
                bottom: 80px;
                right: 0;
                background: white;
                padding: 15px 20px;
                border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
                max-width: 250px;
                opacity: 0;
                transform: translateY(10px);
                transition: all 0.3s ease;
            }
            
            .whatsapp-notification.show {
                opacity: 1;
                transform: translateY(0);
            }
            
            @media (max-width: 480px) {
                .whatsapp-chat {
                    width: calc(100vw - 40px);
                    right: -10px;
                }
            }
        `;
        document.head.appendChild(style);
    }

    /**
     * Initialize
     */
    function init() {
        // Stilleri ekle
        addStyles();
        
        // Widget oluştur
        createWidget();
        
        // Scroll listener
        window.addEventListener('scroll', handleScroll);
        
        // Visibility change listener
        document.addEventListener('visibilitychange', handleVisibilityChange);
        
        // Otomatik mesajlar
        if (WHATSAPP_CONFIG.autoOpen) {
            setupAutoMessages();
        }
        
        console.log('✅ WhatsApp Widget initialized');
    }

    /**
     * DOMContentLoaded'da başlat
     */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    /**
     * Public API
     */
    window.WhatsAppAPI = {
        open: openChat,
        close: closeChat,
        toggle: toggleChat,
        sendMessage: openWhatsApp,
        show: showWidget,
        hide: hideWidget,
        notify: showNotification
    };

})();

/**
 * Kullanım Örnekleri:
 * 
 * 1. Chat'i aç:
 *    WhatsAppAPI.open();
 * 
 * 2. Mesaj gönder:
 *    WhatsAppAPI.sendMessage('Merhaba!');
 * 
 * 3. Bildirim göster:
 *    WhatsAppAPI.notify('Yeni mesaj!');
 * 
 * 4. Widget'ı gizle:
 *    WhatsAppAPI.hide();
 */
