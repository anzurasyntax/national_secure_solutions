<?php

return [
    'main' => [
        ['key' => 'dashboard', 'label' => 'Dashboard', 'route' => 'student.dashboard', 'icon' => 'dash'],
        ['key' => 'profile', 'label' => 'My Profile', 'route' => 'student.profile', 'icon' => 'user'],
        ['key' => 'enrolled', 'label' => 'Enrolled Courses', 'route' => 'student.enrolled', 'icon' => 'book'],
        ['key' => 'reviews', 'label' => 'Reviews', 'route' => 'student.reviews', 'icon' => 'star'],
        ['key' => 'quiz_attempts', 'label' => 'My Quiz Attempts', 'route' => 'student.quiz-attempts', 'icon' => 'quiz'],
        ['key' => 'wishlist', 'label' => 'Wishlist', 'route' => 'student.wishlist', 'icon' => 'bookmark'],
        ['key' => 'orders', 'label' => 'Order History', 'route' => 'student.orders', 'icon' => 'cart'],
        ['key' => 'qa', 'label' => 'Question & Answer', 'route' => 'student.qa', 'icon' => 'qa'],
    ],
    'bottom' => [
        ['key' => 'settings', 'label' => 'Settings', 'route' => 'student.settings', 'icon' => 'gear'],
    ],
];
