<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            // ===== Hero / Header Section =====
            'hero_title'              => 'Find a Muslim Entrepreneur Near You',
            'hero_subtitle'           => 'Showcase your business within a trusted community of Muslim entrepreneurs. Connect, collaborate, and grow together with shared values.',
            'hero_bg_image'           => null, // upload via admin, fallback handled in blade
            'hero_animation_image'    => null, // the flower/pattern overlay image
            'hero_button_text'        => 'Add Your Business',
            'hero_button_link'        => '/business/register/form',
            'hero_search_placeholder' => 'Search by business name ...',
            'hero_search_button_text' => 'Search',

            // ===== Featured Businesses Section =====
            'featured_title'    => 'Featured Businesses',
            'featured_subtitle' => '',

            // ===== Filter Businesses (sidebar) =====
            'filter_title'              => 'Filter Businesses',
            'filter_apply_button_text'  => 'Apply Filters',
            'filter_reset_button_text'  => 'Reset',

            // ===== CTA Section (above footer) =====
            // Title is split in two because the design renders it in two
            // different font weights/colors: "Bring Your Business to the" (light)
            // + "Global Stage" (bold).
            'cta_title_light' => 'Bring Your Business to the',
            'cta_title_bold'  => 'Global Stage',
            'cta_subtitle'     => 'Join a growing network of Muslim entrepreneurs building real businesses, real partnerships, and real impact.',
            'cta_button_text'  => 'Add Your Business Today',
            'cta_button_link'  => '/business/register/form',

            // ===== Footer =====
            'footer_logo'    => null, // upload via admin, fallback to existing asset
            'footer_tagline' => 'Connecting communities, one business at a time.',
        ];

        foreach ($defaults as $key => $value) {
            $type = str_contains($key, 'image') || str_contains($key, 'logo') ? 'image' : 'text';

            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => $type]
            );
        }
    }
}
