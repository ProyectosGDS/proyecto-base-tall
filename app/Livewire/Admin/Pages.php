<?php

namespace App\Livewire\Admin;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;

class Pages extends Component
{
    use WithPagination;
    use Interactions;

    public ?string $search = null;
    public ?int $quantity = 5;
    public array $page = [
        'id' => null,
        'label' => null,
        'icon' => null,
        'route' => null,
        'order' => null,
        'page_id' => null,
        'type' => null,
    ];
    public array $sort = [
        'column' => 'id',
        'direction' => 'desc'
    ];
    public $modal = [
        'new' => false,
        'edit' => false,
        'delete' => false,
    ];

    public function render() {
        $headers = [
            [ 'index' => 'id', 'label' => '#' ],
            [ 'index' => 'label', 'label' => 'label' ],
            [ 'index' => 'route', 'label' => 'route' ],
            [ 'index' => 'icon', 'label' => 'icon' ],
            [ 'index' => 'order', 'label' => 'order' ],
            [ 'index' => 'state', 'label' => 'state' ],
            [ 'index' => 'type', 'label' => 'type' ],
            [ 'index' => 'parent.label', 'label' => 'parent' ],
            [ 'index' => 'permission_name', 'label' => 'permission' ],
            [ 'index' => 'action', 'sortable' => false ],

        ];

        $rows = Page::with(['parent'])
            ->when($this->search,function($query){
                $query->where('label','like','%'.$this->search.'%')
                    ->orWhere('id',$this->search);
            })
            ->orderBy(...array_values($this->sort)) 
            ->paginate($this->quantity)
            ->withQueryString();

        $type = 'data';

        $parents = Page::where('type','parent')->get(['id','label'])->toArray();

        return view('livewire.admin.pages', compact('headers','rows', 'type', 'parents'));
    }

    public function save() {

        $this->validate([
            'page.label' => 'required|string|max:255',
            'page.icon' => 'nullable|string|max:255',
            'page.route' => 'nullable|string|max:255',
            'page.order' => 'nullable|int',
            'page.type' => 'required|string|in:header,parent,page',
            'page.page_id' => 'required_if:type,page|nullable|int|exists:pages,id',
        ]);

        Page::create([
            'label' => $this->page['label'],
            'icon' => $this->page['icon'] ?? null,
            'route' => $this->page['route'] ?? null,
            'order' => $this->page['order'] ?? null,
            'type' => $this->page['type'],
            'page_id' => $this->page['page_id'] ?? null,
        ]);

        $this->toast()->success('Success','Page created successfully.')->send();

        $this->resetData();

    }

    public function edit($id) {
        $this->page = Page::find($id)->toArray();
        $this->modal['edit'] = true;
    }

    public function update() {

        $this->validate([
            'page.label' => 'required|string|max:255',
            'page.icon' => 'nullable|string|max:255',
            'page.route' => 'nullable|string|max:255',
            'page.order' => 'nullable|int',
            'page.type' => 'required|string|in:header,parent,page',
            'page.page_id' => 'required_if:type,page|nullable|int|exists:pages,id',
            'page.permission_name' => 'nullable|string|max:255',
        ]);

        $page = Page::find($this->page['id']);

        $page->label = $this->page['label'];
        $page->icon = $this->page['icon'] ?? null;
        $page->route = $this->page['route'] ?? null;
        $page->order = $this->page['order'] ?? null;
        $page->type = $this->page['type'];
        $page->page_id = $this->page['page_id'] ?? null;
        $page->permission_name = $this->page['permission_name'] ?? null;

        $page->save();

        $this->toast()->success('Success','Page updated successfully.')->send();

        $this->resetData();

    }

    public function delete($id) {
        $this->page = Page::find($id)->toArray();
        $this->modal['delete'] = true;
    }

    public function destroy () {
        $page = Page::find($this->page['id']);
        $page->delete();

        $this->toast()->success('Success','Page deleted successfully.')->send();
        $this->resetData();
    }

    public function resetData() {
        $this->reset(['modal','page']);
    }
}
