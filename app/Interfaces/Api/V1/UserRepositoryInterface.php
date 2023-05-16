<?php

namespace App\Interfaces\Api\V1;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function getUserById();

}
