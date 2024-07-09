<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    // نمایش لیست کاربران
    public function index()
    {
        return User::all();
    }

    // نمایش جزئیات یک کاربر خاص
    public function show(User $user)
    {
        return $user;
    }

    // ذخیره کاربر جدید
    public function store(UserRequest $request)
    {
        $request['password'] = Hash::make($request['password']);
        $user = User::create($request);
        return $user;
    }

    public function checkUser()
    {

    }

    // به‌روزرسانی کاربر
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return $user;
    }

    // حذف کاربر
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }
}
