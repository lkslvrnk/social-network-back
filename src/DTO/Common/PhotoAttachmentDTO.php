<?php
declare(strict_types=1);
namespace App\DTO\Common;

class PhotoAttachmentDTO extends AttachmentDTO {
    public string $src;
    
    function __construct(string $id, string $src) {
        $this->type = 'photo';
        $this->id = $id;
        $this->src = $src;
    }

}
