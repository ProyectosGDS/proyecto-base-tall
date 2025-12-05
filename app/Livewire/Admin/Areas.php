<?php

namespace App\Livewire\Admin;

use App\Models\Area;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class Areas extends Component
{
    use WithPagination;
    use Interactions;

    public ?int $quantity = 5;
    public ?string $search = null;
    public array $sort = [ 
        'column' => 'id',
        'direction' => 'desc',
    ];

    public array $area = [
        'name' => null,
        'area_id' => null,
    ];

    public $modal = [
        'new' => false,
        'edit' => false,
        'delete' => false,
    ];

    public function render() {
        $headers = [
            [ 'index' => 'id', 'label' => '#' ],
            [ 'index' => 'name', 'label' => 'name' ],
            [ 'index' => 'dependency.name', 'label' => 'dependencia' ],
            [ 'index' => 'action', 'sortable' => false],
        ];

        $rows = Area::when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('id', $this->search);
            })
            ->orderBy($this->sort['column'], $this->sort['direction'])
            ->paginate($this->quantity)
            ->withQueryString();
        
        $type = 'data';

        $dependencies = Area::get(['id','name'])->toArray();

        return view('livewire.admin.areas',compact('headers', 'rows', 'type','dependencies'));
    }

    public function save() {
        $this->validate([
            'area.name' => 'required|string|max:255',
            'area.area_id' => 'nullable|int|exists:areas,id',
        ]);

        Area::create([
            'name' => $this->area['name'],
            'area_id' => $this->area['area_id'] ?? null,
        ]);

        $this->toast()->success('Success','Area created successfully.')->send();

        $this->resetData();
    }

    public function edit($id) {
        $this->area = area::find($id)->toArray();
        $this->modal['edit'] = true;
    }

    public function update() {
        $this->validate([
            'area.name' => 'required|string|max:3|unique:areas,name,' . $this->area['id'],
            'area.area_id' => 'nullable|int|exists:areas,id',
        ]);

        $area = Area::find($this->area['id']);
        $area->name = $this->area['name'];
        $area->area_id = $this->area['area_id'] ?? null;
        $area->save();

        $this->toast()->success('Success','Area updated successfully.')->send();

        $this->resetData();
    }

    public function delete($id) {
        $this->area = ['id' => $id];
        $this->modal['delete'] = true;
    }

    public function destroy() {
        $area = Area::find($this->area['id']);
        $area->delete();

        $this->toast()->success('Success','Area deleted successfully.')->send();

        $this->resetData();
    }

    public function resetData() {
        $this->reset(['area','modal']);
    }
}
