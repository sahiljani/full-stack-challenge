<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            ['name' => 'Airbnb', 'location' => 'San Francisco', 'domain' => 'airbnb.com'],
            ['name' => 'Twitter', 'location' => 'San Francisco', 'domain' => 'twitter.com'],
            ['name' => 'Adobe', 'location' => 'San Jose', 'domain' => 'adobe.com'],
            ['name' => 'Salesforce', 'location' => 'San Francisco', 'domain' => 'salesforce.com'],
            ['name' => 'Dropbox', 'location' => 'San Francisco', 'domain' => 'dropbox.com'],
            ['name' => 'Zoom', 'location' => 'San Jose', 'domain' => 'zoom.us'],
            ['name' => 'Intel', 'location' => 'Santa Clara', 'domain' => 'intel.com'],
            ['name' => 'Cisco', 'location' => 'San Jose', 'domain' => 'cisco.com'],
            ['name' => 'HP', 'location' => 'Palo Alto', 'domain' => 'hp.com'],
            ['name' => 'Oracle', 'location' => 'Redwood City', 'domain' => 'oracle.com'],
            ['name' => 'GitHub', 'location' => 'San Francisco', 'domain' => 'github.com'],
            ['name' => 'LinkedIn', 'location' => 'Sunnyvale', 'domain' => 'linkedin.com'],
            ['name' => 'Square', 'location' => 'San Francisco', 'domain' => 'squareup.com'],
            ['name' => 'Stripe', 'location' => 'San Francisco', 'domain' => 'stripe.com'],
            ['name' => 'Pinterest', 'location' => 'San Francisco', 'domain' => 'pinterest.com'],
            ['name' => 'TikTok', 'location' => 'Los Angeles', 'domain' => 'tiktok.com'],
            ['name' => 'Snap', 'location' => 'Santa Monica', 'domain' => 'snap.com'],
            ['name' => 'Atlassian', 'location' => 'Sydney', 'domain' => 'atlassian.com'],
            ['name' => 'PayPal', 'location' => 'San Jose', 'domain' => 'paypal.com'],
            ['name' => 'Etsy', 'location' => 'Brooklyn', 'domain' => 'etsy.com'],
            ['name' => 'Shopify', 'location' => 'Ottawa', 'domain' => 'shopify.com'],
            ['name' => 'WeWork', 'location' => 'New York', 'domain' => 'wework.com'],
            ['name' => 'ByteDance', 'location' => 'Beijing', 'domain' => 'bytedance.com'],
            ['name' => 'Alibaba', 'location' => 'Hangzhou', 'domain' => 'alibaba.com'],
            ['name' => 'Tencent', 'location' => 'Shenzhen', 'domain' => 'tencent.com'],
            ['name' => 'Baidu', 'location' => 'Beijing', 'domain' => 'baidu.com'],
            ['name' => 'JD.com', 'location' => 'Beijing', 'domain' => 'jd.com'],
            ['name' => 'Dell', 'location' => 'Round Rock', 'domain' => 'dell.com'],
            ['name' => 'Asana', 'location' => 'San Francisco', 'domain' => 'asana.com'],
            ['name' => 'Squarespace', 'location' => 'New York', 'domain' => 'squarespace.com'],
            ['name' => 'Epic Games', 'location' => 'Cary', 'domain' => 'epicgames.com'],
            ['name' => 'Unity', 'location' => 'San Francisco', 'domain' => 'unity.com'],
            ['name' => 'Riot Games', 'location' => 'Los Angeles', 'domain' => 'riotgames.com'],
            ['name' => 'Electronic Arts', 'location' => 'Redwood City', 'domain' => 'ea.com'],
            ['name' => 'Zynga', 'location' => 'San Francisco', 'domain' => 'zynga.com'],
            ['name' => 'Expedia', 'location' => 'Seattle', 'domain' => 'expedia.com'],
            ['name' => 'Booking.com', 'location' => 'Amsterdam', 'domain' => 'booking.com'],
            ['name' => 'Uber Eats', 'location' => 'San Francisco', 'domain' => 'ubereats.com'],
            ['name' => 'Doordash', 'location' => 'San Francisco', 'domain' => 'doordash.com'],
            ['name' => 'Lyft', 'location' => 'San Francisco', 'domain' => 'lyft.com'],
            ['name' => 'Instacart', 'location' => 'San Francisco', 'domain' => 'instacart.com'],
            ['name' => 'Robinhood', 'location' => 'Menlo Park', 'domain' => 'robinhood.com'],
            ['name' => 'Coinbase', 'location' => 'San Francisco', 'domain' => 'coinbase.com'],
            ['name' => 'OpenAI', 'location' => 'San Francisco', 'domain' => 'openai.com'],
            ['name' => 'Reddit', 'location' => 'San Francisco', 'domain' => 'reddit.com'],
            ['name' => 'Mozilla', 'location' => 'Mountain View', 'domain' => 'mozilla.org'],
            ['name' => 'ProtonMail', 'location' => 'Geneva', 'domain' => 'protonmail.com'],
            ['name' => 'Telegram', 'location' => 'Dubai', 'domain' => 'telegram.org'],
            ['name' => 'Signal', 'location' => 'Mountain View', 'domain' => 'signal.org'],
            ['name' => 'Vimeo', 'location' => 'New York', 'domain' => 'vimeo.com'],
            ['name' => 'Shopify', 'location' => 'Toronto', 'domain' => 'shopify.com'],
            ['name' => 'Klarna', 'location' => 'Stockholm', 'domain' => 'klarna.com'],
            ['name' => 'Adyen', 'location' => 'Amsterdam', 'domain' => 'adyen.com'],
            ['name' => 'Wise', 'location' => 'London', 'domain' => 'wise.com'],
            ['name' => 'Revolut', 'location' => 'London', 'domain' => 'revolut.com'],
            ['name' => 'N26', 'location' => 'Berlin', 'domain' => 'n26.com'],
            ['name' => 'Monzo', 'location' => 'London', 'domain' => 'monzo.com'],
            ['name' => 'Deliveroo', 'location' => 'London', 'domain' => 'deliveroo.co.uk'],
            ['name' => 'Glovo', 'location' => 'Barcelona', 'domain' => 'glovoapp.com'],
            ['name' => 'Lazada', 'location' => 'Singapore', 'domain' => 'lazada.sg'],
            ['name' => 'Shopee', 'location' => 'Singapore', 'domain' => 'shopee.sg'],
            ['name' => 'Grab', 'location' => 'Singapore', 'domain' => 'grab.com'],
            ['name' => 'Tokopedia', 'location' => 'Jakarta', 'domain' => 'tokopedia.com'],
            ['name' => 'Gojek', 'location' => 'Jakarta', 'domain' => 'gojek.com'],
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
