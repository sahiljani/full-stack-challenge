<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $companies = [
            ['name' => 'Amazon', 'location' => 'Seattle', 'domain' => 'amazon.ca'],
            ['name' => 'Google', 'location' => 'Mountain View', 'domain' => 'google.com'],
            ['name' => 'Apple', 'location' => 'Cupertino', 'domain' => 'apple.com'],
            ['name' => 'Microsoft', 'location' => 'Redmond', 'domain' => 'microsoft.com'],
            ['name' => 'Facebook', 'location' => 'Menlo Park', 'domain' => 'facebook.com'],
            ['name' => 'Netflix', 'location' => 'Los Gatos', 'domain' => 'netflix.com'],
            ['name' => 'Tesla', 'location' => 'Palo Alto', 'domain' => 'tesla.com'],
            ['name' => 'Uber', 'location' => 'San Francisco', 'domain' => 'uber.com'],
            ['name' => 'Spotify', 'location' => 'Stockholm', 'domain' => 'spotify.com'],
            ['name' => 'Slack', 'location' => 'San Francisco', 'domain' => 'slack.com'],
        ];

        foreach ($companies as $company) {
            $logo = $this->fetchCompanyLogo($company['domain']);
            
            Company::create([
                'name' => $company['name'],
                'location' => $company['location'],
                'logo' => $logo
            ]);
        }
    }

    private function fetchCompanyLogo(string $domain): ?string { 
        $url = "https://logo.clearbit.com/{$domain}";

        try {

            $response = Http::get($url);
            
            if ($response->successful()) {    
                $filename = "logos/{$domain}.png";
                Storage::disk('public')->put($filename, $response->body());
                return $filename;
            }
        } catch (\Exception $e) {
          
        }

        return null;
    }
}
