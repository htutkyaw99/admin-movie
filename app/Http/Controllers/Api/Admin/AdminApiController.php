<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRegisterRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminApiController extends Controller
{
    public function index()
    {
        $admins = Admin::with(['role', 'movies'])->get();

        if (!$admins) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'No Users List',
            ], 404);
        }

        return response()->json([
            'statusCode' => 200,
            'message' => 'User Lists',
            'count' => $admins->count(),
            'data' => UserResource::collection($admins)
        ], 200);
    }

    public function show($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'User Not Found',
            ], 404);
        }

        return response()->json([
            'statusCode' => 200,
            'message' => "User $id",
            'data' => new UserResource($admin)
        ], 200);
    }

    public function store(AdminRegisterRequest $request)
    {
        if ($request->hasFile('image')) {
            $imagepath = Storage::disk('public')->put('users', $request->image);
        }

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imagepath,
            'password' => $request->password,
            'role_id' => $request->role_id,
        ]);

        return response()->json([
            'statusCode' => 201,
            'message' => "User Created!",
            'data' => new UserResource($admin)
        ], 201);
    }

    public function update(AdminUpdateRequest $request, string $id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'User Not Found!',
            ], 404);
        }

        $imagepath = null;

        if ($request->hasFile('image')) {
            $imagepath = Storage::disk('public')->put('users', $request->image);
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ];

        if ($imagepath) {
            $updateData['image'] = $imagepath;
        }

        if ($request->password) {
            $updateData['password'] = bcrypt($request->password);
        }

        $admin->update($updateData);

        return response()->json([
            'statusCode' => 200,
            'message' => "User Edited!",
            'data' => new UserResource($admin),
        ], 200);
    }

    public function destroy(string $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'User Not Found!',
            ], 404);
        }

        $admin->delete();

        return response()->json([
            'statusCode' => 200,
            'message' => "User Deleted!",
        ], 200);
    }
}
