<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Settings extends Component
{   
    public array $information = [];
    public $passwords;
    public $sessions;

    public function mount() {
        $user = Auth::user();
        $this->information = $user->information?->toArray() ?? [];
        $this->sessions = $user->sessions;
    }

    public function render() {
        return view('livewire.settings');
    }

    // use Interactions;

    // public User $user;
    // public array $information = [];
    // public array $passwords = [
    //     'current' => null,
    //     'new' => null,
    //     'new_confirmation' => null,
    // ];

    // public function mount ($id) {
    //     $this->user = User::with(['sessions','information'])
    //         ->where('id',$id)
    //         ->first();

    //     $this->information = $this->user->information->toArray();
    // }

    // public function render() {
    //     $profiles = Profile::all();
    //     return view('livewire.admin.user.show',compact('profiles'));
    // }

    // public function updateInformation () {
    //     $this->validate([
    //         'information.first_name' => 'required|string|max:255',
    //         'information.last_name' => 'required|string|max:255',
    //         'information.cui' => 'required|digits:13',
    //         'information.phone' => 'nullable|digits:8',
    //         'information.birthday' => 'required|date',
    //         'information.city' => 'required|string|max:255',
    //         'information.address' => 'required|string|max:255',
    //         'information.email' => 'required|email',
    //         'information.gender' => 'required|in:F,M',
    //         'user.profile_id' => 'nullable|exists:profiles,id',
    //     ]);

    //     $this->user->information->first_name = $this->information['first_name'];
    //     $this->user->information->last_name = $this->information['last_name'];
    //     $this->user->information->cui = $this->information['cui'];
    //     $this->user->information->phone = $this->information['phone'];
    //     $this->user->information->birthday = $this->information['birthday'];
    //     $this->user->information->city = $this->information['city'];
    //     $this->user->information->address = $this->information['address'];
    //     $this->user->information->email = $this->information['email'];
    //     $this->user->information->gender = $this->information['gender'];

    //     $this->user->information->save();

    //     $this->user->profile_id = $this->user->profile_id;
    //     $this->user->save();

    //     $this->toast()->success('Success','User information updated successfully.')->send();
    //     $this->resetData();
    // }

    // public function updatePassword () {
    //     $this->validate([
    //         'passwords.current' => 'required|string',
    //         'passwords.new' => 'required|string|min:8|confirmed',
    //     ]);

    //     if (Hash::check($this->passwords['current'], $this->user->password)) {
    //         $this->toast()->error('Error','The current password is incorrect.')->send();
    //         return;
    //     }

    //     $this->user->password = Hash::make($this->passwords['new']);
    //     $this->user->save();

    //     $this->toast()->success('Success','Password updated successfully.')->send();
    //     $this->resetData();
    // }

    // public function disableUser () {

    //     $this->user->deleted_at = now();
    //     $this->user->save();

    //     $this->toast()->success('Success','User disabled successfully.')->send();
    // }


    // public function resetData () {
    //     $this->reset('passwords');
    // }
}
