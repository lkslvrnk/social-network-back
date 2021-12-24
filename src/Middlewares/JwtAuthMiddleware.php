<?php
declare(strict_types=1);

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use App\Domain\Model\AuthenticationService;
use Tuupola\Middleware\JwtAuthentication\RequestPathRule;
use App\Auth\JwtAuthHS256;

class JwtAuthMiddleware implements MiddlewareInterface {

    private array $ignore;
    private string $path;
    private JwtAuthHS256 $jwtAuthHS256;
    private AuthenticationService $authService;
    
    public function __construct(AuthenticationService $authService, array $options) {
        if(!isset($options['secret'])) {
            throw new \Exception('secret is required');
        }
        $lifetime = $options['lifetime'] ?? 10000;
        $this->jwtAuthHS256 = new JwtAuthHS256('localhost:1338', $options['secret'], $lifetime);
        $this->authService = $authService;
        $this->ignore = $options['ignore'] ?? [];
        $this->path = $options['path'] ?? '/';
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface {
        //echo 'kek';exit();
        $authHeader = $request->getHeaderLine('Authorization');
        //echo 'sdfsdff';exit();
        $pathRule = new RequestPathRule(['path' => $this->path, 'ignore' => $this->ignore]);
        
//        if(!$authHeader && $pathRule($request)) {
//            throw new NotAuthenticatedException('Token is not provided');
//        }
        $authorization = explode(' ', $authHeader);

        $token = $authorization[1] ?? '';

        try {
            if(!$token) {
                throw new \Exception('kek');
            }
            $decodedToken = $this->jwtAuthHS256->decodeToken($token);
            $request = $request->withAttribute('token', $decodedToken);
            $userId = $decodedToken['data']['userId'];
            //$userRoles = $decodedToken['data']['userRoles'];
            $expiresIn = $decodedToken['exp'];
        } catch (\Exception $ex) {
            $reason = $ex->getMessage();
            $userId = null;
            //$userRoles = ['guest'];
            $expiresIn = null;
        }
        
//        if($pathRule($request) && !$userId) {
//            throw new NotAuthenticatedException($reason);
//        }
        $request = $request->withAttribute('token', ['data' => ['userId' => $userId]]);
//        $this->authService->setCurrentUserId($userId);
//        //$this->authService->setCurrentUserRoles($userRoles);
//        $this->authService->setExpiresIn($expiresIn);

        return $handler->handle($request);
    }
}
