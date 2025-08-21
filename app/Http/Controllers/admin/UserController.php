<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->get();
        return view('admin.user', compact('users'));
    }

    public function show($id)
    {
        $users = DB::table('users')->where('id', $id)->first();
        return view('admin.users-detail', compact('users'));
    }

    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('admin.users.index')->with('success', 'User Berhasil Di Delete');
    }
}