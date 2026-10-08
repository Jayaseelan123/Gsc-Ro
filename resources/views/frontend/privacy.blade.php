@extends('layouts.frontend')
@section('title', 'Privacy Policy')
@section('content')
    @php
        $company = $settings['company_name'] ?? ($settings['website_name'] ?? 'CSRGO');
        $email = $settings['email'] ?? null;
        $phone = $settings['phone'] ?? null;
        $address = $settings['address'] ?? null;
    @endphp

    @component('frontend.partials.legal-page', ['title' => 'Privacy Policy', 'updated' => '30 September 2026'])
    <section id="who-we-are">
        <h2>1. Who we are</h2>
        <p>This website is operated by <strong>{{ $company }}</strong> ("we", "us", "our"). This Privacy Policy explains
            what personal information we collect when you use this website, why we collect it, and how you can control it.
        </p>
        <p>By using this website or sending us an enquiry, you agree to the practices described in this policy.</p>
    </section>

    <section id="information-we-collect">
        <h2>2. Information we collect</h2>
        <p><strong>Information you give us.</strong> When you use our Contact form or Submit Requirement form, we collect:
        </p>
        <ul>
            <li>your name, phone number and email address;</li>
            <li>the product or category you are interested in;</li>
            <li>the details you enter about your requirement (for example project type, facility, capacity, water source)
                and any message you write.</li>
        </ul>
        <p><strong>Information collected automatically.</strong> Like most websites, our server records basic technical
            information such as your IP address, browser type and the pages you visit. This is used only to keep the website
            running and secure.</p>
        <p>We do not ask for, and you should not send us, payment card details, passwords or government ID numbers through
            the website.</p>
    </section>

    <section id="how-we-use">
        <h2>3. How we use your information</h2>
        <ul>
            <li>to reply to your enquiry and prepare quotes;</li>
            <li>to contact you by phone, email or WhatsApp about the request you made;</li>
            <li>to keep internal records of enquiries so our team can follow up;</li>
            <li>to operate, protect and improve the website.</li>
        </ul>
        <p>We do not sell your personal information, and we do not send you marketing messages unless you have asked us to.
        </p>
    </section>

    <section id="sharing">
        <h2>4. Sharing your information</h2>
        <p>Your enquiry is seen only by our staff who handle sales and support. We may share information only:</p>
        <ul>
            <li>with service providers who host or maintain this website for us, under confidentiality obligations;</li>
            <li>when required by law, court order or a government authority;</li>
            <li>to protect our rights, our customers or the public from fraud or harm.</li>
        </ul>
    </section>

    <section id="third-party">
        <h2>5. Third-party services</h2>
        <p>Some parts of this website are provided by other companies, which may receive your IP address when the page
            loads:</p>
        <ul>
            <li><strong>Google Maps</strong> – the map on our Contact page;</li>
            <li><strong>Google Fonts</strong> – the fonts used on this website;</li>
            <li><strong>Unsplash</strong> – some background photos;</li>
            <li><strong>WhatsApp</strong> – if you tap a WhatsApp button, the chat happens on WhatsApp and is covered by
                WhatsApp's own privacy policy.</li>
        </ul>
        <p>These companies handle data under their own privacy policies, which we do not control.</p>
    </section>

    <section id="cookies">
        <h2>6. Cookies</h2>
        <p>We use only the cookies needed for the website to work, such as a session cookie and a security cookie that
            protects our forms from misuse. We do not use advertising or tracking cookies.</p>
        <p>You can block cookies in your browser settings, but the enquiry forms may not work without them.</p>
    </section>

    <section id="retention">
        <h2>7. How long we keep your data</h2>
        <p>We keep enquiry details for as long as needed to respond to you and to keep reasonable business records, after
            which they are deleted. You can ask us to delete your enquiry sooner (see "Your rights").</p>
    </section>

    <section id="security">
        <h2>8. Security</h2>
        <p>We use reasonable technical and organisational measures to protect your information, and only authorised staff
            can access enquiries. No method of sending data over the internet is completely secure, so we cannot guarantee
            absolute security.</p>
    </section>

    <section id="your-rights">
        <h2>9. Your rights</h2>
        <p>You can ask us to:</p>
        <ul>
            <li>tell you what personal information we hold about you;</li>
            <li>correct information that is wrong or incomplete;</li>
            <li>delete your information, where we are not required to keep it;</li>
            <li>stop contacting you.</li>
        </ul>
        <p>To make a request, contact us using the details below. We may need to confirm your identity before acting on it.
        </p>
    </section>

    <section id="children">
        <h2>10. Children</h2>
        <p>This website is intended for businesses and adults. We do not knowingly collect personal information from
            children under 18.</p>
    </section>

    <section id="changes">
        <h2>11. Changes to this policy</h2>
        <p>We may update this policy from time to time. The "Last updated" date at the top of this page shows when it was
            last changed.</p>
    </section>


    @endcomponent
@endsection