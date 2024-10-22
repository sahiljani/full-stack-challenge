<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\JobPosting;
use Illuminate\Database\Seeder;

class JobPostingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        $companies = Company::all();

        // Define possible job titles, descriptions, and locations
        $jobTitles = [
            'Software Engineer', 'Product Manager', 'Data Scientist', 'UX Designer', 'Marketing Manager', 
            'DevOps Engineer', 'Sales Representative', 'Content Strategist', 'QA Tester', 'Technical Support'
        ];

        $jobDescriptions = [
            'We are looking for a skilled {title} to join our team.',
            'Seeking a talented {title} to lead our efforts.',
            'Join us as a {title} and make a difference in our company.',
            'Looking for an experienced {title} to help us scale.',
            'We need a {title} to take our product to the next level.'
        ];

        $locations = ['San Francisco', 'New York', 'Los Angeles', 'Remote', 'Chicago', 'Austin'];

        foreach ($companies as $company) {
            // Generate 50 job postings per company
            for ($i = 0; $i < 50; $i++) {
                $title = $this->getRandomItem($jobTitles);
                $description = str_replace('{title}', strtolower($title), $this->getRandomItem($jobDescriptions));
                $location = $this->getRandomItem($locations);

                JobPosting::create([
                    'company_id' => $company->id,
                    'title' => $title,
                    'description' => $description,
                    'location' => $location,
                    'position_type' => $this->getRandomPositionType(),
                    'salary' => rand(50000, 200000),
                ]);
            }
        }
    }

    /**
     * Get a random item from an array.
     */
    private function getRandomItem(array $items): string{
        return $items[array_rand($items)];
    }

    /**
     * Get a random position type.
     */
    private function getRandomPositionType(): string{
        $positionTypes = ['remote', 'in-person'];

        return $positionTypes[array_rand($positionTypes)];
    }
}
