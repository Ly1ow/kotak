@extends('layouts.app')

@section('title', 'Ледовый каток IceArena')

@section('content')
    <!-- Hero секция -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <video class="w-full h-full object-cover" autoplay loop muted>
                <source src="https://player.vimeo.com/external/371837923.sd.mp4?s=8d6c3b9e3b7b7b7b7b7b7b7b7b7b7b7b&profile_id=139" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        </div>
        
        <div class="container mx-auto px-4 z-10 text-center text-white">
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in-down">
                Добро пожаловать в IceArena
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto">
                Лучший ледовый каток города с современным оборудованием и уютной атмосферой
            </p>
            <button onclick="openBookingModal()" 
                    class="bg-white text-blue-600 px-8 py-4 rounded-full text-lg font-semibold hover:bg-blue-600 hover:text-white transform hover:scale-110 transition-all duration-300 shadow-xl hover:shadow-2xl">
                Забронировать сейчас
            </button>
        </div>
    </section>

    <!-- О нас -->
    <section id="about" class="py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">О нашем катке</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover-scale">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">Круглосуточно</h3>
                    <p class="text-gray-600 text-center">Работаем 24/7 для вашего удобства</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover-scale">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">Профессиональный лед</h3>
                    <p class="text-gray-600 text-center">Лед высшего качества для комфортного катания</p>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 hover-scale">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-center mb-4">Безопасность</h3>
                    <p class="text-gray-600 text-center">Современная система безопасности и медики</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Цены -->
    <section id="prices" class="py-20 bg-gradient-to-r from-blue-600 to-cyan-600">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-white">Наши цены</h2>
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl p-8 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Входной билет</h3>
                        <p class="text-4xl font-bold text-blue-600 mb-4">300 ₽</p>
                        <p class="text-gray-600">Безлимитное катание</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl p-8 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-4">Аренда коньков</h3>
                        <p class="text-4xl font-bold text-blue-600 mb-4">150 ₽/час</p>
                        <p class="text-gray-600">Профессиональные коньки</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Коньки -->
    <section id="skates" class="py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12 text-gray-800">Наши коньки</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($skates as $skate)
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover-scale">
                    <img src="{{ $skate->image ?? 'https://via.placeholder.com/400x300' }}" 
                         alt="{{ $skate->model }}" 
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold">{{ $skate->brand }}</h3>
                                <p class="text-gray-600">{{ $skate->model }}</p>
                            </div>
                            <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-semibold">
                                Размер {{ $skate->size }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-blue-600">150 ₽/час</span>
                            <span class="text-sm {{ $skate->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $skate->quantity > 0 ? 'В наличии: ' . $skate->quantity : 'Нет в наличии' }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Контакты -->
    <section id="contacts" class="py-20 bg-gray-900 text-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-12">Контакты</h2>
            <div class="grid md:grid-cols-2 gap-12">
                <div>
                    <div class="flex items-start space-x-4 mb-6">
                        <svg class="w-6 h-6 text-blue-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Адрес</h3>
                            <p class="text-gray-300">г. Москва, ул. Ледовая, 1</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4 mb-6">
                        <svg class="w-6 h-6 text-blue-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Телефон</h3>
                            <p class="text-gray-300">+7 (999) 123-45-67</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <svg class="w-6 h-6 text-blue-400 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Email</h3>
                            <p class="text-gray-300">info@icearena.ru</p>
                        </div>
                    </div>
                </div>
                
                <div class="h-96 bg-gray-800 rounded-2xl overflow-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2245.373691956487!2d37.6188!3d55.7517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTXCsDQ1JzA2LjEiTiAzN8KwMzcnMDcuNCJF!5e0!3m2!1sru!2sru!4v1620000000000!5m2!1sru!2sru" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes fade-in-down {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-down {
            animation: fade-in-down 1s ease-out;
        }
    </style>
@endsection