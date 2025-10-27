<?php

namespace App\Http\Controllers;
use App\Services\UserService;
use App\DTO\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    /**
     * @var \App\Services\UserService
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function findAll(){
        return response()->json($this->userService->findAll());
    }

    public function findById($id)
    {
        $user = $this->userService->findById((int)$id);

        if(!$user){
            return response()->json(['ERROR' => 'User not found'], 404);
        }

        return response()->json($user);

    }

    public function create(Request $request)
    {
        try {
            $dto = new UserRequest($request->only(['name','email','cpf','password']));
            $user = $this->userService->create($dto);
            return response()->json($user, 201);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }
    }


}
