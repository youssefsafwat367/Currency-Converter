<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Assistant;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use \App\Traits\uploadFile;
    public function index(Request $request)
    {
        try {
            $users = User::where('type' , 'user')->latest()->with('assistant')->get();
            return view('pages.users.index', compact('users'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('pages.users.create', compact('roles'));
    }

    public function store(UserRequest $request)
    {

        try {
            $request->validate(
                [
                    'password' => 'required|same:confirm-password',
                    'avatar' => 'required|mimes:jpg,jpeg,png',

                ]
            );
            DB::beginTransaction();

            $user = User::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'avatar' => $request->file('avatar')->getClientOriginalName(),
                    'status' => $request->status,
                    'role' => $request->role[0] ,
                    'type' => 'user'
                ]
            );
            Assistant::create(
                [
                    'userId' => $user->id,
                    'nationalId' => $request->nationalId,
                    'personalPhoneNumber' => $request->personalPhoneNumber,
                    'personalWhatsappNumber' => $request->personalWhatsappNumber,
                    'notes' => $request->notes,
                    'maximumDiscount' => $request->maximumDiscount,
                    'incentive' => $request->incentive,
                    'birthDate' => $request->birthDate,
                    'discount' => $request->discount,
                    'salary' => $request->salary,
                    'gender' => $request->gender,
                ]
            );
            $this->uploadFile($request, 'avatar', $user->id,  'upload_attachments');

            $user->assignRole($request->input('role'));
            DB::commit();
            toastr()->success('تم اضافة المستخدم بنجاح');
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('pages.users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name')->all();
        $userRole = $user->roles->pluck('name')->first();
        return view('pages.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(UserRequest $request, $id)
    {
        try {

            DB::beginTransaction();


            User::find($id)->update(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'status' => $request->status,
                    'role' => $request->role
                ]
            );
            Assistant::where('userId', $id)->first()->update(
                [
                    'userId' => $id,
                    'nationalId' => $request->nationalId,
                    'personalPhoneNumber' => $request->personalPhoneNumber,
                    'personalWhatsappNumber' => $request->personalWhatsappNumber,
                    'maximumDiscount' => $request->maximumDiscount,
                    'incentive' => $request->incentive,
                    'discount' => $request->discount,
                    'salary' => $request->salary,
                    'gender' => $request->gender,
                ]
            );
            $user =  User::find($id);
            $role = $user->role;
            $assistant = Assistant::where('userId', $id)->first();
            // password
            if ($request->filled('password')) {
                $user->update(
                    [
                        'password' =>  Hash::make($request->password)
                    ]
                );
                $user->save();
            }
            // notes
            if ($request->filled('notes')) {
                $assistant->update(
                    [
                        'notes' => $request->notes
                    ]
                );
                $assistant->save();
            }

            // avatar image
            $this->uploadFile($request, 'avatar', $user->id,  'upload_attachments');

            // roles
            DB::table('model_has_roles')->where('model_id', $id)->delete();

            $user->assignRole($role);


            DB::commit();
            toastr()->warning('تم تعديل المستخدم بنجاح');
            return redirect()->route('users.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }


    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        toastr()->error('تم حذف المستخدم بنجاح');
        return redirect()->route('users.index');
    }
}
