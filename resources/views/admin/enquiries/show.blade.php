@extends('layouts.admin')
@section('header', 'View Enquiry')
@section('content')
@php
    [$fields, $freeText] = $enquiry->messageParts();

    // The requirement form always writes "Additional Message: …" (or "None"); show it as the customer's message instead of a detail box.
    $additional = trim((string) ($fields['Additional Message'] ?? ''));
    unset($fields['Additional Message']);
    if (in_array(strtolower($additional), ['none', 'n/a', '-'], true)) {
        $additional = '';
    }
    $customerMessage = trim($additional . ($additional !== '' && $freeText !== '' ? "\n" : '') . $freeText);

    $emailHtml = $enquiry->email ? str_replace('@', '@<wbr>', e($enquiry->email)) : null;

    // Every detail shown in one grid, in this order. 'wide' boxes take the full row.
    $details = [];
    $details[] = ['label' => 'Requirement', 'type' => 'text', 'value' => $enquiry->requirement ?: 'Website enquiry', 'wide' => true];
    $details[] = ['label' => 'Customer Name', 'type' => 'text', 'value' => $enquiry->name];
    $details[] = ['label' => 'Status', 'type' => 'status'];
    $details[] = ['label' => 'Phone', 'type' => 'phone'];
    $details[] = ['label' => 'Email', 'type' => 'email'];
    $details[] = ['label' => 'Received', 'type' => 'text', 'value' => $enquiry->receivedAt()->format('d M Y, h:i A T'), 'wide' => true];
    if ($enquiry->product) {
        $details[] = ['label' => 'Product', 'type' => 'link', 'value' => $enquiry->product->name, 'href' => route('product.details', $enquiry->product->slug)];
    }
    if ($enquiry->category) {
        $details[] = ['label' => 'Category', 'type' => 'link', 'value' => $enquiry->category->name, 'href' => route('products.category', $enquiry->category->slug)];
    }
    if (!$enquiry->product && !$enquiry->category && ($enquiry->product_id || $enquiry->category_id)) {
        $details[] = ['label' => 'Product / Category', 'type' => 'muted', 'value' => 'The product or category this enquiry was about has since been deleted.', 'wide' => true];
    }
    foreach ($fields as $label => $value) {
        $details[] = ['label' => $label, 'type' => 'text', 'value' => $value !== '' ? $value : '—', 'wide' => mb_strlen($value) > 40];
    }

    // Two-column grid without holes: a box left alone before a full-width box (or at the end) stretches to fill its row.
    $col = 0;
    foreach ($details as $i => $item) {
        if (!empty($item['wide'])) {
            if ($col === 1) {
                $details[$i - 1]['wide'] = true;
            }
            $col = 0;
        } else {
            $col = 1 - $col;
        }
    }
    if ($col === 1) {
        $details[array_key_last($details)]['wide'] = true;
    }
@endphp

<!-- Header -->
<div class="mb-8 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
    <div class="flex items-center gap-4 min-w-0">
        <a href="{{ route('admin.enquiries.index') }}" class="w-10 h-10 shrink-0 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-600 hover:border-teal-200 hover:bg-teal-50 transition-all shadow-sm" aria-label="Back to enquiries">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div class="min-w-0">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Enquiry Details</h2>
            <p class="text-slate-500 font-medium mt-1">
                Received {{ $enquiry->receivedAt()->format('d M Y, h:i A T') }}
                <span class="text-slate-400">({{ $enquiry->created_at->diffForHumans() }})</span>
            </p>
        </div>
    </div>

    <div class="flex flex-wrap items-center gap-3">
        <form action="{{ route('admin.enquiries.update', $enquiry) }}" method="POST" class="flex items-center gap-2">
            @csrf
            @method('PUT')
            <label for="status" class="text-sm font-bold text-slate-500">Status</label>
            <div class="relative">
                <select id="status" name="status" onchange="this.form.requestSubmit()" class="rounded-xl border-slate-200 focus:border-teal-500 focus:ring-4 focus:ring-teal-100 bg-white py-2.5 pl-4 pr-10 text-sm font-bold text-slate-700 cursor-pointer shadow-sm appearance-none bg-none">
                    @foreach(array_keys(\App\Models\Enquiry::STATUSES) as $status)
                        <option value="{{ $status }}" @selected($enquiry->status === $status)>{{ $status }}</option>
                    @endforeach
                    @unless(array_key_exists($enquiry->status, \App\Models\Enquiry::STATUSES))
                        <option value="" selected disabled>{{ $enquiry->status }}</option>
                    @endunless
                </select>
                <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
            <noscript><button type="submit" class="px-3 py-2 rounded-lg bg-slate-900 text-white text-sm font-bold">Save</button></noscript>
        </form>

        <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST" data-confirm="Delete the enquiry from {{ $enquiry->name }}? This cannot be undone.">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-50 hover:bg-red-600 text-red-600 hover:text-white font-bold px-4 py-2.5 rounded-xl transition-all shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Delete
            </button>
        </form>
    </div>
