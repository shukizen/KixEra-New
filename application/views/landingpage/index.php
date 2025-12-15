<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="KixEra - The complete shoe care business management platform designed to help you grow and streamline your operations.">
    <title>KixEra - Smart Shoe Care Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        header {
             max-height: 60px;
        }
    </style>
</head>
<body class="bg-white antialiased">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-md border-b border-gray-100 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                  <div class="h-10 flex items-center">
                    <a href="#home" class="flex items-center">
                        <img src="<?= base_url('assets/img/logo/logo.svg') ?>" alt="KixEra Logo" class="h-28 object-contain" >
                    </a>
                
                </div>
                
                <!-- Navigation -->
                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="#home" class="px-4 py-2 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg font-medium transition-all duration-200">Home</a>
                    <a href="#features" class="px-4 py-2 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg font-medium transition-all duration-200">Features</a>
                    <a href="#pricing" class="px-4 py-2 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg font-medium transition-all duration-200">Pricing</a>
                    <a href="#contact" class="px-4 py-2 text-gray-700 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg font-medium transition-all duration-200">Contact</a>
                </nav>
                
                <!-- CTA Buttons -->
                <div class="hidden lg:flex items-center space-x-3">
                    <a href="<?= base_url ('auth/login') ?>" class="px-5 py-2.5 text-gray-700 hover:text-emerald-600 font-medium transition-colors duration-200">Login</a>
                    <a href="<?= base_url ('auth/login')?>" class="px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-400 hover:from-emerald-600 hover:to-emerald-500 text-white rounded-lg font-medium shadow-md hover:shadow-lg transition-all duration-200">Get Started</a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="lg:hidden p-2 text-gray-700 hover:bg-gray-100 rounded-lg" aria-label="Open menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="pt-32 pb-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="grid lg:grid-cols-2 gap-14 items-center">
                <div class="space-y-8">
                    <h1 class="text-6xl font-bold text-gray-900 leading-tight">Smart Shoe Care Management</h1>
                    <p class="text-xl text-gray-900 leading-relaxed">Digitize and streamline your shoe cleaning business with our integrated management platform.</p>
                    <div class="flex gap-3">
                        <button class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-400 hover:from-emerald-600 hover:to-emerald-500 text-white rounded-xl font-semibold text-lg shadow-lg transition-all">Get Started</button>
                        <button class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-300 hover:from-emerald-600 hover:to-teal-400 text-white rounded-xl font-semibold text-lg shadow-lg transition-all">Watch Demo</button>
                    </div>
                </div>
                
                <div class="relative">
                    <div class="bg-emerald-300 rounded-3xl p-12 shadow-2xl transform rotate-1">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-xl">
                            <div class="aspect-video bg-gray-200 flex items-center justify-center">
                                <img src="<?= site_url ('assets/img/konten/dashbd.png') ?>" alt="dashboard">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-3">Powerful Features for Your Business</h2>
                <p class="text-xl text-gray-600">Everything you need to manage and grow your shoe care business efficiently</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">AI Recommendations</h3>
                    <p class="text-gray-600">Smart suggestions for optimal cleaning methods and product usage based on shoe materials and condition.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Financial Management</h3>
                    <p class="text-gray-600">Track revenue, expenses, and profitability with detailed financial reports and analytics.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Inventory Tracking</h3>
                    <p class="text-gray-600">Monitor cleaning supplies, equipment, and materials with automated low-stock alerts.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow">
                    <div class="w-16 h-16 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Order Monitoring</h3>
                    <p class="text-gray-600">Real-time order tracking from pickup to delivery with customer notifications and updates.</p>
                </div>
            </div>
        </div>
    </section>

  <!-- Pricing Section -->
