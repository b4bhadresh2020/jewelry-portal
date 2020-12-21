<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    protected $guarded  = [];

    // Toggle Options
    const ON    = "on";
    const OFF   = "off";

    // Fixed Batch List
    const BATCH_GENERAL         = "general";
    const BATCH_SOCIAL_LINKS    = "social-link";
    const BATCH_HOME_PAGE       = "home-page";

    /** Fixed Batch Wise Setting List **/
    // BATCH_GENERAL
    const GENERAL_EMAIL             = "email";
    const GENERAL_CONTACT_NO        = "contact-no";
    const GENERAL_LOCATION_LINK     = "location-link";
    const GENERAL_FOOTER_SLOGAN     = "footer-slogan";
    const GENERAL_FOOTER_ADDRESS    = "footer-address";

    // SOCIAL_LINKS
    const SOCIAL_LINK_FACEBOOK      = "facebook";
    const SOCIAL_LINK_INSTAGRAM     = "instagram";
    const SOCIAL_LINK_YOUTUBE       = "youtube";
    const SOCIAL_LINK_TWITTER       = "twitter";
    const SOCIAL_LINK_LINKED_IN     = "linked-in";
    const SOCIAL_LINK_GOOGLE        = "google";
    const SOCIAL_LINK_PINTEREST     = "pinterest";
    const SOCIAL_LINK_WHATSAPP      = "whatsapp";

    const SOCIAL_LINK_MAPPING = [
        self::SOCIAL_LINK_FACEBOOK      => "Facebook",
        self::SOCIAL_LINK_INSTAGRAM     => "Instagram",
        self::SOCIAL_LINK_YOUTUBE       => "Youtube",
        self::SOCIAL_LINK_TWITTER       => "Twitter",
        self::SOCIAL_LINK_LINKED_IN     => "Linked In",
        self::SOCIAL_LINK_GOOGLE        => "Google",
        self::SOCIAL_LINK_PINTEREST     => "Pinterest",
        self::SOCIAL_LINK_WHATSAPP      => "Whatsapp",
    ];

    public static function findActiveLinks()
    {
        return self::select('key', 'value')
            ->where('batch', self::BATCH_SOCIAL_LINKS)
            ->whereNotNull('value')->get();
    }

    public static function findAllLinks()
    {
        $oldLinks = self::select('key', 'value')
            ->where('batch', self::BATCH_SOCIAL_LINKS)->get();
        $oldLinksBatchList = [];
        foreach ($oldLinks as $linkObj) {
            $oldLinksBatchList[$linkObj->key] = $linkObj->value;
        }
        return $oldLinksBatchList;
    }

    // HOME_PAGE
    const HOME_PAGE_SERVICES            = "home-page-services";
    const HOME_PAGE_TRENDING_PRODUCTS   = "home-page-trending-products";
    const HOME_PAGE_OFFERS              = "home-page-offters";
    const HOME_PAGE_BACKGROUND_OFFER    = "home-page-background-offer";
    const HOME_OFFER_SLIDER_ONE         = "home-page-offer-slider-one";
    const HOME_OFFER_SLIDER_TWO         = "home-page-offer-slider-two";
    const HOME_PAGE_TESTIMONIAL         = "home-page-testimonials";
    const HOME_PAGE_BLOGS               = "home-page-blogs";

    const HOME_PAGE_MAPPING = [
        self::HOME_PAGE_SERVICES            => "Services",
        self::HOME_PAGE_TRENDING_PRODUCTS   => "Trending Products",
        self::HOME_PAGE_OFFERS              => "Offers",
        self::HOME_PAGE_BACKGROUND_OFFER    => "Background Offer",
        self::HOME_OFFER_SLIDER_ONE         => "Offer Slider One",
        self::HOME_OFFER_SLIDER_TWO         => "Offer Slider Two",
        self::HOME_PAGE_TESTIMONIAL         => "Testimonials",
        self::HOME_PAGE_BLOGS               => "Blogs",
    ];

    public static function findActiveHomeBlockList()
    {
        return self::where('batch', self::BATCH_HOME_PAGE)
            ->where('value', self::ON)->pluck('key')->toArray();
    }

    public static function toggleHomeBlock($toggle = self::ON)
    {
        return self::where('batch', self::BATCH_HOME_PAGE)
            ->update(['value' => $toggle]);
    }
}
