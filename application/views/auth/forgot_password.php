<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - KixEra</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-emerald-100 via-white to-emerald-300">
    <main class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md">
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl overflow-hidden">
                <!-- Top Gradient Bar -->
                <div class="h-1 bg-gradient-to-r from-emerald-500 via-emerald-300 to-emerald-500"></div>
                
                <!-- Back Button -->
                <div class="px-8 pt-6">
                    <a href="<?= base_url('auth/login') ?>" class="inline-flex items-center gap-2 text-gray-600 hover:text-emerald-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span class="text-sm font-medium">Back to Login</span>
                    </a>
                </div>

                <!-- Logo -->
                <div class="flex justify-center pt-4 pb-4">
                    <div class="text-4xl font-bold text-emerald-500">KixEra</div>
                </div>

                <div class="px-8 pb-8">
                    <!-- Header -->
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2">
                            Forgot Password?
                        </h2>
                        <p class="text-gray-600 text-sm">
                            Enter your email address and we'll generate a reset link for you.
                        </p>
                    </div>

                    <!-- Flash Messages -->
                    <?php if($this->session->flashdata('error')): ?>
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl text-sm">
                        <?= $this->session->flashdata('error') ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($this->session->flashdata('info')): ?>
                    <div class="mb-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-xl text-sm">
                        <?= $this->session->flashdata('info') ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if($this->session->flashdata('success')): ?>
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl text-sm">
                        <?= $this->session->flashdata('success') ?>
                    </div>
                    <?php endif; ?>

                    <!-- Reset Link Display -->
                    <?php if($this->session->flashdata('reset_link')): ?>
                    <div class="mb-6 p-4 bg-emerald-50 rounded-xl border border-emerald-200">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div class="flex-1">
                                <h3 class="font-semibold text-emerald-800 mb-2">Reset Link Generated!</h3>
                                <p class="text-sm text-emerald-700 mb-3">Click the link below or copy it to reset your password:</p>
                                <div class="bg-white p-3 rounded-lg border border-emerald-300 break-all text-sm">
                                    <a href="<?= $this->session->flashdata('reset_link') ?>" class="text-emerald-600 hover:underline">
                                        <?= $this->session->flashdata('reset_link') ?>
                                    </a>
                                </div>
                                <button onclick="copyResetLink('<?= $this->session->flashdata('reset_link') ?>')" class="mt-3 text-sm text-emerald-600 hover:text-emerald-700 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                    </svg>
                                    Copy Link
                                </button>
                                <p class="text-xs text-emerald-600 mt-2">
                                    ⏰ Link expires in 1 hour
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Form -->
                    <form method="POST" action="<?= base_url('auth/forgot_password') ?>" class="space-y-6">
                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email Address
                            </label>
                            <div class="relative">
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="Enter your registered email"
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition"
                                />
                                <svg class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-medium py-3 px-4 rounded-xl shadow-lg transition flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                            <span>Generate Reset Link</span>
                        </button>
                    </form>

                    <!-- Info Box -->
                    <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-200">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div class="text-sm text-blue-700">
                                <p class="font-medium mb-1">What happens next?</p>
                                <ul class="list-disc list-inside space-y-1 text-blue-600">
                                    <li>We'll generate a secure reset link</li>
                                    <li>The link will be displayed on this page</li>
                                    <li>Click or copy the link to reset your password</li>
                                    <li>Link expires in 1 hour for security</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function copyResetLink(link) {
            navigator.clipboard.writeText(link).then(() => {
                alert('Reset link copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy:', err);
            });
        }
    </script>
</body>
</html>
