<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SmsController extends Controller
{
    /* =========================================================
       HERO / HEADER SECTION
    ========================================================= */
    public function heroEdit()
    {
        $settings = SiteSetting::getMany([
            'hero_title', 'hero_subtitle', 'hero_bg_image', 'hero_animation_image',
            'hero_button_text', 'hero_button_link',
            'hero_search_placeholder', 'hero_search_button_text',
        ]);

        return view('admin.sms.hero', compact('settings'));
    }

    public function heroUpdate(Request $request)
    {
        $request->validate([
            'hero_title'              => 'required|string|max:255',
            'hero_subtitle'           => 'nullable|string',
            'hero_button_text'        => 'required|string|max:100',
            'hero_button_link'        => 'required|string|max:255',
            'hero_search_placeholder' => 'nullable|string|max:255',
            'hero_search_button_text' => 'nullable|string|max:100',
            'hero_bg_image'           => 'nullable|image|max:4096',
            'hero_animation_image'    => 'nullable|image|max:4096',
        ]);

        SiteSetting::setMany([
            'hero_title'              => $request->hero_title,
            'hero_subtitle'           => $request->hero_subtitle,
            'hero_button_text'        => $request->hero_button_text,
            'hero_button_link'        => $request->hero_button_link,
            'hero_search_placeholder' => $request->hero_search_placeholder,
            'hero_search_button_text' => $request->hero_search_button_text,
        ]);

        if ($request->hasFile('hero_bg_image')) {
            $path = $request->file('hero_bg_image')->store('site-settings', 'public');
            SiteSetting::set('hero_bg_image', $path, 'image');
        }

        if ($request->hasFile('hero_animation_image')) {
            $path = $request->file('hero_animation_image')->store('site-settings', 'public');
            SiteSetting::set('hero_animation_image', $path, 'image');
        }

        return back()->with('success', 'Hero section updated successfully.');
    }

    /* =========================================================
       FEATURED BUSINESSES SECTION
    ========================================================= */
    public function featuredEdit()
    {
        $settings = SiteSetting::getMany(['featured_title', 'featured_subtitle']);

        return view('admin.sms.featured', compact('settings'));
    }

    public function featuredUpdate(Request $request)
    {
        $request->validate([
            'featured_title'    => 'required|string|max:255',
            'featured_subtitle' => 'nullable|string',
        ]);

        SiteSetting::setMany([
            'featured_title'    => $request->featured_title,
            'featured_subtitle' => $request->featured_subtitle,
        ]);

        return back()->with('success', 'Featured Businesses section updated successfully.');
    }

    /* =========================================================
       FILTER BUSINESSES (SIDEBAR)
    ========================================================= */
    public function filterEdit()
    {
        $settings = SiteSetting::getMany([
            'filter_title', 'filter_apply_button_text', 'filter_reset_button_text',
        ]);

        return view('admin.sms.filter', compact('settings'));
    }

    public function filterUpdate(Request $request)
    {
        $request->validate([
            'filter_title'             => 'required|string|max:255',
            'filter_apply_button_text' => 'required|string|max:100',
            'filter_reset_button_text' => 'required|string|max:100',
        ]);

        SiteSetting::setMany([
            'filter_title'             => $request->filter_title,
            'filter_apply_button_text' => $request->filter_apply_button_text,
            'filter_reset_button_text' => $request->filter_reset_button_text,
        ]);

        return back()->with('success', 'Filter Businesses section updated successfully.');
    }

    /* =========================================================
       CTA SECTION (ABOVE FOOTER)
    ========================================================= */
    public function ctaEdit()
    {
        $settings = SiteSetting::getMany([
            'cta_title_light', 'cta_title_bold', 'cta_subtitle',
            'cta_button_text', 'cta_button_link',
        ]);

        return view('admin.sms.cta', compact('settings'));
    }

    public function ctaUpdate(Request $request)
    {
        $request->validate([
            'cta_title_light' => 'required|string|max:255',
            'cta_title_bold'  => 'required|string|max:255',
            'cta_subtitle'    => 'nullable|string',
            'cta_button_text' => 'required|string|max:100',
            'cta_button_link' => 'required|string|max:255',
        ]);

        SiteSetting::setMany([
            'cta_title_light' => $request->cta_title_light,
            'cta_title_bold'  => $request->cta_title_bold,
            'cta_subtitle'    => $request->cta_subtitle,
            'cta_button_text' => $request->cta_button_text,
            'cta_button_link' => $request->cta_button_link,
        ]);

        return back()->with('success', 'CTA section updated successfully.');
    }

    /* =========================================================
       FOOTER (LOGO + TAGLINE ONLY — LINKS STAY HARDCODED)
    ========================================================= */
    public function footerEdit()
    {
        $settings = SiteSetting::getMany(['footer_logo', 'footer_tagline']);

        return view('admin.sms.footer', compact('settings'));
    }

    public function footerUpdate(Request $request)
    {
        $request->validate([
            'footer_tagline' => 'nullable|string|max:255',
            'footer_logo'    => 'nullable|image|max:2048',
        ]);

        SiteSetting::set('footer_tagline', $request->footer_tagline);

        if ($request->hasFile('footer_logo')) {
            $path = $request->file('footer_logo')->store('site-settings', 'public');
            SiteSetting::set('footer_logo', $path, 'image');
        }

        return back()->with('success', 'Footer updated successfully.');
    }
}
