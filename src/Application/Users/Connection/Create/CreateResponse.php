<?php
declare(strict_types=1);
namespace App\Application\Users\Connection\Create;

use App\Application\BaseResponse;

class CreateResponse implements BaseResponse {

    public $id;

    public function __construct(string $id) {
        $this->id = $id;
    }
}
