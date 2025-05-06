<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'E-commerce Website',
                'description' => 'A fully responsive e-commerce website built with Laravel and Vue.js. Features include user authentication, product filtering, cart management, payment gateway integration, and an admin dashboard for inventory management.',
                'category' => 'web',
                'technologies' => json_encode(['Laravel', 'Tailwind CSS', 'Vue.js', 'MySQL', 'Stripe API']),
                'status' => 'online',
                'url' => 'https://example-store.com',
            ],
            [
                'title' => 'Restaurant Website',
                'description' => 'An elegant website for a high-end restaurant featuring an online reservation system, menu showcase, and event booking functionality. The site is no longer online due to business closure.',
                'category' => 'web',
                'technologies' => json_encode(['Laravel', 'Tailwind CSS', 'Alpine.js', 'MySQL', 'JavaScript']),
                'status' => 'offline',
                'url' => null,
            ],
            [
                'title' => 'Corporate Visual Identity',
                'description' => 'Comprehensive visual identity system for a tech company, including logo design, brand guidelines document, stationery design, and digital assets for social media and web presence.',
                'category' => 'design',
                'technologies' => json_encode(['Adobe Illustrator', 'Adobe Photoshop', 'Adobe InDesign']),
                'status' => 'online',
                'url' => 'https://techcompany.com/branding',
            ],
            [
                'title' => 'Educational Platform',
                'description' => 'Modern learning management system with course management, student tracking, assignment submission, and integrated video conferencing. This was a template project created to showcase capabilities.',
                'category' => 'web',
                'technologies' => json_encode(['Laravel', 'Tailwind CSS', 'Vue.js', 'MySQL', 'WebRTC']),
                'status' => 'template',
                'url' => null,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        $this->command->info('Sample projects created successfully!');
    }
}