<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= esc(setting_value($settings, 'company_name', 'Balkondes Bumiharjo')) ?> | Desa Wisata, Penginapan, dan Venue Acara</title>
    <meta name="description" content="<?= esc(setting_value($settings, 'hero_subheadline', 'Website resmi Balkondes Bumiharjo untuk penginapan, venue acara, dan pengalaman wisata hangat di kawasan Borobudur.')) ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cormorant+Garamond:wght@500;600;700&display=swap" rel="stylesheet">
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --surface: #f6f0e6;
                --surface-soft: #fbf7f1;
                --surface-deep: #ece1d1;
                --ink: #342a22;
                --muted: #756657;
                --gold: #b8854d;
                --gold-soft: #d5b283;
                --shadow: 0 30px 60px rgba(59, 41, 18, 0.08);
            }

            html { scroll-behavior: smooth; }
            body {
                @apply bg-[var(--surface)] text-[var(--ink)] antialiased;
                font-family: "Plus Jakarta Sans", sans-serif;
            }
            h1, h2, h3, h4 { font-family: "Cormorant Garamond", serif; }
        }

        @layer components {
            .shell { @apply mx-auto w-full max-w-[1220px] px-5 sm:px-7 lg:px-10; }
            .glass {
                background: rgba(251, 247, 241, 0.68);
                backdrop-filter: blur(18px);
            }
            .section-label { @apply text-[11px] font-semibold uppercase tracking-[0.34em] text-[var(--gold)]; }
            .fade-up {
                opacity: 0;
                transform: translateY(28px);
                transition: opacity 800ms cubic-bezier(0.22, 1, 0.36, 1), transform 800ms cubic-bezier(0.22, 1, 0.36, 1);
            }
            .fade-up.is-visible {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-layer, .parallax-card { will-change: transform; }
        .hero-orb {
            position: absolute;
            border-radius: 999px;
            filter: blur(10px);
            opacity: .7;
            will-change: transform;
        }
        .hero-grid {
            background-image:
                linear-gradient(rgba(255,255,255,.18) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.18) 1px, transparent 1px);
            background-size: 32px 32px;
            mask-image: linear-gradient(180deg, rgba(0,0,0,.7), transparent 85%);
            will-change: transform;
        }
        .hero-backdrop {
            will-change: transform, filter;
            transform-origin: center center;
        }
        .hero-tilt {
            transform-style: preserve-3d;
            will-change: transform;
            transition: transform 240ms ease-out;
        }
        .hidden-entry {
            display: inline-flex;
            width: 12px;
            height: 12px;
            border-radius: 999px;
            opacity: .18;
            background: rgba(213, 178, 131, .9);
            box-shadow: 0 0 0 8px rgba(213, 178, 131, .06);
            transition: opacity 180ms ease, transform 180ms ease;
        }
        .hidden-entry:hover {
            opacity: .55;
            transform: scale(1.08);
        }
        .no-scroll { overflow: hidden; }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            .fade-up, .fade-up.is-visible {
                opacity: 1;
                transform: none;
                transition: none;
            }
            .hero-layer, .parallax-card, .hero-orb, .hero-grid, .hero-backdrop, .hero-tilt { transform: none !important; transition: none; }
        }
    </style>
