<?php
declare(strict_types=1);
namespace App\Application\Users\Connection\Create;

use App\Application\BaseRequest;

class CreateRequest implements BaseRequest {
    public $requesterId;
    public $requesteeId;
    
    function __construct($requesterId, $requesteeId) {
        $this->requesterId = $requesterId;
        $this->requesteeId = $requesteeId;
    }

}
