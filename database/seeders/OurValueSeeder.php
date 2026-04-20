<?php

namespace Database\Seeders;

use App\Models\OurValue;
use Illuminate\Database\Seeder;

class OurValueSeeder extends Seeder
{
    /**
     * Same six cards as the original static home “Our Values” slider.
     */
    public function run(): void
    {
        if (OurValue::query()->exists()) {
            return;
        }

        $rows = [
            [
                'sort_order' => 1,
                'eyebrow' => 'HOME SECURITY',
                'line1' => 'Customer Focus:',
                'line2' => 'Customer comes first',
                'image_path' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?w=600&q=80',
            ],
            [
                'sort_order' => 2,
                'eyebrow' => 'WIRELESS CAMS',
                'line1' => 'Integrity:',
                'line2' => 'Our word is our bond',
                'image_path' => 'https://images.unsplash.com/photo-1557597774-9d273605dfa9?w=600&q=80',
            ],
            [
                'sort_order' => 3,
                'eyebrow' => 'CLOSED CIRCUIT',
                'line1' => 'Innovation:',
                'line2' => 'Make things easy',
                'image_path' => 'https://images.unsplash.com/photo-1553877522-43269d4ea984?w=600&q=80',
            ],
            [
                'sort_order' => 4,
                'eyebrow' => 'ALARM & LOCK',
                'line1' => 'Social Responsibility:',
                'line2' => 'We are good corporate citizens',
                'image_path' => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=600&q=80',
            ],
            [
                'sort_order' => 5,
                'eyebrow' => 'HOME SECURITY',
                'line1' => 'Excellence:',
                'line2' => 'Our watchword in everything we do',
                'image_path' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=600&q=80',
            ],
            [
                'sort_order' => 6,
                'eyebrow' => 'EVENT SECURITY',
                'line1' => 'Safety:',
                'line2' => 'Protection at every event',
                'image_path' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=600&q=80',
            ],
        ];

        foreach ($rows as $row) {
            OurValue::query()->create($row);
        }
    }
}
