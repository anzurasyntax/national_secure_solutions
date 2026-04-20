@extends('layouts.app')

@section('content')
    @include('sections.home.hero')
    @include('sections.home.features')
    @include('sections.home.about')
    @include('sections.home.stats')
    @include('sections.home.services')
    @include('sections.home.why-choose')
    @include('sections.home.values')
    @include('sections.home.cta')
    @include('sections.home.testimonials')
    @include('sections.home.blog')
@endsection

@push('scripts')
    <script>
        (function () {
            function createSlider(selector, interval, prevId, nextId, dotsSelector) {
                const slides = Array.from(document.querySelectorAll(selector));
                const dots = dotsSelector ? Array.from(document.querySelectorAll(dotsSelector)) : [];
                if (!slides.length) return;
                let index = 0;

                function goTo(nextIndex) {
                    slides[index].classList.remove("active");
                    if (dots[index]) {
                        dots[index].classList.remove("active");
                        dots[index].style.background = "rgba(255,255,255,0.4)";
                    }
                    index = (nextIndex + slides.length) % slides.length;
                    slides[index].classList.add("active");
                    if (dots[index]) {
                        dots[index].classList.add("active");
                        dots[index].style.background = "#ee1a28";
                    }
                }

                setInterval(function () {
                    goTo(index + 1);
                }, interval);

                if (prevId) {
                    const prevButton = document.getElementById(prevId);
                    if (prevButton) prevButton.addEventListener("click", function () { goTo(index - 1); });
                }

                if (nextId) {
                    const nextButton = document.getElementById(nextId);
                    if (nextButton) nextButton.addEventListener("click", function () { goTo(index + 1); });
                }

                dots.forEach(function (dot, i) {
                    dot.addEventListener("click", function () { goTo(i); });
                });
            }

            createSlider("[data-hero-slide]", 5000, "heroPrev", "heroNext", "#heroDots [data-dot]");
            createSlider("[data-testimonial-slide]", 4500, "testimonialPrev", "testimonialNext", "#testimonialDots [data-tdot]");

            document.querySelectorAll("[data-counter]").forEach(function (counter) {
                const target = Number(counter.getAttribute("data-counter") || "0");
                const step = Math.max(1, Math.floor(target / 60));
                let value = 0;
                const timer = setInterval(function () {
                    value += step;
                    if (value >= target) {
                        value = target;
                        clearInterval(timer);
                    }
                    counter.textContent = value.toLocaleString();
                }, 25);
            });
        })();
    </script>
@endpush