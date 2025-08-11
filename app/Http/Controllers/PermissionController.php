<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;

class PermissionController extends Controller
{

    public function index(){
        $permission=ModelsPermission::orderBy("created_at","DESC")->paginate(10);

        return view('permissions.list',compact('permission'));
    }
    public function create(){
        return view('permissions.create');
    }
    public function store(Request $request){
        $validator=Validator::make($request->all(),[
       'name'=>"required|unique:permissions|min:3"
        ]);

        if($validator->passes()){
ModelsPermission::create([
    'name'=>$request->name
]);
return redirect()->route('permissions')->with('message',"Permission successfully added");
        }
        else{
            return redirect()->route('permission.create')->withErrors($validator);
        }
    }
}
