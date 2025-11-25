<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function show(User $user) {
        try {
            return response([
                'information' => $user->information->append('profile_name'),
                'sessions' => $user->sessions,
                'message' => 'Load user successfully.'
            ]);
        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error laoder user information'
            ]);
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user) {
        $request->validate([
            'first_name' => 'required|string|max:60',
            'last_name' => 'required|string|max:60',
            'cui' => 'required|numeric|digits:13|unique:user_information,cui,'.$request->id,
            'gender' => 'required|in:F,M',
            'birthday' => 'required|date|date_format:Y-m-d',
            'email' => 'required|email|unique:user_information,email,'.$request->id,
            'phone' => 'required|numeric|digits:8',
            'city' => 'nullable|string|max:60',
            'address' => 'nullable|string|max:255',
        ]);

        try {

            $user->information->first_name = $request->first_name;
            $user->information->last_name = $request->last_name;
            $user->information->cui = $request->cui;
            $user->information->gender = $request->gender;
            $user->information->birthday = $request->birthday;
            $user->information->email = $request->email;
            $user->information->phone = $request->phone;
            $user->information->city = $request->city ?? null;
            $user->information->address = $request->address ?? null;
            $user->information->save();

            return response([
                'information' => $user->information,
                'message' => 'Data updated successfully.'
            ]);

        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error in data update'
            ],500);
        }
    }

    public function changePassword(Request $request, User $user) {
        $request->validate([
            'current' => 'required|string|min:8|current_password', 
            'new' => 'required|string|min:8|confirmed', 
        ]);

        try {

            $user->password = $request->new;
            $user->save();

            return response([
                'message' => 'Password updated successfully.'
            ]);

        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error in password update'
            ],500);
        }
    }

    public function uploadPicture(Request $request, User $user) {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,gif'
        ]);

        try {

            $file = $request->file('file');
            $path = $file->store('user_images');
            
            if($user->information->photo) {
                Storage::delete($user->information->photo);
            }
            
            $user->information->photo = $path;
            $user->information->save();

            return response([
                'url_photo' => Storage::url($user->information->photo),
                'message' => 'Picture upload successfully'
            ]);
            
        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error upload picture'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePicture(User $user) {
        try {

            $old_picture = $user->information->photo;

            $user->information->photo = null;
            $user->information->save();

            Storage::delete($old_picture);

            return response([
                'message' => 'Picture deleted successfully'
            ]);
        } catch (\Throwable $th) {
            return response([
                'error' => $th->getMessage(),
                'message' => 'Error deleted picture'
            ],500);
        }
    }
}
