<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Database\Seeder;

/**
 * Mirrors the Ontario Security Guard Training style outline from:
 * https://training.onlinesecuritytraining.ca/courses/security-guard-training-course/
 */
class SecurityGuardTrainingCourseSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::query()->firstOrCreate(
            ['slug' => 'security-guard-training-course'],
            [
                'title' => 'Security Guard Training Course',
                'summary' => 'Ministry-aligned 40-hour basic security guard programme: PSISA, legal authorities, communications, sensitivity, and use of force theory — online at your own pace.',
                'description' => <<<'TXT'
This 40-hour Basic Security Guard course gives students the foundational knowledge needed for the provincial licensing pathway and practical awareness for basic security duties in Ontario-aligned contexts.

Administrators should replace or extend this overview text from Admin → Courses; structured FAQs and module content below were seeded to match a typical Ontario-style curriculum layout.
TXT,
                'categories' => ['CCTV', 'Conflict Management', 'Security Guard'],
                'learning_outcomes' => [
                    'Introduction to the security industry',
                    'The PSISA and Ministry Code of Conduct',
                    'Basic Security Procedures',
                    'Report Writing',
                    'Health and Safety',
                    'Emergency Response Preparation',
                    'Canadian Legal System',
                    'Legal Authorities',
                    'Effective Communications',
                    'Sensitivity Training',
                    'Use of Force Theory',
                ],
                'faq_sections' => $this->faqSections(),
                'material_includes' => [
                    'Interactive learning method',
                    'PowerPoint presentation',
                    'Learning journal',
                    'On-demand video learning',
                    'MOC-style knowledge checks',
                    'Certificate of completion',
                ],
                'requirements_list' => [
                    'Be 18 years of age or older',
                    'Be eligible to work in Canada',
                    'Have no convictions for a prescribed offence for which you have not been granted a pardon',
                ],
                'audience' => <<<'AUD'
Online Security Guard Training is a professional certification-style programme that teaches how to protect property and people responsibly. This pathway is designed to support learners preparing for provincial licensing steps where applicable; always verify current Ministry requirements for your jurisdiction.
AUD,
                'level_label' => 'All levels',
                'detail_last_updated_at' => '2025-08-17',
                'price' => 180.00,
                'currency' => 'CAD',
                'is_published' => true,
                'duration_minutes' => 40 * 60,
            ]
        );

        if ($course->modules()->exists()) {
            return;
        }

        $ts = now();
        foreach ($this->modules() as $row) {
            CourseModule::query()->create(array_merge($row, [
                'course_id' => $course->id,
                'video_url' => null,
                'created_at' => $ts,
                'updated_at' => $ts,
            ]));
        }
    }

    /**
     * @return array<int, array{title: string, body: string}>
     */
    private function faqSections(): array
    {
        return [
            [
                'title' => 'Who should attend the Ontario security guard training course?',
                'body' => <<<'TXT'
This includes, but is not limited to, hotels, restaurants and bars that employ security guards and bouncers. Businesses that employ their own in-house security guards and/or private investigators may need to register with the Private Security and Investigative Services Branch, and their security personnel may need to be licensed where required.
TXT,
            ],
            [
                'title' => 'Why take this type of security licence training?',
                'body' => <<<'TXT'
Provincial requirements can require new applicants to successfully complete basic training and pass an approved test prior to applying for a security guard licence where applicable. A 40-hour Basic Security Guard course is designed so that successful students possess foundational knowledge aligned to common licensing exams and basic duties of a security guard.
TXT,
            ],
            [
                'title' => 'What are the minimum requirements to hold a security guard licence?',
                'body' => <<<'TXT'
Eligibility commonly includes: being 18 years of age or older; being eligible to work in Canada; and having no convictions for prescribed offences for which you have not been granted a pardon (verify current provincial rules).
TXT,
            ],
            [
                'title' => 'Can individuals still get a licence if they have a criminal record?',
                'body' => <<<'TXT'
Depending on the record, individuals may not be eligible unless a pardon is obtained for applicable offence(s). Review the prescribed offences and clean-record rules on the official Ministry / regulator website for your province.
TXT,
            ],
            [
                'title' => 'Why does training cover the full curriculum even if some topics feel beyond my role?',
                'body' => <<<'TXT'
Training guidelines help ensure all practitioners share a consistent baseline of skills and knowledge, regardless of the exact site or employer needs.
TXT,
            ],
            [
                'title' => 'Does the training entity administer the licensing test?',
                'body' => <<<'TXT'
In Ontario, testing has been delivered through an approved vendor (for example Serco / ontariosecuritytesting.ca). Always confirm the current test provider, fees, and registration steps on the official site.
TXT,
            ],
            [
                'title' => 'How will students be tested?',
                'body' => <<<'TXT'
Typical licensing exams are multiple-choice with a fixed time limit; fees and rewrite rules change over time — confirm on the official testing provider website.
TXT,
            ],
            [
                'title' => 'Resources we provide to all students',
                'body' => <<<'TXT'
Structured online learning, knowledge checks, and progress tracking through this platform. Study at your own pace where your enrolment allows.
TXT,
            ],
        ];
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function modules(): array
    {
        return [
            [
                'sort_order' => 0,
                'title' => 'Preface',
                'duration_minutes' => null,
                'body' => '',
                'lesson_outline' => [
                    ['label' => 'Pre-requisites', 'duration_label' => '00:00'],
                    ['label' => 'Quiz', 'duration_label' => null],
                ],
            ],
            [
                'sort_order' => 1,
                'title' => 'Module 1: Introduction to the security industry – (Duration: 02 hours)',
                'duration_minutes' => 120,
                'body' => <<<'HTML'
<p>Upon completion of this module, learners explore different roles across private investigation, law enforcement support, security services, loss prevention, and patrol services; the occupation of a security guard including knowledge, skills, and abilities; and typical demands such as travel, off-hours work, stress, and risk awareness.</p>
HTML,
                'lesson_outline' => [
                    ['label' => 'Presentation', 'duration_label' => '02:00:00'],
                    ['label' => 'Q-Module: 1', 'duration_label' => null],
                ],
            ],
            [
                'sort_order' => 2,
                'title' => 'Module 2: The PSISA and Ministry Code of Conduct – (Duration: 02 hours)',
                'duration_minutes' => 120,
                'body' => <<<'HTML'
<p>Understand licensing responsibilities, general duties, standards, practices, regulations and prohibitions; producing a licence; consequences of non-compliance; and complaint procedures.</p>
HTML,
                'lesson_outline' => [
                    ['label' => 'Presentation', 'duration_label' => '02:30:00'],
                    ['label' => 'Q-Module: 2', 'duration_label' => null],
                ],
            ],
            [
                'sort_order' => 3,
                'title' => 'Module 3: Basic Security Procedures – (Duration: 03 hours)',
                'duration_minutes' => 180,
                'body' => '<p>Foundational patrol, access control, observation, and incident-awareness procedures used on typical assignments.</p>',
                'lesson_outline' => [
                    ['label' => 'Presentation', 'duration_label' => '03:00:00'],
                    ['label' => 'Q-Module: 3', 'duration_label' => null],
                ],
            ],
            [
                'sort_order' => 4,
                'title' => 'Module 4: Report Writing – (Duration: 02 hours)',
                'duration_minutes' => 120,
                'body' => '<p>Clear, factual reporting: notes, logs, incident narratives, and handover basics.</p>',
                'lesson_outline' => [
                    ['label' => 'Presentation', 'duration_label' => '02:00:00'],
                    ['label' => 'Q-Module: 4', 'duration_label' => null],
                ],
            ],
            [
                'sort_order' => 5,
                'title' => 'Module 5: Health and Safety – (Duration: 01 hours)',
                'duration_minutes' => 60,
                'body' => '<p>Workplace hazards, basic duties, PPE awareness, and reporting expectations.</p>',
                'lesson_outline' => [
                    ['label' => 'Presentation', 'duration_label' => '01:00:00'],
                    ['label' => 'Q-Module: 5', 'duration_label' => null],
                ],
            ],
            [
                'sort_order' => 6,
                'title' => 'Module 6: Emergency Response Preparation – (Duration: 04 hours)',
                'duration_minutes' => 240,
                'body' => '<p>Planning, communications, evacuation concepts, and coordination with emergency services.</p>',
                'lesson_outline' => [
                    ['label' => 'Presentation', 'duration_label' => '04:00:00'],
                    ['label' => 'Q-Module: 6', 'duration_label' => null],
                ],
            ],
            [
                'sort_order' => 7,
                'title' => 'Module 7: Canadian Legal System – (Duration: 03 hours)',
                'duration_minutes' => 180,
                'body' => '<p>High-level overview of institutions and concepts relevant to security practice (not legal advice).</p>',
                'lesson_outline' => [
                    ['label' => 'Presentation', 'duration_label' => '03:00:00'],
                    ['label' => 'Q-Module: 7', 'duration_label' => null],
                ],
            ],
            [
                'sort_order' => 8,
                'title' => 'Module 8: Legal Authorities – (Duration: 07:30 hours)',
                'duration_minutes' => 450,
                'body' => '<p>Authority, limits, arrest concepts where applicable, and professional boundaries — always follow current law and employer policy.</p>',
                'lesson_outline' => [
                    ['label' => 'Presentation', 'duration_label' => '08:00:00'],
                    ['label' => 'Quiz - Module: 8', 'duration_label' => null],
                ],
            ],
            [
                'sort_order' => 9,
                'title' => 'Module 9: Effective Communications – (Duration: 04 hours)',
                'duration_minutes' => 240,
                'body' => '<p>De-escalation-oriented communication, professionalism, and conflict awareness.</p>',
                'lesson_outline' => [
                    ['label' => 'Presentation', 'duration_label' => '04:00:00'],
                    ['label' => 'Quiz: 9', 'duration_label' => null],
                ],
            ],
            [
                'sort_order' => 10,
                'title' => 'Module 10: Sensitivity Training – (Duration: 03 hours)',
                'duration_minutes' => 180,
                'body' => '<p>Respectful engagement, bias awareness, and inclusive practice on the job.</p>',
                'lesson_outline' => [
                    ['label' => 'Presentation', 'duration_label' => '03:00:00'],
                    ['label' => 'Quiz – 10', 'duration_label' => null],
                ],
            ],
            [
                'sort_order' => 11,
                'title' => 'Module 11: Use of Force Theory – (Duration: 02 hours)',
                'duration_minutes' => 120,
                'body' => '<p>Theoretical framework for force considerations; practical skills may require separate hands-on training where required.</p>',
                'lesson_outline' => [
                    ['label' => 'Presentation', 'duration_label' => '02:00:00'],
                    ['label' => 'Quiz - 11', 'duration_label' => null],
                ],
            ],
        ];
    }
}
