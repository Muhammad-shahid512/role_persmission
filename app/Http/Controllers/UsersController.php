<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware; 
class UsersController extends Controller implements HasMiddleware
{

        public static function middleware():array
    {
        return[
new middleware('permission:view users',only:['index']),
new middleware('permission:create users',only:['create']),
new middleware('permission:update users',only:['edit']),
new middleware('permission:delete users',only:['delete']),
        ];
    }
    public function index(){
      $users=User::latest()->paginate(5);
      return view('users.listuser',compact("users"));
    }
    public function create(){
        return view('users.create');
    }

    public function store(Request $request){
        
     $validator=Validator::make($request->all(),[
       'name'=>"required",
       'email'=>"required|email|unique:users,email",
       'password'=>"required|min:8"
        ]);

        if($validator->passes()){
  $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
return redirect()->route('users')->with('message',"User Created successfully");

        }
        else{
            return redirect()->route('user.create')->withErrors($validator);

        }

      

    }


    public function edit($id){
        $users=User::findOrFail($id);
        $hasroles=$users->roles->pluck('id');
// dd($hasroles);
        $roles=Role::orderBy("name","ASC")->get();
        return view('users.edit',[
            'user'=>$users,
            'roles'=>$roles,
            'hasroles'=>$hasroles,
        ]);
    }

    public function update(Request $request,$id){
                $user=User::findOrFail($id);

         $validator=Validator::make($request->all(),[
       'name'=>"required",
       'email'=>'required|email|unique:users,email,'.$id.',id',
        ]);


        if($validator->passes()){
$user->name=$request->name;
$user->email=$request->email;
$user->save();
$user->syncRoles($request->roles);
return redirect()->route('users')->with('message',"Permission successfully added");

        }
        else{
            return "lol";
        }
    }




        public function delete($id){
        $users=User::findOrFail($id);
  $users->delete();
  return redirect()->route('users')->with('message',"User delete successfully");

    }
}
