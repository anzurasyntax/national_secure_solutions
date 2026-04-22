<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Matches the original static home testimonials slider.
     */
    public function run(): void
    {
        if (Testimonial::query()->exists()) {
            return;
        }

        $rows = [
            [
                'sort_order' => 1,
                'body' => 'As a property manager, ensuring the safety of our residents is my top priority. National Secure Solutions has been an invaluable partner in achieving that goal. Their expertise in security assessments and implementation of state-of-the-art technology has given us peace of mind.',
                'name' => 'Paul Vincent',
                'role' => 'Manager',
                'rating' => 5,
                'avatar_path' => 'img/profile.png',
            ],
            [
                'sort_order' => 2,
                'body' => 'I highly recommend National Secure Solutions for their exceptional security services. Their team demonstrated utmost professionalism and vigilance throughout our partnership. A truly reliable security company.',
                'name' => 'Matt Morgan',
                'role' => 'CEO',
                'rating' => 5,
                'avatar_path' => 'img/profile.png',
            ],
            [
                'sort_order' => 3,
                'body' => 'Choosing National Secure Solutions was one of the best decisions we made for our business. Their team is highly trained and professional, providing comprehensive security solutions tailored to our needs.',
                'name' => 'Angel Jones',
                'role' => 'Finance Manager',
                'rating' => 5,
                'avatar_path' => 'img/profile.png',
            ],
        ];

        foreach ($rows as $row) {
            Testimonial::query()->create($row);
        }
    }
}
