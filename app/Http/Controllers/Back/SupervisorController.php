<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\SupervisorsRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SupervisorController extends Controller
{

    public function index()
    {
        if(!auth()->user()->ability('admin' ,
            //'manage_supervisors' ,
            'show_supervisors')){
            return redirect('admin/index');
        }
        $supervisors = User::whereHas('roles' , function($q){
            $q->whereName('supervisor');
        })
            ->when(\request()->keyword != null , function($query){
                $query->search(\request()->keyword);
            })
            ->when(\request()->status != '' , function($query){
                $query->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('back.supervisors.index' , compact('supervisors'));
    }

    public function create()
    {
        if(!auth()->user()->ability('admin' , 'create_supervisors')){
            return redirect('admin/index');
        }
        $permissions = Permission::get(['id' , 'display_name']);
        return view('back.supervisors.create' , compact('permissions'));
    }

    public function store(SupervisorsRequest $request)
    {
        if(!auth()->user()->ability('admin' , 'create_supervisors')){
            return redirect('admin/index');
        }

        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['username'] = $request->username;
        $input['email'] = $request->email;
        // $input['email_verified_at'] = now();
        $input['mobile'] = $request->mobile;
        $input['password'] = bcrypt($request->password);
        $input['status'] = $request->status;

        if($image = $request->file('user_image')){
            $file_name = Str::slug($request->username)."-".time().".".$image->getClientOriginalExtension();
            $path = public_path('/assets/users/' . $file_name);
            Image::make($image->getRealPath())->resize(300, 300 , function ($constraint){
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['user_image'] = $file_name;
        }

        $supervisor = User::create($input);
        $supervisor->markEmailAsVerified();
        $supervisor->attachRole(Role::whereName('supervisor')->first()->id);

        if(isset($request->permissions) && count($request->permissions) > 0){
            $supervisor->permissions()->sync($request->permissions) > 0;
        }
        return redirect()->route('admin.supervisors.index')->with([
            'message' => 'Created successfully',
            'alert-type'=> 'success'
        ]);
    }

    public function show(User $supervisor)
    {
        if(!auth()->user()->ability('admin' , 'display_supervisors')){
            return redirect('admin/index');
        }
        return view('back.supervisors.show' , compact('supervisor'));
    }

    public function edit(User $supervisor)
    {
        if(!auth()->user()->ability('admin' , 'update_supervisors')){
            return redirect('admin/index');
        }
        $permissions = Permission::get(['id' , 'display_name']);
        $supervisorPermissions = UserPermissions::whereUserId($supervisor->id)->pluck('permission_id')->toArray();
        return view('back.supervisors.edit' , compact('supervisor' , 'permissions' , 'supervisorPermissions'));
    }

    public function update(SupervisorsRequest $request, User $supervisor)
    {
        if(!auth()->user()->ability('admin' , 'update_supervisors')){
            return redirect('admin/index');
        }

        $input['first_name'] = $request->first_name;
        $input['last_name'] = $request->last_name;
        $input['username'] = $request->username;
        $input['email'] = $request->email;
        // $input['email_verified_at'] = now();
        $input['mobile'] = $request->mobile;
        if(trim($request->password) != ''){$input['password'] = bcrypt($request->password);}
        $input['status'] = $request->status;

        if($image = $request->file('user_image')){
            if ($supervisor->user_image != null and File::exists('assets/users/'. $supervisor->user_image)){
                unlink('assets/users/' . $supervisor->user_image);
            }
            $file_name = Str::slug($request->username)."-".time().".".$image->getClientOriginalExtension();
            $path = public_path('/assets/users/' . $file_name);
            Image::make($image->getRealPath())->resize(300, 300 , function ($constraint){
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['user_image'] = $file_name;
        }

        $supervisor->update($input);

        if(isset($request->permissions) && count($request->permissions) > 0){
            $supervisor->permissions()->sync($request->permissions) > 0;
        }

        return redirect()->route('admin.supervisors.index')->with([
            'message' => 'Update successfully',
            'alert-type'=> 'success'
        ]);

    }

    public function destroy(User $supervisor)
    {
        if(!auth()->user()->ability('admin' , 'delete_supervisors')){
            return redirect('admin/index');
        }
        if (File::exists('assets/users/'. $supervisor->user_image)){
            unlink('assets/users/' . $supervisor->user_image);
        }
        $supervisor->delete();

        return redirect()->route('admin.supervisors.index')->with([
            'message' => 'Delete successfully',
            'alert-type'=> 'success'
        ]);
    }

    public function remove_image(Request $request){
        if(!auth()->user()->ability('admin' , 'delete_supervisors')){
            return redirect('admin/index');
        }
        $supervisor = User::findOrFail($request->supervisor_id);
        if (File::exists('assets/users/'. $supervisor->user_image)){
            unlink('assets/users/' . $supervisor->user_image);
            $supervisor->user_image = null;
            $supervisor->save();
        }
        return true;
    }
}
