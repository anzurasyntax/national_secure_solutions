<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $fillable = [
        'hero_image_path',
        'brand_title',
        'brand_intro',
        'mission_title',
        'mission_body',
        'vision_title',
        'vision_body',
        'memberships_heading',
        'memberships_body',
        'leadership_heading',
        'leadership_body',
        'statement_heading',
        'statement_list',
        'statement_footer',
        'founder_heading',
        'founder_subtitle',
        'founder_body',
        'chairman_heading',
        'chairman_subtitle',
        'chairman_body',
        'president_heading',
        'president_subtitle',
        'president_body',
    ];

    public static function content(): self
    {
        return static::query()->firstOrNew([], self::defaultAttributes());
    }

    /**
     * @return array<string, string>
     */
    public static function defaultAttributes(): array
    {
        return [
            'hero_image_path' => 'img/about_us.jpg',
            'brand_title' => 'NATIONAL SECURE SOLUTIONS',
            'brand_intro' => 'National Secure Solutions is a seasoned security firm with 40 years of global experience, specializing in professional security guard services, top-notch security systems, and expert security consulting. Our founders are renowned authors of security-related publications, including "Effective Personal Corporate Security," "Kidnap: Face to Face with Death," and more.',
            'mission_title' => 'Our Mission',
            'mission_body' => 'Our mission at National Secure Solutions is to deliver unparalleled security solutions that prioritize safety, trust, and peace of mind for our clients.',
            'vision_title' => 'Our Vision',
            'vision_body' => 'Securing your world so you can focus on the rest.',
            'memberships_heading' => 'Memberships',
            'memberships_body' => 'National Secure Solutions is a proud member of the International Foundation for Protection Officers (IFPO) and the American Society for Industrial Security(ASIS), showcasing our commitment to upholding industry standards and best practices.',
            'leadership_heading' => 'Leadership',
            'leadership_body' => 'Ona Osezua Ekhomu, the President of National Secure Solutions, leads our team with a wealth of experience and a dedication to providing top-tier security services tailored to our clients\' specific needs.',
            'statement_heading' => 'National Secure Solutions is an international protection systems firm with operations in the U.S.A and Africa, We specialize in loss PREVENTION and ASSET PROTECTION for:',
            'statement_list' => "-Banks and financial institutions\n-Oil Companies\n-Government institutions\n-Corporate firms\n-Manufacturing firms\n-Residences\n-Commercial firms",
            'statement_footer' => 'With over 40 yrs of experience, we are fully capable of designing, supplying, installing and maintaining state of the art security systems with technology and manpower.',
            'founder_heading' => 'Founder',
            'founder_subtitle' => 'DR. ONA EKHOMU, CFE, CPP',
            'founder_body' => 'Dr. Ona Ekhomu, the Founder of National Secure Solutions, was a visionary leader in the security industry, renowned for setting the highest standards of excellence and pioneering advancement as a private security professional. With a highly distinguished career, Dr. Ekhomu made significant contributions to ASIS International, the leading organization for security professionals worldwide, where he shared his expertise and insights to advance the field of security. He was the author of multiple books, including "Effective Personal and Corporate Security" and "Kidnap: Face to Face with Death," among others. Dr. Ekhomu\'s contributions to the sector were renowned, especially in Africa, where he literally pioneered the advancement of the private security sector in the region. Beyond his professional achievements, Dr. Ekhomu was deeply committed to charitable endeavors, supporting causes that promoted education, community development, and humanitarian efforts. His philanthropic contributions made a positive impact on the lives of many, reflecting his dedication to making a difference both in the security industry and the broader community. Join us at National Secure Solutions to be a part of Dr. Ona Ekhomu\'s legacy of excellence, innovation, and compassion.',
            'chairman_heading' => 'Chairman of The Board',
            'chairman_subtitle' => 'DR. VICTORIA EKHOMU CPP, MPA',
            'chairman_body' => 'Dr. Mrs. Victoria Ekhomu is a renowned security expert and the Chairman of National Secure Solutions. With a background in security management and a wealth of experience in the field, Dr. Ekhomu is a highly respected figure in the industry. She has demonstrated a strong commitment to ensuring safety and security in various sectors, making significant contributions to the field through her expertise and leadership. Dr. Ekhomu\'s dedication to excellence and her strategic approach to security solutions have earned her a reputation as a trailblazer in the field.',
            'president_heading' => 'President',
            'president_subtitle' => 'ONA OSEZUA EKHOMU, MBA, B.Sc.',
            'president_body' => 'Ona Osezua Ekhomu is the President of National Secure Solutions. Ona is a seasoned executive professional with a diverse background in finance, marketing, and security. He holds a bachelor\'s degree in accounting from Illinois State University and an MBA in Finance and Marketing from Loyola University, Chicago. With a robust career working with several prestigious organizations, Ona has been instrumental in the success of many businesses. He prides himself on customer satisfaction and quality service. He is a veteran having served as an army officer in the United States Army for 8 years, specializing in Field Artillery coupled with military police assignments and infantry training. His leadership skills shine through with his track record of enhancing process standardization, implementing best practice initiatives, and delivering substantial value to organizations through cost savings, revenue generation, marketing strategies, and risk management. His strategic mindset, leadership acumen, and proven track record make him a valuable asset in driving National Secure Solutions\' success and achieving sustainable growth.',
        ];
    }

    /**
     * @return array<int, string>
     */
    public function statementListLines(): array
    {
        $raw = preg_split('/\r\n|\r|\n/', (string) $this->statement_list, -1, PREG_SPLIT_NO_EMPTY);

        return array_values(array_filter(array_map('trim', $raw), fn (string $line): bool => $line !== ''));
    }
}
