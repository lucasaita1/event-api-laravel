<?php

namespace App\Dto;

class UserRequest

{
    public $name;
    public $email;
    public $cpf;
    public $password;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->cpf = $data['cpf'];
        $this->password = $data['password'];
    }


}
