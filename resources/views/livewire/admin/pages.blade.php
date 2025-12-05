<div>
    <div class="flex justify-center mb-4">
        <x-button.circle
            icon="fas.plus"
            wire:click="modal.new = true"
            color="blue"
        />
    </div>
    <x-table :$headers :$rows filter paginate loading :quantity="[5,10,20,50,100]" :$sort>
        @interact('column_preview',$row)
            <x-icon :name="$row->icon" class="size-6" />
        @endinteract

        @interact('column_action',$row)
            <x-dropdown icon="ellipsis-vertical" static>
                <x-dropdown.items icon="fas.pencil" text="Edit" wire:click="edit('{{ $row->id }}')" />
                <x-dropdown.items icon="fas.trash" text="Delete" wire:click="delete('{{ $row->id }}')" separator />
            </x-dropdown>
        @endinteract
    </x-table>

    <x-modal wire="modal.new" title="New page">
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-2 gap-4">
                <x-input wire:model="page.label" label='Label *' icon="fas.edit" required/>
                <x-input wire:model="page.icon" label='Icon' icon="fas.edit" />
                <x-input wire:model="page.route" label='Route' icon="fas.edit" />
                <x-input wire:model="page.order" label='Order' icon="fas.edit" />
                <x-select.native 
                    wire:model="page.type" 
                    label="Type *" 
                    :options="['','header','parent','page']"
                    required
                />
                <x-select.styled 
                    wire:model="page.page_id" 
                    label="Parent"
                    :options="$parents"
                    select="label:label|value:id"
                />
                <x-select.styled 
                    wire:model="page.permission_name" 
                    label="Permissions *"
                    :options="$permissions_pages"
                    select="label:name|value:name"
                    required
                />

            </div>
            <div class="flex justify-around items-center mt-4">
                <x-button wire:click="resetData" icon="fas.xmark" text="Cancel" color="blue" round loading="resetData" />
                <x-button type="submit" icon="fas.save" text="Save" color="dark" round loading="save" />
            </div>
        </form>
    </x-modal>

    <x-modal wire="modal.edit" title="Edit page">
        <form wire:submit.prevent="update">
            <div class="grid grid-cols-2 gap-4">
                <x-input wire:model="page.label" label='Label *' icon="fas.edit" required/>
                <x-input wire:model="page.icon" label='Icon' icon="fas.edit" />
                <x-input wire:model="page.route" label='Route' icon="fas.edit" />
                <x-input wire:model="page.order" label='Order' icon="fas.edit" />
                <x-select.native 
                    wire:model="page.type" 
                    label="Type *" 
                    :options="['','header','parent','page']"
                    required
                />
                <x-select.styled 
                    wire:model="page.page_id" 
                    label="Parent"
                    :options="$parents"
                    select="label:label|value:id"
                />
                <x-select.styled 
                    wire:model.live="page.permission_name" 
                    label="Permissions *"
                    :options="$permissions_pages"
                    select="label:name|value:name"
                    required
                />

            </div>
            <div class="flex justify-around items-center mt-4">
                <x-button wire:click="resetData" icon="fas.xmark" text="Cancel" color="blue" round loading="resetData" />
                <x-button type="submit" icon="fas.arrows-rotate" text="Update" color="dark" round loading="update" />
            </div>
        </form>
    </x-modal>

    <x-modal wire="modal.delete" title="Delete page">
        <form wire:submit.prevent="destroy">
            <div class="flex items-center gap-4">
                <x-icon name="fas.exclamation-triangle" class="size-14 text-orange-500"  />
                <p class="text-xl font-semibold">
                    ¿ Esta seguro de quiere eliminar la pagina {{ $page['label'] ?? null }} ?
                </p>
            </div>
            <div class="flex justify-end gap-4 items-center">
                <x-button wire:click="resetData" text="Cancel" icon="fas.xmark" color="dark" loading="resetData" round />
                <x-button type="submit" text="Yes, delete" icon="fas.trash" color="red" loading="destroy" round />
            </div>
        </div>
    </x-modal>
</div>
