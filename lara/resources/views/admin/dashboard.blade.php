<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель IceArena</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="font-inter bg-gray-100">
    <div class="flex h-screen">
        <!-- Боковое меню -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-blue-600">IceArena Admin</h1>
            </div>
            <nav class="mt-6">
                <a href="#" class="block px-6 py-3 bg-blue-50 text-blue-600 border-l-4 border-blue-600">
                    Дашборд
                </a>
                <a href="#" class="block px-6 py-3 text-gray-600 hover:bg-gray-50 transition-colors duration-300">
                    Коньки
                </a>
                <a href="#" class="block px-6 py-3 text-gray-600 hover:bg-gray-50 transition-colors duration-300">
                    Бронирования
                </a>
            </nav>
        </div>

        <!-- Основной контент -->
        <div class="flex-1 overflow-y-auto">
            <div class="p-8">
                <h2 class="text-3xl font-bold mb-8">Дашборд</h2>

                <!-- Статистика -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-2xl p-6 shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Всего бронирований</p>
                                <p class="text-3xl font-bold">{{ $bookings->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Оплаченные</p>
                                <p class="text-3xl font-bold">{{ $bookings->where('is_paid', true)->count() }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-6 shadow-lg">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Выручка</p>
                                <p class="text-3xl font-bold">{{ number_format($totalRevenue, 0, '.', ' ') }} ₽</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Управление коньками -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                    <h3 class="text-xl font-bold mb-6">Управление коньками</h3>

                    <!-- Форма добавления -->
                    <form action="{{ route('admin.skates.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
                        @csrf
                        <input type="text" name="brand" placeholder="Бренд" required
                               class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <input type="text" name="model" placeholder="Модель" required
                               class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <input type="number" name="size" placeholder="Размер" min="30" max="47" required
                               class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <input type="number" name="quantity" placeholder="Количество" min="1" required
                               class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <button type="submit" 
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transform hover:scale-105 transition-all duration-300">
                            Добавить
                        </button>
                    </form>

                    <!-- Список коньков -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Бренд</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Модель</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Размер</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Количество</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Действия</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($skates as $skate)
                                <tr class="hover:bg-gray-50 transition-colors duration-300">
                                    <td class="px-6 py-4">{{ $skate->brand }}</td>
                                    <td class="px-6 py-4">{{ $skate->model }}</td>
                                    <td class="px-6 py-4">{{ $skate->size }}</td>
                                    <td class="px-6 py-4">
                                        <span class="{{ $skate->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $skate->quantity }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.skates.delete', $skate) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-800 transition-colors duration-300"
                                                    onclick="return confirm('Удалить эти коньки?')">
                                                Удалить
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Список бронирований -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold mb-6">Бронирования</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Дата</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ФИО</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Телефон</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Часы</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Коньки</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Сумма</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Статус</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($bookings as $booking)
                                <tr class="hover:bg-gray-50 transition-colors duration-300">
                                    <td class="px-6 py-4">{{ $booking->created_at->format('d.m.Y H:i') }}</td>
                                    <td class="px-6 py-4">{{ $booking->full_name }}</td>
                                    <td class="px-6 py-4">{{ $booking->phone }}</td>
                                    <td class="px-6 py-4">{{ $booking->hours }} ч</td>
                                    <td class="px-6 py-4">
                                        @if($booking->has_own_skates)
                                            <span class="text-green-600">Свои</span>
                                        @elseif($booking->skate)
                                            {{ $booking->skate->brand }} {{ $booking->skate->model }} ({{ $booking->skate_size }})
                                        @else
                                            <span class="text-gray-400">Не выбраны</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-semibold">{{ number_format($booking->total_amount, 0, '.', ' ') }} ₽</td>
                                    <td class="px-6 py-4">
                                        @if($booking->is_paid)
                                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">Оплачено</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-sm">Ожидает</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>