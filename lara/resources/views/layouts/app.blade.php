<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ледовый каток IceArena')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.02);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gradient-to-br from-blue-50 to-cyan-50 min-h-screen">
    <!-- Шапка сайта -->
    <header class="glass-effect shadow-lg sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Логотип -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span class="text-2xl font-bold text-blue-600">IceArena</span>
                </a>

                <!-- Навигация -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}#about" class="text-gray-700 hover:text-blue-600 transition-colors duration-300">О нас</a>
                    <a href="{{ route('home') }}#prices" class="text-gray-700 hover:text-blue-600 transition-colors duration-300">Цены</a>
                    <a href="{{ route('home') }}#skates" class="text-gray-700 hover:text-blue-600 transition-colors duration-300">Коньки</a>
                    <a href="{{ route('home') }}#contacts" class="text-gray-700 hover:text-blue-600 transition-colors duration-300">Контакты</a>
                </div>

                <!-- Кнопка покупки билета -->
                <button onclick="openBookingModal()" class="bg-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-blue-700 transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-lg">
                    Купить билет
                </button>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- Модальное окно бронирования -->
    <div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full mx-4 transform transition-all duration-300 scale-95 hover:scale-100 max-h-[90vh] overflow-y-auto">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Оформление билета</h2>
            
            <form id="bookingForm" method="POST" action="{{ route('booking.store') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">ФИО *</label>
                    <input type="text" name="full_name" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="Иванов Иван Иванович">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Телефон *</label>
                    <input type="tel" name="phone" id="phone" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                           placeholder="+7 (___) ___-__-__">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Часы аренды *</label>
                    <select name="hours" id="hours" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
                        <option value="1">1 час - 150 ₽</option>
                        <option value="2">2 часа - 300 ₽</option>
                        <option value="3">3 часа - 450 ₽</option>
                        <option value="4">4 часа - 600 ₽</option>
                    </select>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="has_own_skates" id="hasOwnSkates" value="1"
                               class="w-5 h-5 text-blue-600 rounded focus:ring-blue-500">
                        <span class="text-gray-700 font-medium">У меня свои коньки</span>
                    </label>
                    <p class="text-sm text-gray-500 mt-2 ml-8">Если у вас свои коньки, стоимость аренды не взимается</p>
                </div>

                <div id="skatesSelection" class="space-y-4 p-4 border border-gray-200 rounded-lg">
                    <h3 class="font-semibold text-gray-700">Выберите коньки для аренды</h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Модель коньков</label>
                        <select name="skate_id" id="skateSelect" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">-- Выберите модель --</option>
                            @if(isset($skates) && count($skates) > 0)
                                @foreach($skates as $skate)
                                    @if($skate->quantity > 0)
                                    <option value="{{ $skate->id }}" 
                                            data-size="{{ $skate->size }}"
                                            data-brand="{{ $skate->brand }}"
                                            data-model="{{ $skate->model }}"
                                            data-price="150">
                                        {{ $skate->brand }} {{ $skate->model }} (Размер EU {{ $skate->size }}) - {{ $skate->quantity }} шт.
                                    </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Размер (EU)</label>
                        <input type="number" name="skate_size" id="skateSize" min="30" max="47"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               placeholder="Введите размер (30-47)">
                        <p class="text-xs text-gray-500 mt-1">Если ваш размер отличается от выбранной модели</p>
                    </div>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="flex justify-between text-sm">
                        <span>Входной билет:</span>
                        <span class="font-semibold">300 ₽</span>
                    </div>
                    <div class="flex justify-between text-sm mt-2" id="skatePriceDisplay">
                        <span>Аренда коньков:</span>
                        <span class="font-semibold" id="skatePrice">0 ₽</span>
                    </div>
                    <div class="border-t border-blue-200 my-3"></div>
                    <div class="flex justify-between font-bold text-lg">
                        <span>Итого:</span>
                        <span id="totalAmount" class="text-blue-600">300 ₽</span>
                    </div>
                </div>

                <button type="submit" 
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-lg">
                    Перейти к оплате
                </button>
            </form>

            <button onclick="closeBookingModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <script>
        // Маска для телефона
        document.getElementById('phone')?.addEventListener('input', function(e) {
            let x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
            e.target.value = !x[2] ? '+7' : '+7 (' + x[2] + (x[3] ? ') ' + x[3] : '') + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '');
        });

        // Данные коньков для JavaScript
        const skatesData = {
            @if(isset($skates) && count($skates) > 0)
                @foreach($skates as $skate)
                    {{ $skate->id }}: {
                        brand: '{{ $skate->brand }}',
                        model: '{{ $skate->model }}',
                        size: {{ $skate->size }},
                        price: 150
                    },
                @endforeach
            @endif
        };

        // Управление модальным окном
        function openBookingModal() {
            document.getElementById('bookingModal').classList.remove('hidden');
            document.getElementById('bookingModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function openBookingModalWithSkate(skateId, skateName, skateSize) {
            openBookingModal();
            
            // Выбираем коньки в селекте
            const skateSelect = document.getElementById('skateSelect');
            if (skateSelect) {
                skateSelect.value = skateId;
            }
            
            // Устанавливаем размер
            const skateSizeInput = document.getElementById('skateSize');
            if (skateSizeInput) {
                skateSizeInput.value = skateSize;
            }
            
            // Снимаем галочку "свои коньки"
            document.getElementById('hasOwnSkates').checked = false;
            document.getElementById('skatesSelection').style.opacity = '1';
            document.getElementById('skatesSelection').style.pointerEvents = 'auto';
            
            updateTotal();
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').classList.add('hidden');
            document.getElementById('bookingModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Расчет стоимости
        document.getElementById('hours')?.addEventListener('change', updateTotal);
        document.getElementById('skateSelect')?.addEventListener('change', updateTotal);
        
        document.getElementById('hasOwnSkates')?.addEventListener('change', function(e) {
            const skatesSection = document.getElementById('skatesSelection');
            if (e.target.checked) {
                skatesSection.style.opacity = '0.5';
                skatesSection.style.pointerEvents = 'none';
            } else {
                skatesSection.style.opacity = '1';
                skatesSection.style.pointerEvents = 'auto';
            }
            updateTotal();
        });

        function updateTotal() {
            const hours = parseInt(document.getElementById('hours').value) || 1;
            const hasOwnSkates = document.getElementById('hasOwnSkates').checked;
            const skateSelect = document.getElementById('skateSelect');
            const selectedSkateId = skateSelect ? skateSelect.value : null;
            
            let skatePrice = 0;
            
            if (!hasOwnSkates && selectedSkateId) {
                skatePrice = 150 * hours;
            }
            
            document.getElementById('skatePrice').textContent = skatePrice + ' ₽';
            document.getElementById('totalAmount').textContent = (300 + skatePrice) + ' ₽';
        }

        // Валидация формы перед отправкой
        document.getElementById('bookingForm')?.addEventListener('submit', function(e) {
            const hasOwnSkates = document.getElementById('hasOwnSkates').checked;
            const skateSelect = document.getElementById('skateSelect');
            
            if (!hasOwnSkates && (!skateSelect.value || skateSelect.value === '')) {
                e.preventDefault();
                alert('Пожалуйста, выберите коньки для аренды или отметьте "У меня свои коньки"');
                return;
            }
            
            // Можно добавить дополнительную валидацию
        });

        // Закрытие по клику вне модального окна
        document.getElementById('bookingModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeBookingModal();
            }
        });

        // Закрытие по Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeBookingModal();
            }
        });
    </script>

    @stack('scripts')
</body>
</html>