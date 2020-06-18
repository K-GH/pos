<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index()
    {
        $users=User::all();
        return view('dashboard.users.index',compact('users'));
    }

    
    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        //
    }


 

   
    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }


    public function destroy(User $user)
    {
        //
    }
}
