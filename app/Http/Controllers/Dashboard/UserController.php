<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Storage;
use Illuminate\Validation\Rule;


class UserController extends Controller
{   

    public function __construct()
    {
        //CRUD => users permission to access only have function that matched
        //ana kda bamn3 users from url access
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }
    public function index(Request $request)
    {   
        /*if($request->search){
            //dd($request->all());
            $users= User::where('first_name', 'like', '%'.$request->search.'%')
                        ->orWhere('last_name', 'like', '%'.$request->search.'%')
                        ->get();
        }else{
            //$users=User::all();
             $users=User::whereRoleIs('admin')->get();
        }*/

        //another advanced way for search
        //when like if , why i use it ? to check if serach 
        $users=User::whereRoleIs('admin')->when($request->search, function($query) use($request){//why use use($request)? to access request from this outside scope
                return $query->where('first_name','like','%'.$request->search.'%')
                             ->orWhere('last_name','like','%'.$request->search.'%');
 
          })->latest()->paginate(5); 
       // })->get();
        
        return view('dashboard.users.index',compact('users'));
    }

    
    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {   
        //Dump and Die => dd()
        //dd($request->all());
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|unique:users',
            'image'=>'image',
            'password'=>'required|confirmed',
            'permissions'=>'required|min:1',
            
        ]);
        
        $request_data=$request->except(['password','password_confirmation','permissions','image']);
        $request_data['password']=bcrypt($request->password);

        if($request->image)
        {
            // create instance
            Image::make($request->image)
                  ->resize(300, null, function ($constraint) {   // resize the image to a width of 300 and constrain aspect ratio (auto height)
                    $constraint->aspectRatio();
                   })->save(public_path('uploads/users_images/'.$request->image->hashName()));
            //ready to store image of name after hashName()
            $request_data['image']=$request->image->hashName();
        }
        $user=User::create($request_data);
        $user->attachRole('admin');//get this from laratrust_seeders.php
        $user->syncPermissions($request->permissions);//add this in db link between users and roles

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.users.index');
    }


 

   
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>['required',Rule::unique('users')->ignore($user->id)],//search on all users m3da user->id da
            'image'=>'image',
            'permissions'=>'required|min:1',
        ]);
        
        $request_data=$request->except(['permissions','image']);
        
        if($request->image)
        {
            if($user->image != 'default.png')
            {
                 //public_uploads that custom added on config/filessystem.php
                 Storage::disk('public_uploads')->delete('/users_images/'.$user->image);
            }
                         
            // create instance
            Image::make($request->image)
                    ->resize(300, null, function ($constraint) {   // resize the image to a width of 300 and constrain aspect ratio (auto height)
                    $constraint->aspectRatio();
                    })->save(public_path('uploads/users_images/'.$request->image->hashName()));
            //ready to store image of name after hashName()
            $request_data['image']=$request->image->hashName();
        }
        $user->update($request_data);
        $user->syncPermissions($request->permissions);//add this in db link between users and roles
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.users.index');
    }


    public function destroy(User $user)
    {
        if($user->image != 'default.png')
        {
            //public_uploads that custom added on config/filessystem.php
            Storage::disk('public_uploads')->delete('/users_images/'.$user->image);
        }
        $user->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}
