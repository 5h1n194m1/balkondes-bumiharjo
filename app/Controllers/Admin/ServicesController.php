<?php

namespace App\Controllers\Admin;

use App\Models\ServiceModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class ServicesController extends BaseAdminController
{
    protected ServiceModel $model;

    public function __construct()
    {
        $this->model = new ServiceModel();
    }

    public function index(): string
    {
        return $this->render('admin/services/index', [
            'title' => 'Layanan',
            'rows'  => $this->model->orderBy('sort_order', 'ASC')->findAll(),
        ]);
    }

    public function create(): string
    {
        return $this->render('admin/services/form', [
            'title'  => 'Tambah Layanan',
            'record' => null,
        ]);
    }

    public function store()
    {
        if (! $this->validate([
            'title'      => 'required|max_length[255]',
            'icon'       => 'permit_empty|max_length[20]',
            'sort_order' => 'permit_empty|integer',
            'image_path' => 'permit_empty|is_image[image_path]|max_size[image_path,5120]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert([
            'icon'        => trim((string) $this->request->getPost('icon')),
            'title'       => trim((string) $this->request->getPost('title')),
            'description' => trim((string) $this->request->getPost('description')),
            'image_path'  => $this->moveUpload('image_path', 'uploads/services'),
            'highlight_points' => trim((string) $this->request->getPost('highlight_points')),
            'sort_order'  => (int) ($this->request->getPost('sort_order') ?: 0),
            'is_active'   => $this->toggleValue('is_active'),
        ]);

        return redirect()->to('/admin/services')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        return $this->render('admin/services/form', [
            'title'  => 'Edit Layanan',
            'record' => $this->findOrFail($id),
        ]);
    }

    public function update(int $id)
    {
        $this->findOrFail($id);

        if (! $this->validate([
            'title'      => 'required|max_length[255]',
            'icon'       => 'permit_empty|max_length[20]',
            'sort_order' => 'permit_empty|integer',
            'image_path' => 'permit_empty|is_image[image_path]|max_size[image_path,5120]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, [
            'icon'        => trim((string) $this->request->getPost('icon')),
            'title'       => trim((string) $this->request->getPost('title')),
            'description' => trim((string) $this->request->getPost('description')),
            'image_path'  => $this->moveUpload('image_path', 'uploads/services', $record['image_path'] ?? null),
            'highlight_points' => trim((string) $this->request->getPost('highlight_points')),
            'sort_order'  => (int) ($this->request->getPost('sort_order') ?: 0),
            'is_active'   => $this->toggleValue('is_active'),
        ]);

        return redirect()->to('/admin/services')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $record = $this->findOrFail($id);
        $this->deleteFile($record['image_path'] ?? null);
        $this->model->delete($id);

        return redirect()->to('/admin/services')->with('success', 'Layanan berhasil dihapus.');
    }

    protected function findOrFail(int $id): array
    {
        $record = $this->model->find($id);

        if (! $record) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $record;
    }
}
