<?php
declare(strict_types=1);
namespace App\Application\Users\SignIn;

use App\Auth\JwtAuthHS256;
use App\Domain\Model\Users\User\UserRepository;
//use App\Infrastructure\Authentication\AuthService;
use App\Application\Exceptions\ForbiddenException;

class SignIn {
    //private AuthService $authService;
    private JwtAuthHS256 $jwtAuthHS256;
    private UserRepository $users;
    
    public function __construct(JwtAuthHS256 $jwtAuthHS256, UserRepository $users) {
        $this->jwtAuthHS256 = $jwtAuthHS256;
        $this->users = $users;
        //$this->authService = $authService;
    }

    function execute(?string $email, ?string $password)  {
        //$this->validate($signInData);
        //echo $this->authService->isAuthenticated();exit();
        //echo $this->authService->isAuthenticated();exit();
        
//        if($this->authService->isAuthenticated()) {
//            throw new NotPermittedException('Пользователь уже вошел вошел в систему');
//        };
//

        if(!$email || !$password) {
            throw new ForbiddenException(13, 'email and password are required');
        }
        
        $user = $this->users->getByEmail($email);
        
        if(!$user || !password_verify($password, $user->password()->value())) {
            throw new ForbiddenException(13, 'Неправильный эмейл или пароль');
        }

        return [
            "message" => "Successful login.",
            'jwt' => $this->jwtAuthHS256->createJwt((string)$user->id(), ['user']),
            'token_type' => 'Bearer',
            'expires_in' => $this->jwtAuthHS256->getLifetime()
        ];
    }
//
//    function validate(SignInRequest $signInData) {
//    }

}
