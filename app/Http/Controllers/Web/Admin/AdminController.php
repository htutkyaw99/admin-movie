<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRegisterRequest;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();

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
        $adminData = $request->validated();

        $image = $request->file('image');

        $fileName = time() . '_' . $image->getClientOriginalName();

        $filePath = $image->storeAs('uploads', $fileName);

        $adminData['image'] = $filePath;

        $admin = new Admin($adminData);

        $admin->save();

        dd($admin);

        return redirect()->route('admins.index')->with('info', 'New admin has been granted');
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

        return view('dashboard.user.user-edit', [
            'admin' => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd('Admin Updated', $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd('Admin Deleted');
    }
}
