<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{
    public function showAdmins()
    {
        try {
            $admins = User::where('role', 'admin')->get();
            return view('admin_dashboard.superadmin', ['admins' => $admins]);
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function addAdmin(Request $request)
    {
        try {
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'admin'
            ]);

            return redirect('/dashboard/admins');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function deleteAdmin($id)
    {
        try {
            User::findOrFail($id)->delete();
            return redirect('/dashboard/admins');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

    public function updateAdmin(Request $request, $id)
    {
        try {
            User::findOrFail($id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return redirect('/dashboard/admins');
        } catch (Exception $e) {
            return response('Something is wrong ' . $e->getMessage());
        }
    }

}
