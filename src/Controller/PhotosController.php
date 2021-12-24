<?php
declare(strict_types=1);
namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Exceptions\UnprocessableRequestException;
use App\Application\TransactionalApplicationService;
use App\Application\Users\CreateProfilePhoto\CreateProfilePhotoRequest;
use App\Application\Users\Photos\Create\CreateRequest;
use App\Application\Users\Photos\Delete\DeleteRequest;
use App\Application\Users\ProfilePicture\Create\CreateRequest as CreateProfilePictureRequest;
use App\Application\Users\ProfilePicture\Get\GetRequest as GetProfilePictureRequest;
use App\Application\Users\Photos\CreateComment\CreateCommentRequest;
use App\Application\Users\Photos\CreateReaction\CreateReactionRequest;
use App\Application\Users\Photos\Update\UpdateRequest;
use App\Application\Users\Photos\CreateCommentReaction\CreateCommentReactionRequest;
use App\Application\Users\Photos\UpdateCommentReaction\UpdateCommentReactionRequest;
use App\Application\Users\Photos\UpdateReaction\UpdateReactionRequest;
use App\Application\Users\Photos\DeleteCommentReaction\DeleteCommentReactionRequest;
use App\Application\Users\Photos\Get\GetRequest;
use App\Application\Users\Photos\UpdateComment\UpdateCommentRequest;
use App\Application\Users\Photos\DeleteReaction\DeleteReactionRequest;
use App\Application\Users\Photos\GetAll\GetAllRequest;

class PhotosController extends AbstractController {
    /**
     * @Inject
     * @var \App\Application\TransactionalSession
     */
    private $transactionalSession;
    
    /**
     * @Inject
     * @var \App\Application\Users\ProfilePicture\Create\Create
     */
    private $createProfilePicture;
    
    /**
     * @Inject
     * @var \App\Application\Users\ProfilePicture\Get\Get
     */
    private $getProfilePicture;
    
    private string $fakeId = '01f5c16qts25jhsfx8efjev0qb';
 
    
    function createProfilePicture(Request $request, Response $response) {
        $parsedBody = $request->getParsedBody() ?? [];
        
        $uploadedFiles = $request->getUploadedFiles();
        if(!ISSET($uploadedFiles['photo'])) {
            throw new UnprocessableRequestException(123, "File 'photo' should be passed");
        }
        $this->failIfRequiredParamWasNotPassed($parsedBody, ['x', 'y', 'width']);
        
        $requestDTO = new CreateProfilePictureRequest(
            $request->getAttribute('token')['data']->userId,
            $uploadedFiles['photo'],
            $parsedBody['x'], $parsedBody['y'], $parsedBody['width']
        );
        $useCase = new TransactionalApplicationService(
            $this->createProfilePicture, $this->transactionalSession
        );
        return $this->prepareResponse($response, $useCase->execute($requestDTO), 201);
    }
    
    function getProfilePicture(Request $request, Response $response) {
        $requestDTO = new GetProfilePictureRequest(
            $request->getAttribute('token')['data']['userId'],
            $request->getAttribute('id')
        );
        $useCase = new TransactionalApplicationService(
            $this->getProfilePicture, $this->transactionalSession
        );
        return $this->prepareResponse($response, $useCase->execute($requestDTO));
    }
    
}