</head>
<body>
<?php
    $companyName = setting_value($settings, 'company_name', 'Balkondes Bumiharjo');
    $heroKicker = setting_value($settings, 'hero_kicker', 'Balkondes Bumiharjo');
    $heroHeadline = setting_value($settings, 'hero_headline', 'Balkondes Bumiharjo');
    $heroSubheadline = setting_value($settings, 'hero_subheadline', 'Tempat singgah hangat di kawasan Borobudur untuk penginapan, gathering, meeting, wedding, dan momen yang ingin dikenang lebih lama.');
    $heroPrimaryLabel = setting_value($settings, 'hero_primary_label', 'Lihat Opsi Booking');
    $heroPrimaryUrl = setting_value($settings, 'hero_primary_url', base_url('booking'));
    $heroSecondaryLabel = setting_value($settings, 'hero_secondary_label', 'Chat WhatsApp');
    $heroSecondaryUrl = setting_value($settings, 'hero_secondary_url', whatsapp_link($settings));
    $aboutLabel = setting_value($settings, 'about_label', 'Nuansa Desa Wisata');
    $aboutTitle = setting_value($settings, 'about_title', 'Lebih Dari Sekadar Tempat Singgah');
    $aboutContent = setting_value($settings, 'about_content', 'Balkondes Bumiharjo menghadirkan suasana desa yang tenang, nyaman, dan akrab. Di sini, tamu dapat beristirahat, menyusun acara, menikmati kuliner, hingga merasakan ritme Borobudur dengan cara yang lebih dekat dan lebih hangat.');
    $servicesLabel = setting_value($settings, 'services_label', 'Pengalaman Tak Terlupakan');
    $servicesTitle = setting_value($settings, 'services_title', 'Pengalaman Tak Terlupakan');
    $servicesIntro = setting_value($settings, 'services_intro', 'Rangkaian pengalaman yang disusun untuk tamu yang datang mencari ketenangan, kebersamaan, maupun momentum acara yang berkesan.');
    $galleryLabel = setting_value($settings, 'gallery_label', 'Galeri');
    $galleryTitle = setting_value($settings, 'gallery_title', 'Keindahan yang terasa dekat dan tenang.');
    $galleryIntro = setting_value($settings, 'gallery_intro', 'Sudut-sudut visual Balkondes Bumiharjo yang hangat, tenang, dan cocok untuk penginapan maupun acara.');
    $videoTitle = setting_value($settings, 'video_title', 'Ruang yang hangat, tenang, dan mudah diingat.');
    $videoCaption = setting_value($settings, 'video_caption', 'Section video sudah disiapkan mengikuti referensi. Saat file video final tersedia, bagian ini bisa langsung dihubungkan ke media upload dari admin.');
    $videoEnabled = (int) ($settings['video_enabled'] ?? 1) === 1;
    $address = setting_value($settings, 'address', 'Bumiharjo, Borobudur, Magelang, Jawa Tengah, Indonesia');
    $locationLabel = setting_value($settings, 'location_label', 'Lokasi Kami');
    $locationTitle = setting_value($settings, 'location_title', 'Mudah dijangkau, dekat dengan suasana Borobudur.');
    $locationIntro = setting_value($settings, 'location_intro', 'Akses mudah menuju kawasan Balkondes Bumiharjo untuk kunjungan santai maupun acara bersama.');
    $openingHours = setting_value($settings, 'opening_hours', 'Setiap hari, 08.00 - 20.00 WIB');
    $mapsEmbed = setting_value($settings, 'maps_embed_url', 'https://www.google.com/maps?q=Balkondes%20Bumiharjo&output=embed');
    $whatsAppNumber = setting_value($settings, 'whatsapp_number', '082242186437');
    $footerTitle = setting_value($settings, 'footer_title', $companyName);
    $footerDescription = setting_value($settings, 'footer_description', 'Website resmi Balkondes Bumiharjo untuk penginapan, kegiatan bersama, dan kanal booking yang lebih rapi.');

    $heroBackground = ! empty($primaryHero['image_path'])
        ? media_url($primaryHero['image_path'])
        : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1600&q=80';

    $fallbackImages = [
        'https://images.unsplash.com/photo-1519046904884-53103b34b206?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1540541338287-41700207dee6?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1512632578888-169bbbc64f33?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1200&q=80',
    ];

    $visualPool = [];
    foreach ($heroSlides as $slide) {
        if (! empty($slide['image_path'])) {
            $visualPool[] = media_url($slide['image_path']);
        }
    }
    foreach ($galleryItems as $item) {
        if (! empty($item['image_path'])) {
            $visualPool[] = media_url($item['image_path']);
        }
    }

    $pickVisual = static function (int $index) use ($visualPool, $fallbackImages): string {
        return $visualPool[$index] ?? $fallbackImages[$index % count($fallbackImages)];
    };

    $serviceCards = [];
    foreach ($services as $index => $service) {
        $title = trim((string) ($service['title'] ?? ''));
        $description = trim((string) ($service['description'] ?? ''));
        if ($title === '') {
            continue;
        }
        $serviceCards[] = [
            'title' => $title,
            'description' => $description !== '' ? $description : 'Nikmati pengalaman yang disusun hangat untuk tamu Balkondes Bumiharjo.',
            'image' => ! empty($service['image_path']) ? media_url($service['image_path']) : $pickVisual($index + 1),
            'points' => array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) ($service['highlight_points'] ?? '')) ?: []))),
        ];
        if ($serviceCards[array_key_last($serviceCards)]['points'] === []) {
            $serviceCards[array_key_last($serviceCards)]['points'] = [
                'Suasana hangat khas desa wisata',
                'Cocok untuk keluarga, komunitas, atau acara kecil',
                'Akses mudah menuju kawasan Borobudur',
            ];
        }
    }

    if ($serviceCards === []) {
        $serviceCards = [
            ['title' => 'Penginapan dan Homestay', 'description' => 'Kamar dan area inap yang tenang untuk tamu yang ingin beristirahat dekat Borobudur dengan suasana desa yang terasa akrab.', 'image' => $pickVisual(0), 'points' => ['Nuansa hangat dan tenang', 'Cocok untuk staycation keluarga', 'Nyaman untuk tamu rombongan kecil']],
            ['title' => 'Kuliner dan Jamuan', 'description' => 'Sajian yang cocok untuk makan bersama, acara keluarga, hingga penyambutan tamu dalam suasana yang lebih personal.', 'image' => $pickVisual(1), 'points' => ['Nuansa makan bersama lebih intim', 'Pas untuk jamuan komunitas', 'Bisa dikombinasikan dengan acara di lokasi']],
            ['title' => 'Venue Acara', 'description' => 'Ruang dan suasana yang mendukung meeting, gathering, wedding, atau kegiatan budaya dengan latar desa wisata.', 'image' => $pickVisual(2), 'points' => ['Fleksibel untuk berbagai kebutuhan acara', 'Visual lokasi kuat untuk dokumentasi', 'Suasana tenang dan representatif']],
            ['title' => 'Eksplorasi Borobudur', 'description' => 'Mulai perjalanan ke kawasan Borobudur dari titik yang lebih hangat, dekat, dan penuh cerita lokal.', 'image' => $pickVisual(3), 'points' => ['Dekat dengan destinasi utama', 'Cocok untuk itinerary wisata', 'Memberi pengalaman desa yang lebih otentik']],
        ];
    }

    $galleryVisuals = [];
    foreach ($galleryItems as $index => $item) {
        if (! empty($item['image_path'])) {
            $galleryVisuals[] = [
                'src' => media_url($item['image_path']),
                'title' => $item['title'] ?: 'Galeri Balkondes Bumiharjo',
                'caption' => $item['caption'] ?: 'Sudut suasana Balkondes Bumiharjo.',
            ];
        }
    }
    while (count($galleryVisuals) < 6) {
        $galleryVisuals[] = [
            'src' => $pickVisual(count($galleryVisuals) + 2),
            'title' => 'Galeri Balkondes Bumiharjo',
            'caption' => 'Sudut suasana Balkondes Bumiharjo.',
        ];
    }

    $instagramUrl = '#';
    $mapsUrl = '#';
    foreach ($contactLinks as $contactLink) {
        if (($contactLink['label'] ?? '') === 'Instagram') {
            $instagramUrl = $contactLink['url'];
        }
        if (($contactLink['label'] ?? '') === 'Google Maps') {
            $mapsUrl = $contactLink['url'];
        }
    }

    $heroBookingUrl = base_url('booking');
