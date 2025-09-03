<?php

use Google\Service\Forms\Option;

if (!function_exists('view_submodules')) {
    function view_submodules($view, $data = [], $options = [])
    {
        return view('Modules\\' . $view, $data);
    }
}

if (!function_exists('read_env')) {
    function read_env($key, $default = null)
    {
        $envFile = ROOTPATH . '.env'; // Pastikan file .env ada di root
        if (!file_exists($envFile)) {
            return $default;
        }

        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue; // Skip komentar
            }

            list($envKey, $value) = explode('=', $line, 2);
            $envKey = trim($envKey);
            $value = trim($value);

            // Hapus tanda kutip jika ada
            if (preg_match('/^"(.*)"$/', $value, $matches) || preg_match("/^'(.*)'$/", $value, $matches)) {
                $value = $matches[1];
            }

            if ($envKey === $key) {
                return $value;
            }
        }

        return $default;
    }
}
