<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Matches the original blog reference layout (titles, dates, images, categories, tag cloud).
 */
class BlogDemoSeeder extends Seeder
{
    public function run(): void
    {
        $cats = collect([
            ['name' => 'Business', 'slug' => 'business'],
            ['name' => 'Fingerprint', 'slug' => 'fingerprint'],
            ['name' => 'Home Safe', 'slug' => 'home-safe'],
            ['name' => 'Security', 'slug' => 'security'],
        ])->map(fn ($c, $i) => BlogCategory::query()->firstOrCreate(
            ['slug' => $c['slug']],
            ['name' => $c['name'], 'sort_order' => $i + 1],
        ));

        $tags = collect([
            ['name' => 'AZ', 'slug' => 'az'],
            ['name' => 'Business', 'slug' => 'business-tag'],
            ['name' => 'Security', 'slug' => 'security-tag'],
            ['name' => 'Guards', 'slug' => 'guards'],
            ['name' => 'Events', 'slug' => 'events'],
            ['name' => 'Retail', 'slug' => 'retail'],
            ['name' => 'CCTV', 'slug' => 'cctv'],
            ['name' => 'Training', 'slug' => 'training'],
        ])->map(fn ($t, $i) => BlogTag::query()->firstOrCreate(
            ['slug' => $t['slug']],
            ['name' => $t['name'], 'sort_order' => $i + 1],
        ));

        // Same card copy/structure as the first static blog grid; dates match on-card labels (2023).
        $posts = [
            [
                'title' => 'The Hidden ROI Of Modern Security Systems',
                'slug' => 'the-hidden-roi-of-modern-security-systems',
                'excerpt' => 'In the past, businesses saw security systems only as a cost for…',
                'body' => "In the past, businesses saw security systems only as a cost center. Today's platforms pair visibility with analytics—turning deterrence, compliance, and faster incident response into measurable savings across operations.",
                'published_at' => Carbon::parse('2023-11-17 12:00:00'),
                'featured_image_url' => 'https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?w=640&q=80',
                'categories' => [$cats->firstWhere('slug', 'business'), $cats->firstWhere('slug', 'security')],
                'tags' => [$tags->firstWhere('slug', 'az'), $tags->firstWhere('slug', 'business-tag'), $tags->firstWhere('slug', 'security-tag')],
            ],
            [
                'title' => 'Security Guard Services: Preventing Workplace Violence',
                'slug' => 'security-guard-services-preventing-workplace-violence',
                'excerpt' => 'Professional teams and clear protocols reduce incidents before they escalate.',
                'body' => 'Uniformed and plain-clothes coverage, visitor management, and trained de-escalation align with HR and legal playbooks—keeping staff and customers safer during high-stress moments.',
                'published_at' => Carbon::parse('2023-10-22 12:00:00'),
                'featured_image_url' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=640&q=80',
                'categories' => [$cats->firstWhere('slug', 'security')],
                'tags' => [$tags->firstWhere('slug', 'guards'), $tags->firstWhere('slug', 'security-tag')],
            ],
            [
                'title' => 'How To Mitigate Risk Involve In Large Scale Events',
                'slug' => 'how-to-mitigate-risk-involve-in-large-scale-events',
                'excerpt' => 'Crowd flow, credentials, and unified comms keep festivals and conferences safer.',
                'body' => 'Start with staffing ratios and egress modeling; layer access zones, medical stands, and radio discipline so teams can coordinate under pressure.',
                'published_at' => Carbon::parse('2023-09-08 12:00:00'),
                'featured_image_url' => null,
                'categories' => [$cats->firstWhere('slug', 'business'), $cats->firstWhere('slug', 'security')],
                'tags' => [$tags->firstWhere('slug', 'events'), $tags->firstWhere('slug', 'security-tag')],
            ],
            [
                'title' => 'Retail Loss Prevention In High-Traffic Stores',
                'slug' => 'retail-loss-prevention-in-high-traffic-stores',
                'excerpt' => 'Blend hospitality with analytics to spot shrink without hurting the shopping experience.',
                'body' => 'Customer-facing awareness, POS exception reporting, and targeted CCTV reviews close gaps where organized theft and refund fraud concentrate.',
                'published_at' => Carbon::parse('2023-08-14 12:00:00'),
                'featured_image_url' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=640&q=80',
                'categories' => [$cats->firstWhere('slug', 'business')],
                'tags' => [$tags->firstWhere('slug', 'retail'), $tags->firstWhere('slug', 'cctv')],
            ],
            [
                'title' => 'Choosing The Right CCTV Layout For Your Facility',
                'slug' => 'choosing-the-right-cctv-layout-for-your-facility',
                'excerpt' => 'Match lens coverage to lighting, blind spots, and retention requirements.',
                'body' => 'Map choke points first, then add overview cameras and license-plate capture where vehicles matter. Validate night IR and storage retention against policy.',
                'published_at' => Carbon::parse('2023-07-03 12:00:00'),
                'featured_image_url' => null,
                'categories' => [$cats->firstWhere('slug', 'security'), $cats->firstWhere('slug', 'home-safe')],
                'tags' => [$tags->firstWhere('slug', 'cctv'), $tags->firstWhere('slug', 'security-tag')],
            ],
            [
                'title' => 'Night Patrol Best Practices For Commercial Sites',
                'slug' => 'night-patrol-best-practices-for-commercial-sites',
                'excerpt' => 'Randomized routes, digital tour logs, and rapid escalation paths protect overnight assets.',
                'body' => 'Pair vehicle and foot patrols with sensor checks; debrief every exception so patterns surface before they become losses.',
                'published_at' => Carbon::parse('2023-06-19 12:00:00'),
                'featured_image_url' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=640&q=80',
                'categories' => [$cats->firstWhere('slug', 'security')],
                'tags' => [$tags->firstWhere('slug', 'guards'), $tags->firstWhere('slug', 'training')],
            ],
        ];

        foreach ($posts as $i => $data) {
            $tagModels = collect($data['tags'])->filter()->values();
            $catModels = collect($data['categories'])->filter()->values();
            $imageUrl = $data['featured_image_url'] ?? null;
            unset($data['categories'], $data['tags'], $data['featured_image_url']);

            $post = BlogPost::query()->updateOrCreate(
                ['slug' => $data['slug']],
                [
                    ...$data,
                    'featured_image_path' => null,
                    'sort_order' => $i + 1,
                ]
            );

            $post->categories()->sync($catModels->pluck('id')->all());
            $post->tags()->sync($tagModels->pluck('id')->all());

            if ($imageUrl !== null) {
                $this->downloadFeaturedImage($post, $imageUrl);
            } else {
                $post->update(['featured_image_path' => null]);
            }
        }
    }

    private function downloadFeaturedImage(BlogPost $post, string $url): void
    {
        try {
            $context = stream_context_create([
                'http' => ['timeout' => 15, 'follow_location' => 1],
                'ssl' => ['verify_peer' => true, 'verify_peer_name' => true],
            ]);
            $contents = @file_get_contents($url, false, $context);
            if ($contents === false || $contents === '') {
                return;
            }

            $dir = public_path('img/blog');
            if (! is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            $filename = 'seed-'.$post->slug.'.jpg';
            $relative = 'img/blog/'.$filename;
            $full = public_path($relative);
            file_put_contents($full, $contents);
            $post->update(['featured_image_path' => $relative]);
        } catch (\Throwable) {
            // Keep post without image if download fails (offline / firewall).
        }
    }
}
