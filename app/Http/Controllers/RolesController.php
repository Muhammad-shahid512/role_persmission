<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(){

        $roles=Role::orderBy("name","ASC")->paginate(10);
return view("Roles.show",compact('roles'));
    }

    public function create(){
                $permission=ModelsPermission::orderBy("created_at","DESC")->paginate(100);

        return view('Roles.create',compact('permission'));
    }

    public function store(Request $request){
        
        // dd($request->all());


               $validator=Validator::make($request->all(),[
       'name'=>"required|unique:permissions|min:3"
        ]);

        if($validator->passes()){
$role=Role::create([
    'name'=>$request->name
]);

if(!empty($request->permissions)){
foreach($request->permissions as $value){
    $role->givePermissionTo($value);
}
}
return redirect()->route('roles')->with('message',"Permission successfully added");
        }
        else{
            return redirect()->route('permission.create')->withErrors($validator);
        }
    }









    public function edit($id){
        // return $id;
        $role=Role::findOrFail($id);
        $haspermissions=$role->permissions->pluck("name");
        $permission=ModelsPermission::orderBy("created_at","DESC")->paginate(100);

        return view('Roles.edit',[
            'permission'=>$permission,
            'haspermissions'=>$haspermissions,
            'role'=>$role,
        ]);

        // dd($permission);
    }

    public function update(Request $request,$id){
        // return $request;
                $role=Role::findOrFail($id);
                // return $role;
       $validator=Validator::make($request->all(),[
       'name'=>'required|unique:roles,name,'.$id.',id',
        ]);

        if($validator->passes()){
         $role->name=$request->name;
         $role->save();


if(!empty($request->permissions)){
$role->syncPermissions($request->permissions);

}
else{
$role->syncPermissions([]);

}
return redirect()->route('roles')->with('message',"Permission successfully added");
        }
        else{
            return redirect()->route('permission.create')->withErrors($validator);
        }
    }

    public function destroy($id){
                $role=Role::findOrFail($id);
$role->delete();


return redirect()->back()->with('delete',"Role Delete Successfully ");



    }
}
