<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="page-head">
        <div>
            <div class="eyebrow">Dashboard</div>
            <h2><?= esc($title) ?></h2>
            <p class="muted">Ringkasan cepat konten website dan pintasan untuk mengelola halaman publik.</p>
        </div>
        <div class="actions">
            <a href="<?= site_url('/') ?>" target="_blank" rel="noopener" class="btn btn-outline">Preview Landing Page</a>
            <a href="<?= site_url('admin/site-settings') ?>" class="btn btn-primary">Edit Landing Page</a>
        </div>
    </div>
    <div class="grid-4">
        <div class="stat">
            <small>Hero Slides</small>
            <strong><?= esc((string) $stats['heroSlides']) ?></strong>
        </div>
        <div class="stat">
            <small>Layanan</small>
            <strong><?= esc((string) $stats['services']) ?></strong>
        </div>
        <div class="stat">
            <small>Galeri & Video</small>
            <strong><?= esc((string) $stats['galleryItems']) ?></strong>
        </div>
        <div class="stat">
            <small>Booking Links</small>
            <strong><?= esc((string) $stats['bookingLinks']) ?></strong>
        </div>
        <div class="stat">
            <small>Site Settings</small>
            <strong><?= esc((string) $stats['siteSettings']) ?></strong>
        </div>
    </div>
</div>

<div class="card">
    <div class="page-head">
        <div>
            <div class="eyebrow">Workflow</div>
            <h2>Kontrol Landing Page</h2>
        </div>
    </div>
    <div class="grid-3">
        <div class="stat">
            <small>1. Pengaturan dasar</small>
            <div>Atur hero copy, label section, video, footer, kontak, Maps, dan sosial media dari menu Pengaturan Website.</div>
        </div>
        <div class="stat">
            <small>2. Konten visual</small>
            <div>Kelola hero image, gambar layanan, dan item galeri agar landing page selalu sesuai materi terbaru.</div>
        </div>
        <div class="stat">
            <small>3. Jalur konversi</small>
            <div>Kelola WhatsApp, OTA, Maps, Instagram, dan semua link yang muncul di booking hub dari menu Booking Links.</div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
