<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $log = auth()->attempt($credentials);
        if (!$log) {
            return response()->json(['message' => 'username atau password salah'], 401);
        }

        $user = User::where('username', $request->username)->first();
        $token = $user->createToken('web-token')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token], 200);
    }


    public function profile(Request $request)
    {
        $user = $request->user();
        return response()->json([
            "data" => $user
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'berhasil logout'], 200);
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        // $path = "";
        // if ($request->image) {
        //     $path = $this->uploadFile($request->image);
        // }
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        return response()->json([
            "data" => $user
        ], 200);
    }

    public function index(Request $request)
    {
        $data = User::where('username', 'LIKE', '%' . $request->cari . '%')
            // ->whereHas(
            //     'tag',
            //     function ($q) use ($tag) {
            //         $q->where('nama', 'LIKE', '%' . $tag . '%');
            //     }

            // )
            ->orderBy('created_at', 'DESC')->paginate($request->total ?? 10);

        return UserResource::collection($data);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'message' => 'Berhasil hapus User',
            'data' => $user,
        ], 200);
    }
}
