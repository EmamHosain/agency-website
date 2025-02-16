<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Laravel Livewire Filament Web App' }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="This is meta description">
    <meta name="author" content="Themefisher">
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('frontend/images/favicon.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- CSS Plugins -->
    <link rel="stylesheet" href="{{ asset('frontend/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/font-awesome/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/font-awesome/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/font-awesome/solid.css') }}">

    <!-- Main Style Sheet -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    @livewireStyles
</head>
<body>
    <!-- Navigation -->
    <header class="navigation bg-tertiary">
        <nav class="navbar navbar-expand-xl navbar-light text-center py-3">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img loading="preload" decoding="async" class="img-fluid" width="160"
                        src="{{ asset('frontend/images/logo.png') }}" alt="Wallet">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{ route('homePage') }}" wire:navigate>Home</a>
                        </li>
                        <li class="nav-item"><a wire:navigate class="nav-link" href="{{ route('about_us') }}">About
                                Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('servicePage') }}"
                                wire:navigate>Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('members') }}" wire:navigate>Our
                                Team</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('blog_page') }}" wire:navigate>Blog</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" wire:navigate href="{{ route('faq_page') }}">FAQ</a>
                        </li>
                    </ul>
                    <a wire:navigate href="{{route('contact_us_page') }}" class="btn btn-outline-primary">Contact Us</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- /Navigation -->

    {{ $slot }}

    <!-- Footer -->
    <footer class="section-sm bg-tertiary">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <div class="footer-widget">
                        <h5 class="mb-4 text-primary font-secondary">Service</h5>
                        @php
                        $services =
                        App\Models\Service::where('status',1)->orderByDesc('id')->select('title','id')->get();
                        // print_r($services);
                        @endphp
                        <ul class="list-unstyled">
                            @if (!empty($services))
                            @foreach ($services as $item)


                            <li class="mb-2">
                                <a wire:navigate href="{{ route('serviceDetails',$item->id) }}">{{ ucwords($item->title) }}</a>
                            </li>
                            @endforeach
                            @else
                            <li class="mb-2">Services Not Found</li>
                            @endif


                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <div class="footer-widget">
                        <h5 class="mb-4 text-primary font-secondary">Quick Links</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ url('/about') }}">About Us</a></li>
                            <li class="mb-2"><a href="{{ url('/contact') }}">Contact Us</a></li>
                            <li class="mb-2"><a href="{{ url('/blog') }}">Blog</a></li>
                            <li class="mb-2"><a href="{{ url('/team') }}">Team</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <div class="footer-widget">
                        <h5 class="mb-4 text-primary font-secondary">Other Links</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                            <li class="mb-2"><a href="{{ url('/terms') }}">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /Footer -->

    <!-- JS Plugins -->
    <script src="{{ asset('frontend/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/plugins/bootstrap/bootstrap.min.js') }}"></script>

    <!-- Main Script -->
    <script src="{{ asset('frontend/js/script.js') }}"></script>

    @livewireScripts
</body>
</html>