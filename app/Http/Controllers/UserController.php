<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use Response;

    public function register()
    {
        $validador = Validator::make(request()->all(), [
            'email' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'document_type' => 'required|string|min:2',
            'document_number' => 'required|string|min:6',
        ]);

        if ($validador->fails()) {
            return $this->error($validador->errors(), 400);
        }

        $usuario = User::create([
            'email' => request('email'),
            'document_type' => request('document_type'),
            'document_number' => request('document_number'),
            'name' => request('name'),
            'password' => bcrypt(request('document_number')),
        ]);

        $usuario->save();
        // $token = $this->guard()->login($usuario);
        return $this->success(['message' => 'User created successfully'], 201);
        // return $this->success(['message' => 'User created successfully', 'token' => $token], 201);
    }
    public function index()
    {

        $items = User::select([
            'email',
            'id',
            // 'document_type' => request('document_type'),
            // 'document_number',
            'name',
            // 'password' => bcrypt(request('document_number')),
        ])->get();


        return $this->success($items, 201);
    }
}
