<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<form method="post" enctype="multipart/form-data" action="<?= $record ? site_url('admin/gallery-items/' . $record['id']) : site_url('admin/gallery-items') ?>" class="card">
    <h2 style="margin-top:0;"><?= esc($title) ?></h2>
    <div class="grid-2">
        <div class="field">
            <label>Judul</label>
            <input type="text" name="title" value="<?= esc(old_or_value('title', $record['title'] ?? '')) ?>">
        </div>
        <div class="field">
            <label>Jenis Media</label>
            <select name="media_type">
                <?php $mediaType = old('media_type', $record['media_type'] ?? 'image'); ?>
                <option value="image" <?= $mediaType === 'image' ? 'selected' : '' ?>>Foto</option>
                <option value="video" <?= $mediaType === 'video' ? 'selected' : '' ?>>Video</option>
            </select>
        </div>
    </div>
    <div class="field">
        <label>Caption</label>
        <textarea name="caption"><?= esc(old_or_value('caption', $record['caption'] ?? '')) ?></textarea>
    </div>
    <div class="grid-2">
        <div class="field">
            <label>Upload Foto</label>
            <input type="file" name="image_path" accept="image/*">
            <?php if (! empty($record['image_path'])): ?><img src="<?= esc(media_url($record['image_path'])) ?>" class="thumb" alt="foto"><?php endif; ?>
        </div>
        <div class="field">
            <label>Upload Video</label>
            <input type="file" name="video_path" accept="video/mp4,video/webm,video/quicktime">
            <?php if (! empty($record['video_path'])): ?><div class="muted">Video saat ini: <?= esc(basename($record['video_path'])) ?></div><?php endif; ?>
        </div>
    </div>
    <div class="field">
        <label>Urutan</label>
        <input type="number" name="sort_order" value="<?= esc(old_or_value('sort_order', $record['sort_order'] ?? '0')) ?>">
    </div>
    <label class="checkbox"><input type="checkbox" name="is_active" value="1" <?= (int) old('is_active', $record['is_active'] ?? 1) === 1 ? 'checked' : '' ?>> Aktifkan item</label>
    <div class="actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('admin/gallery-items') ?>" class="btn btn-outline">Kembali</a>
    </div>
</form>
<?= $this->endSection() ?>
