<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i = 1;
        $user = User::select('*')->Orderby('name', 'DESC')->where('deleted_at', null)->paginate(5);
        return view('users.list', [
            'user' => $user,
            'i' => $i
        ]);
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
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'deleted' => now(),
            'remember_token' => $request->_token,
        ])->save();
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {

        $user = User::where('id', $id)->first();

        if (!Hash::check($request->re_password, $user->password)) {
            return back()->with('error', 'mật khẩu không đúng');
        }
        User::find($id)->update($request->all());
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        if ($user == null) {
            User::withTrashed()->where('id', $request->id)->forceDelete();
            return back();
        }
        User::where('id', $id)->delete();
        return back();
    }
    public function search(Request $request)
    {
        $search = $request->search;

        if (empty($search)) {
            $user = User::Orderby('name', 'DESC')
                ->select('*')
                ->paginate(5);
        } else {
            $user = User::Orderby('name', 'DESC')
                ->select('*')
                ->where('name', 'LIKE', '%' . $search . '%')
                ->paginate(5);
        }
        return view('users.list', compact('user'));
    }
    public function onlyTrashed()
    {
        $user =  User::onlyTrashed()->paginate(5);
        $i = 0;
        return view('users.list', compact(['user', 'i']));
    }
    public function restore(Request $request)
    {
        $check = User::where('id', $request->id)->first();
        if ($check == null) {
            User::withTrashed()->where('id', $request->id)->restore();
            return redirect()->route('user.index');
        }
    }
}
