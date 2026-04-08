<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<form method="post" enctype="multipart/form-data" action="<?= $record ? site_url('admin/hero-slides/' . $record['id']) : site_url('admin/hero-slides') ?>" class="card">
    <div class="page-head" style="margin-bottom:18px;">
        <div>
            <div class="eyebrow">Hero Editor</div>
            <h2><?= esc($title) ?></h2>
        </div>
    </div>
    <div class="grid-2">
        <div class="field">
            <label>Judul</label>
            <input type="text" name="title" value="<?= esc(old_or_value('title', $record['title'] ?? '')) ?>">
        </div>
        <div class="field">
            <label>Urutan</label>
            <input type="number" name="sort_order" value="<?= esc(old_or_value('sort_order', $record['sort_order'] ?? '0')) ?>">
        </div>
    </div>
    <div class="field">
        <label>Subjudul</label>
        <textarea name="subtitle"><?= esc(old_or_value('subtitle', $record['subtitle'] ?? '')) ?></textarea>
    </div>
    <div class="grid-2">
        <div class="field">
            <label>Teks Tombol</label>
            <input type="text" name="button_text" value="<?= esc(old_or_value('button_text', $record['button_text'] ?? '')) ?>">
        </div>
        <div class="field">
            <label>Link Tombol</label>
            <input type="text" name="button_link" value="<?= esc(old_or_value('button_link', $record['button_link'] ?? '#layanan')) ?>">
        </div>
    </div>
    <div class="field">
        <label>Gambar Hero</label>
        <input type="file" name="image_path" accept="image/*">
        <?php if (! empty($record['image_path'])): ?><img src="<?= esc(media_url($record['image_path'])) ?>" class="thumb" alt="hero"><?php endif; ?>
    </div>
    <label class="checkbox"><input type="checkbox" name="is_active" value="1" <?= (int) old('is_active', $record['is_active'] ?? 1) === 1 ? 'checked' : '' ?>> Aktifkan slide</label>
    <div class="actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('admin/hero-slides') ?>" class="btn btn-outline">Kembali</a>
    </div>
</form>
<?= $this->endSection() ?>
