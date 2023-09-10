<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function changePassword(Request $request)
    {
        try {
            Admin::where('id', auth()->id())->update([
                'password' => Hash::make($request->password)
            ]);

            return response()->json(['success' => 'Password Changed Successfully']);
        } catch (Exception $ex) {
            return response()->json(['success' => $ex->getMessage()]);
        }
    }

    public function changeEmail(Request $request)
    {
        try {
            Admin::where('id', auth()->id())->update([
                'email' => $request->email
            ]);

            return response()->json(['success' => 'Email address Changed Successfully']);
        } catch (Exception $ex) {
            return response()->json(['success' => $ex->getMessage()]);
        }
    }
}
