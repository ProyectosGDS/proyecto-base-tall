<?php

namespace App\Livewire\Admin\User;

use App\Models\Area;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use TallStackUi\Traits\Interactions;

class Show extends Component
{
    use Interactions;

    public User $user;
    public array $user_to_update = [];
    public array $information = [];

    public function mount ($id) {
        $this->user = User::with(['sessions','information'])
            ->where('id',$id)
            ->first();

        $this->user_to_update = $this->user->toArray();
        $this->information = $this->user->information->toArray();
    }

    public function render() {
        $roles = Role::all();
        $areas = Area::where('active',1)->get();
        return view('livewire.admin.user.show',compact('roles','areas'));
    }

    public function updateInformation () {
        $this->validate([
            'information.first_name' => 'required|string|max:255',
            'information.last_name' => 'required|string|max:255',
            'information.cui' => 'required|digits:13',
            'information.phone' => 'nullable|digits:8',
            'information.birthday' => 'required|date',
            'information.city' => 'required|string|max:255',
            'information.address' => 'required|string|max:255',
            'information.email' => 'required|email',
            'information.gender' => 'required|in:F,M',
            'user.profile_id' => 'nullable|exists:profiles,id',
        ]);

        $this->user->information->first_name = $this->information['first_name'];
        $this->user->information->last_name = $this->information['last_name'];
        $this->user->information->cui = $this->information['cui'];
        $this->user->information->phone = $this->information['phone'];
        $this->user->information->birthday = $this->information['birthday'];
        $this->user->information->city = $this->information['city'];
        $this->user->information->address = $this->information['address'];
        $this->user->information->email = $this->information['email'];
        $this->user->information->gender = $this->information['gender'];

        $this->user->information->save();

        $this->user->profile_id = $this->user_to_update['profile_id'];
        $this->user->area_id = $this->user_to_update['area_id'];
        $this->user->save();

        $this->toast()->success('Success','User information updated successfully.')->send();
    }

    public function resetPassword () {

        $this->user->password = Hash::make($this->user::DEFAULTPASS);
        $this->user->save();

        $this->toast()->success('Success','Password restore successfully.')->send();
    }

    public function disableUser () {

        $this->user->deleted_at = now();
        $this->user->save();

        $this->toast()->success('Success','User disabled successfully.')->send();
    }


    public function resetData () {
        $this->reset('passwords');
    }
}
