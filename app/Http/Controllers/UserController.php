<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, $id)
    {
        $user = User::find($id);

        if (Auth::user()->id != $user->id && !Auth::user()->is_admin) return redirect("home");

        return view('user.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $id)
    {
        $validationFields = [
            'name' => 'required|string|max:255',
        ];

        $user = User::find($id);

        if ($request->email != $user->email) {
            $validationFields["email"] = 'required|string|email|max:255|unique:users';
        }

        $validated = $request->validate($validationFields);

        if (isset($validated["email"])) {
            $user->email = $validated["email"];
        }

        $user->name = $validated["name"];

        $user->save();

        return redirect()->back()->with("status", __("user.edit.success"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (Auth::user()->id != $user->id && !Auth::user()->is_admin) return redirect("home");
        $user->delete();
        return redirect()->back();

    }
}

