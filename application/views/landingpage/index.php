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
    </style>
</head>
<body class="bg-white antialiased">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-md border-b border-gray-100 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-20">
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="#home" class="flex items-center">
                        <img src="<?= base_url('assets/img/logo/logo.svg') ?>" alt="KixEra Logo" class="h-12 w-auto">
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
                    <a href="#register" class="px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-400 hover:from-emerald-600 hover:to-emerald-500 text-white rounded-lg font-medium shadow-md hover:shadow-lg transition-all duration-200">Get Started</a>
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
                                <img src="<?= base_url ('assets/img/konten/dashboard') ?>" alt="dashboard">
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
                <div class="bg-gray-50 rounded-2xl p-8 shadow-md">
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
                    
                    <button class="w-full py-3 bg-gray-200 hover:bg-gray-300 text-gray-900 rounded-xl font-semibold transition-colors">Get Started</button>
                </div>

                <!-- Pro Plan (Popular) -->
                <div class="bg-blue-50 rounded-2xl p-8 shadow-xl border-2 border-blue-200 relative">
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
                            <span class="text-gray-700">Up to 500 orders/month</span>
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
                    
                    <button class="w-full py-3 bg-teal-700 hover:bg-teal-800 text-white rounded-xl font-semibold transition-colors">Get Started</button>
                </div>

                <!-- Premium Plan -->
                <div class="bg-gray-50 rounded-2xl p-8 shadow-md">
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
                    
                    <button class="w-full py-3 bg-gray-200 hover:bg-gray-300 text-gray-900 rounded-xl font-semibold transition-colors">Contact Sales</button>
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
                <button class="px-8 py-4 bg-white hover:bg-gray-100 text-emerald-500 rounded-xl font-semibold text-lg shadow-lg transition-colors">Start Free Trial</button>
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
                        <li><a href="#api" class="text-blue-100 hover:text-white transition-colors">API</a></li>
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