<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index(){
      $users=User::latest()->paginate(5);
    //   return $users;
      return view('users.listuser',compact("users"));
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
}
