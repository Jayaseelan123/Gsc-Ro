@extends('layouts.frontend')
@section('title', 'Terms of Service')
@section('content')
    @php
        $company = $settings['company_name'] ?? ($settings['website_name'] ?? 'CSRGO');
        $email = $settings['email'] ?? null;
        $phone = $settings['phone'] ?? null;
        $address = $settings['address'] ?? null;
    @endphp

    @component('frontend.partials.legal-page', ['title' => 'Terms of Service', 'updated' => '30 September 2026'])
    <section id="acceptance">
        <h2>1. Acceptance of these terms</h2>
        <p>These Terms of Service apply to your use of this website, which is operated by <strong>{{ $company }}</strong>
            ("we", "us", "our"). By using the website you agree to these terms. If you do not agree, please do not use the
            website.</p>
    </section>

    <section id="use-of-website">
        <h2>2. Use of the website</h2>
        <p>You may use this website to learn about our products and to contact us. You agree not to:</p>
        <ul>
            <li>submit false, misleading or someone else's information in our forms;</li>
            <li>send spam, automated submissions or harmful code;</li>
            <li>try to access the admin area or any part of the website you are not authorised to use;</li>
            <li>copy or scrape the website's content in bulk, or use it in a way that could damage or overload it.</li>
        </ul>
        <p>We may block access to anyone who breaks these rules.</p>
    </section>

    <section id="products-info">
        <h2>3. Product information</h2>
        <p>We try to keep product descriptions, specifications and images accurate and up to date. However, images are for
            illustration, and specifications may change without notice. Please confirm the details that matter to you with
            our team before placing an order.</p>
    </section>

    <section id="prices-quotes">
        <h2>4. Prices and quotations</h2>
        <ul>
            <li>Prices are not shown on the website. Prices are available on request and are confirmed in a written
                quotation.</li>
            <li>A quotation is valid only for the period and terms stated in it. Taxes, delivery and installation are
                charged as stated in the quotation.</li>
        </ul>
    </section>

    <section id="enquiries">
        <h2>5. Enquiries and orders</h2>
        <p>Sending an enquiry or requirement through the website does not create an order or a contract. An order is
            confirmed only when both you and {{ $company }} agree to it in writing (for example, a signed quotation or
            purchase order). Payment, delivery, warranty and return terms will be set out in that agreement.</p>
    </section>

    <section id="intellectual-property">
        <h2>6. Intellectual property</h2>
        <p>The website's content, including text, logos, product images and design, belongs to {{ $company }} or is used
            with permission. You may view and print pages for your own business use, but you may not copy, publish or sell
            the content without our written permission.</p>
    </section>

    <section id="third-party-links">
        <h2>7. Third-party links</h2>
        <p>The website links to services run by others, such as WhatsApp, Google Maps and social media pages. We are not
            responsible for their content, availability or privacy practices.</p>
    </section>

    <section id="disclaimer">
        <h2>8. Disclaimer</h2>
        <p>The website is provided "as is". We do our best to keep it available and error-free, but we do not guarantee that
            it will always be available, uninterrupted or free of errors.</p>
    </section>

    <section id="liability">
        <h2>9. Limitation of liability</h2>
        <p>To the extent allowed by law, {{ $company }} is not liable for any indirect or consequential loss arising from
            your use of this website or reliance on its content. Nothing in these terms limits any liability that cannot be
            limited by law. Liability for products you buy from us is governed by the agreement for that purchase.</p>
    </section>

    <section id="privacy">
        <h2>10. Privacy</h2>
        <p>How we handle the personal information you send us is explained in our <a href="{{ route('privacy') }}">Privacy
                Policy</a>.</p>
    </section>

    <section id="law">
        <h2>11. Governing law</h2>
        <p>These terms are governed by the laws of India. Any dispute relating to them will be handled by the courts that
            have jurisdiction over {{ $company }}'s registered place of business.</p>
    </section>

    <section id="changes">
        <h2>12. Changes to these terms</h2>
        <p>We may update these terms from time to time. The "Last updated" date at the top of this page shows when they were
            last changed. Continuing to use the website after a change means you accept the updated terms.</p>
    </section>


    @endcomponent
@endsection