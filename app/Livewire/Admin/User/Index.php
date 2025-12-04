<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?int $quantity = 10;
    public ?string $search = null;
    public array $sort = [ 
        'column' => 'id',
        'direction' => 'desc',
    ];

    public $user;

    public $modal = [
        'new' => false,
        'edit' => false,
        'delete' => false,
    ];

    public function render() {
        $headers = [
            [ 'index' => 'id', 'label' => '#' ],
            [ 'index' => 'cui', 'label' => 'cui' ],
            [ 'index' => 'information.first_name', 'label' => 'first name' ],
            [ 'index' => 'information.last_name', 'label' => 'last name' ],
            [ 'index' => 'information.gender', 'label' => 'gender' ],
            [ 'index' => 'information.birthday', 'label' => 'birthday' ],
            [ 'index' => 'information.email', 'label' => 'email' ],
            [ 'index' => 'area.name', 'label' => 'area' ],
            [ 'index' => 'role_name', 'label' => 'role' ],
            [ 'index' => 'deleted_at', 'label' => 'active' ]
        ];

        $rows = User::with(['information','area'])
            ->when($this->search, function($query) {
                $query->where('cui', 'like', '%' . $this->search . '%')
                    ->orWhereHas('information', function($q) {
                        $q->where('first_name', 'like', '%' . $this->search . '%')
                          ->orWhere('last_name', 'like', '%' . $this->search . '%')
                          ->orWhere('email', 'like', '%' . $this->search . '%');
                    });
            })
            ->paginate($this->quantity)
            ->withQueryString();
        
        $type = 'data';

        return view('livewire.admin.user.index',compact('headers', 'rows', 'type'));
    }

    public function edit($id) {
        $this->user = User::find($id);
        $this->modal['edit'] = true;
    }

    public function resetData() {
        $this->reset(['user','modal']);
    }
}
