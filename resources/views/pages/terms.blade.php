@extends('layouts.app')

@section('title', __('Terms & Conditions'))

@section('content')
<div class="pt-24 pb-16 bg-white dark:bg-dark-950">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="section-title">{{ __('Terms & Conditions') }}</h1>
            <p class="section-subtitle">{{ __('Premium Electric Motorcycles Algeria') }}</p>
        </div>

        <div class="glass-card p-8 md:p-12 prose prose-surface dark:prose-invert max-w-none">
            <h2>1. Introduction</h2>
            <p>Welcome to MotoPlus. By accessing our website and using our services, you agree to these terms and conditions.</p>

            <h2>2. Products & Pricing</h2>
            <p>All prices are listed in Algerian Dinar (DZD). We reserve the right to modify prices at any time. Product availability is subject to change without notice.</p>

            <h2>3. Orders & Payment</h2>
            <p>Orders are confirmed upon payment processing. We accept cash on delivery (limited wilayas) and bank transfers. Full payment is required before delivery.</p>

            <h2>4. Delivery</h2>
            <p>We deliver to all 58 wilayas of Algeria. Delivery times vary by location. Shipping costs are calculated based on wilaya and delivery method.</p>

            <h2>5. Warranty</h2>
            <p>All new vehicles come with a manufacturer warranty. Warranty terms vary by brand and model. See product page for specific warranty information.</p>

            <h2>6. Returns & Refunds</h2>
            <p>Returns are accepted within 14 days of delivery for unused products in original packaging. Refunds are processed within 7 business days.</p>

            <h2>7. Privacy</h2>
            <p>Your personal information is handled in accordance with our Privacy Policy. We do not share your data with third parties without your consent.</p>

            <h2>8. Contact</h2>
            <p>For questions about these terms, please contact us at contact@motoplus.dz.</p>
        </div>
    </div>
</div>
@endsection
