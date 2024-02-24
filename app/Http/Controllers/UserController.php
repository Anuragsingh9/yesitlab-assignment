<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validation = $request->validate([
                'name' => 'required|regex:/^[a-zA-Z\s]*$/',
                'email' => 'required|email|unique:users',
                'mobile_number' => 'required|digits:10',
                'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'password' => 'required|min:8',
            ]);

            $param = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_number,
                'password' => Hash::make($request->password),
            ];

            if ($request->hasFile('profile_pic')) {
                $imagePath = $request->file('profile_pic')->store('public/profile_pics');
                $param['profile_pic'] = $imagePath;
            }

            $user = User::create($param);
            return response()->json(['status' => true, 'data' => 'User created successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['status' => false, 'error' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validation = $request->validate([
                'name' => 'required|regex:/^[a-zA-Z\s]*$/',
                'mobile_number' => 'required|digits:10',
                'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'password' => 'required|min:8',
            ]);

            $param = [
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_number,
                'password' => Hash::make($request->password),
            ];

            if ($request->hasFile('profile_pic')) {
                $imagePath = $request->file('profile_pic')->store('public/profile_pics');
                $param['profile_pic'] = $imagePath;
            }

            $user = User::whereId($id)->update($param);

            // $user = User::create($param);
            return response()->json(['status' => true, 'data' => 'User created successfully'], 200);
        } catch (ValidationException $e) {
            return response()->json(['status' => false, 'error' => $e->validator->errors()->all()], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
