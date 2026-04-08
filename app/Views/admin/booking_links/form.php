<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<form method="post" action="<?= $record ? site_url('admin/booking-links/' . $record['id']) : site_url('admin/booking-links') ?>" class="card">
    <h2 style="margin-top:0;"><?= esc($title) ?></h2>
    <div class="grid-2">
        <div class="field">
            <label>Grup Link</label>
            <?php $groupKey = old('group_key', $record['group_key'] ?? 'contact'); ?>
            <select name="group_key">
                <option value="contact" <?= $groupKey === 'contact' ? 'selected' : '' ?>>Kontak</option>
                <option value="ota" <?= $groupKey === 'ota' ? 'selected' : '' ?>>OTA</option>
            </select>
        </div>
        <div class="field">
            <label>Urutan</label>
            <input type="number" name="sort_order" value="<?= esc(old_or_value('sort_order', $record['sort_order'] ?? '0')) ?>">
        </div>
    </div>
    <div class="field">
        <label>Label</label>
        <input type="text" name="label" value="<?= esc(old_or_value('label', $record['label'] ?? '')) ?>">
    </div>
    <div class="field">
        <label>Deskripsi</label>
        <textarea name="description"><?= esc(old_or_value('description', $record['description'] ?? '')) ?></textarea>
    </div>
    <div class="field">
        <label>URL</label>
        <input type="text" name="url" value="<?= esc(old_or_value('url', $record['url'] ?? '')) ?>">
    </div>
    <label class="checkbox"><input type="checkbox" name="is_active" value="1" <?= (int) old('is_active', $record['is_active'] ?? 1) === 1 ? 'checked' : '' ?>> Aktifkan link</label>
    <div class="actions">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('admin/booking-links') ?>" class="btn btn-outline">Kembali</a>
    </div>
</form>
<?= $this->endSection() ?>
