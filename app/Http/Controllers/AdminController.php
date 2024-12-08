<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AdminController extends Controller
{
    public function index(){
        return view('admin.overview',[
            'users' => User::latest()->filter(request(['search']))->paginate(6),
            
        ]);
    }
    public function inactivateUser(User $user){

        $user->inactive = 1;

        $user->save();

        return view('admin.overview',[
            'users' => User::latest()->filter(request(['search']))->paginate(6),
            
        ]);
    }
    public function activateUser(User $user){

        $user->inactive = 0;

        $user->save();

        return view('admin.overview',[
            'users' => User::latest()->filter(request(['search']))->paginate(6),
            
        ]);
    }

    public function addUser(User $user){

        $user->is_admin = 1;

        $user->save();

        return view('admin.overview',[
            'users' => User::latest()->filter(request(['search']))->paginate(6),
            
        ]);
    }
    public function removeUser(User $user){

        $user->is_admin = 0;

        $user->save();

        return view('admin.overview',[
            'users' => User::latest()->filter(request(['search']))->paginate(6),
            
        ]);
    }
}
