<?php
declare(strict_types=1);

use Slim\Middleware\ContentLengthMiddleware;
use Slim\App;
use Middlewares\TrailingSlash;
use App\Middlewares\EtagMiddleware;
use Tuupola\Middleware\JwtAuthentication;
use App\Middlewares\ServerErrorsHandlerMiddleware;
use App\Middlewares\ErrorsHandlerMiddleware;
use App\Infrastructure\MyRequestPathRule;

return function (App $app) {
    // Parse json, form data and xml
    $app->add(new \App\Middlewares\JSONValidationMiddleware());
    $app->addBodyParsingMiddleware();
    
    /**
     * The routing middleware should be added earlier than the ErrorMiddleware
     * Otherwise exceptions thrown from it will not be handled by the middleware
     */
    $app->addRoutingMiddleware();
    
    $app->add(new ContentLengthMiddleware());
    $app->add(new EtagMiddleware());
    $app->add(new JwtAuthentication([
        "secret" => $app->getContainer()->get('secret'),
        "rules" => [
            new MyRequestPathRule([
                'path' => '/',                               
                'ignore' => [
                    ['uri' => '/users/\w+$', 'method' => 'GET'],
                    ['uri' => '/users/\w+/\posts', 'method' => 'GET'],
                    ['uri' => '/user-posts/\w+', 'method' => 'GET'],
                    ['uri' => '/user-post-comments/\w+', 'method' => 'GET'],
                    ['uri' => '/profile-pictures/\w+', 'method' => 'GET'],
//                    ['uri' => '/user-albums/\w+', 'method' => 'GET'],
//                    ['uri' => "/auth/me", 'method' => 'GET'],
                    ['uri' => "/auth/login", 'method' => 'POST'],
                    ['uri' => "/auth/signup", 'method' => 'POST'],
//                    ['uri' => "/test"],
//                    ['uri' => "/profile-posts", 'method' => 'POST'],
//                    ['uri' => "/profile-pictures/\w+"],
//                    ['uri' => "/privacy"],
//                    ['uri' => "/connections"],
//                    ['uri' => "/user-subscriptions"],
//                    ['uri' => "/user-albums"],
//                    ['uri' => "/user-photos"],
//                    ['uri' => "/profile-pictures"],
                ]
            ]),
            new \Tuupola\Middleware\JwtAuthentication\RequestMethodRule([
                "ignore" => ["OPTIONS"]
            ])
        ],
    ]));
        
    //$app->add(JwtAuthMiddleware::class);
    //$app->add($conditionalMiddleware);
    $app->add(new TrailingSlash(false));
    
    // Catch exceptions and errors
//    $logger = new Logger('errors');

    $app->add(ErrorsHandlerMiddleware::class);
    //$app->add(WarningsAndNoticesMiddleware::class);
    $app->add(ServerErrorsHandlerMiddleware::class);
    
    $app->addErrorMiddleware(false, true, true);
//    $errorHandler = new ErrorsHandler($app->getCallableResolver(), $app->getResponseFactory(), $logger);
//    $errorMiddleware->setDefaultErrorHandler($errorHandler);
    
    //$app->add(ErrorsHandler::class);
};
