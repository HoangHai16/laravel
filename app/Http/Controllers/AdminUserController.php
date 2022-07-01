<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Hash;
use DB;
use Session;

Session_start();

use Illuminate\Support\Facades\Redirect;

class AdminUserController extends Controller
{
    private $user;
    private $role;
    private $roleuser;
    public function __construct(User $user, Role $role, RoleUser $roleuser)
    {
        $this->user = $user;
        $this->role = $role;
        $this->roleuser = $roleuser;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->paginate(5);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $this->user->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);

        foreach ($request->role_id as $role) {
            $role_user = $this->roleuser->create([
                'user_id' => $user->id,
                'role_id' => $role
            ]);
        }

        return redirect()->route('users.index');
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
        $roles = $this->role->all();
        // Lay gtri trong db ra
        $user = $this->user->find($id);
        $rolesOfUser = RoleUser::where('user_id', $user->id)->get();

        return view('admin.user.edit', compact('roles', 'user', 'rolesOfUser'));
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
        $this->user->find($id);
        $this->user->find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);



        $user = $this->user->find($id);
        
        $rolesOfUsers = RoleUser::where('user_id', $user->id)->get();


        foreach ($rolesOfUsers as $rolesOfUser){
            $roleUserId= $rolesOfUser->user_id;
            $rolesOfUser->delete();
        }

        foreach($request->role_id as $role){
            $roleuser= new RoleUser;
            $roleuser->user_id= $roleUserId;
            $roleuser->role_id= $role;
            $roleuser->save();
        }


        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('id', $id)->delete();
        DB::table('role_user')->where('user_id', $id)->delete();
        Session::put('message', 'Xoa thanh cong');

        return redirect()->route('users.index');
    }
}
