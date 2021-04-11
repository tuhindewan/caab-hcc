<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.employee.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeStoreRequest $request)
    {
        DB::transaction(function () use($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->mobile,
                'password' => Hash::make('123123')
            ]);

            if($user){
                Employee::create([
                    'designation' => $request->designation,
                    'department' => $request->department,
                    'mobile' => $request->mobile,
                    'user_id' => $user->id
                ]);
                $user->assignRole($request->input('roles'));
            }

            return response()->json([
                'success' => 'Employee is created successfully!'
            ]);
        });

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $roles = Role::all();
        return view('admin.employee.edit', compact('employee', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);

        DB::transaction(function () use($request, $employee) {
            DB::table('employees')->where('id', $employee->id)->update([
                'department' => $request->department,
                'designation' => $request->designation,
                'mobile' => $request->mobile
            ]);

            DB::table('users')->where('id', $employee->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->mobile
            ]);

            $user = $employee->user;
            DB::table('model_has_roles')->where('model_id',$user->id)->delete();
            $user->assignRole($request->input('roles'));

            return response()->json([
                'success' => 'Employee updated successfully!'
            ]);

        });

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        $user = $employee->user;
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $employee->user()->delete();
        return response()->json([
            'success' => 'Employee is deleted!'
        ]);
    }
}
