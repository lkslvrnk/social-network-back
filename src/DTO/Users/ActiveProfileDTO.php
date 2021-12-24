<?php
declare(strict_types=1);
namespace App\DTO\Users;

use App\DTO\Users\ConnectionDTO;
use App\DTO\Users\SubscriptionDTO;
use App\DTO\Users\PictureDTO;

class ActiveProfileDTO extends ProfileDTO {
    
    public ?PictureDTO $picture;
    public string $gender;
    public ?array $birthday;
    public string $country;
    public string $city;
    public string $status;
    public ?ConnectionDTO $connection;
    public ?SubscriptionDTO $subscription;
    public bool $banned;
    public bool $acceptMessages;
    public int $postsCount;
    
    public function __construct(
        string $id, ?PictureDTO $picture, string $firstName, string $lastName, string $username,
        string $gender, ?array $birthday,
        string $country, string $city,
        ?ConnectionDTO $connection,
        ?SubscriptionDTO $subscription,
        bool $banned, 
        string $status, bool $acceptMessages, int $postsCount
    ) {
        parent::__construct($id, $firstName, $lastName, $username);
        $this->picture = $picture;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->country = $country;
        $this->city = $city;
        $this->connection = $connection;
        $this->subscription = $subscription;
        $this->banned = $banned;
        $this->status = $status;
        $this->acceptMessages = $acceptMessages;
        $this->postsCount = $postsCount;
    }


}
