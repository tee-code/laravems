<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::paginate(5);

        $roles = Role::all();

        foreach ($users as $user){

            if($user->role_id){
                $user->role = Role::findById($user->role_id)->name;
                $role_with_permission = (DB::table('role_with_permissions')->where('role_id', $user->role_id)->pluck('permissions'));

                $role_with_permission = json_decode($role_with_permission[0] ?? "[]");

                $permision_names = [];



                foreach ($role_with_permission as $permission){
                    array_push($permision_names,Permission::findById($permission)->name);
                }

                $user->permissions = collect($permision_names);
            }


        }


        if( $request->has('search')){
            $users = User::where('username','like',"%{$request->search}%")
                ->orWhere('email','like',"%{$request->search}%")
                ->paginate(5);
        }


        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        //Create new user
        User::create([
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name,
            "username"=>$request->username,
            "email"=>$request->email,
            "password"=> Hash::make($request->password)
        ]);

        //redirect back to index with response message

        return redirect()->route('users.index')->with('message', 'User Successfully Created.');

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
    public function edit(User $user)
    {
        if($user->role_id){
            $role_id = Role::findById($user->role_id)->pluck('id');
        }else{
            $role_id = null;
        }

        $roles = Role::all();

        $users = User::all();

        $data = [
            "users" => $users,
            "user" => $user
        ];

        return view('users.edit',compact('data', 'role_id', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {


        $user->update([
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name,
            "username"=>$request->username,
            "email"=>$request->email,
            "role_id" => $request->role
        ]);


        return redirect()->route('users.index')->with('message', 'User Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(auth()->user()->id == $user->id){
            return redirect()->route('users.index')->with('message','Sorry! You can not delete yourself.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('message','User Successfully Deleted.');

    }
}
