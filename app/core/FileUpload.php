<?php

namespace App\Core;

use App\core\Singleton;

class FileUpload extends Singleton{

    public static function uploadImage($imageFile, $targetDirectory, $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'])
    {
        if (!isset($imageFile) || $imageFile['error'] === UPLOAD_ERR_NO_FILE) {
            throw new \Exception("Aucun fichier n'a été sélectionné.");
        }

        $imageName = $imageFile['name'];
        $imageTmpName = $imageFile['tmp_name'];
        $imageSize = $imageFile['size'];
        $imageError = $imageFile['error'];
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        
        $uniqueImageName = uniqid() . '.' . $imageExtension;
$targetDirectory = __DIR__ . '/../..'. IMG_DIR ; 
$imagePath = $targetDirectory . $uniqueImageName;

$imageUrl = URL . IMG_DIR . $uniqueImageName;

if (!is_dir($targetDirectory)) {
    if (!mkdir($targetDirectory, 0755, true)) {
        throw new \Exception("Impossible de créer le dossier : $targetDirectory");
    }
}

if (move_uploaded_file($imageTmpName, $imagePath)) {
    return [
        'url' => $imageUrl,
        'path' => $imagePath,
        'name' => $uniqueImageName
    ];
} else {
    throw new \Exception("Erreur lors du déplacement de l'image dans le dossier cible.");
}

    }

    public static function uploadMultipleImages($files, $targetDirectory)
    {
        $uploadedImages = [];
        
        foreach ($files as $key => $file) {
            if ($file['error'] !== UPLOAD_ERR_NO_FILE) {
                $uploadedImages[$key] = self::uploadImage($file, $targetDirectory);
            }
        }
        
        return $uploadedImages;
    }
}