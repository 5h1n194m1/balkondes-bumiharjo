<?php

namespace App\Controllers\Admin;

use App\Models\GalleryItemModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class GalleryItemsController extends BaseAdminController
{
    protected GalleryItemModel $model;

    public function __construct()
    {
        $this->model = new GalleryItemModel();
    }

    public function index(): string
    {
        return $this->render('admin/gallery_items/index', [
            'title' => 'Galeri & Video',
            'rows'  => $this->model->orderBy('sort_order', 'ASC')->findAll(),
        ]);
    }

    public function create(): string
    {
        return $this->render('admin/gallery_items/form', [
            'title'  => 'Tambah Item Galeri',
            'record' => null,
        ]);
    }

    public function store()
    {
        if (! $this->validate($this->rules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert([
            'title'      => trim((string) $this->request->getPost('title')),
            'caption'    => trim((string) $this->request->getPost('caption')),
            'media_type' => (string) $this->request->getPost('media_type'),
            'image_path' => $this->moveUpload('image_path', 'uploads/gallery/images'),
            'video_path' => $this->moveUpload('video_path', 'uploads/gallery/videos'),
            'sort_order' => (int) ($this->request->getPost('sort_order') ?: 0),
            'is_active'  => $this->toggleValue('is_active'),
        ]);

        return redirect()->to('/admin/gallery-items')->with('success', 'Item galeri berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        return $this->render('admin/gallery_items/form', [
            'title'  => 'Edit Item Galeri',
            'record' => $this->findOrFail($id),
        ]);
    }

    public function update(int $id)
    {
        $record = $this->findOrFail($id);

        if (! $this->validate($this->rules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, [
            'title'      => trim((string) $this->request->getPost('title')),
            'caption'    => trim((string) $this->request->getPost('caption')),
            'media_type' => (string) $this->request->getPost('media_type'),
            'image_path' => $this->moveUpload('image_path', 'uploads/gallery/images', $record['image_path']),
            'video_path' => $this->moveUpload('video_path', 'uploads/gallery/videos', $record['video_path']),
            'sort_order' => (int) ($this->request->getPost('sort_order') ?: 0),
            'is_active'  => $this->toggleValue('is_active'),
        ]);

        return redirect()->to('/admin/gallery-items')->with('success', 'Item galeri berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $record = $this->findOrFail($id);
        $this->deleteFile($record['image_path']);
        $this->deleteFile($record['video_path']);
        $this->model->delete($id);

        return redirect()->to('/admin/gallery-items')->with('success', 'Item galeri berhasil dihapus.');
    }

    protected function rules(): array
    {
        return [
            'title'      => 'permit_empty|max_length[255]',
            'media_type' => 'required|in_list[image,video]',
            'sort_order' => 'permit_empty|integer',
            'image_path' => 'permit_empty|is_image[image_path]|max_size[image_path,5120]',
            'video_path' => 'permit_empty|mime_in[video_path,video/mp4,video/webm,video/quicktime]|max_size[video_path,51200]',
        ];
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
