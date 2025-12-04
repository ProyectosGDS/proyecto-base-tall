<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use TallStackUi\Traits\Interactions;

class Roles extends Component
{

    use WithPagination;
    use Interactions;

    public ?string $search = null;
    public ?int $quantity = 5;
    public array $sort = [
        'column' => 'id',
        'direction' => 'desc'
    ];
    public $modal = [
        'new' => false,
        'edit' => false,
        'delete' => false,
    ];

    public array $role = [
        'id' => null,
        'name' => null,
        'permissions' => [],
    ];
    public array $permissions = [];

    public function render() {
         $headers = [
            [ 'index' => 'id', 'label' => '#' ],
            [ 'index' => 'name', 'label' => 'name' ],
            [ 'index' => 'action', 'sortable' => false ],

        ];

        $rows = Role::with(['permissions'])
            ->when($this->search,function($query){
                $query->where('name','like','%'.$this->search.'%')
                    ->orWhere('id',$this->search);
            })
            ->orderBy(...array_values($this->sort)) 
            ->paginate($this->quantity)
            ->withQueryString();

        $type = 'data';

        return view('livewire.admin.roles', compact('headers', 'rows', 'type'));
    }
}
