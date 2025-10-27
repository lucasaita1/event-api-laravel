<?php

namespace App\Dto;

class UserResponse
{
    public $id;
    public $name;
    public $email;
    public  $cpf;

    public function __construct($user)
    {
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->cpf = $user->cpf;
    }
}
