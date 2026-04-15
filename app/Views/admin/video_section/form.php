<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<form method="post" action="<?= app_relative_url('admin/video-section') ?>" class="card">
    <div class="page-head" style="margin-bottom:18px;">
        <div>
            <div class="eyebrow">Landing Page</div>
            <h2><?= esc($title) ?></h2>
            <p class="muted">Atur khusus video section yang tampil di bawah hero, tanpa tercampur dengan hero atau galeri.</p>
        </div>
        <div class="actions">
            <a href="<?= app_relative_url('/') ?>" target="_blank" rel="noopener" class="btn btn-outline">Preview Website</a>
        </div>
    </div>

    <div class="card" style="padding:20px;background:#f9fbfc;">
        <h3 style="margin-top:0;">Video Section Bawah Hero</h3>
        <label class="checkbox"><input type="checkbox" name="video_enabled" value="1" <?= (int) old('video_enabled', $setting['video_enabled'] ?? 1) === 1 ? 'checked' : '' ?>> Tampilkan section video highlight</label>
        <div class="grid-2">
            <div class="field">
                <label>Judul Video</label>
                <input type="text" name="video_title" value="<?= esc(old_or_value('video_title', $setting['video_title'] ?? '')) ?>">
            </div>
            <div class="field">
                <label>Link Video</label>
                <input type="text" name="video_url" value="<?= esc(old_or_value('video_url', $setting['video_url'] ?? '')) ?>" placeholder="https://...">
                <div class="muted">Bisa pakai link YouTube, Vimeo, atau direct link `.mp4` / `.webm`.</div>
            </div>
        </div>
        <div class="field">
            <label>Caption Video</label>
            <textarea name="video_caption"><?= esc(old_or_value('video_caption', $setting['video_caption'] ?? '')) ?></textarea>
        </div>
    </div>

    <button class="btn btn-primary" type="submit">Simpan Video Section</button>
</form>
<?= $this->endSection() ?>

