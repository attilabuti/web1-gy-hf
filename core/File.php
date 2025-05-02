<?php

class File {

    public static function save($file = null, $directory = null, $filename = null) {
        if (!isset($file) || !is_array($file) || !isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return false;
        }

        if ($filename === null) {
            $filename = uniqid() . $file['name'];
        }

        $filename = preg_replace('/\s+/u', '_', $filename);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        if (!is_writable($directory)) {
            throw new Exception("Directory {$directory} must be writable");
        }

        $filename = Path::join($directory, $filename);

        if (move_uploaded_file($file['tmp_name'], $filename)) {
            chmod($filename, 0644);

            return $filename;
        }

        return false;
    }

    public static function isImage($file) {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        if (!is_uploaded_file($file['tmp_name'])) {
            return false;
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);
        if (!in_array($mime, $allowedMimeTypes)) {
            return false;
        }

        $imageInfo = getimagesize($file['tmp_name']);
        if ($imageInfo === false) {
            return false;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExtensions)) {
            return false;
        }

        return true;
    }

}
