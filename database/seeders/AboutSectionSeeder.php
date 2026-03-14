<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutSection;
use App\Models\WorkExperience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Certification;
use App\Models\Achievement;

class AboutSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed About Section
        $about = AboutSection::first();
        if (!$about) {
            AboutSection::create([
                'title' => 'About Me',
                'description' => 'A passionate Full Stack Developer with a keen eye for design and a love for creating seamless digital experiences.',
                'motto' => 'Design is not just what it looks like and feels like. Design is how it works.',
                'content' => '<p>Hello! I am Revaldy Adhitya, a dedicated developer based in Jakarta, Indonesia. I specialize in building robust web applications using modern technologies like Laravel, Livewire, and Tailwind CSS. My journey in tech started with a curiosity for how things work on the internet, which quickly evolved into a career where I solve complex problems through code.</p><p>When I am not coding, you can find me exploring new coffee shops, reading about the latest tech trends, or working on personal projects to sharpen my skills.</p>',
                'location' => 'Jakarta, Indonesia',
                'availability_status' => 'Available for Work',
                'button_text' => 'Contact Me',
                'button_link' => '#contact',
                // 'image' => 'path/to/image.jpg', // You might want to upload a real image manually later
                // 'cv_file' => 'path/to/cv.pdf', // You might want to upload a real CV manually later
            ]);
        }

        // 2. Seed Work Experiences
        if (WorkExperience::count() == 0) {
            WorkExperience::create([
                'company' => 'Tech Solutions Inc.',
                'role' => 'Senior Full Stack Developer',
                'period' => '2023 - Present',
                'description' => 'Leading the development of scalable web applications, mentoring junior developers, and implementing best practices in code quality and deployment pipelines.',
                'sort_order' => 1,
            ]);
            WorkExperience::create([
                'company' => 'Creative Agency XYZ',
                'role' => 'Web Developer',
                'period' => '2021 - 2023',
                'description' => 'Collaborated with designers to bring creative concepts to life, optimized website performance, and ensured cross-browser compatibility.',
                'sort_order' => 2,
            ]);
        }

        // 3. Seed Education
        if (Education::count() == 0) {
            Education::create([
                'institution' => 'University of Indonesia',
                'degree' => 'Bachelor of Computer Science',
                'period' => '2017 - 2021',
                'description' => 'Graduated with honors. Focused on Software Engineering and Artificial Intelligence.',
                'sort_order' => 1,
            ]);
        }

        // 4. Seed Skills
        if (Skill::count() == 0) {
            $skills = [
                ['name' => 'Laravel', 'category' => 'Backend', 'proficiency' => 95],
                ['name' => 'Vue.js', 'category' => 'Frontend', 'proficiency' => 85],
                ['name' => 'Tailwind CSS', 'category' => 'Frontend', 'proficiency' => 90],
                ['name' => 'PHP', 'category' => 'Backend', 'proficiency' => 95],
                ['name' => 'MySQL', 'category' => 'Database', 'proficiency' => 80],
                ['name' => 'Git', 'category' => 'Tools', 'proficiency' => 85],
            ];

            foreach ($skills as $index => $skill) {
                Skill::create([
                    'name' => $skill['name'],
                    'category' => $skill['category'],
                    'proficiency' => $skill['proficiency'],
                    'sort_order' => $index + 1,
                ]);
            }
        }

        // 5. Seed Certifications
        if (Certification::count() == 0) {
            Certification::create([
                'name' => 'Certified Laravel Developer',
                'issuer' => 'Laravel LLC',
                'date' => '2023',
                'link' => 'https://laravel.com/certification',
                'sort_order' => 1,
            ]);
            Certification::create([
                'name' => 'AWS Certified Cloud Practitioner',
                'issuer' => 'Amazon Web Services',
                'date' => '2022',
                'link' => 'https://aws.amazon.com/certification/',
                'sort_order' => 2,
            ]);
        }

        // 6. Seed Achievements
        if (Achievement::count() == 0) {
            Achievement::create([
                'title' => 'Best Developer Award',
                'description' => 'Recognized as the top performer in the engineering department for Q3 2023.',
                'date' => '2023',
                'sort_order' => 1,
            ]);
            Achievement::create([
                'title' => 'Hackathon Winner',
                'description' => 'First place winner in the National Tech Hackathon 2022.',
                'date' => '2022',
                'sort_order' => 2,
            ]);
        }
    }
}
