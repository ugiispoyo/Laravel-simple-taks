<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (
            $request->email === 'admin@test.com' &&
            $request->password === '123456'
        ) {
            session(['token' => 'my-secret-token']);
            return redirect('/tasks');
        }

        return back()->withErrors([
            'message' => 'Invalid credentials'
        ]);
    }

}
