<?php

if (! function_exists('setting_value')) {
    function setting_value(?array $settings, string $key, string $fallback = ''): string
    {
        $value = $settings[$key] ?? null;

        return is_string($value) && trim($value) !== '' ? $value : $fallback;
    }
}

if (! function_exists('whatsapp_link')) {
    function whatsapp_link(?array $settings): string
    {
        $number = preg_replace('/\D+/', '', (string) ($settings['whatsapp_number'] ?? ''));

        if ($number === '') {
            return '#';
        }

        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        }

        $message = setting_value(
            $settings,
            'whatsapp_message',
            'Halo admin Balkondes Bumiharjo, saya ingin bertanya soal reservasi.'
        );

        return 'https://wa.me/' . $number . '?text=' . rawurlencode($message);
    }
}

if (! function_exists('media_url')) {
    function media_url(?string $path): string
    {
        if ($path === null || trim($path) === '') {
            return '';
        }

        $normalizedPath = str_replace('\\', '/', trim($path));

        if (preg_match('#^(?:https?:)?//#i', $normalizedPath) === 1) {
            return $normalizedPath;
        }

        return '/' . ltrim($normalizedPath, '/');
    }
}

if (! function_exists('app_relative_url')) {
    function app_relative_url(string $path = ''): string
    {
        $normalizedPath = trim(str_replace('\\', '/', $path), '/');

        return $normalizedPath === '' ? '/' : '/' . $normalizedPath;
    }
}

if (! function_exists('normalize_internal_url')) {
    function normalize_internal_url(?string $url, string $fallback = '/'): string
    {
        $url = trim((string) $url);

        if ($url === '') {
            return app_relative_url($fallback);
        }

        if (preg_match('#^(?:https?:|mailto:|tel:|\#)#i', $url) === 1) {
            return $url;
        }

        $parts = parse_url($url);

        if ($parts === false) {
            return app_relative_url($fallback);
        }

        if (isset($parts['scheme']) || isset($parts['host'])) {
            return $url;
        }

        $path = $parts['path'] ?? '';
        $path = $path === '' ? app_relative_url($fallback) : app_relative_url($path);

        if (isset($parts['query'])) {
            $path .= '?' . $parts['query'];
        }

        if (isset($parts['fragment'])) {
            $path .= '#' . $parts['fragment'];
        }

        return $path;
    }
}

if (! function_exists('is_active_admin')) {
    function is_active_admin(string $prefix): string
    {
        $path = trim(uri_string(), '/');

        return $path === $prefix || str_starts_with($path, $prefix . '/') ? 'active' : '';
    }
}

if (! function_exists('old_or_value')) {
    function old_or_value(string $key, $value = ''): string
    {
        return (string) old($key, $value);
    }
}

if (! function_exists('guess_video_mime_from_url')) {
    function guess_video_mime_from_url(string $url): string
    {
        $path = strtolower((string) parse_url($url, PHP_URL_PATH));

        return match (pathinfo($path, PATHINFO_EXTENSION)) {
            'webm' => 'video/webm',
            'mov' => 'video/quicktime',
            default => 'video/mp4',
        };
    }
}

if (! function_exists('build_video_section_media')) {
    function build_video_section_media(?array $settings): ?array
    {
        $rawUrl = trim((string) ($settings['video_url'] ?? ''));

        if ($rawUrl === '' && ! empty($settings['video_path'])) {
            $rawUrl = media_url($settings['video_path']);
        }

        if ($rawUrl === '') {
            return null;
        }

        $youtubeId = null;
        if (preg_match('~(?:youtube\.com/watch\?v=|youtu\.be/|youtube\.com/embed/|youtube\.com/shorts/)([A-Za-z0-9_-]{6,})~i', $rawUrl, $matches)) {
            $youtubeId = $matches[1];
        }

        if ($youtubeId !== null) {
            return [
                'type' => 'embed',
                'provider' => 'youtube',
                'src' => 'https://www.youtube.com/embed/' . $youtubeId . '?autoplay=1&mute=1&loop=1&playlist=' . $youtubeId . '&playsinline=1&rel=0&modestbranding=1',
                'modal_src' => 'https://www.youtube.com/embed/' . $youtubeId . '?autoplay=1&mute=0&loop=1&playlist=' . $youtubeId . '&playsinline=1&rel=0&modestbranding=1',
            ];
        }

        if (preg_match('~vimeo\.com/(?:video/)?(\d+)~i', $rawUrl, $matches)) {
            $vimeoId = $matches[1];

            return [
                'type' => 'embed',
                'provider' => 'vimeo',
                'src' => 'https://player.vimeo.com/video/' . $vimeoId . '?autoplay=1&muted=1&loop=1&autopause=0',
                'modal_src' => 'https://player.vimeo.com/video/' . $vimeoId . '?autoplay=1&muted=0&loop=1&autopause=0',
            ];
        }

        return [
            'type' => 'file',
            'provider' => 'direct',
            'src' => $rawUrl,
            'mime' => guess_video_mime_from_url($rawUrl),
        ];
    }
}
