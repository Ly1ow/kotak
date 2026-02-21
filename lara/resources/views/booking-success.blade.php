<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Билет куплен - IceArena</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #3B82F6;
            opacity: 0.7;
            animation: fall 3s linear infinite;
        }
        @keyframes fall {
            to {
                transform: translateY(100vh) rotate(360deg);
            }
        }
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .animate-scale-in {
            animation: scaleIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-cyan-50 min-h-screen flex items-center justify-center p-4">
    <!-- Конфетти (анимация) -->
    @for($i = 0; $i < 20; $i++)
    <div class="confetti" style="left: {{ rand(0, 100) }}%; animation-delay: {{ rand(0, 3) }}s; background: {{ ['#3B82F6', '#10B981', '#F59E0B', '#EF4444'][rand(0, 3)] }};"></div>
    @endfor

    <div class="max-w-2xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden animate-scale-in">
        <!-- Верхняя часть с иконкой успеха -->
        <div class="bg-gradient-to-r from-green-500 to-emerald-500 p-8 text-center">
            <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Билет успешно куплен!</h1>
            <p class="text-green-100">Спасибо за покупку. Ждем вас на нашем катке!</p>
        </div>

        <!-- Детали бронирования -->
        <div class="p-8">
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Детали бронирования</h2>
                <div class="bg-gray-50 rounded-2xl p-6 space-y-4">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                        <span class="text-gray-600">Номер брони:</span>
                        <span class="font-mono font-bold text-blue-600">#{{ $booking->id }}-{{ substr($booking->payment_id, -6) }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                        <span class="text-gray-600">ФИО:</span>
                        <span class="font-semibold">{{ $booking->full_name }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                        <span class="text-gray-600">Телефон:</span>
                        <span class="font-semibold">{{ $booking->phone }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                        <span class="text-gray-600">Время катания:</span>
                        <span class="font-semibold">{{ $booking->hours }} {{ $booking->hours == 1 ? 'час' : ($booking->hours < 5 ? 'часа' : 'часов') }}</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200">
                        <span class="text-gray-600">Коньки:</span>
                        <span class="font-semibold">
                            @if($booking->has_own_skates)
                                <span class="text-green-600">Свои коньки</span>
                            @elseif($booking->skate)
                                {{ $booking->skate->brand }} {{ $booking->skate->model }} (размер {{ $booking->skate_size ?? $booking->skate->size }})
                            @else
                                <span class="text-gray-500">Не выбраны</span>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between items-center text-lg font-bold">
                        <span class="text-gray-800">Итого к оплате:</span>
                        <span class="text-2xl text-blue-600">{{ number_format($booking->total_amount, 0, '.', ' ') }} ₽</span>
                    </div>
                </div>
            </div>

            <!-- QR-код (имитация) -->
            <div class="mb-8 text-center">
                <div class="inline-block bg-white p-4 rounded-2xl shadow-md">
                    <div class="w-32 h-32 bg-gray-200 mx-auto mb-2 flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-600" viewBox="0 0 24 24" fill="currentColor">
                            <rect x="2" y="2" width="4" height="4" fill="currentColor"/>
                            <rect x="8" y="2" width="4" height="4" fill="currentColor"/>
                            <rect x="14" y="2" width="4" height="4" fill="currentColor"/>
                            <rect x="2" y="8" width="4" height="4" fill="currentColor"/>
                            <rect x="14" y="8" width="4" height="4" fill="currentColor"/>
                            <rect x="2" y="14" width="4" height="4" fill="currentColor"/>
                            <rect x="8" y="14" width="4" height="4" fill="currentColor"/>
                            <rect x="14" y="14" width="4" height="4" fill="currentColor"/>
                            <rect x="8" y="8" width="4" height="4" fill="currentColor"/>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-500">Покажите этот код на входе</p>
                </div>
            </div>

            <!-- Важная информация -->
            <div class="bg-blue-50 rounded-xl p-4 mb-8">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <p class="text-sm text-blue-800">
                            <span class="font-semibold">Важно:</span> При входе необходимо предъявить этот код. 
                            Начало катания - с момента входа на лед.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Кнопки действий -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('home') }}" 
                   class="flex-1 bg-blue-600 text-white text-center px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-lg">
                    Вернуться на главную
                </a>
                <button onclick="window.print()" 
                        class="flex-1 border-2 border-blue-600 text-blue-600 px-6 py-3 rounded-xl font-semibold hover:bg-blue-50 transform hover:scale-105 transition-all duration-300">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        <span>Распечатать</span>
                    </span>
                </button>
            </div>

            <!-- Ссылка на админку (для демо) -->
            <div class="mt-6 text-center">
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-400 hover:text-gray-600 transition-colors duration-300">
                    Админ-панель →
                </a>
            </div>
        </div>
    </div>

    <script>
        // Автоматическая печать через 1 секунду (можно убрать если не нужно)
        // setTimeout(() => window.print(), 1000);
    </script>
</body>
</html>