<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WebsiteSetting;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Gallery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@csrgo.com'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Clear existing dynamic content before reseeding to prevent duplicates
        WebsiteSetting::truncate();
        Banner::truncate();
        Category::truncate();
        Product::truncate();
        Gallery::truncate();

        // 3. Website Settings (Global Content)
        $settings = [
            'website_name' => 'CSRGO',
            'company_name' => 'CSRGO Commercial Solutions',
            'company_description' => 'Delivering exceptional commercial and industrial products designed for modern operational demands and uncompromising reliability.',
            'about_title' => 'Engineered for Excellence, Built on Trust',
            'about_description' => 'At CSRGO, we specialize in sourcing and delivering premium-grade products for businesses. Our commitment is simple: providing unparalleled quality, seamless logistics, and a customer-first approach that ensures your operations never slow down. We believe in building lasting partnerships through transparent communication and consistent delivery.',
            'vision_description' => 'To be the most reliable and innovative supply partner, setting the benchmark for product quality and operational integrity across all sectors we serve.',
            'mission_description' => 'We relentlessly empower our clients by providing top-tier commercial solutions, backed by transparent processes and dedicated support to drive their continuous growth and success.',
            'founder_name' => '[Founder / Director Name]',
            'founder_designation' => 'Executive Director',
            'founder_description' => 'Our foundation is built on absolute integrity and a commitment to quality. We do not just supply products; we build lasting partnerships that help businesses thrive in competitive environments.',
            'address' => '[123 Business Avenue, Commercial District, City, Country]',
            'phone' => '[+1 234 567 8900]',
            'email' => 'contact@csrgo.com',
            'facebook' => 'https://facebook.com',
            'linkedin' => 'https://linkedin.com',
        ];

        foreach ($settings as $key => $value) {
            WebsiteSetting::create(['key' => $key, 'value' => $value]);
        }

        // 4. Banners
        $banners = [
            [
                'title' => 'Premium Commercial Supply Solutions',
                'subtitle' => 'Equipping businesses with high-grade materials and equipment engineered for optimal operational success.',
                'image' => '', // Empty string to prevent SQL constraint error
                'button_text' => 'Explore Our Catalog',
                'button_url' => '/products',
                'display_order' => 1,
                'status' => true,
            ],
            [
                'title' => 'Uncompromising Quality Standards',
                'subtitle' => 'Every product in our inventory undergoes rigorous evaluation to ensure absolute reliability for your business.',
                'image' => '',
                'button_text' => 'Learn About Us',
                'button_url' => '/about',
                'display_order' => 2,
                'status' => true,
            ],
            [
                'title' => 'Dedicated Professional Support',
                'subtitle' => 'Our expert team is standing by to assist with custom orders, bulk requirements, and seamless delivery scheduling.',
                'image' => '',
                'button_text' => 'Contact Our Team',
                'button_url' => '/contact',
                'display_order' => 3,
                'status' => true,
            ]
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }

        // 5. Categories
        $categoriesData = [
            [
                'name' => 'Industrial Equipment',
                'description' => 'Heavy-duty machinery, precision tools, and robust hardware designed exclusively for rigorous commercial environments and manufacturing sectors.',
            ],
            [
                'name' => 'Enterprise Technology',
                'description' => 'Advanced computing hardware, secure networking devices, and reliable communication technology to streamline your daily business operations.',
            ],
            [
                'name' => 'Professional Safety Gear',
                'description' => 'Commercial-grade protective equipment and apparel ensuring maximum workplace safety and strict regulatory compliance for your workforce.',
            ],
            [
                'name' => 'Commercial Packaging',
                'description' => 'Durable, efficient, and sustainable packaging materials engineered for secure global transit, storage, and retail distribution.',
            ]
        ];

        $categories = [];
        $order = 1;
        foreach ($categoriesData as $catData) {
            $categories[] = Category::create([
                'name' => $catData['name'],
                'slug' => Str::slug($catData['name']),
                'description' => $catData['description'],
                'image' => '',
                'display_order' => $order++,
                'status' => true,
            ]);
        }

        // 6. Products
        $productsData = [
            // Industrial Equipment
            [
                'category_id' => $categories[0]->id,
                'name' => 'Commercial Power Generator 5000W',
                'short_description' => 'High-capacity backup power generator built for uninterrupted commercial operations during critical outages.',
                'description' => "Ensure your business never stops with our Commercial Power Generator 5000W.\n\nKey Benefits:\n- Continuous power supply for essential commercial machinery.\n- High-efficiency fuel consumption.\n- Built with industrial-grade steel components for longevity.\n- Designed for minimal maintenance.\n\nIdeal for small manufacturing units, construction sites, and emergency backup systems.",
                'price' => 1250.00,
                'featured' => true,
            ],
            [
                'category_id' => $categories[0]->id,
                'name' => 'Precision Hydraulic Lift',
                'short_description' => 'Heavy-duty hydraulic lifting mechanism designed for safe and efficient warehouse material handling.',
                'description' => "Maximize your warehouse efficiency with our Precision Hydraulic Lift.\n\nKey Benefits:\n- Safely handles up to 2 tons of commercial freight.\n- Smooth, precision-controlled lifting mechanism.\n- Built-in safety locks to prevent accidental drops.\n\nBuilt to withstand daily heavy usage in demanding logistics environments.",
                'price' => null, // POA
                'featured' => false,
            ],
            
            // Enterprise Technology
            [
                'category_id' => $categories[1]->id,
                'name' => 'Secure Enterprise Network Router',
                'short_description' => 'Advanced routing hardware providing secure, high-speed, and reliable connectivity for large corporate networks.',
                'description' => "Keep your business connected and secure with our Enterprise Network Router.\n\nKey Benefits:\n- Built-in advanced firewall and threat protection.\n- Supports over 500 concurrent high-speed connections.\n- Failover capabilities for uninterrupted service.\n\nThe perfect solution for corporate offices requiring absolute data security and zero downtime.",
                'price' => 450.00,
                'featured' => true,
            ],
            [
                'category_id' => $categories[1]->id,
                'name' => 'Commercial Workstation PC',
                'short_description' => 'High-performance desktop computer optimized for intense data processing and commercial multitasking.',
                'description' => "Power through your daily operations with our Commercial Workstation.\n\nKey Benefits:\n- Optimized for heavy commercial applications and data processing.\n- Highly durable chassis designed for office environments.\n- Energy-efficient power management system.\n\nEquip your team with the reliable technology they need to succeed.",
                'price' => 899.99,
                'featured' => false,
            ],

            // Professional Safety Gear
            [
                'category_id' => $categories[2]->id,
                'name' => 'Reinforced Industrial Safety Helmet',
                'short_description' => 'Impact-resistant protective headgear designed to meet strict commercial safety regulations.',
                'description' => "Protect your workforce with our Reinforced Industrial Safety Helmet.\n\nKey Benefits:\n- High-impact polycarbonate shell.\n- Adjustable suspension for all-day comfort.\n- Meets and exceeds commercial safety compliance standards.\n\nEssential for construction, manufacturing, and heavy logistics operations.",
                'price' => 25.50,
                'featured' => true,
            ],
            [
                'category_id' => $categories[2]->id,
                'name' => 'High-Visibility Protective Vest',
                'short_description' => 'Reflective commercial safety vest for maximum visibility in hazardous or low-light work environments.',
                'description' => "Ensure maximum visibility on the job site with our Protective Vest.\n\nKey Benefits:\n- Premium reflective strips visible from 500 feet.\n- Breathable, lightweight commercial mesh fabric.\n- Durable stitching for long-term daily use.\n\nA mandatory safety requirement for warehouse operations and field work.",
                'price' => 12.00,
                'featured' => false,
            ],

            // Commercial Packaging
            [
                'category_id' => $categories[3]->id,
                'name' => 'Heavy-Duty Corrugated Shipping Boxes',
                'short_description' => 'Reinforced packaging boxes engineered to protect valuable commercial goods during long-distance transit.',
                'description' => "Secure your products with our Heavy-Duty Corrugated Boxes.\n\nKey Benefits:\n- Multi-layered reinforced walls prevent crushing.\n- Optimized for standard commercial pallet stacking.\n- Manufactured from sustainable, highly durable materials.\n\nIdeal for secure international shipping and wholesale logistics.",
                'price' => null, // POA
                'featured' => true,
            ]
        ];

        $order = 1;
        foreach ($productsData as $prodData) {
            Product::create([
                'category_id' => $prodData['category_id'],
                'name' => $prodData['name'],
                'slug' => Str::slug($prodData['name']),
                'short_description' => $prodData['short_description'],
                'description' => $prodData['description'],
                'price' => $prodData['price'],
                'main_image' => '',
                'featured' => $prodData['featured'],
                'display_order' => $order++,
                'status' => true,
            ]);
        }

        // 7. Gallery
        $galleryData = [
            ['title' => 'Warehouse Facility', 'description' => 'Our secure logistics center.'],
            ['title' => 'Quality Inspection', 'description' => 'Rigorous testing protocols.'],
            ['title' => 'Global Logistics', 'description' => 'Seamless export operations.'],
            ['title' => 'Customer Support', 'description' => 'Dedicated professional team.'],
        ];

        $order = 1;
        foreach ($galleryData as $galData) {
            Gallery::create([
                'title' => $galData['title'],
                'description' => $galData['description'],
                'image' => '',
                'display_order' => $order++,
                'status' => true,
            ]);
        }
    }
}
