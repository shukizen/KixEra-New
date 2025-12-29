<!-- Main Content -->
<main class="flex-1 ml-64">
    <!-- Header -->
    <header class="bg-white border-b border-gray-100 shadow-sm px-6 py-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="<?= base_url('pemilik/pengaturan') ?>" 
                   class="text-gray-500 hover:text-emerald-500 transition">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800"><?= lang_text('choose_subscription') ?></h1>
                    <p class="text-sm text-gray-500"><?= lang_text('upgrade_business') ?></p>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <div class="p-6">
        <!-- Current Plan Badge -->
        <?php if(isset($current_plan) && $current_plan): ?>
        <div class="mb-6 bg-gradient-to-r from-emerald-500 to-teal-400 rounded-2xl p-4 text-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <i class="fas fa-crown text-2xl text-yellow-300"></i>
                </div>
                <div>
                    <p class="text-emerald-100 text-sm"><?= lang_text('active_plan') ?></p>
                    <p class="text-xl font-bold"><?= ucfirst($current_plan) ?></p>
                </div>
            </div>
            <?php if(isset($subscription_end)): ?>
            <div class="text-right">
                <p class="text-emerald-100 text-sm"><?= lang_text('valid_until') ?></p>
                <p class="font-semibold"><?= date('d M Y', strtotime($subscription_end)) ?></p>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Pricing Cards -->
        <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            
            <!-- Free Plan -->
            <div class="bg-gray-50 rounded-3xl p-8 border border-gray-200 hover:shadow-lg transition-all">
                <div class="text-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4"><?= lang_text('free_plan') ?></h3>
                    <div class="mb-2">
                        <span class="text-4xl font-bold text-gray-900">Rp 0</span>
                        <span class="text-gray-500 text-sm">/ <?= lang_text('free_forever') ?></span>
                    </div>
                    <p class="text-emerald-600 text-sm"><?= lang_text('perfect_small_business') ?></p>
                </div>
                
                <ul class="space-y-3 mb-8 text-sm">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-emerald-500"></i>
                        <span class="text-gray-700"><?= lang_text('orders_100') ?></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-emerald-500"></i>
                        <span class="text-gray-700"><?= lang_text('basic_inventory') ?></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-emerald-500"></i>
                        <span class="text-gray-700"><?= lang_text('email_support') ?></span>
                    </li>
                </ul>
                
                <button disabled class="w-full py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-full font-semibold cursor-not-allowed hover:bg-gray-100 transition">
                    <?= lang_text('get_started') ?>
                </button>
            </div>

            <!-- Pro Plan (Popular) -->
            <div class="bg-white rounded-3xl p-8 border-2 border-emerald-400 shadow-xl relative">
                <!-- Most Popular Badge -->
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="bg-emerald-600 text-white px-4 py-1.5 rounded-full text-xs font-semibold shadow-lg">
                        <?= lang_text('most_popular') ?>
                    </span>
                </div>
                
                <div class="text-center mb-6 pt-2">
                    <h3 class="text-xl font-bold text-gray-900 mb-4"><?= lang_text('pro_plan') ?></h3>
                    <div class="mb-2">
                        <span class="text-4xl font-bold text-emerald-600">Rp 99.000</span>
                        <span class="text-gray-500 text-sm">/ <?= lang_text('per_month') ?></span>
                    </div>
                    <p class="text-emerald-600 text-sm"><?= lang_text('ideal_growing_business') ?></p>
                </div>
                
                <ul class="space-y-3 mb-8 text-sm">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-emerald-500"></i>
                        <span class="text-gray-700"><?= lang_text('orders_10000') ?></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-emerald-500"></i>
                        <span class="text-gray-700"><?= lang_text('advanced_analytics') ?></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-emerald-500"></i>
                        <span class="text-gray-700"><?= lang_text('ai_recommendations') ?></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-emerald-500"></i>
                        <span class="text-gray-700"><?= lang_text('priority_support') ?></span>
                    </li>
                </ul>
                
                <a href="<?= base_url('pembayaran/checkout/2') ?>" 
                   class="block w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full font-semibold text-center transition shadow-lg">
                    <?= lang_text('get_started') ?>
                </a>
            </div>

            <!-- Premium Plan -->
            <div class="bg-gray-50 rounded-3xl p-8 border border-gray-200 hover:shadow-lg transition-all">
                <div class="text-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4"><?= lang_text('premium_plan') ?></h3>
                    <div class="mb-2">
                        <span class="text-4xl font-bold text-gray-900">Rp 199.000</span>
                        <span class="text-gray-500 text-sm">/ <?= lang_text('per_month') ?></span>
                    </div>
                    <p class="text-emerald-600 text-sm"><?= lang_text('for_enterprise') ?></p>
                </div>
                
                <ul class="space-y-3 mb-8 text-sm">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-emerald-500"></i>
                        <span class="text-gray-700"><?= lang_text('unlimited_orders') ?></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-emerald-500"></i>
                        <span class="text-gray-700"><?= lang_text('custom_integrations') ?></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-emerald-500"></i>
                        <span class="text-gray-700"><?= lang_text('multi_location') ?></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-check text-emerald-500"></i>
                        <span class="text-gray-700"><?= lang_text('phone_support_24_7') ?></span>
                    </li>
                </ul>
                
                <button class="w-full py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:bg-gray-100 transition">
                    <?= lang_text('get_started') ?>
                </button>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="max-w-3xl mx-auto mt-16">
            <h2 class="text-2xl font-bold text-gray-900 text-center mb-8"><?= lang_text('faq_title') ?></h2>
            
            <div class="space-y-4">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="font-semibold text-gray-900 mb-2"><?= lang_text('faq_upgrade_q') ?></h3>
                    <p class="text-gray-600"><?= lang_text('faq_upgrade_a') ?></p>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="font-semibold text-gray-900 mb-2"><?= lang_text('faq_downgrade_q') ?></h3>
                    <p class="text-gray-600"><?= lang_text('faq_downgrade_a') ?></p>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="font-semibold text-gray-900 mb-2"><?= lang_text('faq_payment_q') ?></h3>
                    <p class="text-gray-600"><?= lang_text('faq_payment_a') ?></p>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="font-semibold text-gray-900 mb-2"><?= lang_text('faq_refund_q') ?></h3>
                    <p class="text-gray-600"><?= lang_text('faq_refund_a') ?></p>
                </div>
            </div>
        </div>

        <!-- Contact CTA -->
        <div class="max-w-3xl mx-auto mt-12 bg-gradient-to-r from-gray-800 to-gray-900 rounded-2xl p-8 text-center text-white">
            <h3 class="text-xl font-bold mb-2"><?= lang_text('need_enterprise') ?></h3>
            <p class="text-gray-300 mb-6"><?= lang_text('contact_sales_desc') ?></p>
            <a href="mailto:sales@kixera.id" class="inline-flex items-center gap-2 px-6 py-3 bg-white text-gray-900 rounded-xl font-semibold hover:bg-gray-100 transition">
                <i class="fas fa-envelope"></i>
                <?= lang_text('contact_sales') ?>
            </a>
        </div>
    </div>
</main>
