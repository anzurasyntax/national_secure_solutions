<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trusted Security Service Phoenix, AZ | Trans-World Security')</title>
    <meta name="description" content="@yield('meta_description', 'Trans-World Security Systems offers trained security guards and robust security equipment for homes, offices, and events. #1 security consultant in Phoenix, AZ.')">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#ee1a28",
                        navy: "#000080",
                        ink: "#070e20"
                    },
                    fontFamily: {
                        sans: ["Roboto", "sans-serif"],
                        heading: ["Fira Sans", "sans-serif"]
                    }
                }
            }
        };
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        .fade-slide { opacity: 0; transition: opacity .6s ease; pointer-events: none; }
        .fade-slide.active { opacity: 1; pointer-events: auto; }
        .testimonial-wrapper { position: relative; min-height: 260px; }
        .values-card { position: relative; overflow: hidden; }
        .values-card img { transition: transform 0.4s ease; }
        .values-card:hover img { transform: scale(1.05); }
        .service-card { transition: box-shadow 0.3s ease, transform 0.3s ease; }
        .service-card:hover { transform: translateY(-4px); box-shadow: 0 20px 45px rgba(0,0,0,0.14); }
        .nav-link { position: relative; }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: #ee1a28;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }
        .dots-btn {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255,255,255,0.4);
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }
        .dots-btn.active { background: #ee1a28; }
    </style>
    @stack('styles')
</head>
<body class="bg-white font-sans text-[#797979]">
    @include('partials.header')

    <main class="overflow-hidden">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