<section id="pricing" class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-3">Affordable Plans for Every Business Size</h2>
            <p class="text-xl text-gray-600">Choose the perfect plan to scale your shoe care business</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Free Plan -->
            <div class="bg-gray-50 rounded-2xl p-8 shadow-md hover:shadow-xl transition-all">
                <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Free</h3>
                <div class="text-center mb-2">
                    <span class="text-4xl font-bold text-gray-900">Rp 0</span>
                    <span class="text-gray-600 text-lg"> / Gratis Selamanya</span>
                </div>
                <p class="text-center text-gray-600 mb-8">Perfect for small businesses</p>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">Up to 100 orders/month</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">Basic inventory tracking</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">Email support</span>
                    </li>
                </ul>
                
                <a href="<?= site_url('auth/register') ?>" class="block w-full py-3 bg-gray-200 hover:bg-gray-300 text-gray-900 rounded-xl font-semibold transition-colors text-center">Get Started</a>
            </div>

            <!-- Pro Plan (Popular) -->
            <div class="bg-blue-50 rounded-2xl p-8 shadow-xl border-2 border-blue-200 relative hover:shadow-2xl transition-all">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="bg-teal-700 text-white px-6 py-1.5 rounded-full text-sm font-semibold">Most Popular</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 text-center mb-2 mt-4">Pro</h3>
                <div class="text-center mb-2">
                    <span class="text-4xl font-bold text-emerald-600">Rp 99.000</span>
                    <span class="text-gray-600 text-lg"> / Bulan</span>
                </div>
                <p class="text-center text-gray-600 mb-8">Ideal for growing businesses</p>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">Up to 10.000 orders/month</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">Advanced analytics</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">AI recommendations</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">Priority support</span>
                    </li>
                </ul>
                
                <a id="btn-pro-plan" href="<?= base_url('pembayaran/checkout/2') ?>" class="relative z-10 block w-full py-3 bg-teal-700 hover:bg-teal-800 text-white rounded-xl font-semibold transition-colors text-center cursor-pointer">Get Started</a>
            </div>

            <!-- Premium Plan -->
            <div class="bg-gray-50 rounded-2xl p-8 shadow-md hover:shadow-xl transition-all">
                <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Premium</h3>
                <div class="text-center mb-2">
                    <span class="text-4xl font-bold text-gray-900">Rp 199.000</span>
                    <span class="text-gray-600 text-lg"> / Bulan</span>
                </div>
                <p class="text-center text-gray-600 mb-8">For enterprise businesses</p>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">Unlimited orders</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">Custom integrations</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">Multi-location support</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-700">24/7 phone support</span>
                    </li>
                </ul>
                
                <a href="<?= site_url('pembayaran/checkout/3') ?>" class="block w-full py-3 bg-gray-200 hover:bg-gray-300 text-gray-900 rounded-xl font-semibold transition-colors text-center">Get Started</a>
            </div>
        </div>
    </div>
</section>
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-3">Trusted By Thousands of Businesses</h2>
            <p class="text-xl text-gray-600">Hear directly from KixEra users</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow">
                <div class="flex items-center gap-1 mb-4">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                </div>
                <p class="text-gray-700 mb-6 italic">"KixEra helps us save 3-4 hours of work every day. Orders become much neater and easier to track."</p>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-bold text-lg">J</div>
                    <div>
                        <p class="font-semibold text-gray-900">Jonathan</p>
                        <p class="text-sm text-gray-600">Clean Kicks Studio</p>
                    </div>
                </div>
            </div>
            <!-- Testimonial 2 -->
<div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow">
    <div class="flex items-center gap-1 mb-4">
        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
        </svg>
        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
        </svg>
        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
        </svg>
        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
        </svg>
        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
        </svg>
    </div>
    <p class="text-gray-700 mb-6 italic">"Sejak menggunakan KixEra, inventaris selalu terkendali. Tidak pernah ada selisih dan laporan menjadi otomatis."</p>
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-bold text-lg">M</div>
        <div>
            <p class="font-semibold text-gray-900">Maya</p>
            <p class="text-sm text-gray-600">Sneakers Care Pro</p>
        </div>
    </div>
</div>

<!-- Testimonial 3 -->
<div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow">
    <div class="flex items-center gap-1 mb-4">
        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
        </svg>
        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
        </svg>
        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
        </svg>
        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
        </svg>
        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
        </svg>
    </div>
    <p class="text-gray-700 mb-6 italic">"Antarmuka yang mudah dipahami, fitur lengkap, dan dukungan pelanggan yang responsif. Sangat membantu untuk pertumbuhan bisnis kami."</p>
    <div class="flex items-center gap-3">
        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-lg">R</div>
        <div>
            <p class="font-semibold text-gray-900">Rizky</p>
            <p class="text-sm text-gray-600">Premium Shoe Spa</p>
        </div>
    </div>
</div>
        </div>
    </div>
</section>