?>

<nav class="fixed inset-x-0 top-0 z-50">
    <div class="shell pt-4">
        <div class="glass flex items-center justify-between rounded-full px-4 py-3 shadow-[0_18px_45px_rgba(68,45,14,0.08)] sm:px-6">
            <a class="max-w-[180px] text-sm font-semibold tracking-[0.12em] text-[var(--muted)] sm:max-w-none sm:text-[13px]" href="#home"><?= esc($companyName) ?></a>
            <div class="hidden items-center gap-7 text-sm text-[var(--muted)] md:flex">
                <a href="#tentang" class="transition hover:text-[var(--ink)]">Tentang</a>
                <a href="#pengalaman" class="transition hover:text-[var(--ink)]">Pengalaman</a>
                <a href="#galeri" class="transition hover:text-[var(--ink)]">Galeri</a>
                <a href="#lokasi" class="transition hover:text-[var(--ink)]">Lokasi</a>
            </div>
            <div class="flex items-center gap-2">
                <a class="hidden rounded-full px-4 py-2 text-sm font-semibold text-[var(--muted)] transition hover:bg-white/60 sm:inline-flex" href="<?= esc($whatsappLink) ?>" target="_blank" rel="noopener">WhatsApp</a>
                <a class="inline-flex rounded-full bg-[var(--gold)] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#9d723e]" href="<?= esc($heroBookingUrl) ?>">Booking</a>
            </div>
        </div>
    </div>
</nav>

