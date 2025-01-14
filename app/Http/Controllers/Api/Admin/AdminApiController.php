<?php

namespace App\Http\Controllers\Api\Admin;

use App\Api\ResponseTrait;
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
    use ResponseTrait;

    public function index()
    {
        $admins = Admin::with(['role', 'movies'])->get();

        if (!$admins) {
            return $this->error(404, 'User List Not Found!');
        }

        return $this->ok(200, 'Users List', UserResource::collection($admins));
    }

    public function show($id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return $this->error(404, 'User Not Found!');
        }

        return $this->ok(200, "User $id", new UserResource($admin));
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

        return $this->ok(201, "User Created", new UserResource($admin));
    }

    public function update(AdminUpdateRequest $request, string $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return $this->error(404, 'User Not Found!');
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

        return $this->ok(200, 'User Edited', new UserResource($admin));
    }

    public function destroy(string $id)
    {
        $admin = Admin::find($id);

        if (!$admin) {
            return $this->error(404, 'User Not Found!');
        }

        $admin->delete();

        return $this->ok(200, 'User Deleted');
    }
}