<!-- Statistics / Achievements Section -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-3">Proven to Help Thousands of Businesses</h2>
            <p class="text-xl text-gray-600">Real data and achievements from KixEra users</p>
        </div>
        
        <div class="grid md:grid-cols-4 gap-8">
            <!-- Stat 1 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-emerald-100 rounded-2xl mb-4">
                    <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-5xl font-bold text-gray-900 mb-2">150+</h3>
                <p class="text-gray-600 font-medium">Registered Businesses</p>
            </div>

            <!-- Stat 2 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-2xl mb-4">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-5xl font-bold text-gray-900 mb-2">32K+</h3>
                <p class="text-gray-600 font-medium">Orders Processed</p>
            </div>

            <!-- Stat 3 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-purple-100 rounded-2xl mb-4">
                    <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-5xl font-bold text-gray-900 mb-2">70%</h3>
                <p class="text-gray-600 font-medium">Efficiency Improvement</p>
            </div>

            <!-- Stat 4 -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-orange-100 rounded-2xl mb-4">
                    <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-5xl font-bold text-gray-900 mb-2">98%</h3>
                <p class="text-gray-600 font-medium">Customer Satisfaction</p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-3">How KixEra Works</h2>
            <p class="text-xl text-gray-600">Start managing your business in just 4 easy steps</p>
        </div>
        
        <div class="grid md:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-500 text-white rounded-full text-2xl font-bold mb-6">1</div>
                    <div class="w-16 h-16 bg-emerald-100 rounded-xl flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Register & Login</h3>
                    <p class="text-gray-600">Create an account in seconds. Free to start.</p>
                </div>
                <!-- Arrow -->
                <div class="hidden md:block absolute top-1/2 -right-4 transform -translate-y-1/2 z-10">
                    <svg class="w-8 h-8 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-500 text-white rounded-full text-2xl font-bold mb-6">2</div>
                    <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Set Up Products & Stock</h3>
                    <p class="text-gray-600">Add product catalog, set prices, and real-time stock.</p>
                </div>
                <!-- Arrow -->
                <div class="hidden md:block absolute top-1/2 -right-4 transform -translate-y-1/2 z-10">
                    <svg class="w-8 h-8 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-500 text-white rounded-full text-2xl font-bold mb-6">3</div>
                    <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Manage Orders</h3>
                    <p class="text-gray-600">Process orders faster with automatic status.</p>
                </div>
                <!-- Arrow -->
                <div class="hidden md:block absolute top-1/2 -right-4 transform -translate-y-1/2 z-10">
                    <svg class="w-8 h-8 text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="relative">
                <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-xl transition-shadow text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-500 text-white rounded-full text-2xl font-bold mb-6">4</div>
                    <div class="w-16 h-16 bg-orange-100 rounded-xl flex items-center justify-center mb-6 mx-auto">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">View Reports</h3>
                    <p class="text-gray-600">Get daily/weekly reports automatically.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Case Study / Success Stories Section -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-3">Our Customer Success Stories</h2>
            <p class="text-xl text-gray-600">See how KixEra transformed their businesses</p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Case Study 1 -->
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-8 shadow-lg">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-14 h-14 bg-emerald-500 rounded-full flex items-center justify-center text-white font-bold text-xl">MC</div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Mutiara Craft</h3>
                        <p class="text-sm text-gray-600">Shoe Craft SME</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-3 py-1 bg-red-100 text-red-700 text-sm font-semibold rounded-full">Before</span>
                        </div>
                        <ul class="space-y-2 text-gray-700">
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-red-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Stock often lost & not synchronized</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-red-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Slow & manual order process</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-red-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Reports made manually in Excel</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-full">After</span>
                        </div>
                        <ul class="space-y-2 text-gray-700">
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span><strong>65%</strong> faster order processing</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Stock always updated in real-time</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Sales increased by <strong>28%</strong> in 2 months</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Case Study 2 -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 shadow-lg">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-14 h-14 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-xl">SS</div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Sole Sanctuary</h3>
                        <p class="text-sm text-gray-600">Premium Shoe Care</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-3 py-1 bg-red-100 text-red-700 text-sm font-semibold rounded-full">Before</span>
                        </div>
                        <ul class="space-y-2 text-gray-700">
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-red-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Difficult to track customer order status</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-red-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Many complaints about delays</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-red-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span>No notification system</span>
                            </li>
                        </ul>
                    </div>
                    
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-full">After</span>
                        </div>
                        <ul class="space-y-2 text-gray-700">
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Real-time order tracking</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Auto notification to customers</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Satisfaction rating increased by <strong>45%</strong></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Comparison Table Section -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-20">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-3">Why Choose KixEra?</h2>
            <p class="text-xl text-gray-600">Compare KixEra's efficiency with traditional methods</p>
        </div>
        
        <!-- Sistem Otomatis vs Metode Manual -->
