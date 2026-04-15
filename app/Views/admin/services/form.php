<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<form method="post" enctype="multipart/form-data" action="<?= $record ? app_relative_url('admin/services/' . $record['id']) : app_relative_url('admin/services') ?>" class="card">
    <div class="page-head" style="margin-bottom:18px;">
        <div>
            <div class="eyebrow">Service Editor</div>
            <h2><?= esc($title) ?></h2>
        </div>
    </div>
    <div class="grid-2">
        <div class="field">
            <label>Icon / Emoji</label>
            <input type="text" name="icon" value="<?= esc(old_or_value('icon', $record['icon'] ?? '')) ?>">
        </div>
        <div class="field">
            <label>Urutan</label>
            <input type="number" name="sort_order" value="<?= esc(old_or_value('sort_order', $record['sort_order'] ?? '0')) ?>">
        </div>
    </div>
    <div class="field">
        <label>Judul</label>
        <input type="text" name="title" value="<?= esc(old_or_value('title', $record['title'] ?? '')) ?>">
    </div>
    <div class="field">
        <label>Deskripsi</label>
        <textarea name="description"><?= esc(old_or_value('description', $record['description'] ?? '')) ?></textarea>
    </div>
    <div class="field">
        <label>Poin Keunggulan Modal (pisahkan per baris)</label>
        <textarea name="highlight_points"><?= esc(old_or_value('highlight_points', $record['highlight_points'] ?? '')) ?></textarea>
    </div>
    <div class="field">
        <label>Gambar Layanan</label>
        <input type="file" name="image_path" accept="image/*">
        <?php if (! empty($record['image_path'])): ?><img src="<?= esc(media_url($record['image_path'])) ?>" class="thumb" alt="layanan"><?php endif; ?>
    </div>
    <label class="checkbox"><input type="checkbox" name="is_active" value="1" <?= (int) old('is_active', $record['is_active'] ?? 1) === 1 ? 'checked' : '' ?>> Aktifkan layanan</label>
    <div class="actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= app_relative_url('admin/services') ?>" class="btn btn-outline">Kembali</a>
    </div>
</form>
<?= $this->endSection() ?>

