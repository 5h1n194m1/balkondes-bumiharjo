<?php

namespace App\Controllers\Admin;

use App\Models\BookingLinkModel;
use App\Models\GalleryItemModel;
use App\Models\HeroSlideModel;
use App\Models\ServiceModel;
use App\Models\SiteSettingModel;

class DashboardController extends BaseAdminController
{
    public function index(): string
    {
        return $this->render('admin/dashboard/index', [
            'title' => 'Dashboard',
            'stats' => [
                'heroSlides'   => (new HeroSlideModel())->countAllResults(),
                'services'     => (new ServiceModel())->countAllResults(),
                'galleryItems' => (new GalleryItemModel())->countAllResults(),
                'bookingLinks' => (new BookingLinkModel())->countAllResults(),
                'siteSettings' => (new SiteSettingModel())->countAllResults(),
            ],
        ]);
    }
}
