<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div style="display:flex;justify-content:space-between;gap:16px;align-items:center;flex-wrap:wrap;">
        <div>
            <h2 style="margin:0;"><?= esc($title) ?></h2>
            <p class="muted">Kelola foto dan video untuk section galeri.</p>
        </div>
        <a href="<?= site_url('admin/gallery-items/create') ?>" class="btn btn-primary">Tambah Item</a>
    </div>
</div>
<div class="card table-wrap">
    <table>
        <thead>
        <tr>
            <th>Preview</th>
            <th>Judul</th>
            <th>Tipe</th>
            <th>Urutan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td>
                    <?php if (! empty($row['image_path'])): ?>
                        <img src="<?= esc(media_url($row['image_path'])) ?>" class="thumb" alt="preview">
                    <?php elseif (! empty($row['video_path'])): ?>
                        <span class="muted">Video tersedia</span>
                    <?php else: ?>
                        <span class="muted">Belum ada media</span>
                    <?php endif; ?>
                </td>
                <td><?= esc($row['title'] ?: '-') ?></td>
                <td><?= esc($row['media_type']) ?></td>
                <td><?= esc((string) $row['sort_order']) ?></td>
                <td><span class="badge <?= (int) $row['is_active'] === 1 ? 'badge-success' : 'badge-muted' ?>"><?= (int) $row['is_active'] === 1 ? 'Aktif' : 'Nonaktif' ?></span></td>
                <td>
                    <div class="actions">
                        <a href="<?= site_url('admin/gallery-items/' . $row['id'] . '/edit') ?>" class="btn btn-outline">Edit</a>
                        <form method="post" action="<?= site_url('admin/gallery-items/' . $row['id'] . '/delete') ?>" onsubmit="return confirm('Hapus item ini?')">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>
