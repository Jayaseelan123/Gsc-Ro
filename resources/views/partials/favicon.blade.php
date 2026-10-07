@php
    $faviconPath = $settings['favicon'] ?? \App\Models\WebsiteSetting::where('key', 'favicon')->value('value');
    $faviconType = match (strtolower(pathinfo((string) $faviconPath, PATHINFO_EXTENSION))) {
        'png' => 'image/png',
        'jpg', 'jpeg' => 'image/jpeg',
        'webp' => 'image/webp',
        default => 'image/x-icon',
    };
@endphp
@if($faviconPath)
    <link rel="icon" type="{{ $faviconType }}" href="{{ asset('storage/' . $faviconPath) }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/' . $faviconPath) }}">
@else
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
@endif
