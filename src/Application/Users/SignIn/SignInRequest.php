<?php
declare(strict_types=1);
namespace App\Application\Users\SignIn;

class SignInRequest {

    public $email;
    public $password;

    public function __construct(array $signInData) {
        $this->email = $signInData['email'] ;
        $this->password = $signInData['password'];
    }
}