<div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-12 max-w-6xl mx-auto">
        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-8 py-6">
            <h3 class="text-2xl font-bold text-white">Automated System vs Manual Method</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-8 py-4 text-left text-gray-900 font-semibold border-b">Feature</th>
                        <th class="px-8 py-4 text-center text-blue-600 font-semibold border-b">Automated System</th>
                        <th class="px-8 py-4 text-center text-gray-600 font-semibold border-b">Manual</th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="hover:bg-gray-50">
                        <td class="px-8 py-5 border-b font-medium text-gray-900">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span>Processing Speed</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 border-b text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Seconds to minutes</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 border-b text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Long & gradual process</span>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <td class="px-8 py-5 border-b font-medium text-gray-900">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Data Accuracy</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 border-b text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Consistent & minimal errors</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 border-b text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Prone to human error</span>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <td class="px-8 py-5 border-b font-medium text-gray-900">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span>Real-time Monitoring</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 border-b text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Automatic updates anytime</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 border-b text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Requires periodic manual checks</span>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <td class="px-8 py-5 border-b font-medium text-gray-900">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Operational Costs</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 border-b text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Saves time & effort</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 border-b text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">More expensive, requires many staff</span>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50">
                        <td class="px-8 py-5 font-medium text-gray-900">
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span>Reports & Analytics</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Automatic & ready to download</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <svg class="w-8 h-8 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Must be compiled manually from scratch</span>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    </div>
</section>
    <!-- CTA Section -->
    <section class="py-28 bg-emerald-500">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-white mb-5 leading-tight">Ready to Transform Your Shoe Care Business?</h2>
            <p class="text-xl text-blue-100 mb-8">Join thousands of businesses already using KixEra to streamline their operations and increase profits.</p>
            <div class="flex justify-center gap-4">
                <a href="<?= base_url ('auth/login') ?>" class="px-8 py-4 bg-white hover:bg-gray-100 text-emerald-500 rounded-xl font-semibold text-lg shadow-lg transition-colors">Start Free Trial</a>
                <button class="px-8 py-4 border-2 border-white/30 hover:border-white/50 hover:bg-white/10 text-white rounded-xl font-semibold text-lg transition-all">Schedule Demo</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-teal-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="grid md:grid-cols-3 gap-12 mb-12">
                <div>
                    <h3 class="text-2xl font-bold mb-6">KixEra</h3>
                    <p class="text-blue-100 mb-6">The complete shoe care business management platform designed to help you grow and streamline your operations.</p>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Product</h4>
                    <ul class="space-y-3">
                        <li><a href="#features" class="text-blue-100 hover:text-white transition-colors">Features</a></li>
                        <li><a href="#pricing" class="text-blue-100 hover:text-white transition-colors">Pricing</a></li>
                        <li><a href="#integrations" class="text-blue-100 hover:text-white transition-colors">Integrations</a></li>
                        <li><a href="#api" class="text-blue-100 hover:text-white transition-colors">Location</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-semibold mb-4">Company</h4>
                    <ul class="space-y-3">
                        <li><a href="#about" class="text-blue-100 hover:text-white transition-colors">About</a></li>
                        <li><a href="#contact" class="text-blue-100 hover:text-white transition-colors">Contact</a></li>
                        <li><a href="#support" class="text-blue-100 hover:text-white transition-colors">Support</a></li>
                        <li><a href="#privacy" class="text-blue-100 hover:text-white transition-colors">Privacy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-emerald-600 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-blue-100">© KixEra 2025. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#terms" class="text-blue-100 hover:text-white transition-colors">Terms</a>
                    <a href="#privacy" class="text-blue-100 hover:text-white transition-colors">Privacy</a>
                    <a href="#cookies" class="text-blue-100 hover:text-white transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>