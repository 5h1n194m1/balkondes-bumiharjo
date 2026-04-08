<?php

namespace App\Controllers\Admin;

use App\Models\BookingLinkModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class BookingLinksController extends BaseAdminController
{
    protected BookingLinkModel $model;

    public function __construct()
    {
        $this->model = new BookingLinkModel();
    }

    public function index(): string
    {
        return $this->render('admin/booking_links/index', [
            'title' => 'Booking Links',
            'rows'  => $this->model->orderBy('group_key', 'ASC')->orderBy('sort_order', 'ASC')->findAll(),
        ]);
    }

    public function create(): string
    {
        return $this->render('admin/booking_links/form', [
            'title'  => 'Tambah Link Booking',
            'record' => null,
        ]);
    }

    public function store()
    {
        if (! $this->validate($this->rules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->insert($this->payload());

        return redirect()->to('/admin/booking-links')->with('success', 'Link booking berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        return $this->render('admin/booking_links/form', [
            'title'  => 'Edit Link Booking',
            'record' => $this->findOrFail($id),
        ]);
    }

    public function update(int $id)
    {
        $this->findOrFail($id);

        if (! $this->validate($this->rules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->model->update($id, $this->payload());

        return redirect()->to('/admin/booking-links')->with('success', 'Link booking berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $this->findOrFail($id);
        $this->model->delete($id);

        return redirect()->to('/admin/booking-links')->with('success', 'Link booking berhasil dihapus.');
    }

    protected function rules(): array
    {
        return [
            'group_key' => 'required|in_list[contact,ota]',
            'label' => 'required|max_length[255]',
            'description' => 'permit_empty',
            'url' => 'required|max_length[255]',
            'sort_order' => 'permit_empty|integer',
        ];
    }

    protected function payload(): array
    {
        return [
            'group_key' => trim((string) $this->request->getPost('group_key')),
            'label' => trim((string) $this->request->getPost('label')),
            'description' => trim((string) $this->request->getPost('description')),
            'url' => trim((string) $this->request->getPost('url')),
            'sort_order' => (int) ($this->request->getPost('sort_order') ?: 0),
            'is_active' => $this->toggleValue('is_active'),
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
