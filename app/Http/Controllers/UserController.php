<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(String $id)
    {
        $user = User::find($id);
        return view('users.user', ['user' => $user]);
    }
}
