<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="page-head">
        <div>
            <div class="eyebrow">Konversi</div>
            <h2><?= esc($title) ?></h2>
            <p class="muted">Kelola link kontak utama dan seluruh OTA yang muncul di halaman booking hub.</p>
        </div>
        <a href="<?= app_relative_url('admin/booking-links/create') ?>" class="btn btn-primary">Tambah Link</a>
    </div>
</div>

<div class="card table-wrap">
    <table>
        <thead>
        <tr>
            <th>Grup</th>
            <th>Label</th>
            <th>URL</th>
            <th>Urutan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?= esc(strtoupper((string) $row['group_key'])) ?></td>
                <td>
                    <strong><?= esc($row['label']) ?></strong>
                    <div class="muted"><?= esc($row['description'] ?? '') ?></div>
                </td>
                <td class="muted"><?= esc($row['url']) ?></td>
                <td><?= esc((string) $row['sort_order']) ?></td>
                <td><span class="badge <?= (int) $row['is_active'] === 1 ? 'badge-success' : 'badge-muted' ?>"><?= (int) $row['is_active'] === 1 ? 'Aktif' : 'Nonaktif' ?></span></td>
                <td>
                    <div class="actions">
                        <a href="<?= app_relative_url('admin/booking-links/' . $row['id'] . '/edit') ?>" class="btn btn-outline">Edit</a>
                        <form method="post" action="<?= app_relative_url('admin/booking-links/' . $row['id'] . '/delete') ?>" onsubmit="return confirm('Hapus link ini?')">
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

