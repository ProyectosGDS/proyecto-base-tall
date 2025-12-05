<div>
    <div class="flex justify-center mb-4">
        <x-button.circle
            color="sky"
            wire:click="modal.new = true"
            icon="fas.plus"
        />
    </div>

    <x-table :$headers :$rows filter loading paginate striped :quantity="[5,10,20,50,100]">
        @interact('column_action', $row) 
            <x-dropdown icon="ellipsis-vertical" static>
                <x-dropdown.items icon="fas.pencil" text="Edit" wire:click="edit('{{ $row->id }}')" />
                <x-dropdown.items icon="fas.trash" text="Delete" wire:click="delete('{{ $row->id }}')" separator />
            </x-dropdown>
        @endinteract
    </x-table>

    <x-modal title="New área" wire="modal.new" icon="fas.lock" scrollable>
        <form wire:submit.prevent="save" class="grid gap-4">
            <x-input icon="fas.edit" label="Name *" wire:model="area.name" required/>
            <x-select.styled 
                wire:model="area.area_id" 
                label="Dependency"
                :options="$dependencies"
                select="label:name|value:id"
            />
            <div class="flex justify-end gap-4 items-center">
                <x-button  color="blue" wire:click="resetData" text="Cancel" icon="fas.xmark" round loading="resetData" />
                <x-button type="submit" color="dark" text="Save" icon="fas.save" round loading="save"/>
            </div>
        </form>
        
    </x-modal>

    <x-modal title="Edit área" wire="modal.edit" icon="fas.lock" scrollable>
        <form wire:submit.prevent="update" class="grid gap-4">
            <x-input icon="fas.edit" label="Name *" wire:model.defer="area.name" required/>
            <x-select.styled 
                wire:model="area.area_id" 
                label="Dependency"
                :options="$dependencies"
                select="label:name|value:id"
            />
            <div class="flex justify-end gap-4 items-center">
                <x-button  color="blue" wire:click="resetData()" text="Cancel" icon="fas.xmark" round loading="resetData" />
                <x-button type="submit" color="dark" text="Update" icon="fas.arrows-rotate" round loading="update"/>
            </div>
        </form>
    </x-modal>

    <x-modal title="Delete área" wire="modal.delete" icon="fas.lock" scrollable>
        <form wire:submit.prevent="destroy" class="grid gap-4">
            <div class="flex gap-4">
                <x-icon name="fas.exclamation-triangle" class="size-14 text-orange-500"/>
                <p class="text-lg self-center">
                    Are you sure you want to delete the area 
                    <strong>{{ $area['name'] ?? '' }}</strong>? 
                    This action cannot be undone.
                </p>
            </div>
            <div class="flex justify-end items-center gap-4">
                <x-button  color="dark" wire:click="resetData()" text="Cancel" icon="fas.xmark" round loading="resetData" />
                <x-button type="submit" color="red" text="Yes, delete" icon="fas.check" round loading="destroy"/>
            </div>
        </form>
    </x-modal>

</div>
