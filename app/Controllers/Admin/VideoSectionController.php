<?php

namespace App\Controllers\Admin;

use App\Models\SiteSettingModel;

class VideoSectionController extends BaseAdminController
{
    public function edit(): string
    {
        $model = new SiteSettingModel();
        $record = $model->first();

        if (! $record) {
            $id = $model->insert(['company_name' => 'Balkondes Bumiharjo'], true);
            $record = $model->find($id);
        }

        return $this->render('admin/video_section/form', [
            'title' => 'Video Section',
            'setting' => $record,
        ]);
    }

    public function update()
    {
        $model = new SiteSettingModel();
        $record = $model->first();

        if (! $record) {
            $id = $model->insert(['company_name' => 'Balkondes Bumiharjo'], true);
            $record = $model->find($id);
        }

        if (! $this->validate([
            'video_title'   => 'permit_empty|max_length[255]',
            'video_caption' => 'permit_empty',
            'video_url'     => 'permit_empty|max_length[500]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model->update($record['id'], [
            'video_title' => trim((string) $this->request->getPost('video_title')),
            'video_caption' => trim((string) $this->request->getPost('video_caption')),
            'video_url' => trim((string) $this->request->getPost('video_url')),
            'video_enabled' => $this->request->getPost('video_enabled') ? 1 : 0,
        ]);

        return redirect()->to('/admin/video-section')->with('success', 'Video section berhasil diperbarui.');
    }
}
