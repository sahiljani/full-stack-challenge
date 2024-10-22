<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobPosting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobPostingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        $companies = Company::all();

        foreach ($companies as $company) {
            // Generate multiple job postings per company
            JobPosting::create([
                'company_id' => $company->id,
                'title' => 'Software Engineer',
                'description' => 'We are looking for a skilled software engineer to join our team.',
                'location' => 'San Francisco',
                'position_type' => $this->getRandomPositionType(),
                'salary' => rand(80000, 150000),
            ]);

            JobPosting::create([
                'company_id' => $company->id,
                'title' => 'Product Manager',
                'description' => 'Seeking a talented product manager to lead our product development efforts.',
                'location' => $company->location,
                'position_type' => $this->getRandomPositionType(),
                'salary' => rand(100000, 200000),
            ]);

            JobPosting::create([
                'company_id' => $company->id,
                'title' => 'Data Scientist',
                'description' => 'Looking for a data scientist to analyze and interpret complex data.',
                'location' => $company->location,
                'position_type' => $this->getRandomPositionType(),
                'salary' => rand(90000, 180000),
            ]);
        }
    }
    
    /**
     * Get a random position type.
     */
    private function getRandomPositionType(): string{
        $positionTypes = ['remote', 'in-person'];

        return $positionTypes[array_rand($positionTypes)];
    }
}
