<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function create(Request $request) {
    	$data = $request->input();

    	$email = $data['email'];
    	$password = $data['password'];
    	$fullname = $data['fullname'];
    	$birth_date = $data['birth_date'];

    	$user = User::where('email', $email)->first();

    	if($user) {
    		return response()->json([
				"status" => "ERROR", 
				"message" => "User already exist"
			]);
    	}
    	else {
    		User::addUser($email, $password, $fullname, $birth_date);
    		return response()->json([
				"status" => "OK", 
				"message" => "User successfully registered"
			]);
    	}
    }

    public function getUser($id, Request $request) {
		$user = User::find($id);

		if($user) {
			return response()->json([
				"status" => "OK", 
				"data" => $user
			]);
		}
		else {
			return response()->json([
				"status" => "ERROR", 
				"message" => "User does not exist"
			]);
		}
    }

    public function updateUser($id, Request $request) {
    	$data = $request->input();

    	$email = $data['email'];
    	$password = $data['password'];
    	$fullname = $data['fullname'];
    	$birth_date = $data['birth_date'];

    	$user = User::find($id)->first();

    	if(!$user) {
    		return response()->json([
				"status" => "ERROR", 
				"message" => "User does not exist"
			]);
    	}
    	else {
    		$user->email = $email;
    		$user->password = $password;
    		$user->fullname = $fullname;
    		$user->birth_date = $birth_date;

    		$user->save();

    		return response()->json([
				"status" => "OK", 
				"message" => "User successfully update"
			]);
    	}
    }

    public function deleteUser($id, Request $request) {
    	$user = User::find($id)->first();

    	if(!$user) {
    		return response()->json([
				"status" => "ERROR", 
				"message" => "User does not exist"
			]);
    	}
    	else {
    		$user->delete();
    		return response()->json([
				"status" => "OK", 
				"message" => "User successfully deleted"
			]);
    	}
    }

    public function login(Request $request) {
    	$data = $request->input();

    	$user = User::where('email', $data['email'])
    				->where('password', $data['password'])
    				->first();

    	if($user) {
    		return response()->json([
    			"status" => "OK", 
    			"token" => "s0m3r4nd0mSTR1NG"
			]);
    	}
    	else {
    		return response()->json([
    			"status" => "ERROR", 
    			"message" => "Invalid username or password"
			]);
    	}
    }
}