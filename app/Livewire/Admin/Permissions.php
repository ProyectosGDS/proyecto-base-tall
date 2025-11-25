<?php

namespace App\Livewire\Admin;

use App\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class Permissions extends Component
{
    use WithPagination;
    use Interactions;

    public ?int $quantity = 5;
    public ?string $search = null;
    public array $sort = [ 
        'column' => 'id',
        'direction' => 'desc',
    ];

    public array $permission = [];

    public $modal = [
        'new' => false,
        'edit' => false,
        'delete' => false,
    ];

    public function render() {
        $headers = [
            [ 'index' => 'id', 'label' => '#' ],
            [ 'index' => 'name', 'label' => 'name' ],
            [ 'index' => 'module', 'label' => 'module' ],
            [ 'index' => 'guard_name', 'label' => 'guard name' ],
            [ 'index' => 'action'],
        ];

        $rows = Permission::when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('module', 'like', '%' . $this->search . '%')
                        ->orWhere('id', $this->search);
            })
            ->orderBy($this->sort['column'], $this->sort['direction'])
            ->paginate($this->quantity)
            ->withQueryString();
        
        $type = 'data';

        return view('livewire.admin.permissions',compact('headers', 'rows', 'type'));
    }

    public function save() {
        $this->validate([
            'permission.name' => 'required|string|max:255',
            'permission.module' => 'required|string|max:255',
        ]);

        Permission::create([
            'name' => $this->permission['name'],
            'module' => $this->permission['module'],
            'guard_name' => 'web',
        ]);

        $this->toast()->success('Success','Permission created successfully.')->send();

        $this->resetData();
    }

    public function edit($id) {
        $this->permission = Permission::find($id)->toArray();
        $this->modal['edit'] = true;
    }

    public function update() {
        $this->validate([
            'permission.name' => 'required|string|max:3|unique:permissions,name,' . $this->permission['id'],
            'permission.module' => 'required|string|max:255',
        ]);

        $permission = Permission::find($this->permission['id']);
        $permission->name = $this->permission['name'];
        $permission->module = $this->permission['module'];
        $permission->save();

        $this->toast()->success('Success','Permission updated successfully.')->send();

        $this->resetData();
    }

    public function delete($id) {
        $this->permission = ['id' => $id];
        $this->modal['delete'] = true;
    }

    public function destroy() {
        $permission = Permission::find($this->permission['id']);
        $permission->delete();

        $this->toast()->success('Success','Permission deleted successfully.')->send();

        $this->resetData();
    }

    public function resetData() {
        $this->reset(['permission','modal']);
    }
}
