<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="m-0 p-0">

<!-- Hero Banner -->
<section class="relative w-full h-52 md:h-64 overflow-hidden">

    <!-- Background image -->
    <img
        src="{{ asset('img/bg.png') }}"
        alt="About Us background"
        class="absolute inset-0 w-full h-full object-cover object-center"
    />

    <!-- Dark blue overlay -->
    <div class="absolute inset-0 bg-[#1a2a4a] opacity-75"></div>

    <!-- Content -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
        <h1 class="text-white text-4xl md:text-7xl font-bold mb-3 tracking-tight">About Us</h1>
        <nav class="flex items-center gap-2 text-lg">
            <a href="#" class="text-red-500 font-medium hover:underline">Home</a>
            <span class="text-white">
          <!-- chevron right -->
          <svg xmlns="http://www.w3.org/2000/svg" class="inline w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </span>
            <span class="text-white font-medium">About Us</span>
        </nav>
    </div>

</section>

</body>
</html>
