@extends('layouts.frontend')
@section('title', 'Contact Us')
@section('content')
    @include('frontend.partials.page-hero', [
        'eyebrow' => 'Get In Touch',
        'title' => "Let's Build Something Great",
        'subtitle' => 'We would love to hear from you.',

    ])

    @php
        // Phone numbers from Admin > Settings ("94866 67373,79043 32288"), shown as "+91 94866 67373".
        $phoneList = collect(explode(',', $settings['phone'] ?? ''))
            ->map(fn($p) => trim($p))
            ->filter()
            ->map(function ($p) {
                $digits = preg_replace('/[^0-9]/', '', $p);
                $local = strlen($digits) === 12 && str_starts_with($digits, '91') ? substr($digits, 2) : $digits;
                $isIndian = strlen($local) === 10 && !str_starts_with($p, '+');
                return [
                    'label' => $isIndian ? '+91 ' . substr($local, 0, 5) . ' ' . substr($local, 5) : $p,
                    'tel' => $isIndian ? '+91' . $local : preg_replace('/[^0-9+]/', '', $p),
                    'wa' => $isIndian ? '91' . $local : preg_replace('/[^0-9]/', '', $p),
                ];
            })
            ->values();
        $email = $settings['email'] ?? '';
        $addressLines = collect(preg_split('/\r\n|\r|\n/', (string) ($settings['address'] ?? '')))->map(fn($l) => trim($l))->filter();

        $cardClass = 'bg-brand-50 rounded-lg p-6 sm:p-[30px] shadow-[0_2px_8px_rgba(0,0,0,0.08)] min-w-0';
        $titleClass = 'text-lg sm:text-xl font-semibold text-brand-900 mb-3';
        $bodyClass = 'pl-2.5 text-base text-brand-700 leading-[1.9] break-words';
        $linkClass = 'hover:underline underline-offset-2';
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 lg:py-16">
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 px-4 py-10 sm:px-8 lg:px-10 lg:py-12">

            <!-- Contact Us -->
            <h2 class="text-center text-3xl md:text-4xl font-bold text-brand-800 tracking-tight mb-8 lg:mb-10">Contact Us</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-10 items-stretch">
                <!-- Left: Address (stretches to the height of the right column) -->
                @if($addressLines->isNotEmpty())
                    <div class="{{ $cardClass }} h-full">
                        <h3 class="{{ $titleClass }}">Address</h3>
                        <address class="{{ $bodyClass }} not-italic">
                            @foreach($addressLines as $line)
                                {{ $line }}@if(!$loop->last)<br>@endif
                            @endforeach
                        </address>
                    </div>
                @endif

                <!-- Right: Phone and WhatsApp side by side (half width each), Email full width below -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 content-start">
                    @if($phoneList->isNotEmpty())
                        <div class="{{ $cardClass }}">
                            <h3 class="{{ $titleClass }}">Phone</h3>
                            <div class="{{ $bodyClass }}">
                                @foreach($phoneList as $p)
                                    <a href="tel:{{ $p['tel'] }}" class="block w-fit whitespace-nowrap {{ $linkClass }}">{{ $p['label'] }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="{{ $cardClass }}">
                            <h3 class="{{ $titleClass }}">WhatsApp</h3>
                            <div class="{{ $bodyClass }}">
                                @foreach($phoneList as $p)
                                    <a href="https://wa.me/{{ $p['wa'] }}" target="_blank" rel="noopener" class="block w-fit whitespace-nowrap {{ $linkClass }}">{{ $p['label'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if(filled($email))
                        <div class="{{ $cardClass }} lg:col-span-2">
                            <h3 class="{{ $titleClass }}">Email</h3>
                            <div class="{{ $bodyClass }} break-all">
                                <a href="mailto:{{ $email }}" class="{{ $linkClass }}">{{ $email }}</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Find Us on Google Maps -->
            <h2 class="text-center text-3xl md:text-4xl font-bold text-brand-900 tracking-tight mt-14 lg:mt-16 mb-8">Find Us on Google Maps</h2>
            <div class="rounded-lg shadow-[0_2px_8px_rgba(0,0,0,0.08)] overflow-hidden h-[360px] relative bg-brand-50">
                {{-- Google Maps embed for the "GSC- RO Aqua Water Treatment" business listing. --}}
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3575.5714616556!2d78.22133907461134!3d12.510152724828096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bac3532f2fcf5e1%3A0x595aa8be7ca685e2!2sGSC-%20RO%20Aqua%20Water%20Treatment!5e1!3m2!1sen!2sin!4v1791422317683!5m2!1sen!2sin"
                    title="GSC-RO Aqua Water Treatment location on Google Maps" width="100%" height="100%" style="border:0;"
                    allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"
                    class="absolute inset-0 w-full h-full"></iframe>
            </div>
        </div>
    </div>
@endsection