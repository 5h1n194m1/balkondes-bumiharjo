<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= esc(setting_value($settings, 'company_name', 'Balkondes Bumiharjo')) ?> | Booking Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cormorant+Garamond:wght@500;600;700&display=swap" rel="stylesheet">
    <style type="text/tailwindcss">
        @layer base {
            body {
                @apply min-h-screen bg-[#f6f0e6] text-[#342a22] antialiased;
                font-family: "Plus Jakarta Sans", sans-serif;
            }
            h1, h2, h3 { font-family: "Cormorant Garamond", serif; }
        }
    </style>
</head>
<body>
<?php $companyName = setting_value($settings, 'company_name', 'Balkondes Bumiharjo'); ?>
<main class="mx-auto max-w-5xl px-5 py-10 sm:px-8 sm:py-16">
    <a href="<?= esc(app_relative_url()) ?>" class="inline-flex rounded-full bg-white px-5 py-3 text-sm font-semibold text-[#6e5f51] shadow-[0_18px_35px_rgba(60,40,18,0.08)] transition hover:-translate-y-0.5">Kembali ke Beranda</a>

    <section class="mt-8 rounded-[2.5rem] bg-gradient-to-br from-[#dfc29b] via-[#f4e5d2] to-[#fbf7f1] p-8 shadow-[0_30px_60px_rgba(59,41,18,0.08)] sm:p-12">
        <p class="text-[11px] font-semibold uppercase tracking-[0.34em] text-[#b8854d]">Official Booking Hub</p>
        <h1 class="mt-4 text-[46px] leading-[0.92] sm:text-[72px]"><?= esc($companyName) ?></h1>
        <p class="mt-5 max-w-2xl text-[15px] leading-7 text-[#6e5f51] sm:text-[17px]">Satu pintu untuk reservasi, WhatsApp admin, sosial media, peta lokasi, dan seluruh kanal OTA resmi Balkondes Bumiharjo.</p>
    </section>

    <section class="mt-8 grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
        <div class="rounded-[2rem] bg-[#fbf7f1] p-6 shadow-[0_30px_60px_rgba(59,41,18,0.08)] sm:p-8">
            <p class="text-[11px] font-semibold uppercase tracking-[0.34em] text-[#b8854d]">Kontak Utama</p>
            <div class="mt-5 space-y-4">
                <?php foreach ($contactLinks as $contact): ?>
                    <a href="<?= esc($contact['url']) ?>" target="_blank" rel="noopener" class="block rounded-[1.4rem] bg-white px-5 py-4 shadow-[0_18px_35px_rgba(60,40,18,0.06)] transition hover:-translate-y-0.5">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-base font-semibold text-[#342a22]"><?= esc($contact['label']) ?></p>
                                <p class="mt-1 text-sm leading-6 text-[#6e5f51]"><?= esc($contact['description']) ?></p>
                            </div>
                            <span class="text-[#b8854d]">-&gt;</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="rounded-[2rem] bg-[#342a22] p-6 text-white shadow-[0_30px_60px_rgba(59,41,18,0.12)] sm:p-8">
            <p class="text-[11px] font-semibold uppercase tracking-[0.34em] text-[#d5b283]">OTA Resmi</p>
            <div class="mt-5 space-y-4">
                <?php foreach ($bookingLinks as $booking): ?>
                    <a href="<?= esc($booking['url']) ?>" target="_blank" rel="noopener" class="block rounded-[1.4rem] bg-white/10 px-5 py-4 transition hover:bg-white/15">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-base font-semibold"><?= esc($booking['label']) ?></p>
                                <p class="mt-1 text-sm leading-6 text-white/70"><?= esc($booking['description']) ?></p>
                            </div>
                            <span class="text-[#d5b283]">-&gt;</span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="mt-8 rounded-[2rem] bg-[#fbf7f1] p-6 text-center shadow-[0_30px_60px_rgba(59,41,18,0.08)] sm:p-8">
        <p class="text-[11px] font-semibold uppercase tracking-[0.34em] text-[#b8854d]">Reservasi Cepat</p>
        <h2 class="mt-3 text-[38px] leading-none sm:text-[52px]">Butuh jawaban cepat?</h2>
        <p class="mx-auto mt-3 max-w-2xl text-[15px] leading-7 text-[#6e5f51]">Gunakan WhatsApp untuk bertanya soal ketersediaan kamar, acara gathering, meeting, wedding, atau kebutuhan reservasi lainnya.</p>
        <a href="<?= esc($whatsappLink) ?>" target="_blank" rel="noopener" class="mt-6 inline-flex rounded-full bg-[#b8854d] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#9d723e]">Chat Admin Sekarang</a>
    </section>
</main>
</body>
</html>
