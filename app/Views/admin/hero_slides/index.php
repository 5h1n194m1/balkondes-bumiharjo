<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="page-head">
        <div>
            <div class="eyebrow">Landing Page</div>
            <h2><?= esc($title) ?></h2>
            <p class="muted">Kelola slide hero utama untuk landing page.</p>
        </div>
        <a href="<?= site_url('admin/hero-slides/create') ?>" class="btn btn-primary">Tambah Slide</a>
    </div>
</div>

<div class="card table-wrap">
    <table>
        <thead>
        <tr>
            <th>Preview</th>
            <th>Judul</th>
            <th>Urutan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php if (! empty($row['image_path'])): ?><img src="<?= esc(media_url($row['image_path'])) ?>" class="thumb" alt="preview"><?php else: ?><span class="muted">Tanpa gambar</span><?php endif; ?></td>
                <td><?= esc($row['title'] ?: '-') ?></td>
                <td><?= esc((string) $row['sort_order']) ?></td>
                <td><span class="badge <?= (int) $row['is_active'] === 1 ? 'badge-success' : 'badge-muted' ?>"><?= (int) $row['is_active'] === 1 ? 'Aktif' : 'Nonaktif' ?></span></td>
                <td>
                    <div class="actions">
                        <a href="<?= site_url('admin/hero-slides/' . $row['id'] . '/edit') ?>" class="btn btn-outline">Edit</a>
                        <form method="post" action="<?= site_url('admin/hero-slides/' . $row['id'] . '/delete') ?>" onsubmit="return confirm('Hapus slide ini?')">
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
