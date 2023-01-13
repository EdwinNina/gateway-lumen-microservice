<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponse;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * Return books list
     * @return Illuminate\Http\Response
    */
    public function index()
    {
        $user = User::get();

        return $this->validResponse($user, Response::HTTP_OK);
    }

    /**
     * Create an instance of user
     * @return Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);
        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);

        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Return an specific user
     * @return Illuminate\Http\Response
    */
    public function show($user)
    {
        $user = User::findOrFail($user);

        return $this->successResponse($user);
    }

    /**
     * Create the information of an existing user
     * @return Illuminate\Http\Response
    */
    public function update(Request $request, $user)
    {
        $this->validate($request, [
            'name' => 'max:255',
            'email' => 'email|unique:users,email,' . $user,
            'password' => 'min:8|confirmed',
        ]);

        $user = User::findOrFail($user);

        $user->fill($request->all());

        if($request->has('password')){
            $user->password = Hash::hash($request->password);
        }

        if($user->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $user->save();

        return $this->successResponse($user);
    }

    /**
     * Remove an existing user
     * @return Illuminate\Http\Response
    */
    public function destroy($user)
    {
        $user = User::findOrFail($user);

        $user->delete();

        return $this->successResponse($user);
    }

    /**
     * Remove an existing user
     * @return Illuminate\Http\Response
    */
    public function me(Request $request)
    {
        return $this->validResponse($request->user());
    }
}
