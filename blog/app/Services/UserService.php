<?php

namespace App\Services;

use App\Models\User;
use App\Dto\UserRequest;
use App\Dto\UserResponse;
use Illuminate\Validation\ValidationException;

class UserService
{

    public function findAll(){

        User::all()->map(function ($Response) {
            return new UserResponse($Response);
        });
    }

    public function findById($id){

        $user = User::find($id);
        return $user ? new UserResponse($user):null;

        //or
//        if ($user) {
//            return new UserResponse($user);
//        } else {
//            return null;
//        }
    }

    public function create(UserRequest $request){

        if (User::where ('email', $request->email)->exists()){
            throw ValidationException::withMessages(['email' => 'Email já cadastrado']);
        }
        if (User::where('cpf', $request->cpf)->exists()){
            throw ValidationException::withMessages(['cpf' => 'CPF já cadastrado']);
        }

        $response = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Salva automaticamente encrypatada
            'cpf' => $request->cpf
        ]);

        return new UserResponse($response);
    }
}