<main id="home">
    <section class="relative overflow-hidden px-0 pb-16 pt-28 sm:pt-32">
        <div class="absolute inset-x-0 top-0 h-[88%] bg-gradient-to-b from-[#eadbc8] via-[#f3eadf] to-transparent"></div>
        <div class="hero-orb left-[-6%] top-[10%] h-40 w-40 bg-[rgba(184,133,77,.22)]" data-speed="0.22"></div>
        <div class="hero-orb right-[6%] top-[18%] h-28 w-28 bg-[rgba(92,106,85,.18)]" data-speed="-0.18"></div>
        <div class="hero-orb right-[12%] bottom-[14%] h-44 w-44 bg-[rgba(255,255,255,.26)]" data-speed="0.16"></div>
        <div class="hero-grid absolute inset-x-0 top-[6%] h-[68%] opacity-30" data-speed="0.08"></div>
        <div class="shell relative">
            <div class="grid items-end gap-10 lg:grid-cols-[1.08fr_0.92fr] lg:gap-12">
                <div class="relative z-10 fade-up">
                    <p class="section-label mb-5"><?= esc($heroKicker) ?></p>
                    <h1 class="max-w-[14ch] text-[52px] leading-[0.92] text-[var(--ink)] sm:text-[72px] lg:text-[92px]"><?= esc($heroHeadline) ?></h1>
                    <p class="mt-6 max-w-xl text-[15px] leading-7 text-[var(--muted)] sm:text-[17px]"><?= esc($heroSubheadline) ?></p>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <a class="inline-flex rounded-full bg-[var(--gold)] px-6 py-3 text-sm font-semibold text-white shadow-[0_18px_35px_rgba(184,133,77,0.28)] transition hover:-translate-y-0.5 hover:bg-[#9d723e]" href="<?= esc($heroPrimaryUrl) ?>"<?= str_starts_with($heroPrimaryUrl, 'http') ? ' target="_blank" rel="noopener"' : '' ?>><?= esc($heroPrimaryLabel) ?></a>
                        <a class="inline-flex rounded-full bg-white/80 px-6 py-3 text-sm font-semibold text-[var(--ink)] shadow-[0_18px_35px_rgba(60,40,18,0.08)] transition hover:-translate-y-0.5" href="<?= esc($heroSecondaryUrl) ?>"<?= str_starts_with($heroSecondaryUrl, 'http') ? ' target="_blank" rel="noopener"' : '' ?>><?= esc($heroSecondaryLabel) ?></a>
                    </div>
                    <div class="mt-10 flex flex-wrap gap-6 text-sm text-[var(--muted)]">
                        <span>Penginapan</span>
                        <span>Venue Acara</span>
                        <span>Gathering</span>
                        <span>Borobudur</span>
                    </div>
                </div>

                <div class="relative h-[480px] sm:h-[620px] lg:h-[720px]" data-hero-mouse>
                    <div class="hero-layer hero-tilt absolute inset-x-[16%] top-0 h-[58%] overflow-hidden rounded-[2.5rem] shadow-[var(--shadow)] sm:inset-x-[20%] lg:left-[18%] lg:right-[12%]" data-speed="0.12" data-depth="16">
                        <img class="hero-backdrop h-full w-full object-cover scale-[1.08]" src="<?= esc($heroBackground) ?>" alt="Hero Balkondes Bumiharjo">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#2f261f]/26 via-transparent to-white/10"></div>
                    </div>
                    <div class="parallax-card hero-tilt absolute left-0 top-[32%] w-[44%] overflow-hidden rounded-[1.75rem] shadow-[var(--shadow)]" data-speed="0.08" data-depth="10">
                        <img class="h-[220px] w-full object-cover sm:h-[280px]" src="<?= esc($pickVisual(4)) ?>" alt="Suasana penginapan">
                    </div>
                    <div class="glass parallax-card hero-tilt absolute left-[18%] top-[42%] max-w-[340px] rounded-[2rem] p-5 shadow-[var(--shadow)] sm:p-7" data-speed="0.05" data-depth="7">
                        <p class="section-label"><?= esc($aboutLabel) ?></p>
                        <h2 class="mt-2 text-[30px] leading-[1] text-[var(--ink)] sm:text-[42px]"><?= esc($aboutTitle) ?></h2>
                        <p class="mt-3 text-sm leading-6 text-[var(--muted)] sm:text-[15px]"><?= esc(mb_strimwidth($aboutContent, 0, 220, '...')) ?></p>
                    </div>
                    <div class="parallax-card hero-tilt absolute bottom-[3%] right-0 w-[38%] overflow-hidden rounded-[1.5rem] shadow-[var(--shadow)]" data-speed="0.09" data-depth="12">
                        <img class="h-[150px] w-full object-cover sm:h-[190px]" src="<?= esc($pickVisual(5)) ?>" alt="Sudut budaya">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="shell py-10 sm:py-16">
        <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr] lg:gap-12">
            <div class="fade-up">
                <p class="section-label"><?= esc($aboutLabel) ?></p>
                <h2 class="mt-3 text-[40px] leading-[0.95] sm:text-[56px]"><?= esc($aboutTitle) ?></h2>
            </div>
            <div class="fade-up rounded-[2rem] bg-[var(--surface-soft)] p-7 shadow-[var(--shadow)] sm:p-10">
                <p class="text-[15px] leading-8 text-[var(--muted)] sm:text-[17px]"><?= nl2br(esc($aboutContent)) ?></p>
            </div>
        </div>
    </section>

    <?php if ($videoEnabled): ?>
        <section class="shell py-10 sm:py-16">
            <div class="fade-up relative overflow-hidden rounded-[2.5rem] bg-[#3f382f] shadow-[var(--shadow)]">
                <img class="h-[320px] w-full object-cover opacity-80 sm:h-[420px]" src="<?= esc($pickVisual(6)) ?>" alt="Video highlight Balkondes Bumiharjo">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-black/10"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <button type="button" class="video-trigger flex h-16 w-16 items-center justify-center rounded-full bg-white text-[var(--gold)] shadow-[0_20px_40px_rgba(0,0,0,0.18)] transition hover:scale-105 sm:h-20 sm:w-20" aria-label="Putar highlight video">
                        <span class="ml-1 text-2xl sm:text-3xl">&gt;</span>
                    </button>
                </div>
                <div class="absolute inset-x-0 bottom-0 p-6 text-white sm:p-10">
                    <p class="text-[11px] font-semibold uppercase tracking-[0.34em] text-white/70">Video Highlight</p>
                    <h2 class="mt-2 text-[34px] leading-none sm:text-[56px]"><?= esc($videoTitle) ?></h2>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section id="pengalaman" class="bg-[var(--surface-soft)] py-16 sm:py-24">
        <div class="shell">
            <div class="fade-up max-w-2xl">
                <p class="section-label"><?= esc($servicesLabel) ?></p>
                <h2 class="mt-3 text-[40px] leading-[0.95] sm:text-[58px]"><?= esc($servicesTitle) ?></h2>
                <p class="mt-4 text-[15px] leading-7 text-[var(--muted)] sm:text-[17px]"><?= esc($servicesIntro) ?></p>
            </div>

            <div class="mt-10 grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
                <?php foreach (array_slice($serviceCards, 0, 4) as $index => $service): ?>
                    <article class="fade-up group relative overflow-hidden rounded-[2rem] bg-[#2d241d] shadow-[var(--shadow)] <?= $index % 2 === 1 ? 'sm:translate-y-8' : '' ?>">
                        <img class="h-[320px] w-full object-cover opacity-80 transition duration-700 group-hover:scale-105 group-hover:opacity-100" src="<?= esc($service['image']) ?>" alt="<?= esc($service['title']) ?>">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/35 to-transparent"></div>
                        <div class="absolute inset-x-0 bottom-0 p-6 text-white">
                            <h3 class="text-[30px] leading-none"><?= esc($service['title']) ?></h3>
                            <p class="mt-3 text-sm leading-6 text-white/70"><?= esc(mb_strimwidth($service['description'], 0, 120, '...')) ?></p>
                            <button
                                type="button"
                                class="service-trigger mt-5 inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.28em] text-[var(--gold-soft)]"
                                data-title="<?= esc($service['title'], 'attr') ?>"
                                data-description="<?= esc($service['description'], 'attr') ?>"
                                data-image="<?= esc($service['image'], 'attr') ?>"
                                data-points="<?= esc(json_encode($service['points'], JSON_UNESCAPED_UNICODE), 'attr') ?>"
                            >
                                Lihat Detail
                                <span>+</span>
                            </button>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="galeri" class="shell py-16 sm:py-24">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div class="fade-up max-w-2xl">
                <p class="section-label"><?= esc($galleryLabel) ?></p>
                <h2 class="mt-3 text-[40px] leading-[0.95] sm:text-[58px]"><?= esc($galleryTitle) ?></h2>
                <p class="mt-4 text-[15px] leading-7 text-[var(--muted)] sm:text-[17px]"><?= esc($galleryIntro) ?></p>
            </div>
            <a class="fade-up inline-flex w-fit rounded-full border border-[var(--gold-soft)] px-5 py-3 text-sm font-semibold text-[var(--gold)] transition hover:bg-[var(--gold)] hover:text-white" href="<?= esc($heroBookingUrl) ?>">Booking dan Kontak</a>
        </div>

        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <?php foreach (array_slice($galleryVisuals, 0, 6) as $index => $visual): ?>
                <?php $spanClass = in_array($index, [0, 4], true) ? 'lg:col-span-2' : ''; ?>
                <button
                    type="button"
                    class="gallery-trigger fade-up group relative overflow-hidden rounded-[1.8rem] shadow-[var(--shadow)] <?= esc($spanClass) ?>"
                    data-src="<?= esc($visual['src'], 'attr') ?>"
                    data-title="<?= esc($visual['title'], 'attr') ?>"
                    data-caption="<?= esc($visual['caption'], 'attr') ?>"
                >
                    <img class="h-[210px] w-full object-cover transition duration-700 group-hover:scale-105 sm:h-[260px] <?= $spanClass !== '' ? 'lg:h-[300px]' : '' ?>" src="<?= esc($visual['src']) ?>" alt="<?= esc($visual['title']) ?>">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-80"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-5 text-left text-white">
                        <p class="text-lg leading-none sm:text-xl"><?= esc($visual['title']) ?></p>
                    </div>
                </button>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="bg-[var(--surface-soft)] py-16 sm:py-24">
        <div class="shell">
            <div class="grid gap-6 lg:grid-cols-[1.05fr_0.95fr]">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="fade-up overflow-hidden rounded-[2rem] shadow-[var(--shadow)] sm:col-span-2">
                        <img class="h-[280px] w-full object-cover sm:h-[360px]" src="<?= esc($pickVisual(7)) ?>" alt="Balkondes Bumiharjo exterior">
                    </div>
                    <div class="fade-up overflow-hidden rounded-[2rem] shadow-[var(--shadow)]">
                        <img class="h-[220px] w-full object-cover sm:h-[280px]" src="<?= esc($pickVisual(3)) ?>" alt="Aktivitas warga">
                    </div>
                    <div class="fade-up overflow-hidden rounded-[2rem] shadow-[var(--shadow)]">
                        <img class="h-[220px] w-full object-cover sm:h-[280px]" src="<?= esc($pickVisual(5)) ?>" alt="Detail interior">
                    </div>
                </div>

                <div id="lokasi" class="fade-up self-end">
                    <p class="section-label"><?= esc($locationLabel) ?></p>
                    <h2 class="mt-3 text-[40px] leading-[0.95] sm:text-[58px]"><?= esc($locationTitle) ?></h2>
                    <p class="mt-4 text-[15px] leading-7 text-[var(--muted)] sm:text-[17px]"><?= esc($locationIntro) ?></p>
                    <div class="mt-8 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-[1.8rem] bg-white p-5 shadow-[var(--shadow)]">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--gold)]">Alamat</p>
                            <p class="mt-3 text-sm leading-7 text-[var(--muted)]"><?= esc($address) ?></p>
                        </div>
                        <div class="rounded-[1.8rem] bg-white p-5 shadow-[var(--shadow)]">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--gold)]">Operasional</p>
                            <p class="mt-3 text-sm leading-7 text-[var(--muted)]"><?= esc($openingHours) ?></p>
                        </div>
                    </div>
                    <div class="mt-4 rounded-[2rem] bg-white p-5 shadow-[var(--shadow)]">
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--gold)]">Kontak</p>
                        <p class="mt-3 text-sm leading-7 text-[var(--muted)]">WhatsApp <?= esc($whatsAppNumber) ?></p>
                        <div class="mt-4 flex flex-wrap gap-3">
                            <a class="inline-flex rounded-full bg-[var(--gold)] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#9d723e]" href="<?= esc($whatsappLink) ?>" target="_blank" rel="noopener">Hubungi Sekarang</a>
                            <a class="inline-flex rounded-full bg-[var(--surface)] px-5 py-3 text-sm font-semibold text-[var(--ink)] transition hover:bg-[var(--surface-deep)]" href="<?= esc($heroBookingUrl) ?>">Lihat Semua Link</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fade-up mt-8 overflow-hidden rounded-[2rem] shadow-[var(--shadow)]">
                <iframe title="Peta Balkondes Bumiharjo" src="<?= esc($mapsEmbed, 'attr') ?>" class="h-[320px] w-full border-0 sm:h-[420px]" loading="lazy" allowfullscreen></iframe>
            </div>
        </div>
    </section>
