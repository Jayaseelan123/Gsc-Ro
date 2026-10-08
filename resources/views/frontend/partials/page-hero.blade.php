{{--
    Shared dark hero banner for the product pages.
    @param string      $eyebrow      small label above the title
    @param string      $title        main heading
    @param string|null $subtitle     optional text under the title
    @param array       $breadcrumbs  list of [label, url|null]; the last item is the current page
--}}
<div class="bg-brand-500 pt-10 pb-12 md:pt-12 md:pb-16 relative overflow-hidden print:hidden">
    <div class="absolute inset-0 opacity-30"><img src="https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=2069&auto=format&fit=crop" alt="Corporate Architecture" class="w-full h-full object-cover"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-brand-500 via-brand-500/90 to-brand-500/60"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center text-center [text-shadow:0_1px_3px_rgba(0,45,60,0.45)]">
        @if(!empty($breadcrumbs))
            <nav class="flex flex-wrap justify-center items-center gap-y-1 text-xs font-bold uppercase tracking-wider text-white/90 mb-6" aria-label="Breadcrumb">
                @foreach($breadcrumbs as [$label, $url])
                    @if(!$loop->first)
                        <span class="mx-2 text-white/70" aria-hidden="true">/</span>
                    @endif
                    @if($url && !$loop->last)
                        <a href="{{ $url }}" class="hover:underline underline-offset-2 transition-colors">{{ $label }}</a>
                    @else
                        <span class="text-white break-words" aria-current="page">{{ $label }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        @if(!empty($eyebrow))
            <span class="px-4 py-1.5 rounded-full bg-white/15 text-white font-bold text-sm tracking-widest uppercase mb-6 border border-white/50 backdrop-blur">{{ $eyebrow }}</span>
        @endif

        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 tracking-tight leading-tight break-words max-w-full">{{ $title }}</h1>

        @if(!empty($subtitle))
            <p class="text-xl text-white font-light leading-relaxed max-w-2xl mx-auto">{{ $subtitle }}</p>
        @endif
    </div>
</div>
