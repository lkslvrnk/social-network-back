<?php
declare(strict_types=1);
namespace App\Application\Users\SignIn;

use App\Domain\Model\Users\User\User;

class SignInResponse {
    
    public $responseMessage;
    public $id;
    public $email;
    public $avatar;
    
    function __construct(User $user) {
        $this->responseMessage = 'User entered to the system';
        $this->id = $user->id();
        $this->email = $user->email();
        $this->avatar = 'avatar';
    }
}