</main>

<footer class="bg-[#3a3028] pb-10 pt-16 text-white">
    <div class="shell">
        <div class="grid gap-10 md:grid-cols-4">
            <div>
                <p class="text-[28px] leading-none text-[var(--gold-soft)]"><?= esc($footerTitle) ?></p>
                <p class="mt-4 text-sm leading-7 text-white/65"><?= esc($footerDescription) ?></p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--gold-soft)]">Menu</p>
                <div class="mt-4 space-y-3 text-sm text-white/70">
                    <a class="block transition hover:text-white" href="#tentang">Tentang</a>
                    <a class="block transition hover:text-white" href="#pengalaman">Pengalaman</a>
                    <a class="block transition hover:text-white" href="#galeri">Galeri</a>
                    <a class="block transition hover:text-white" href="#lokasi">Lokasi</a>
                </div>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--gold-soft)]">Reservasi</p>
                <div class="mt-4 space-y-3 text-sm text-white/70">
                    <a class="block transition hover:text-white" href="<?= esc($whatsappLink) ?>" target="_blank" rel="noopener">WhatsApp</a>
                    <a class="block transition hover:text-white" href="<?= esc($heroBookingUrl) ?>">Booking Hub</a>
                    <a class="block transition hover:text-white" href="<?= esc($instagramUrl) ?>" target="_blank" rel="noopener">Instagram</a>
                    <a class="block transition hover:text-white" href="<?= esc($mapsUrl) ?>" target="_blank" rel="noopener">Google Maps</a>
                </div>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.24em] text-[var(--gold-soft)]">Alamat</p>
                <p class="mt-4 text-sm leading-7 text-white/70"><?= esc($address) ?></p>
            </div>
        </div>
        <div class="mt-10 border-t border-white/10 pt-6 text-center text-sm text-white/40">
            &copy; <?= esc(date('Y')) ?> <?= esc($companyName) ?>. Seluruh hak cipta dilindungi.
            <span style="display:inline-flex;align-items:center;gap:10px;margin-left:10px;">
                <span style="opacity:.22;">|</span>
                <a href="<?= esc(site_url('gerbang-senja-bumiharjo')) ?>" class="hidden-entry" aria-label="Akses admin tersembunyi" title="Akses admin tersembunyi"></a>
            </span>
        </div>
    </div>
