<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'DESC');
        if($request->search){
            $searchQuery=$request->search;
            $users = $users->where('full_name',"like" ,"%$searchQuery%")
            ->orwhere('email','like', "%$searchQuery%")
            ->orwhere('role','like', "%$searchQuery%");
        }
        $users = $users->paginate(10);
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'full_name' => 'string|required',
                'username' => 'string|nullable',
                'email' => 'email|required|unique:users,email',
                'password' => 'min:4|required',
                'phone' => 'string|nullable',
                'photo' => 'required',
                'address' => 'string|nullable',
                'role' => 'required|in:admin,customer,vendor',
                'status' => 'required|in:active,inactive',
            ]
        );

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        // save data
        $status = User::create($data);
        if ($status) {
            return redirect()->route('user.index')->with('success', 'Successfully Crated User');
        } else {
            return  back()->with('error', 'Some thing went wrong');
        }
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
        $user = User::find($id);
        if ($user) {
            return view('backend.users.edit', compact('user'));
        } else {
            return back()->with('error', 'Data Not Found');
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
        $user = User::find($id);
        if ($user) {
            $this->validate(
                $request,
                [
                    'full_name' => 'string|required',
                    'username' => 'string|nullable',
                    // 'email' => 'email|required|unique:users,email'
                    'phone' => 'string|nullable',
                    // 'photo' => 'required',
                    'address' => 'string|nullable',
                    'role' => 'required|in:admin,waiter,vendor',
                    'status' => 'required|in:active,inactive',
                ]
            );

            $data = $request->all();
            
            if($data['password']){
            $data['password'] = Hash::make($request->password);
                
            } else {
                  $data['password'] = $user->password; 
            }
            // save data
            $status = $user->fill($data)->save();
            if ($status) {
                return redirect()->route('user.index')->with('success', 'Successfully Updated User');
            } else {
                return  back()->with('error', 'Some thing went wrong');
            }
        } else {
            return back()->with('error', 'Data Not Found');
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
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Successfully Deleted User');
        } else {
            return back()->with('error', 'Data Not Found');
        }
    }


    /**
     * userStatus // active -inactive
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userStatus(Request $request)
    {
        if ($request->mode) {
            DB::table('users')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('users')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully update', 'status' => true]);
    }
}
