<?php
declare(strict_types=1);
namespace App\Domain\Model\Users\Comments\Photo;

use App\Domain\Repository;

interface PhotoRepository extends Repository {
    function getById(string $id): ?Photo;
}