</div>
@error('status') <p class="-mt-4 mb-6 text-red-600 text-sm font-bold">{{ $message }}</p> @enderror

<div class="space-y-6">
        <!-- Submitted details -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 sm:p-8">
            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Submitted Details</h3>

            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($details as $item)
                    <div class="rounded-2xl bg-slate-50 border border-slate-100 px-4 py-3 min-w-0 {{ !empty($item['wide']) ? 'sm:col-span-2' : '' }}">
                        <dt class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ $item['label'] }}</dt>
                        @switch($item['type'])
                            @case('status')
                                <dd class="mt-1.5"><span class="inline-block px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-lg {{ $enquiry->statusClass() }}">{{ $enquiry->status }}</span></dd>
                                @break
                            @case('phone')
                                @if($enquiry->phone)
                                    <dd class="mt-1 flex items-center justify-between gap-2">
                                        <a href="tel:{{ $enquiry->phone }}" class="min-w-0 text-base font-semibold text-slate-900 hover:text-teal-600 break-words">{{ $enquiry->phone }}</a>
                                        <button type="button" data-copy="{{ $enquiry->phone }}" class="copy-btn shrink-0 text-xs font-bold text-slate-500 hover:text-teal-600 px-2 py-1 rounded-lg hover:bg-teal-50">Copy</button>
                                    </dd>
                                @else
                                    <dd class="mt-1 text-base font-semibold text-slate-400">Not provided</dd>
                                @endif
                                @break
                            @case('email')
                                @if($enquiry->email)
                                    <dd class="mt-1 flex items-center justify-between gap-2">
                                        <a href="mailto:{{ $enquiry->email }}" class="min-w-0 text-base font-semibold text-slate-900 hover:text-teal-600 break-words">{!! $emailHtml !!}</a>
                                        <button type="button" data-copy="{{ $enquiry->email }}" class="copy-btn shrink-0 text-xs font-bold text-slate-500 hover:text-teal-600 px-2 py-1 rounded-lg hover:bg-teal-50">Copy</button>
                                    </dd>
                                @else
                                    <dd class="mt-1 text-base font-semibold text-slate-400">Not provided</dd>
                                @endif
                                @break
                            @case('link')
                                <dd class="mt-1 text-base font-semibold break-words">
                                    <a href="{{ $item['href'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 text-teal-700 hover:text-teal-800 hover:underline">
                                        {{ $item['value'] }}
                                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </dd>
                                @break
                            @case('muted')
                                <dd class="mt-1 text-sm font-medium text-slate-400">{{ $item['value'] }}</dd>
                                @break
                            @default
                                <dd class="mt-1 text-base font-semibold text-slate-900 break-words whitespace-pre-wrap">{{ $item['value'] }}</dd>
                        @endswitch
                    </div>
                @endforeach
            </dl>
        </div>

        <!-- Customer message -->
        @if($customerMessage !== '')
            <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-6 sm:p-8">
                <div class="flex items-center justify-between gap-3 mb-4">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Customer Message</h3>
                    <button type="button" data-copy="{{ $customerMessage }}" class="copy-btn text-xs font-bold text-slate-500 hover:text-teal-600 px-3 py-1.5 rounded-lg hover:bg-teal-50 transition-colors">Copy</button>
                </div>
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-100 text-slate-800 leading-relaxed whitespace-pre-wrap break-words">{{ $customerMessage }}</div>
            </div>
        @endif
</div>

<script>
    document.querySelectorAll('.copy-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const text = btn.dataset.copy;
            const done = function () {
                const old = btn.textContent;
                btn.textContent = 'Copied!';
                setTimeout(function () { btn.textContent = old; }, 1500);
            };
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(done);
            } else {
                const t = document.createElement('textarea');
                t.value = text; t.style.position = 'fixed'; t.style.opacity = '0';
                document.body.appendChild(t); t.select();
                try { document.execCommand('copy'); done(); } finally { t.remove(); }
            }
        });
    });
</script>
@endsection
