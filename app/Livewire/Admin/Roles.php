<?php

namespace App\Livewire\Admin;

use App\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use TallStackUi\Traits\Interactions;

class Roles extends Component
{

    use WithPagination;
    use Interactions;

    public ?string $search = null;
    public ?string $search_permissions = null;
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
        'name' => null,
        'permissions' => []
    ];

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
        
        $all_permissions = Permission::where('name','like','%'.$this->search_permissions.'%')->get()->groupBy('module');

        return view('livewire.admin.roles', compact('headers', 'rows', 'type','all_permissions'));
    }

        public function save() {

        $this->validate([
            'role.name' => 'required|string|max:255',
        ]);

        $role = Role::create([
            'name' => $this->role['name'],
        ]);

        if(!empty($this->role['permissions'])) {
            $role->permissions()->sync($this->role['permissions'] ?? []);
        }

        $this->toast()->success('Success','Role created successfully.')->send();

        $this->resetData();

    }

    public function edit($id) {
        $role = Role::find($id);
        $this->role = $role->toArray();
        $this->role['permissions'] = $role->permissions->pluck('id')->toArray();
        $this->modal['edit'] = true;
    }

    public function update() {

        $this->validate([
            'role.name' => 'required|string|max:255',
        ]);

        $role = role::find($this->role['id']);

        $role->name = $this->role['name'];
        $role->save();

        $role->permissions()->sync($this->role['permissions'] ?? []);

        $this->toast()->success('Success','Role updated successfully.')->send();

        $this->resetData();

    }

    public function delete($id) {
        $this->role = role::find($id)->toArray();
        $this->modal['delete'] = true;
    }

    public function destroy () {
        $role = role::find($this->role['id']);
        $role->delete();

        $this->toast()->success('Success','Role deleted successfully.')->send();
        $this->resetData();
    }

    public function resetData() {
        $this->reset(['modal','role']);
    }
}
