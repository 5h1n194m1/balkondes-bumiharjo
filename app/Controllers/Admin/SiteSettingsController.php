<?php

namespace App\Controllers\Admin;

use App\Models\SiteSettingModel;

class SiteSettingsController extends BaseAdminController
{
    public function edit(): string
    {
        $model  = new SiteSettingModel();
        $record = $model->first();

        if (! $record) {
            $id = $model->insert(['company_name' => 'Balkondes Bumiharjo'], true);
            $record = $model->find($id);
        }

        return $this->render('admin/site_settings/form', [
            'title'   => 'Pengaturan Website',
            'setting' => $record,
        ]);
    }

    public function update()
    {
        $model  = new SiteSettingModel();
        $record = $model->first();

        if (! $record) {
            $id = $model->insert(['company_name' => 'Balkondes Bumiharjo'], true);
            $record = $model->find($id);
        }

        if (! $this->validate([
            'company_name'    => 'required|max_length[255]',
            'hero_kicker'     => 'permit_empty|max_length[255]',
            'hero_headline'   => 'permit_empty|max_length[255]',
            'hero_primary_label' => 'permit_empty|max_length[255]',
            'hero_primary_url' => 'permit_empty|max_length[255]',
            'hero_secondary_label' => 'permit_empty|max_length[255]',
            'hero_secondary_url' => 'permit_empty|max_length[255]',
            'about_title'     => 'permit_empty|max_length[255]',
            'about_label'     => 'permit_empty|max_length[255]',
            'services_title'  => 'permit_empty|max_length[255]',
            'services_label'  => 'permit_empty|max_length[255]',
            'gallery_title'   => 'permit_empty|max_length[255]',
            'gallery_label'   => 'permit_empty|max_length[255]',
            'video_title'     => 'permit_empty|max_length[255]',
            'video_path'      => 'permit_empty|mime_in[video_path,video/mp4,video/webm,video/quicktime]|max_size[video_path,51200]',
            'footer_title'    => 'permit_empty|max_length[255]',
            'location_title'  => 'permit_empty|max_length[255]',
            'location_label'  => 'permit_empty|max_length[255]',
            'opening_hours'   => 'permit_empty|max_length[255]',
            'whatsapp_number' => 'permit_empty|max_length[30]',
            'instagram_url'   => 'permit_empty|max_length[255]',
            'facebook_url'    => 'permit_empty|max_length[255]',
            'maps_url'        => 'permit_empty|max_length[255]',
            'email'           => 'permit_empty|valid_email|max_length[255]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $videoPath = $this->moveUpload('video_path', 'uploads/site-settings/videos', $record['video_path'] ?? null);

        $model->update($record['id'], [
            'company_name'     => trim((string) $this->request->getPost('company_name')),
            'hero_kicker'      => trim((string) $this->request->getPost('hero_kicker')),
            'hero_headline'    => trim((string) $this->request->getPost('hero_headline')),
            'hero_subheadline' => trim((string) $this->request->getPost('hero_subheadline')),
            'hero_primary_label' => trim((string) $this->request->getPost('hero_primary_label')),
            'hero_primary_url' => trim((string) $this->request->getPost('hero_primary_url')),
            'hero_secondary_label' => trim((string) $this->request->getPost('hero_secondary_label')),
            'hero_secondary_url' => trim((string) $this->request->getPost('hero_secondary_url')),
            'about_title'      => trim((string) $this->request->getPost('about_title')),
            'about_label'      => trim((string) $this->request->getPost('about_label')),
            'about_content'    => trim((string) $this->request->getPost('about_content')),
            'services_title'   => trim((string) $this->request->getPost('services_title')),
            'services_label'   => trim((string) $this->request->getPost('services_label')),
            'services_intro'   => trim((string) $this->request->getPost('services_intro')),
            'gallery_title'    => trim((string) $this->request->getPost('gallery_title')),
            'gallery_intro'    => trim((string) $this->request->getPost('gallery_intro')),
            'gallery_label'    => trim((string) $this->request->getPost('gallery_label')),
            'video_title'      => trim((string) $this->request->getPost('video_title')),
            'video_caption'    => trim((string) $this->request->getPost('video_caption')),
            'video_path'       => $videoPath,
            'video_enabled'    => $this->request->getPost('video_enabled') ? 1 : 0,
            'footer_title'     => trim((string) $this->request->getPost('footer_title')),
            'footer_description' => trim((string) $this->request->getPost('footer_description')),
            'address'          => trim((string) $this->request->getPost('address')),
            'location_title'   => trim((string) $this->request->getPost('location_title')),
            'location_intro'   => trim((string) $this->request->getPost('location_intro')),
            'location_label'   => trim((string) $this->request->getPost('location_label')),
            'maps_embed_url'   => trim((string) $this->request->getPost('maps_embed_url')),
            'opening_hours'    => trim((string) $this->request->getPost('opening_hours')),
            'whatsapp_number'  => trim((string) $this->request->getPost('whatsapp_number')),
            'whatsapp_message' => trim((string) $this->request->getPost('whatsapp_message')),
            'instagram_url'    => trim((string) $this->request->getPost('instagram_url')),
            'facebook_url'     => trim((string) $this->request->getPost('facebook_url')),
            'maps_url'         => trim((string) $this->request->getPost('maps_url')),
            'email'            => trim((string) $this->request->getPost('email')),
        ]);

        return redirect()->to('/admin/site-settings')->with('success', 'Pengaturan website berhasil diperbarui.');
    }
}
