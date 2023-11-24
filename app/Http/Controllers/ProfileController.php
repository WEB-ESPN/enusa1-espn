<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);

        $user = User::create($request->toArray());

        return response($user, 200);
    }

    public function update(Request $request)
    {
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return response('Old Password is wrong!', 400);
        }

        auth()->user()->update(['password' => Hash::make($request->new_password)]);

        return response(true, 200);
    }
}
