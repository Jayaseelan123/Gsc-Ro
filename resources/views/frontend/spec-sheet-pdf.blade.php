{{-- Spec sheet PDF for "Download Specs" (rendered by Dompdf: plain tables and CSS 2.1 only, images from disk paths). --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $product->name }} - Specifications</title>
    <style>
        @page { margin: 28px 34px 70px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1e293b; line-height: 1.5; }
        .header { width: 100%; border-bottom: 3px solid #0891b2; padding-bottom: 10px; }
        .header td { vertical-align: middle; }
        .company { font-size: 18px; font-weight: bold; color: #0e7490; }
        .tagline { font-size: 9px; color: #64748b; letter-spacing: 1px; text-transform: uppercase; }
        .contact { text-align: right; font-size: 9px; color: #475569; line-height: 1.6; }
        .eyebrow { margin-top: 22px; font-size: 9px; font-weight: bold; color: #0891b2; letter-spacing: 1.5px; text-transform: uppercase; }
        h1 { margin: 4px 0 0; font-size: 22px; color: #0f172a; }
        .summary { margin-top: 8px; font-size: 11px; color: #475569; }
        .image-box { margin-top: 18px; text-align: center; border: 1px solid #e2e8f0; padding: 14px; }
        .image-box img { max-width: 100%; max-height: 300px; }
        h2 { margin: 24px 0 8px; font-size: 13px; color: #0f172a; text-transform: uppercase; letter-spacing: 1px; }
        .specs { width: 100%; border-collapse: collapse; }
        .specs td { border: 1px solid #e2e8f0; padding: 7px 10px; vertical-align: top; }
        .specs tr:nth-child(even) td { background: #f8fafc; }
        .specs .num { width: 26px; color: #0891b2; font-weight: bold; text-align: center; }
        .empty { color: #64748b; font-style: italic; }
        .footer { position: fixed; bottom: -48px; left: 0; right: 0; border-top: 1px solid #e2e8f0; padding-top: 6px; font-size: 8.5px; color: #64748b; }
        .footer td { vertical-align: top; }
    </style>
</head>
<body>
    @php
        $company = 'GSC-RO Aqua Water Treatment';
        $phone = $settings['phone'] ?? '';
        $email = $settings['email'] ?? '';
        $address = $settings['address'] ?? '';
    @endphp

    <div class="footer">
        <table width="100%"><tr>
            <td>{{ $company }}@if($address) &middot; {{ $address }}@endif</td>
            <td style="text-align: right; white-space: nowrap;">{{ url('/') }} &middot; {{ now()->format('d M Y') }}</td>
        </tr></table>
    </div>

    <table class="header"><tr>
        <td style="width: 70px;">
            @if(is_file($logoPath))
                <img src="{{ $logoPath }}" alt="" style="width: 60px; height: 60px;">
            @endif
        </td>
        <td>
            <div class="company">{{ $company }}</div>
            <div class="tagline">Product Specification Sheet</div>
        </td>
        <td class="contact">
            @if($phone)Phone: {{ $phone }}<br>@endif
            @if($email)Email: {{ $email }}<br>@endif
            {{ preg_replace('#^https?://#', '', url('/')) }}
        </td>
    </tr></table>

    @if($product->category)
        <div class="eyebrow">{{ $product->category->name }}</div>
    @endif
    <h1>{{ $product->name }}</h1>
    @if(filled($product->short_description))
        <div class="summary">{{ $product->short_description }}</div>
    @endif

    @if($imagePath)
        <div class="image-box"><img src="{{ $imagePath }}" alt="{{ $product->name }}"></div>
    @endif

    <h2>Specifications</h2>
    @if(count($specs))
        <table class="specs">
            @foreach($specs as $i => $spec)
                <tr>
                    <td class="num">{{ $i + 1 }}</td>
                    <td>{{ $spec }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p class="empty">Detailed specifications are available on request. Please contact us using the details above.</p>
    @endif

    @if(filled($product->description))
        <h2>Description</h2>
        <div>{!! nl2br(e(strip_tags($product->description))) !!}</div>
    @endif
</body>
</html>
