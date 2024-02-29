<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


    
class UserController extends Controller
{
    public function status(){
        return view('request.pending');
    }
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();

        return redirect()->route('users.index')->with('success', 'User approved successfully');
    }

   // UserController.php

// UserController.php

public function reject($id)
{
    $user = User::findOrFail($id);
    $user->status = 'rejected';
    $user->save();

    \Log::info('User rejected:', ['user_id' => $id]);

    return redirect()->route('users.index')->with('success', 'User rejected successfully');
}

}
