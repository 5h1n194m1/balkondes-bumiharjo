<?php

namespace App\Controllers\Admin;

use App\Models\HeroSlideModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class HeroSlidesController extends BaseAdminController
{
    protected HeroSlideModel $model;

    public function __construct()
    {
        $this->model = new HeroSlideModel();
    }

    public function index(): string
    {
        return $this->render('admin/hero_slides/index', [
            'title' => 'Hero Slides',
            'rows'  => $this->model->orderBy('sort_order', 'ASC')->findAll(),
        ]);
    }

    public function create(): string
    {
        return $this->render('admin/hero_slides/form', [
            'title'  => 'Tambah Hero Slide',
            'record' => null,
        ]);
    }

    public function store()
    {
        if (! $this->validate([
            'title'       => 'permit_empty|max_length[255]',
            'button_text' => 'permit_empty|max_length[255]',
            'button_link' => 'permit_empty|max_length[255]',
            'sort_order'  => 'permit_empty|integer',
            'image_path'  => 'permit_empty|is_image[image_path]|max_size[image_path,5120]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert([
            'title'       => trim((string) $this->request->getPost('title')),
            'subtitle'    => trim((string) $this->request->getPost('subtitle')),
            'button_text' => trim((string) $this->request->getPost('button_text')),
            'button_link' => trim((string) $this->request->getPost('button_link')) ?: '#layanan',
            'image_path'  => $this->moveUpload('image_path', 'uploads/hero'),
            'sort_order'  => (int) ($this->request->getPost('sort_order') ?: 0),
            'is_active'   => $this->toggleValue('is_active'),
        ]);

        return redirect()->to('/admin/hero-slides')->with('success', 'Hero slide berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        return $this->render('admin/hero_slides/form', [
            'title'  => 'Edit Hero Slide',
            'record' => $this->findOrFail($id),
        ]);
    }

    public function update(int $id)
    {
        $record = $this->findOrFail($id);

        if (! $this->validate([
            'title'       => 'permit_empty|max_length[255]',
            'button_text' => 'permit_empty|max_length[255]',
            'button_link' => 'permit_empty|max_length[255]',
            'sort_order'  => 'permit_empty|integer',
            'image_path'  => 'permit_empty|is_image[image_path]|max_size[image_path,5120]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, [
            'title'       => trim((string) $this->request->getPost('title')),
            'subtitle'    => trim((string) $this->request->getPost('subtitle')),
            'button_text' => trim((string) $this->request->getPost('button_text')),
            'button_link' => trim((string) $this->request->getPost('button_link')) ?: '#layanan',
            'image_path'  => $this->moveUpload('image_path', 'uploads/hero', $record['image_path']),
            'sort_order'  => (int) ($this->request->getPost('sort_order') ?: 0),
            'is_active'   => $this->toggleValue('is_active'),
        ]);

        return redirect()->to('/admin/hero-slides')->with('success', 'Hero slide berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $record = $this->findOrFail($id);
        $this->deleteFile($record['image_path']);
        $this->model->delete($id);

        return redirect()->to('/admin/hero-slides')->with('success', 'Hero slide berhasil dihapus.');
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