</footer>

<div id="service-modal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/55 px-4 py-8">
    <div class="relative max-h-[92vh] w-full max-w-4xl overflow-auto rounded-[2rem] bg-[var(--surface-soft)] shadow-[0_35px_80px_rgba(0,0,0,0.28)]">
        <button type="button" class="service-close absolute right-4 top-4 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-white/85 text-xl text-[var(--ink)]">x</button>
        <div class="grid lg:grid-cols-[0.95fr_1.05fr]">
            <div class="overflow-hidden">
                <img id="service-modal-image" class="h-[260px] w-full object-cover lg:h-full" src="" alt="Detail layanan">
            </div>
            <div class="p-6 sm:p-8 lg:p-10">
                <p class="section-label">Detail Layanan</p>
                <h3 id="service-modal-title" class="mt-3 text-[42px] leading-none text-[var(--ink)]"></h3>
                <p id="service-modal-description" class="mt-5 text-[15px] leading-8 text-[var(--muted)]"></p>
                <div id="service-modal-points" class="mt-6 space-y-3"></div>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a class="inline-flex rounded-full bg-[var(--gold)] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#9d723e]" href="<?= esc($whatsappLink) ?>" target="_blank" rel="noopener">Tanya via WhatsApp</a>
                    <a class="inline-flex rounded-full bg-white px-5 py-3 text-sm font-semibold text-[var(--ink)] shadow-[var(--shadow)]" href="<?= esc($heroBookingUrl) ?>">Lihat Booking Hub</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="gallery-lightbox" class="fixed inset-0 z-[80] hidden items-center justify-center bg-black/80 px-4 py-8">
    <button type="button" class="gallery-close absolute right-5 top-5 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-white/15 text-2xl text-white">x</button>
    <div class="w-full max-w-5xl">
        <img id="gallery-lightbox-image" class="max-h-[76vh] w-full rounded-[1.8rem] object-cover shadow-[0_30px_70px_rgba(0,0,0,0.35)]" src="" alt="Galeri Balkondes Bumiharjo">
        <div class="mx-auto mt-5 max-w-2xl text-center text-white">
            <p id="gallery-lightbox-title" class="text-2xl"></p>
            <p id="gallery-lightbox-caption" class="mt-2 text-sm leading-7 text-white/75"></p>
        </div>
    </div>
