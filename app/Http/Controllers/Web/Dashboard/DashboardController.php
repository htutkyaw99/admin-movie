<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $moviesCount = DB::table('movies')->count();
        $adminsCount = DB::table('admins')->count();

        return view('dashboard.panel', [
            'moviesCount' => $moviesCount,
            'adminsCount' => $adminsCount
        ]);
    }
}
