<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Http\Controllers\Controller;

class RolePermissionController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $roles = Role::paginate(5);

        foreach ($roles as $role){

            $role_with_permission = (DB::table('role_with_permissions')->where('role_id', $role->id)->pluck('permissions'));

            if(count($role_with_permission) > 0){
                $role_with_permission = json_decode($role_with_permission[0] ?? "[]");
            }else{
                $role_with_permission = [];
            }

            $permision_names = [];
            foreach ($role_with_permission as $permission){
                array_push($permision_names,Permission::findById($permission)->name);
            }

            $role->permissions = $permision_names;


        }

        if($request->has('search')){

            foreach ($roles as $role){
                $pattern = "/$request->search/i";

                if(! preg_match($pattern, $role->name)){
                    unset($roles[$key]);
                }
            }

            return view('role_permissions.index')->with('roles', $roles);
        }

        return view('role_permissions.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findById($id);
        $permissions = Permission::all();

        $role_with_permission = (DB::table('role_with_permissions')->where('role_id', $id)->pluck('permissions'));
        if(count($role_with_permission) > 0){
            $role_with_permission = json_decode($role_with_permission[0] ?? "[]");
        }else{
            $role_with_permission = [];
        }

        if($role){

            return view('role_permissions.edit', compact(['role', 'permissions', 'role_with_permission']));

        }else{
            return redirect()->back()->with('message','Role Not Found.');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {

            $permissions = $request->permissions;

            $data = [
                "role_id" => $id,
                "permissions" => json_encode($permissions)
            ];

            $role_with_permission = DB::table('role_with_permissions')->where('role_id', $id)->first();


            if($role_with_permission){
                //update
                DB::table('role_with_permissions')->update($data);

            }else{
                //insert
                DB::table('role_with_permissions')->insert($data);
            }

            return redirect()->back()->with('message', 'Permissions Assigned Successfully.');
        }catch (\Exception $e){
            return redirect()->back()->with('message', 'Something went wrong! ' . $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
