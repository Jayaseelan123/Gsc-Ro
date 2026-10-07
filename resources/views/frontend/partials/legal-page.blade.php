{{--
    Shared layout for legal pages.
    @param string $title     page title
    @param string $updated   "last updated" date text
    @param string $slot      the page body (rendered HTML), made of <section> blocks
--}}
@include('frontend.partials.page-hero', [
    'eyebrow' => 'Legal',
    'title' => $title,
    'subtitle' => 'Last updated: ' . $updated,
    'breadcrumbs' => [['Home', route('home')], [$title, null]],
])

<div class="bg-slate-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
        <article class="legal-body bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-10 text-slate-700 leading-relaxed">
            {!! $slot !!}
        </article>
    </div>
</div>

<style>
    .legal-body section { scroll-margin-top: 7rem; }
    .legal-body section + section { margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #f1f5f9; }
    .legal-body h2 { font-size: 1.25rem; font-weight: 800; color: #0f172a; margin-bottom: .75rem; }
    .legal-body p { margin-bottom: .75rem; }
    .legal-body ul { list-style: disc; padding-left: 1.25rem; margin-bottom: .75rem; }
    .legal-body li { margin-bottom: .35rem; }
    .legal-body a { color: #2563eb; font-weight: 600; }
    .legal-body a:hover { text-decoration: underline; }
    .legal-body strong { color: #0f172a; }
</style>
