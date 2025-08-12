<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware; 



class PermissionController extends Controller  implements HasMiddleware
{   public static function middleware():array
    {
        return[
new middleware('permission:view permissions',only:['index']),
new middleware('permission:create permissions',only:['create']),
new middleware('permission:update articles',only:['edit']),
new middleware('permission:delete permissions',only:['delete']),
        ];
    }

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



    public function delete($id){
                $permission=ModelsPermission::findOrFail($id);
                $permission->delete();
                return redirect()->back()->with('message',"Permission successfully delete");

    }
}
