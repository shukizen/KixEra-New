<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KixEra - Register Your Account</title>
    <meta name="description" content="Create your KixEra account and start managing your shoe care business digitally.">
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

    <main class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-7xl flex flex-col lg:flex-row items-center gap-16">
            
            <!-- Left Section - Features -->
            <section class="flex-1 flex flex-col items-center space-y-8 max-w-2xl" aria-label="Business benefits">
                <!-- Logo & Header -->
                <div class="text-center space-y-6">
                    <div class="text-5xl font-bold text-emerald-500 mb-4">KixEra</div>
                    <h1 class="text-3xl lg:text-4xl font-semibold text-gray-800" data-i18n="hero.title">
                        Transform Your Shoe Care Business
                    </h1>
                    <p class="text-lg text-gray-600 max-w-md mx-auto" data-i18n="hero.subtitle">
                        Join thousands of shoe care professionals who trust KixEra to streamline their operations and grow their business.
                    </p>
                </div>

                <!-- Dashboard Preview -->
                <div class="relative w-full max-w-lg">
                    <div class="absolute inset-0 bg-emerald-500/10 rounded-full -z-10 scale-110"></div>
                    <div class="bg-white rounded-2xl shadow-2xl p-4">
                        <img 
                            src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop" 
                            alt="Dashboard preview showing business analytics" 
                            class="w-full h-auto object-cover rounded-lg"
                        />
                    </div>
                </div>

                <!-- Features List -->
                <ul class="space-y-4 max-w-md">
                    <li class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <span class="text-gray-800" data-i18n="features.customer">Digital customer management</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-gray-800" data-i18n="features.billing">Automated billing & invoicing</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <span class="text-gray-800" data-i18n="features.analytics">Real-time business analytics</span>
                    </li>
                </ul>
            </section>

            <!-- Right Section - Registration Form -->
            <section class="w-full max-w-md" aria-label="Registration form">
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                    <!-- Logo for mobile -->
                    <div class="flex justify-center pt-8 pb-4 lg:hidden">
                        <div class="text-4xl font-bold text-emerald-500">KixEra</div>
                    </div>

                    <div class="px-8 pb-8 pt-4">
                        <!-- Header -->
                        <header class="text-center mb-8">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-2" data-i18n="register.title">
                                Create Your KixEra Account
                            </h2>
                            <p class="text-gray-600" data-i18n="register.subtitle">
                                Start managing your shoe care business digitally.
                            </p>
                        </header>

                        <!-- Registration Form -->
                        <form class="space-y-4" onsubmit="handleRegister(event)">
                            <!-- Full Name -->
                            <div class="space-y-2">
                                <label for="fullName" class="block text-sm font-medium text-gray-700" data-i18n="form.fullName">
                                    Full Name
                                </label>
                                <input
                                    type="text"
                                    id="fullName"
                                    name="fullName"
                                    data-i18n-placeholder="form.fullNamePlaceholder"
                                    placeholder="Enter your full name"
                                    required
                                    autocomplete="name"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                                />
                            </div>

                            <!-- Email -->
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-medium text-gray-700" data-i18n="form.email">
                                    Email Address
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    data-i18n-placeholder="form.emailPlaceholder"
                                    placeholder="Enter your email"
                                    required
                                    autocomplete="email"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                                />
                            </div>

                            <!-- Password -->
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
                                        placeholder="Create a password"
                                        required
                                        autocomplete="new-password"
                                        minlength="8"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                                    />
                                    <button
                                        type="button"
                                        onclick="togglePasswordField('password')"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                                    >
                                        <svg id="password-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500" data-i18n="form.passwordHint">Minimum 8 characters</p>
                            </div>

                            <!-- Confirm Password -->
                            <div class="space-y-2">
                                <label for="confirmPassword" class="block text-sm font-medium text-gray-700" data-i18n="form.confirmPassword">
                                    Confirm Password
                                </label>
                                <div class="relative">
                                    <input
                                        type="password"
                                        id="confirmPassword"
                                        name="confirmPassword"
                                        data-i18n-placeholder="form.confirmPasswordPlaceholder"
                                        placeholder="Confirm your password"
                                        required
                                        autocomplete="new-password"
                                        minlength="8"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                                    />
                                    <button
                                        type="button"
                                        onclick="togglePasswordField('confirmPassword')"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                                    >
                                        <svg id="confirmPassword-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Register Button -->
                            <button
                                type="submit"
                                class="w-full bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg transition mt-6"
                                data-i18n="register.registerButton"
                            >
                                Register
                            </button>

                            <!-- Divider -->
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-4 bg-white text-gray-500" data-i18n="register.or">or</span>
                                </div>
                            </div>

                            <!-- Google Register Button -->
                            <button
                                type="button"
                                onclick="handleGoogleRegister()"
                                class="w-full bg-white hover:bg-gray-50 active:bg-gray-100 border border-gray-300 text-gray-700 font-semibold py-3 px-4 rounded-xl shadow-sm transition flex items-center justify-center gap-3"
                            >
                                <svg class="w-5 h-5" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>
                                <span data-i18n="register.googleRegister">Register with Google</span>
                            </button>
                        </form>

                        <!-- Login Link -->
                        <footer class="mt-8 text-center space-y-1">
                            <p class="text-sm text-gray-600" data-i18n="register.hasAccount">Already have an account?</p>
                            <a href="<?= base_url ('auth/login') ?>" class="text-teal-700 hover:text-teal-800 font-semibold hover:underline transition" data-i18n="register.loginHere">
                                Login here
                            </a>
                        </footer>
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
                    title: "Transform Your Shoe Care Business",
                    subtitle: "Join thousands of shoe care professionals who trust KixEra to streamline their operations and grow their business."
                },
                features: {
                    customer: "Digital customer management",
                    billing: "Automated billing & invoicing",
                    analytics: "Real-time business analytics"
                },
                register: {
                    title: "Create Your KixEra Account",
                    subtitle: "Start managing your shoe care business digitally.",
                    registerButton: "Register",
                    or: "or",
                    googleRegister: "Register with Google",
                    hasAccount: "Already have an account?",
                    loginHere: "Login here"
                },
                form: {
                    fullName: "Full Name",
                    fullNamePlaceholder: "Enter your full name",
                    email: "Email Address",
                    emailPlaceholder: "Enter your email",
                    password: "Password",
                    passwordPlaceholder: "Create a password",
                    passwordHint: "Minimum 8 characters",
                    confirmPassword: "Confirm Password",
                    confirmPasswordPlaceholder: "Confirm your password"
                },
                messages: {
                    passwordMismatch: "Passwords do not match!",
                    passwordTooShort: "Password must be at least 8 characters long!",
                    registrationSuccess: "Registration successful!",
                    googleOAuth: "Google OAuth registration would be implemented here!"
                }
            },
            id: {
                hero: {
                    title: "Transformasi Bisnis Perawatan Sepatu Anda",
                    subtitle: "Bergabunglah dengan ribuan profesional perawatan sepatu yang mempercayai KixEra untuk menyederhanakan operasi dan mengembangkan bisnis mereka."
                },
                features: {
                    customer: "Manajemen pelanggan digital",
                    billing: "Tagihan & invoice otomatis",
                    analytics: "Analitik bisnis real-time"
                },
                register: {
                    title: "Buat Akun KixEra Anda",
                    subtitle: "Mulai kelola bisnis perawatan sepatu Anda secara digital.",
                    registerButton: "Daftar",
                    or: "atau",
                    googleRegister: "Daftar dengan Google",
                    hasAccount: "Sudah punya akun?",
                    loginHere: "Masuk di sini"
                },
                form: {
                    fullName: "Nama Lengkap",
                    fullNamePlaceholder: "Masukkan nama lengkap Anda",
                    email: "Alamat Email",
                    emailPlaceholder: "Masukkan email Anda",
                    password: "Password",
                    passwordPlaceholder: "Buat password",
                    passwordHint: "Minimal 8 karakter",
                    confirmPassword: "Konfirmasi Password",
                    confirmPasswordPlaceholder: "Konfirmasi password Anda"
                },
                messages: {
                    passwordMismatch: "Password tidak cocok!",
                    passwordTooShort: "Password harus minimal 8 karakter!",
                    registrationSuccess: "Pendaftaran berhasil!",
                    googleOAuth: "Pendaftaran Google OAuth akan diimplementasikan di sini!"
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

        function togglePasswordField(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye');
            
            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                `;
            } else {
                field.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
            }
        }

        function handleRegister(event) {
            event.preventDefault();
            
            const fullName = document.getElementById('fullName').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            // Validate passwords match
            if (password !== confirmPassword) {
                alert(translations[currentLang].messages.passwordMismatch);
                return;
            }
            
            // Validate password length
            if (password.length < 8) {
                alert(translations[currentLang].messages.passwordTooShort);
                return;
            }
            
            console.log('Registration attempt:', { fullName, email, password });
            
            const message = currentLang === 'en'
                ? `${translations[currentLang].messages.registrationSuccess}\n\nName: ${fullName}\nEmail: ${email}`
                : `${translations[currentLang].messages.registrationSuccess}\n\nNama: ${fullName}\nEmail: ${email}`;
            
            alert(message);
        }

        function handleGoogleRegister() {
            console.log('Google registration clicked');
            alert(translations[currentLang].messages.googleOAuth);
        }

        // Real-time password match validation
        document.getElementById('confirmPassword').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;
            
            if (confirmPassword && password !== confirmPassword) {
                this.setCustomValidity(translations[currentLang].messages.passwordMismatch);
                this.classList.add('border-red-500');
            } else {
                this.setCustomValidity('');
                this.classList.remove('border-red-500');
            }
        });
    </script>
</body>
</html>