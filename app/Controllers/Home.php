<?php

namespace App\Controllers;

use App\Models\BookingLinkModel;
use App\Models\GalleryItemModel;
use App\Models\HeroSlideModel;
use App\Models\ServiceModel;
use App\Models\SiteSettingModel;
use Throwable;

class Home extends BaseController
{
    public function index(): string
    {
        $settings = null;
        $heroSlides = [];
        $services = [];
        $galleryItems = [];
        $bookingLinks = [];

        try {
            $settings = (new SiteSettingModel())->first();
            $heroSlides = (new HeroSlideModel())->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();
            $services = (new ServiceModel())->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();
            $galleryItems = (new GalleryItemModel())->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();
            $bookingLinks = (new BookingLinkModel())->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();
        } catch (Throwable) {
            // Keep public page available even before database setup.
        }
        [$contactLinks, $otaLinks] = $this->splitBookingLinks($bookingLinks, $settings);

        return view('public/home', [
            'settings'     => $settings,
            'heroSlides'   => $heroSlides,
            'primaryHero'  => $heroSlides[0] ?? null,
            'services'     => $services,
            'galleryItems' => $galleryItems,
            'whatsappLink' => whatsapp_link($settings),
            'bookingLinks' => $otaLinks,
            'contactLinks' => $contactLinks,
        ]);
    }

    public function booking(): string
    {
        $settings = null;

        try {
            $settings = (new SiteSettingModel())->first();
            $bookingLinks = (new BookingLinkModel())->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();
        } catch (Throwable) {
            // Keep booking hub available even before database setup.
            $bookingLinks = [];
        }

        [$contactLinks, $otaLinks] = $this->splitBookingLinks($bookingLinks, $settings);

        return view('public/booking', [
            'settings'     => $settings,
            'whatsappLink' => whatsapp_link($settings),
            'bookingLinks' => $otaLinks,
            'contactLinks' => $contactLinks,
        ]);
    }

    /**
     * @param list<array<string, mixed>> $rows
     * @return array{0: list<array<string, string>>, 1: list<array<string, string>>}
     */
    private function splitBookingLinks(array $rows, ?array $settings): array
    {
        $contacts = [];
        $ota = [];

        foreach ($rows as $row) {
            $payload = [
                'label' => (string) ($row['label'] ?? ''),
                'url' => (string) ($row['url'] ?? ''),
                'description' => (string) ($row['description'] ?? ''),
            ];

            if (($row['group_key'] ?? 'contact') === 'ota') {
                $ota[] = $payload;
            } else {
                $contacts[] = $payload;
            }
        }

        if ($contacts === []) {
            $contacts = $this->fallbackContacts($settings);
        }

        if ($ota === []) {
            $ota = $this->fallbackOtaLinks();
        }

        return [$contacts, $ota];
    }

    /**
     * @return list<array<string, string>>
     */
    private function fallbackOtaLinks(): array
    {
        return [
            [
                'label'       => 'Traveloka',
                'url'         => 'https://trv.lk/db641855',
                'description' => 'Pilihan praktis untuk cek harga dan ketersediaan kamar.',
            ],
            [
                'label'       => 'Agoda',
                'url'         => 'https://www.agoda.com/id-id/balkondes-bumiharjo-kampung-dolanan/hotel/magelang-id.html?cid=1844104&ds=juYbDxwIAFbSir8F',
                'description' => 'Reservasi online dengan detail penginapan lengkap.',
            ],
            [
                'label'       => 'Booking.com',
                'url'         => 'https://www.booking.com/Share-GzG276',
                'description' => 'Alternatif booking internasional yang mudah diakses.',
            ],
            [
                'label'       => 'Tiket.com',
                'url'         => 'https://www.tiket.com/id-id/homes/indonesia/balkondes-bumiharjo-kampung-dolanan-412001639600251554',
                'description' => 'Reservasi staycation dan perjalanan dalam satu tempat.',
            ],
            [
                'label'       => 'Hotels.com',
                'url'         => 'https://hotelsapp.onelink.me/fSyN/fianz273',
                'description' => 'Pilihan kanal tambahan untuk pemesanan resmi.',
            ],
        ];
    }

    /**
     * @return list<array<string, string>>
     */
    private function fallbackContacts(?array $settings): array
    {
        return [
            [
                'label'       => 'WhatsApp Reservasi',
                'url'         => whatsapp_link($settings),
                'description' => 'Tanya harga, ketersediaan, dan kebutuhan acara langsung ke admin.',
            ],
            [
                'label'       => 'Instagram',
                'url'         => 'https://www.instagram.com/balkondes_bumiharjo?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==',
                'description' => 'Lihat suasana terbaru Balkondes Bumiharjo.',
            ],
            [
                'label'       => 'Facebook',
                'url'         => 'https://www.facebook.com/balkondesbumiharjo/',
                'description' => 'Ikuti update kegiatan dan dokumentasi acara.',
            ],
            [
                'label'       => 'Google Maps',
                'url'         => 'https://maps.app.goo.gl/JVdfWouy6Mn44Tvm6',
                'description' => 'Akses lokasi resmi Balkondes Bumiharjo.',
            ],
            [
                'label'       => 'Email',
                'url'         => 'mailto:balkonbumiharjo@gmail.com',
                'description' => 'Kirim pertanyaan atau kebutuhan kerja sama melalui email.',
            ],
        ];
    }
}
