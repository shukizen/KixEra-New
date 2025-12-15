<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KixEra - Login</title>
    <meta name="description" content="Login to KixEra to manage your shoe care business with ease.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-emerald-300">
    <!-- Language Toggle -->
    <div class="fixed top-4 right-4 z-50">
        <button 
            onclick="toggleLanguage()"
            class="bg-white/90 backdrop-blur-sm hover:bg-white border border-gray-200 rounded-lg px-4 py-2 shadow-lg transition flex items-center gap-2 font-medium text-gray-700 hover:text-emerald-600"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
            </svg>
            <span id="langToggleText">ID</span>
        </button>
    </div>

    <main class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-6xl flex flex-col lg:flex-row items-center gap-12 lg:gap-24">
            
            <!-- Left Section - Hero -->
            <section class="flex-1 flex flex-col items-center text-center space-y-8">
                <!-- Image Circle -->
                <div class="relative w-80 h-80 lg:w-96 lg:h-96">
                    <div class="absolute inset-0 bg-emerald-500/10 rounded-full flex items-center justify-center">
                        <img src="<?= site_url ('assets/img/konten/dashbd.png') ?>" alt="dashboard">
                    </div>
                </div>
                
                <!-- Hero Text -->
                <div class="space-y-4 max-w-md">
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-800" data-i18n="hero.title">
                        Digitalize Your Shoe Care Business
                    </h1>
                    <p class="text-lg text-gray-600" data-i18n="hero.subtitle">
                        Streamline operations, track inventory, and manage customer relationships with KixEra's powerful platform.
                    </p>
                </div>
            </section>

            <!-- Right Section - Login Form -->
            <section class="w-full max-w-md">
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden">
                    <!-- Top Gradient Bar -->
                    <div class="h-1 bg-gradient-to-r from-emerald-500 via-emerald-300 to-emerald-500"></div>
                    
                    <!-- Logo -->
                    <div class="flex justify-center pt-8 pb-4">
                        <div class="text-4xl font-bold text-emerald-500">KixEra</div>
                    </div>

                    <div class="px-8 pb-8">
                        <!-- Header -->
                        <div class="text-center mb-8">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-2" data-i18n="login.title">
                                Welcome Back to KixEra
                            </h2>
                            <p class="text-gray-600" data-i18n="login.subtitle">
                                Manage your shoe care business with ease.
                            </p>
                        </div>

                        <!-- Login Form -->
                        <form class="space-y-6" onsubmit="handleLogin(event)">
                            <!-- Email Field -->
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-medium text-gray-700" data-i18n="form.email">
                                    Email Address
                                </label>
                                <div class="relative">
                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        data-i18n-placeholder="form.emailPlaceholder"
                                        placeholder="Enter your email"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                                    />
                                    <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Password Field -->
                            <div class="space-y-2">
                                <label for="password" class="block text-sm font-medium text-gray-700" data-i18n="form.password">
                                    Password
                                </label>
                                <div class="relative">
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        data-i18n-placeholder="form.passwordPlaceholder"
                                        placeholder="Enter your password"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                                    />
                                    <button
                                        type="button"
                                        onclick="togglePassword()"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                                    >
                                        <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="flex items-center justify-between">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input
                                        type="checkbox"
                                        id="remember"
                                        name="remember"
                                        class="w-4 h-4 text-emerald-500 border-gray-300 rounded focus:ring-emerald-500 cursor-pointer"
                                    />
                                    <span class="text-sm text-gray-600" data-i18n="login.rememberMe">Remember Me</span>
                                </label>
                                <a href="#" class="text-sm text-teal-700 hover:text-teal-800 hover:underline transition" data-i18n="login.forgotPassword">
                                    Forgot Password?
                                </a>
                            </div>

                            <!-- Login Button -->
                            <button
                                type="submit"
                                class="w-full bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-medium py-3 px-4 rounded-xl shadow-lg transition flex items-center justify-center gap-2"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                </svg>
                                <span data-i18n="login.loginButton">Login to KixEra</span>
                            </button>

                            <!-- Divider -->
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-4 bg-white text-gray-500" data-i18n="login.orContinue">or continue with</span>
                                </div>
                            </div>

                            <!-- Google Login Button -->
                            <button
                                type="button"
                                onclick="handleGoogleLogin()"
                                class="w-full bg-white hover:bg-gray-50 active:bg-gray-100 border border-gray-300 text-gray-700 font-medium py-3 px-4 rounded-xl shadow-sm transition flex items-center justify-center gap-3"
                            >
                                <svg class="w-5 h-5" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>
                                <span data-i18n="login.googleLogin">Login with Google</span>
                            </button>
                        </form>

                        <!-- Register Link -->
                        <div class="mt-8 text-center space-y-1">
                            <p class="text-sm text-gray-600" data-i18n="login.noAccount">Don't have an account?</p>
                            <a href="<?= base_url ('auth/register') ?>" class="text-emerald-500 hover:text-emerald-600 font-medium hover:underline transition" data-i18n="login.registerNow">
                                Register now
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        // Translation data
        const translations = {
            en: {
                hero: {
                    title: "Digitalize Your Shoe Care Business",
                    subtitle: "Streamline operations, track inventory, and manage customer relationships with KixEra's powerful platform."
                },
                login: {
                    title: "Welcome Back to KixEra",
                    subtitle: "Manage your shoe care business with ease.",
                    rememberMe: "Remember Me",
                    forgotPassword: "Forgot Password?",
                    loginButton: "Login to KixEra",
                    orContinue: "or continue with",
                    googleLogin: "Login with Google",
                    noAccount: "Don't have an account?",
                    registerNow: "Register now"
                },
                form: {
                    email: "Email Address",
                    emailPlaceholder: "Enter your email",
                    password: "Password",
                    passwordPlaceholder: "Enter your password"
                }
            },
            id: {
                hero: {
                    title: "Digitalkan Bisnis Perawatan Sepatu Anda",
                    subtitle: "Sederhanakan operasi, lacak inventori, dan kelola hubungan pelanggan dengan platform KixEra yang powerful."
                },
                login: {
                    title: "Selamat Datang Kembali di KixEra",
                    subtitle: "Kelola bisnis perawatan sepatu Anda dengan mudah.",
                    rememberMe: "Ingat Saya",
                    forgotPassword: "Lupa Password?",
                    loginButton: "Masuk ke KixEra",
                    orContinue: "atau lanjutkan dengan",
                    googleLogin: "Masuk dengan Google",
                    noAccount: "Belum punya akun?",
                    registerNow: "Daftar sekarang"
                },
                form: {
                    email: "Alamat Email",
                    emailPlaceholder: "Masukkan email Anda",
                    password: "Password",
                    passwordPlaceholder: "Masukkan password Anda"
                }
            }
        };

        // Get current language from localStorage or default to 'en'
        let currentLang = localStorage.getItem('language') || 'en';

        // Apply translations
        function applyTranslations(lang) {
            document.querySelectorAll('[data-i18n]').forEach(element => {
                const key = element.getAttribute('data-i18n');
                const keys = key.split('.');
                let translation = translations[lang];
                
                keys.forEach(k => {
                    translation = translation[k];
                });
                
                element.textContent = translation;
            });

            // Handle placeholders
            document.querySelectorAll('[data-i18n-placeholder]').forEach(element => {
                const key = element.getAttribute('data-i18n-placeholder');
                const keys = key.split('.');
                let translation = translations[lang];
                
                keys.forEach(k => {
                    translation = translation[k];
                });
                
                element.placeholder = translation;
            });

            // Update language toggle button
            document.getElementById('langToggleText').textContent = lang === 'en' ? 'ID' : 'EN';
            document.documentElement.lang = lang;
        }

        // Toggle language
        function toggleLanguage() {
            currentLang = currentLang === 'en' ? 'id' : 'en';
            localStorage.setItem('language', currentLang);
            applyTranslations(currentLang);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            applyTranslations(currentLang);
        });

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
            }
        }

        function handleLogin(event) {
            event.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const remember = document.getElementById('remember').checked;
            
            const message = currentLang === 'en' 
                ? `Login functionality would be implemented here!\n\nEmail: ${email}`
                : `Fungsi login akan diimplementasikan di sini!\n\nEmail: ${email}`;
            
            console.log('Login attempt:', { email, password, remember });
            alert(message);
        }

        function handleGoogleLogin() {
            const message = currentLang === 'en' 
                ? 'Google OAuth would be implemented here!'
                : 'Google OAuth akan diimplementasikan di sini!';
            
            console.log('Google login clicked');
            alert(message);
        }
    </script>
</body>
</html>