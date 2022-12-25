<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">
    <meta name="keywords"
        content="simkesda tapsel, simkesda, tapsel, tapanuli selatan, sistem kesehatan daerah, sistem kesehatan, simkesda kabupaten tapsel, simkesda kab tapsel">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- META --}}
    <meta name="og:site_name" content="{{ config('app.name') . ' | ' . config('app.unit_name') }}">
    <meta property="og:url" content="{{ $url ?? url()->current() }}">
    <meta property="og:type" content="{{ $type ?? 'website' }}">
    <meta name="author" content="{{ $author ?? 'Administrator SIMKESDA' }}">
    <meta property="og:title" content="{{ $title ?? config('app.name') . ' | ' . config('app.unit_name') }}">
    <meta property="og:description" content="{{ $desc ?? config('app.name') . ' | ' . config('app.unit_name') }}">
    <meta property="og:image" content="{{ isset($image) ? asset($image) : asset('images/ads.png') }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="images/logo-tapsel.png" type="image/x-icon">
    <title>{{ config('app.name') . ' | ' . config('app.unit_name') }}</title>

    {{-- Styles --}}
    <link href="{{ asset('builder/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('builder/css/preloader.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend-assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
