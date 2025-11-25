<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        try {
            return response([
                'profiles' => Profile::with(['menu','role'])->latest('id')->get(),
                'message' => 'Get all profiles successfully.'
            ]);
        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Message example.'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'role_id' => 'required|integer|exists:roles,id',
            'menu_id' => 'required|integer|exists:menus,id',
        ]);

        try {
            $profile = Profile::create([
                'name' => $request->name,
                'description' => $request->description ?? null,
                'role_id' => $request->role_id,
                'menu_id' => $request->menu_id,
            ]);

            return response([
                'profile' => $profile,
                'message' => 'create profile successfully.'
            ]);
        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error created profile.'
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'role_id' => 'required|integer|exists:roles,id',
            'menu_id' => 'required|integer|exists:menus,id',
        ]);

        try {
            
                $profile->name = $request->name;
                $profile->description = $request->description ?? null;
                $profile->role_id = $request->role_id;
                $profile->menu_id = $request->menu_id;
                $profile->save();

            return response([
                'profile' => $profile,
                'message' => 'update profile successfully.'
            ]);
        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error updated profile.'
            ]);
        }
    }

    public function destroy(Profile $profile) {
        try {
            $profile->delete();
            return response([
                'profile' => $profile,
                'message' => 'Delete profile successfully.'
            ]);
        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error deleted profile.'
            ]);
        }
    }
}
