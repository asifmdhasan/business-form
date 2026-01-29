<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Agriculture & Agribusiness',
                'services' => [
                    'Fresh Fruits & Vegetables',
                    'Rice, Grains & Pulses',
                    'Seeds & Fertilizers',
                    'Animal Feed & Poultry Supplies',
                    'Agro Machinery & Tools',
                    'Organic & Processed Food Products',
                ],
            ],
            [
                'name' => 'Apparel, Fashion & Textiles',
                'services' => [
                    'Ready-Made Garments',
                    'Corporate Uniforms',
                    'Fabrics & Textiles',
                    'Fashion Accessories',
                    'Footwear',
                    'Custom Apparel & Printing',
                ],
            ],
            [
                'name' => 'Automotive & Transportation',
                'services' => [
                    'Vehicles (Commercial & Private)',
                    'Auto Spare Parts',
                    'Tyres & Batteries',
                    'Vehicle Accessories',
                    'Fleet Management Services',
                    'Maintenance & Repair Services',
                ],
            ],
            [
                'name' => 'Construction & Real Estate',
                'services' => [
                    'Cement, Rod & Construction Materials',
                    'Tiles, Sanitaryware & Fittings',
                    'Doors, Windows & Glass',
                    'Electrical & Plumbing Materials',
                    'Real Estate Development Services',
                    'Interior & Exterior Design Services',
                ],
            ],
            [
                'name' => 'Corporate Printing & Promotional Gifts',
                'services' => [
                    'Business Cards & Stationery',
                    'Brochures, Flyers & Catalogues',
                    'Banners, Signage & Displays',
                    'Branded Merchandise',
                    'Corporate Gift Items',
                    'Custom Packaging Solutions',
                ],
            ],
            [
                'name' => 'Creative, Media & Advertising',
                'services' => [
                    'Graphic Design Services',
                    'Video Production & Editing',
                    'Photography Services',
                    'TV, Radio & Digital Ads',
                    'Animation & Motion Graphics',
                    'Content Writing & Copywriting',
                ],
            ],
            [
                'name' => 'E-commerce & Online Retail',
                'services' => [
                    'Physical Product Retail',
                    'Digital Product Sales',
                    'Marketplace Management',
                    'Dropshipping Services',
                    'Payment & Checkout Solutions',
                ],
            ],
            [
                'name' => 'Education & Training',
                'services' => [
                    'Online Courses & Certifications',
                    'Corporate Training Programs',
                    'School & College Services',
                    'EdTech Platforms',
                    'Workshops & Skill Development',
                ],
            ],
            [
                'name' => 'Energy & Renewable Solutions',
                'services' => [
                    'Solar Panels & Inverters',
                    'Wind Energy Equipment',
                    'Battery Storage Systems',
                    'EV Charging Solutions',
                    'Energy Auditing Services',
                ],
            ],
            [
                'name' => 'Event Management & Services',
                'services' => [
                    'Event Planning & Coordination',
                    'Stage, Sound & Lighting',
                    'Exhibition Booth Setup',
                    'Corporate Events & Conferences',
                    'Wedding & Social Events',
                ],
            ],
            [
                'name' => 'Financial Services & FinTech',
                'services' => [
                    'Accounting & Bookkeeping',
                    'Tax & VAT Services',
                    'Digital Payment Solutions',
                    'Investment & Advisory Services',
                    'Insurance Services',
                ],
            ],
            [
                'name' => 'Food, Beverage & Hospitality',
                'services' => [
                    'Restaurants & Catering',
                    'Packaged Food Products',
                    'Beverage Products',
                    'Cloud Kitchen Services',
                    'Hotels & Accommodation',
                ],
            ],
            [
                'name' => 'Freelance & Professional Services',
                'services' => [
                    'Business Consulting',
                    'Legal Advisory',
                    'Virtual Assistant Services',
                    'Translation & Interpretation',
                    'Project Management',
                ],
            ],
            [
                'name' => 'Healthcare & Medical Services',
                'services' => [
                    'Hospitals & Clinics',
                    'Medical Equipment',
                    'Diagnostic Services',
                    'Pharmaceuticals',
                    'Telemedicine Services',
                ],
            ],
            [
                'name' => 'Import, Export & Trading',
                'services' => [
                    'Raw Material Trading',
                    'Finished Goods Trading',
                    'Customs & Clearing Services',
                    'Sourcing & Procurement',
                    'International Logistics',
                ],
            ],
            [
                'name' => 'Information Technology & Software',
                'services' => [
                    'Software Development',
                    'Mobile App Development',
                    'Website Development',
                    'SaaS Products',
                    'IT Support & Maintenance',
                ],
            ],
            [
                'name' => 'Logistics, Supply Chain & Warehousing',
                'services' => [
                    'Freight Forwarding',
                    'Courier & Delivery Services',
                    'Warehouse Management',
                    'Cold Chain Logistics',
                    'Inventory Management',
                ],
            ],
            [
                'name' => 'Manufacturing & Industrial Production',
                'services' => [
                    'OEM Manufacturing',
                    'Custom Fabrication',
                    'Industrial Machinery',
                    'Packaging Production',
                    'Quality Control Services',
                ],
            ],
            [
                'name' => 'Marketing, Branding & PR',
                'services' => [
                    'Brand Strategy & Identity',
                    'Digital Marketing Services',
                    'Social Media Management',
                    'Influencer Marketing',
                    'Public Relations Services',
                ],
            ],
            [
                'name' => 'NGO, Social Enterprise & Development',
                'services' => [
                    'Community Programs',
                    'Development Projects',
                    'Training & Awareness Campaigns',
                    'Research & Policy Services',
                ],
            ],
            [
                'name' => 'Retail & Wholesale Distribution',
                'services' => [
                    'FMCG Distribution',
                    'Electronics Wholesale',
                    'Apparel Wholesale',
                    'Pharmacy Distribution',
                    'Dealer & Channel Sales',
                ],
            ],
            [
                'name' => 'Security, Safety & Surveillance',
                'services' => [
                    'CCTV & Surveillance Systems',
                    'Access Control Systems',
                    'Fire Safety Equipment',
                    'Cybersecurity Services',
                    'Security Guard Services',
                ],
            ],
            [
                'name' => 'Tourism, Travel & Experiences',
                'services' => [
                    'Tour Packages',
                    'Airline & Ticketing Services',
                    'Hotel Booking Services',
                    'Travel Consultancy',
                    'Experience & Adventure Services',
                ],
            ],
            [
                'name' => 'Transportation, Mobility & Rentals',
                'services' => [
                    'Scooter & Bike Rentals',
                    'Car & Vehicle Rentals',
                    'Ride-Sharing Services',
                    'Fleet Leasing',
                    'Logistics Vehicles',
                ],
            ],
            [
                'name' => 'Wholesale Corporate Solutions',
                'services' => [
                    'Office Supplies',
                    'IT Hardware Procurement',
                    'Facility Management',
                    'Corporate Gifting Solutions',
                ],
            ],
            [
                'name' => 'Other',
                'services' => [
                    'Custom Products',
                    'Mixed Services',
                    'Not Listed (Specify)',
                ],
            ],
        ];

        foreach ($categories as $category) {
            $categoryId = DB::table('business_categories')->insertGetId([
                'name' => $category['name'],
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($category['services'] as $service) {
                DB::table('services')->insert([
                    'business_category_id' => $categoryId,
                    'name' => $service,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('All business categories and services have been inserted successfully!');
    }
}