</div>

<div id="video-modal" class="fixed inset-0 z-[75] hidden items-center justify-center bg-black/75 px-4 py-8">
    <button type="button" class="video-close absolute right-5 top-5 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-white/15 text-2xl text-white">x</button>
    <div class="w-full max-w-4xl overflow-hidden rounded-[2rem] bg-black shadow-[0_30px_80px_rgba(0,0,0,0.4)]">
        <div class="relative aspect-video">
            <img class="h-full w-full object-cover opacity-45" src="<?= esc($pickVisual(6)) ?>" alt="Video highlight">
            <div class="absolute inset-0 flex items-center justify-center p-8 text-center text-white">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-[0.34em] text-white/70">Video Highlight</p>
                    <h3 class="mt-3 text-[34px] leading-none sm:text-[48px]"><?= esc($videoTitle) ?></h3>
                    <p class="mx-auto mt-4 max-w-xl text-sm leading-7 text-white/75 sm:text-base"><?= esc($videoCaption) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const isDesktop = window.matchMedia('(min-width: 1024px)').matches;

    if (!prefersReducedMotion) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.18 });
        document.querySelectorAll('.fade-up').forEach((element) => observer.observe(element));
    } else {
        document.querySelectorAll('.fade-up').forEach((element) => element.classList.add('is-visible'));
    }

    if (!prefersReducedMotion && isDesktop) {
        const parallaxItems = document.querySelectorAll('[data-speed]');
        const heroBackdrop = document.querySelector('.hero-backdrop');
        const onScroll = () => {
            const offset = window.scrollY;
            parallaxItems.forEach((item) => {
                const speed = Number(item.dataset.speed || 0);
                item.style.transform = `translateY(${offset * speed * -0.22}px)`;
            });
            if (heroBackdrop) {
                const scale = 1.08 + Math.min(offset / 5000, 0.04);
                const blur = Math.min(offset / 180, 8);
                heroBackdrop.style.transform = `scale(${scale}) translateY(${offset * -0.018}px)`;
                heroBackdrop.style.filter = `saturate(1.05) blur(${blur * 0.08}px)`;
            }
        };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }

    if (!prefersReducedMotion && isDesktop) {
        const mouseHero = document.querySelector('[data-hero-mouse]');
        if (mouseHero) {
            const depthItems = mouseHero.querySelectorAll('[data-depth]');
            const moveItems = (x, y) => {
                depthItems.forEach((item) => {
                    const depth = Number(item.dataset.depth || 0);
                    item.style.transform += ` translate3d(${x * depth}px, ${y * depth}px, 0)`;
                });
            };

            mouseHero.addEventListener('mousemove', (event) => {
                const rect = mouseHero.getBoundingClientRect();
                const x = ((event.clientX - rect.left) / rect.width - 0.5) * 0.85;
                const y = ((event.clientY - rect.top) / rect.height - 0.5) * 0.85;

                depthItems.forEach((item) => {
                    const base = item.style.transform.replace(/ translate3d\([^)]+\)/g, '');
                    item.style.transform = base;
                });

                moveItems(x, y);
            });

            mouseHero.addEventListener('mouseleave', () => {
                depthItems.forEach((item) => {
                    item.style.transform = item.style.transform.replace(/ translate3d\([^)]+\)/g, '');
                });
            });
        }
    }

    const toggleModal = (modal, open) => {
        if (!modal) return;
        modal.classList.toggle('hidden', !open);
        modal.classList.toggle('flex', open);
        document.body.classList.toggle('no-scroll', open);
    };

    const serviceModal = document.getElementById('service-modal');
    const serviceTitle = document.getElementById('service-modal-title');
    const serviceDescription = document.getElementById('service-modal-description');
    const serviceImage = document.getElementById('service-modal-image');
    const servicePoints = document.getElementById('service-modal-points');
    document.querySelectorAll('.service-trigger').forEach((button) => {
        button.addEventListener('click', () => {
            serviceTitle.textContent = button.dataset.title || '';
            serviceDescription.textContent = button.dataset.description || '';
            serviceImage.src = button.dataset.image || '';
            serviceImage.alt = button.dataset.title || 'Detail layanan';
            let points = [];
            try { points = JSON.parse(button.dataset.points || '[]'); } catch (error) { points = []; }
            servicePoints.innerHTML = points.map((point) => `
                <div class="flex items-start gap-3 rounded-[1.2rem] bg-white px-4 py-3 text-sm leading-6 text-[var(--muted)] shadow-[var(--shadow)]">
                    <span class="mt-1 text-[var(--gold)]">*</span>
                    <span>${point}</span>
                </div>
            `).join('');
            toggleModal(serviceModal, true);
        });
    });
    document.querySelectorAll('.service-close').forEach((button) => button.addEventListener('click', () => toggleModal(serviceModal, false)));

    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxImage = document.getElementById('gallery-lightbox-image');
    const lightboxTitle = document.getElementById('gallery-lightbox-title');
    const lightboxCaption = document.getElementById('gallery-lightbox-caption');
    document.querySelectorAll('.gallery-trigger').forEach((button) => {
        button.addEventListener('click', () => {
            lightboxImage.src = button.dataset.src || '';
            lightboxTitle.textContent = button.dataset.title || '';
            lightboxCaption.textContent = button.dataset.caption || '';
            toggleModal(lightbox, true);
        });
    });
    document.querySelectorAll('.gallery-close').forEach((button) => button.addEventListener('click', () => toggleModal(lightbox, false)));

    const videoModal = document.getElementById('video-modal');
    document.querySelectorAll('.video-trigger').forEach((button) => button.addEventListener('click', () => toggleModal(videoModal, true)));
    document.querySelectorAll('.video-close').forEach((button) => button.addEventListener('click', () => toggleModal(videoModal, false)));

    [serviceModal, lightbox, videoModal].forEach((modal) => {
        if (!modal) return;
        modal.addEventListener('click', (event) => {
            if (event.target === modal) toggleModal(modal, false);
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            toggleModal(serviceModal, false);
            toggleModal(lightbox, false);
            toggleModal(videoModal, false);
        }
    });
</script>
</body>
</html>
