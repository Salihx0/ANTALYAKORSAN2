/**
 * FİYAT HESAPLAMA SİSTEMİ
 * Google Maps API ile Mesafe Hesaplama
 * Antalya Korsan Taksi
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 * @author Burak KAYA
 */

(function() {
    'use strict';

    // Fiyatlandırma Ayarları
    const PRICING = {
        basePrice: 50,          // Başlangıç ücreti (TL)
        pricePerKm: 15,         // Kilometre başı ücret (TL)
        minPrice: 100,          // Minimum ücret (TL)
        
        // Mesafe bazlı indirimler
        discounts: [
            { minKm: 0, maxKm: 10, discount: 0 },      // 0-10 km: İndirim yok
            { minKm: 10, maxKm: 30, discount: 5 },     // 10-30 km: %5 indirim
            { minKm: 30, maxKm: 50, discount: 10 },    // 30-50 km: %10 indirim
            { minKm: 50, maxKm: 100, discount: 15 },   // 50-100 km: %15 indirim
            { minKm: 100, maxKm: Infinity, discount: 20 } // 100+ km: %20 indirim
        ],
        
        // Popüler rotalar (sabit fiyat)
        popularRoutes: {
            'Havalimanı - Kaleici': { distance: 15, price: 250 },
            'Havalimanı - Lara': { distance: 12, price: 200 },
            'Havalimanı - Kundu': { distance: 18, price: 280 },
            'Havalimanı - Belek': { distance: 35, price: 450 },
            'Havalimanı - Side': { distance: 65, price: 750 },
            'Havalimanı - Alanya': { distance: 125, price: 1400 }
        }
    };

    // Price Calculator Class
    class PriceCalculator {
        constructor() {
            this.map = null;
            this.directionsService = null;
            this.directionsRenderer = null;
            this.autocompleteFrom = null;
            this.autocompleteTo = null;
            
            this.fromInput = document.getElementById('from-location');
            this.toInput = document.getElementById('to-location');
            this.calculateBtn = document.getElementById('calculate-price');
            this.resultsDiv = document.getElementById('price-results');
            this.mapDiv = document.getElementById('map');
            
            if (this.fromInput && this.toInput && this.calculateBtn) {
                this.init();
            }
        }

        init() {
            // Initialize Google Maps
            this.initMap();
            
            // Setup autocomplete
            this.setupAutocomplete();
            
            // Setup event listeners
            this.setupEventListeners();
            
            // Load popular routes
            this.loadPopularRoutes();
        }

        initMap() {
            // Antalya merkez koordinatları
            const antalya = { lat: 36.8969, lng: 30.7133 };
            
            // Harita oluştur
            this.map = new google.maps.Map(this.mapDiv, {
                zoom: 11,
                center: antalya,
                mapTypeControl: true,
                streetViewControl: false,
                fullscreenControl: true,
                styles: this.getMapStyles()
            });
            
            // Directions service
            this.directionsService = new google.maps.DirectionsService();
            this.directionsRenderer = new google.maps.DirectionsRenderer({
                map: this.map,
                suppressMarkers: false,
                polylineOptions: {
                    strokeColor: '#007BFF',
                    strokeWeight: 5,
                    strokeOpacity: 0.8
                }
            });
        }

        setupAutocomplete() {
            // Antalya bölgesi için sınırlama
            const bounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(36.5, 30.0),
                new google.maps.LatLng(37.5, 32.0)
            );
            
            const options = {
                bounds: bounds,
                strictBounds: true,
                componentRestrictions: { country: 'tr' },
                fields: ['formatted_address', 'geometry', 'name']
            };
            
            // From autocomplete
            this.autocompleteFrom = new google.maps.places.Autocomplete(
                this.fromInput,
                options
            );
            
            // To autocomplete
            this.autocompleteTo = new google.maps.places.Autocomplete(
                this.toInput,
                options
            );
        }

        setupEventListeners() {
            // Calculate button
            this.calculateBtn.addEventListener('click', () => {
                this.calculateRoute();
            });
            
            // Enter key
            this.fromInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.toInput.focus();
                }
            });
            
            this.toInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.calculateRoute();
                }
            });
            
            // Swap locations button
            const swapBtn = document.getElementById('swap-locations');
            if (swapBtn) {
                swapBtn.addEventListener('click', () => {
                    this.swapLocations();
                });
            }
        }

        calculateRoute() {
            const from = this.fromInput.value.trim();
            const to = this.toInput.value.trim();
            
            // Validation
            if (!from || !to) {
                this.showError('Lütfen başlangıç ve varış noktalarını giriniz.');
                return;
            }
            
            if (from === to) {
                this.showError('Başlangıç ve varış noktaları aynı olamaz.');
                return;
            }
            
            // Show loading
            this.showLoading();
            
            // Calculate route
            const request = {
                origin: from,
                destination: to,
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC
            };
            
            this.directionsService.route(request, (result, status) => {
                if (status === google.maps.DirectionsStatus.OK) {
                    this.displayRoute(result);
                } else {
                    this.showError('Rota hesaplanamadı. Lütfen adresleri kontrol ediniz.');
                }
            });
        }

        displayRoute(result) {
            // Display route on map
            this.directionsRenderer.setDirections(result);
            
            // Get route info
            const route = result.routes[0];
            const leg = route.legs[0];
            
            const distance = leg.distance.value / 1000; // km
            const duration = leg.duration.text;
            
            // Calculate price
            const priceInfo = this.calculatePrice(distance);
            
            // Display results
            this.displayResults({
                from: leg.start_address,
                to: leg.end_address,
                distance: distance,
                duration: duration,
                ...priceInfo
            });
        }

        calculatePrice(distance) {
            // Base calculation
            let basePrice = PRICING.basePrice + (distance * PRICING.pricePerKm);
            
            // Apply discount
            const discount = this.getDiscount(distance);
            const discountAmount = basePrice * (discount / 100);
            const finalPrice = basePrice - discountAmount;
            
            // Apply minimum price
            const price = Math.max(finalPrice, PRICING.minPrice);
            
            return {
                basePrice: Math.round(basePrice),
                discount: discount,
                discountAmount: Math.round(discountAmount),
                finalPrice: Math.round(price),
                pricePerKm: PRICING.pricePerKm
            };
        }

        getDiscount(distance) {
            for (const tier of PRICING.discounts) {
                if (distance >= tier.minKm && distance < tier.maxKm) {
                    return tier.discount;
                }
            }
            return 0;
        }

        displayResults(data) {
            const html = `
                <div class="price-result-card" data-aos="fade-up">
                    <div class="route-info">
                        <div class="route-item">
                            <i class="fas fa-map-marker-alt text-success"></i>
                            <div>
                                <strong>Başlangıç:</strong>
                                <p>${data.from}</p>
                            </div>
                        </div>
                        <div class="route-divider">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                        <div class="route-item">
                            <i class="fas fa-map-marker-alt text-danger"></i>
                            <div>
                                <strong>Varış:</strong>
                                <p>${data.to}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="distance-info">
                        <div class="info-item">
                            <i class="fas fa-road"></i>
                            <div>
                                <span class="label">Mesafe</span>
                                <span class="value">${data.distance.toFixed(1)} km</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <span class="label">Süre</span>
                                <span class="value">${data.duration}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="price-breakdown">
                        <div class="price-item">
                            <span>Başlangıç Ücreti</span>
                            <span>${PRICING.basePrice} ₺</span>
                        </div>
                        <div class="price-item">
                            <span>Mesafe Ücreti (${data.distance.toFixed(1)} km × ${data.pricePerKm} ₺)</span>
                            <span>${(data.distance * data.pricePerKm).toFixed(0)} ₺</span>
                        </div>
                        ${data.discount > 0 ? `
                        <div class="price-item discount">
                            <span>İndirim (%${data.discount})</span>
                            <span>-${data.discountAmount} ₺</span>
                        </div>
                        ` : ''}
                        <div class="price-item total">
                            <span>Toplam Ücret</span>
                            <span class="final-price">${data.finalPrice} ₺</span>
                        </div>
                    </div>
                    
                    <div class="price-actions">
                        <a href="tel:+905551234567" class="btn btn-primary">
                            <i class="fas fa-phone"></i>
                            Hemen Ara
                        </a>
                        <a href="https://wa.me/905551234567?text=Merhaba, ${data.from} - ${data.to} arası transfer için rezervasyon yapmak istiyorum." 
                           class="btn btn-success" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                            WhatsApp
                        </a>
                    </div>
                    
                    <div class="price-note">
                        <i class="fas fa-info-circle"></i>
                        <p>Fiyatlar tahminidir. Trafik durumu ve bekleme süresine göre değişiklik gösterebilir.</p>
                    </div>
                </div>
            `;
            
            this.resultsDiv.innerHTML = html;
            this.resultsDiv.style.display = 'block';
            
            // Scroll to results
            this.resultsDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        loadPopularRoutes() {
            const container = document.getElementById('popular-routes');
            if (!container) return;
            
            let html = '<div class="popular-routes-grid">';
            
            for (const [route, data] of Object.entries(PRICING.popularRoutes)) {
                html += `
                    <div class="popular-route-card" data-route="${route}">
                        <div class="route-name">${route}</div>
                        <div class="route-details">
                            <span><i class="fas fa-road"></i> ${data.distance} km</span>
                            <span class="route-price">${data.price} ₺</span>
                        </div>
                        <button class="btn btn-sm btn-outline select-route">
                            Seç <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                `;
            }
            
            html += '</div>';
            container.innerHTML = html;
            
            // Add click handlers
            container.querySelectorAll('.select-route').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const card = e.target.closest('.popular-route-card');
                    const route = card.dataset.route;
                    this.selectPopularRoute(route);
                });
            });
        }

        selectPopularRoute(route) {
            const [from, to] = route.split(' - ');
            this.fromInput.value = from;
            this.toInput.value = to;
            this.calculateRoute();
        }

        swapLocations() {
            const temp = this.fromInput.value;
            this.fromInput.value = this.toInput.value;
            this.toInput.value = temp;
        }

        showLoading() {
            this.resultsDiv.innerHTML = `
                <div class="loading-state">
                    <div class="spinner"></div>
                    <p>Rota hesaplanıyor...</p>
                </div>
            `;
            this.resultsDiv.style.display = 'block';
            this.calculateBtn.disabled = true;
            this.calculateBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Hesaplanıyor...';
        }

        showError(message) {
            this.resultsDiv.innerHTML = `
                <div class="error-state">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p>${message}</p>
                </div>
            `;
            this.resultsDiv.style.display = 'block';
            this.calculateBtn.disabled = false;
            this.calculateBtn.innerHTML = '<i class="fas fa-calculator"></i> Fiyat Hesapla';
        }

        getMapStyles() {
            // Custom map styles
            return [
                {
                    featureType: 'water',
                    elementType: 'geometry',
                    stylers: [{ color: '#e9e9e9' }, { lightness: 17 }]
                },
                {
                    featureType: 'landscape',
                    elementType: 'geometry',
                    stylers: [{ color: '#f5f5f5' }, { lightness: 20 }]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry.fill',
                    stylers: [{ color: '#ffffff' }, { lightness: 17 }]
                },
                {
                    featureType: 'road.highway',
                    elementType: 'geometry.stroke',
                    stylers: [{ color: '#ffffff' }, { lightness: 29 }, { weight: 0.2 }]
                }
            ];
        }
    }

    // Initialize when Google Maps is loaded
    window.initPriceCalculator = function() {
        new PriceCalculator();
    };

    // Auto-initialize if Google Maps is already loaded
    if (typeof google !== 'undefined' && google.maps) {
        window.initPriceCalculator();
    }

})();
