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
}
