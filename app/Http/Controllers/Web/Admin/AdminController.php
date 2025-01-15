<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRegisterRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with(['role', 'movies'])->get();

        return view('dashboard.user.user-list', [
            'admins' => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.user.user-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRegisterRequest $request)
    {
        // dd($request->validated());

        if ($request->hasFile('image')) {
            $imagepath = Storage::disk('public')->put('admin', $request->image);
        }

        $movie = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->email,
            'image' => $imagepath,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admins.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        return view('dashboard.user.user-profile');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $admin = Admin::findorFail($id);

        // dd($admin);

        return view('dashboard.user.user-edit', [
            'admin' => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(AdminUpdateRequest $request, string $id)
    {
        $updateData = array_filter($request->validated(), function ($value) {
            return !is_null($value);
        });

        // dd($updateData);

        $admin = Admin::findOrFail($id);

        if ($request->hasFile('image')) {

            if ($admin->image) {
                Storage::disk('public')->delete($admin->image);
            }

            $updateData['image'] = Storage::disk('public')->put('admin', $request->image);
        }

        $admin->update($updateData);

        return redirect()->route('admins.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd('Admin Deleted');

        $admin = Admin::findOrFail($id);

        $admin->delete();

        if ($admin->image) {
            Storage::disk('public')->delete($admin->image);
        }

        return redirect()->route('admins.index');
    }

    public function trash()
    {
        $admins = Admin::onlyTrashed()->get();

        return view('dashboard.user.user-trash-list', ['admins' => $admins]);
    }

    public function delete($id)
    {
        $admin = Admin::onlyTrashed()->findOrFail($id);

        if ($admin->image) {
            Storage::disk('public')->delete($admin->image);
        }

        $admin->forceDelete();

        return redirect()->route('admins.trash');
    }

    public function restore($id)
    {

        $admin = Admin::onlyTrashed()->findOrFail($id);

        $admin->restore();

        return redirect()->route('admins.index');
    }
}
