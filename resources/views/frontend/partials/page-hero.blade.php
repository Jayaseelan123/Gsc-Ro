{{--
    Shared dark hero banner for the product pages.
    @param string      $eyebrow      small label above the title
    @param string      $title        main heading
    @param string|null $subtitle     optional text under the title
    @param array       $breadcrumbs  list of [label, url|null]; the last item is the current page
--}}
<div class="bg-slate-900 pt-10 pb-12 border-b border-slate-800 text-center relative overflow-hidden print:hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#3b82f6 1px, transparent 1px); background-size: 32px 32px;" aria-hidden="true"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 flex flex-col items-center">
        @if(!empty($breadcrumbs))
            <nav class="flex flex-wrap justify-center items-center gap-y-1 text-xs font-bold uppercase tracking-wider text-slate-400 mb-6" aria-label="Breadcrumb">
                @foreach($breadcrumbs as [$label, $url])
                    @if(!$loop->first)
                        <span class="mx-2 text-slate-600" aria-hidden="true">/</span>
                    @endif
                    @if($url && !$loop->last)
                        <a href="{{ $url }}" class="hover:text-white transition-colors">{{ $label }}</a>
                    @else
                        <span class="text-slate-200 break-words" aria-current="page">{{ $label }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        @if(!empty($eyebrow))
            <span class="px-4 py-1.5 rounded-full bg-teal-600/20 text-teal-400 font-bold text-xs sm:text-sm tracking-widest uppercase mb-4 border border-teal-500/30 backdrop-blur">{{ $eyebrow }}</span>
        @endif

        <h1 class="text-3xl md:text-5xl font-extrabold text-white tracking-tight leading-tight break-words max-w-full">{{ $title }}</h1>

        @if(!empty($subtitle))
            <p class="mt-4 text-base md:text-xl text-slate-300 font-light leading-relaxed max-w-2xl">{{ $subtitle }}</p>
        @endif
    </div>
</div>
