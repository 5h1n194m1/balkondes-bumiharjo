<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

abstract class BaseAdminController extends BaseController
{
    protected function render(string $view, array $data = []): string
    {
        $defaults = [
            'currentUser' => [
                'name'  => session()->get('admin_name') ?? 'Admin',
                'email' => session()->get('admin_email') ?? '',
            ],
        ];

        return view($view, array_merge($defaults, $data));
    }

    protected function moveUpload(string $field, string $targetDirectory, ?string $currentPath = null): ?string
    {
        $file = $this->request->getFile($field);

        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return $currentPath;
        }

        $targetDirectory = trim($targetDirectory, '/\\');
        $fullDirectory   = FCPATH . $targetDirectory;

        if (! is_dir($fullDirectory)) {
            mkdir($fullDirectory, 0777, true);
        }

        $newName = $file->getRandomName();
        $file->move($fullDirectory, $newName);

        if ($currentPath) {
            $this->deleteFile($currentPath);
        }

        return $targetDirectory . '/' . $newName;
    }

    protected function deleteFile(?string $path): void
    {
        if (! $path) {
            return;
        }

        $fullPath = FCPATH . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);

        if (is_file($fullPath)) {
            unlink($fullPath);
        }
    }

    protected function toggleValue(string $key): int
    {
        return $this->request->getPost($key) ? 1 : 0;
    }
}
