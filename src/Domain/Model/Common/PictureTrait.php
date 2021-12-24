<?php
declare(strict_types=1);
namespace App\Domain\Model\Common;

use App\Domain\Model\Users\User\User;

trait PictureTrait {
    
    //private string $description = "";
    
//    private string $original;
//    private string $small;
//    private string $extraSmall;
//    private string $medium;
//    private string $large;
    
    private string $croppedSmall;
    private string $croppedMedium;
    private string $croppedLarge;
    
//    /** @param array<string> $versions */
//    private function setCroppedVersions(array $versions): void {
//        $this->small = $versions['small'];
//        $this->medium = $versions['medium'];
//        $this->large = $versions['large'];
//    }
    
    /** @param array<string> $versions */
    private function setVersions(array $versions): void {
        //print_r($versions);exit();
//        $this->original = $versions['original'];
//        $this->small = $versions['small'];
//        $this->extraSmall = $versions['extraSmall'];
//        $this->medium = $versions['medium'];
//        $this->large = $versions['large'];
        //echo $this->extraSmall;exit();
        
        $this->croppedLarge = $versions['cropped_large'];
        $this->croppedMedium = $versions['cropped_medium'];
        $this->croppedSmall = $versions['cropped_small'];
    }
    
//    /** @return array<string> */
//    function versions(): array {
//        return [
//            'original' => $this->original,
//            'small' => $this->small,
//            'extra_small' => $this->extraSmall,
//            'medium' => $this->medium,
//            'large' => $this->large,
//            'cropped_small' => $this->croppedSmall,
//            'cropped_medium' => $this->croppedMedium,
//            'cropped_large' => $this->croppedLarge
//        ];
//    }
//    
//    function original(): string { return $this->original; }
//    function extraSmall(): string { return $this->extraSmall; }
//    function small(): string { return $this->small; }
//    function medium(): string { return $this->medium; }
//    function large(): string { return $this->large; }
    
    function croppedSmall(): string { return $this->croppedSmall; }
    function croppedMedium(): string { return $this->croppedMedium; }
    function croppedLarge(): string { return $this->croppedLarge; }
}
/*
//    private function setAvatarVersions(array $avatarVersions) {
//        if(count($avatarVersions) !== 3) {
//            throw new \InvalidArgumentException("Incorrect count of avatar versions");
//        }
//
//        foreach ($avatarVersions as $version => $path) {
//            if(!isset($path)) {
//                throw new \InvalidArgumentException("Путь к {$version} изображения отсутствует");
//            } // } else if(!file_exists($path)) {
//            //     throw new \InvalidArgumentException("{$version} изображения по заданому пути отсутствует");
//            // }
//        }
//
//        //$this->checkAvatarSizes($avatarVersions);
//
//        $this->avatar = $avatarVersions['avatar'];
//        $this->miniAvatar = $avatarVersions['miniAvatar'];
//        $this->microAvatar = $avatarVersions['microAvatar'];
//    }
//
//    private function checkRequiredImageSizes($imageVersions) {
//        $avatarSize = getimagesize($avatarVersions['avatar']);
//        $miniAvatarSize = getimagesize($avatarVersions['miniAvatar']);
//        $microAvatarSize = getimagesize($avatarVersions['microAvatar']);
//
//        if($avatarSize[0] != 200 || ($avatarSize[1] < 200 || $avatarSize[1] > 300)) {
//            throw new \InvalidArgumentException('Неправильные размеры изображения.'
//                    . ' Ширина аватара должна быть 200px, высота от 200px до 300 px');
//        } else if($miniAvatarSize[0] != 100 || $miniAvatarSize[1] != 100) {
//            throw new \InvalidArgumentException('Неправильные размеры изображения.'
//                    . ' Ширина и ширина мини аватара должны быть 100px');
//        } else if($microAvatarSize[0] != 50 || $microAvatarSize[1] != 50) {
//            throw new \InvalidArgumentException('Неправильные размеры изображения.'
//                    . ' Ширина и ширина микро аватара должны быть 50px');
//        }
//    }
//
//    private function checkAvatarSizes($avatarVersions) {
//        $avatarSize = getimagesize($avatarVersions['avatar']);
//        $miniAvatarSize = getimagesize($avatarVersions['miniAvatar']);
//        $microAvatarSize = getimagesize($avatarVersions['microAvatar']);
//
//        if($avatarSize[0] != 200 || ($avatarSize[1] < 200 || $avatarSize[1] > 300)) {
//            throw new \InvalidArgumentException('Неправильные размеры изображения.'
//                    . ' Ширина аватара должна быть 200px, высота от 200px до 300 px');
//        } else if($miniAvatarSize[0] != 100 || $miniAvatarSize[1] != 100) {
//            throw new \InvalidArgumentException('Неправильные размеры изображения.'
//                    . ' Ширина и ширина мини аватара должны быть 100px');
//        } else if($microAvatarSize[0] != 50 || $microAvatarSize[1] != 50) {
//            throw new \InvalidArgumentException('Неправильные размеры изображения.'
//                    . ' Ширина и ширина микро аватара должны быть 50px');
//        }
//    }
//
//    private function failIfNotImage($path) : void {
//        $mime = $this->knowMIME($path);
//
//        if($mime != self::JPEG_MIME && $mime != self::GIF_MIME && $mime != self::PNG_MIME) {
//            throw new \InvalidArgumentException('По пути {$path} находится не изображение');
//        }
//    }
//
//    private function knowMIME(string $imagePath) : ?string {
//        $finfo = \finfo_open(FILEINFO_MIME_TYPE);
//        $mime = \finfo_file($finfo, $imagePath);
//        \finfo_close($finfo);
//
//        return $mime ?? null;
//    }
//
//    function move(string $imagesStorage, string $imagePath, int $ownerId) {
//        $extension = explode('/', $this->mime)[1];
//        $newName = '';
//        $newPath = $imagesStorage . "user{$ownerId}/avatar/" . "photoname.{$extension}";
//        move_uploaded_file($this->path, $newPath);
//        $this->path = $newPath;
//    }
 * 
 */