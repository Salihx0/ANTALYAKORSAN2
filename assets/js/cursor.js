/**
 * CUSTOM CURSOR JAVASCRIPT
 * Antalya Korsan Taksi - Taksi Tekeri Cursor
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

(function() {
    'use strict';

    // Mobil cihazlarda çalıştırma
    if (window.innerWidth <= 768 || 'ontouchstart' in window) {
        return;
    }

    // Cursor elementi oluştur
    const cursor = document.createElement('div');
    cursor.className = 'custom-cursor';
    cursor.innerHTML = `
        <div class="cursor-wheel">
            <div class="cursor-spoke"></div>
            <div class="cursor-spoke"></div>
            <div class="cursor-spoke"></div>
            <div class="cursor-spoke"></div>
            <div class="cursor-spoke"></div>
            <div class="cursor-spoke"></div>
            <div class="cursor-spoke"></div>
            <div class="cursor-spoke"></div>
        </div>
    `;
    document.body.appendChild(cursor);

    // Cursor pozisyonu
    let mouseX = 0;
    let mouseY = 0;
    let cursorX = 0;
    let cursorY = 0;

    // Cursor durumu
    let isHovering = false;
    let isClicking = false;
    let isDragging = false;

    // Trail elementleri
    const trails = [];
    const maxTrails = 5;

    /**
     * Cursor pozisyonunu güncelle
     */
    function updateCursorPosition(e) {
        mouseX = e.clientX;
        mouseY = e.clientY;
    }

    /**
     * Cursor animasyonu
     */
    function animateCursor() {
        // Smooth follow
        const speed = 0.15;
        cursorX += (mouseX - cursorX) * speed;
        cursorY += (mouseY - cursorY) * speed;

        cursor.style.transform = `translate(${cursorX - 20}px, ${cursorY - 20}px)`;

        // Trail oluştur
        if (Math.random() > 0.9) {
            createTrail(cursorX, cursorY);
        }

        requestAnimationFrame(animateCursor);
    }

    /**
     * Trail oluştur
     */
    function createTrail(x, y) {
        if (trails.length >= maxTrails) {
            const oldTrail = trails.shift();
            oldTrail.remove();
        }

        const trail = document.createElement('div');
        trail.className = 'cursor-trail';
        trail.style.left = x + 'px';
        trail.style.top = y + 'px';
        document.body.appendChild(trail);
        trails.push(trail);

        setTimeout(() => {
            trail.classList.add('fade');
            setTimeout(() => {
                trail.remove();
                const index = trails.indexOf(trail);
                if (index > -1) trails.splice(index, 1);
            }, 300);
        }, 100);
    }

    /**
     * Particle efekti
     */
    function createParticle(x, y) {
        const particle = document.createElement('div');
        particle.className = 'cursor-particle';
        particle.style.left = x + 'px';
        particle.style.top = y + 'px';
        
        const angle = Math.random() * Math.PI * 2;
        const distance = 20 + Math.random() * 30;
        const tx = Math.cos(angle) * distance;
        const ty = Math.sin(angle) * distance;
        
        particle.style.setProperty('--tx', tx + 'px');
        particle.style.setProperty('--ty', ty + 'px');
        
        document.body.appendChild(particle);

        setTimeout(() => {
            particle.remove();
        }, 1000);
    }

    /**
     * Ripple efekti
     */
    function createRipple(x, y) {
        const ripple = document.createElement('div');
        ripple.className = 'cursor-ripple';
        ripple.style.left = (x - 20) + 'px';
        ripple.style.top = (y - 20) + 'px';
        document.body.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 600);
    }

    /**
     * Hover durumunu kontrol et
     */
    function checkHoverState(e) {
        const target = e.target;
        const isInteractive = target.matches('a, button, input, textarea, select, [role="button"], .clickable');

        if (isInteractive && !isHovering) {
            isHovering = true;
            cursor.classList.add('hover');
        } else if (!isInteractive && isHovering) {
            isHovering = false;
            cursor.classList.remove('hover');
        }

        // Text input kontrolü
        const isTextInput = target.matches('input[type="text"], input[type="email"], input[type="search"], textarea');
        if (isTextInput) {
            cursor.classList.add('text');
        } else {
            cursor.classList.remove('text');
        }
    }

    /**
     * Click efekti
     */
    function handleClick(e) {
        isClicking = true;
        cursor.classList.add('click');
        
        // Particle efekti
        for (let i = 0; i < 5; i++) {
            setTimeout(() => {
                createParticle(e.clientX, e.clientY);
            }, i * 20);
        }
        
        // Ripple efekti
        createRipple(e.clientX, e.clientY);

        setTimeout(() => {
            isClicking = false;
            cursor.classList.remove('click');
        }, 300);
    }

    /**
     * Drag başlangıcı
     */
    function handleDragStart() {
        isDragging = true;
        cursor.classList.add('drag');
    }

    /**
     * Drag bitişi
     */
    function handleDragEnd() {
        isDragging = false;
        cursor.classList.remove('drag');
    }

    /**
     * Sayfa dışına çıkınca gizle
     */
    function handleMouseLeave() {
        cursor.classList.add('hidden');
    }

    /**
     * Sayfaya girince göster
     */
    function handleMouseEnter() {
        cursor.classList.remove('hidden');
    }

    /**
     * Scroll sırasında
     */
    let scrollTimeout;
    function handleScroll() {
        cursor.classList.add('loading');
        
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            cursor.classList.remove('loading');
        }, 150);
    }

    /**
     * Magnetic efekt
     */
    function handleMagneticEffect(e) {
        const target = e.target;
        if (!target.matches('.magnetic')) return;

        const rect = target.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;
        
        const deltaX = e.clientX - centerX;
        const deltaY = e.clientY - centerY;
        const distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
        
        if (distance < 100) {
            const strength = (100 - distance) / 100;
            const offsetX = deltaX * strength * 0.3;
            const offsetY = deltaY * strength * 0.3;
            
            cursor.style.transform = `translate(${cursorX - 20 + offsetX}px, ${cursorY - 20 + offsetY}px)`;
            cursor.classList.add('magnetic');
        } else {
            cursor.classList.remove('magnetic');
        }
    }

    /**
     * Özel cursor tipleri
     */
    function handleSpecialCursors(e) {
        const target = e.target;
        
        // Taxi emoji cursor
        if (target.matches('.taxi-cursor')) {
            cursor.classList.add('taxi');
        } else {
            cursor.classList.remove('taxi');
        }
        
        // Pointer cursor
        if (target.matches('.pointer-cursor')) {
            cursor.classList.add('pointer');
        } else {
            cursor.classList.remove('pointer');
        }
        
        // Grab cursor
        if (target.matches('.grab-cursor')) {
            cursor.classList.add('grab');
        } else {
            cursor.classList.remove('grab');
        }
    }

    /**
     * Event listeners
     */
    document.addEventListener('mousemove', (e) => {
        updateCursorPosition(e);
        checkHoverState(e);
        handleMagneticEffect(e);
        handleSpecialCursors(e);
    });

    document.addEventListener('mousedown', handleClick);
    document.addEventListener('mouseup', handleDragEnd);
    document.addEventListener('dragstart', handleDragStart);
    document.addEventListener('dragend', handleDragEnd);
    document.addEventListener('mouseleave', handleMouseLeave);
    document.addEventListener('mouseenter', handleMouseEnter);
    window.addEventListener('scroll', handleScroll);

    // Animasyonu başlat
    animateCursor();

    /**
     * Glow efekti toggle
     */
    let glowInterval;
    function toggleGlow(enable) {
        if (enable) {
            cursor.classList.add('glow');
            glowInterval = setInterval(() => {
                cursor.classList.toggle('glow');
            }, 2000);
        } else {
            cursor.classList.remove('glow');
            clearInterval(glowInterval);
        }
    }

    /**
     * Keyboard shortcuts
     */
    document.addEventListener('keydown', (e) => {
        // Ctrl + Shift + C: Cursor toggle
        if (e.ctrlKey && e.shiftKey && e.key === 'C') {
            cursor.style.display = cursor.style.display === 'none' ? 'block' : 'none';
        }
        
        // Ctrl + Shift + G: Glow toggle
        if (e.ctrlKey && e.shiftKey && e.key === 'G') {
            toggleGlow(!cursor.classList.contains('glow'));
        }
    });

    /**
     * Resize handler
     */
    window.addEventListener('resize', () => {
        if (window.innerWidth <= 768) {
            cursor.style.display = 'none';
        } else {
            cursor.style.display = 'block';
        }
    });

    /**
     * Public API
     */
    window.CursorAPI = {
        show: () => cursor.classList.remove('hidden'),
        hide: () => cursor.classList.add('hidden'),
        setType: (type) => {
            cursor.className = 'custom-cursor ' + type;
        },
        createParticle: createParticle,
        createRipple: createRipple,
        toggleGlow: toggleGlow
    };

    /**
     * Debug mode
     */
    if (window.location.search.includes('debug=cursor')) {
        console.log('Cursor Debug Mode Active');
        
        // Cursor pozisyonunu göster
        const debugInfo = document.createElement('div');
        debugInfo.style.cssText = `
            position: fixed;
            top: 10px;
            left: 10px;
            background: rgba(0,0,0,0.8);
            color: #FFD700;
            padding: 10px;
            font-family: monospace;
            font-size: 12px;
            z-index: 10001;
            border-radius: 5px;
        `;
        document.body.appendChild(debugInfo);

        setInterval(() => {
            debugInfo.innerHTML = `
                X: ${Math.round(cursorX)}<br>
                Y: ${Math.round(cursorY)}<br>
                Hover: ${isHovering}<br>
                Click: ${isClicking}<br>
                Drag: ${isDragging}<br>
                Trails: ${trails.length}
            `;
        }, 100);
    }

    console.log('✅ Custom Cursor initialized');

})();

/**
 * Kullanım Örnekleri:
 * 
 * 1. Magnetic efekt için:
 *    <button class="magnetic">Hover Me</button>
 * 
 * 2. Taxi cursor için:
 *    <div class="taxi-cursor">Taxi Area</div>
 * 
 * 3. Grab cursor için:
 *    <div class="grab-cursor">Draggable</div>
 * 
 * 4. JavaScript'ten kontrol:
 *    CursorAPI.hide();
 *    CursorAPI.show();
 *    CursorAPI.setType('hover');
 *    CursorAPI.createParticle(x, y);
 *    CursorAPI.toggleGlow(true);
 */
