<div>
    <div class="flex justify-center mb-4">
        <x-button.circle
            icon="fas.plus"
            wire:click="modal.new = true"
            color="blue"
        />
    </div>
    <x-table :$headers :$rows filter paginate loading :quantity="[5,10,20,50,100]" :$sort>
        @interact('column_action',$row)
            <x-dropdown icon="ellipsis-vertical" static>
                <x-dropdown.items icon="fas.pencil" text="Edit" wire:click="edit('{{ $row->id }}')" />
                <x-dropdown.items icon="fas.trash" text="Delete" wire:click="delete('{{ $row->id }}')" separator />
            </x-dropdown>
        @endinteract
    </x-table>

    <x-modal wire="modal.new" title="New role">
        <form wire:submit.prevent="save">
            <div class="p-4">
                <x-input wire:model="role.name" label='Name *' icon="fas.edit" required/>
                <div class="flex justify-between my-4 items-center">
                    <h3 class="font-semibold mb-2">Todos los permisos</h3>
                    <x-input 
                        wire:model.live="search_permissions"
                        label="Buscar permisos"
                        icon="fas.search"
                    />
                </div>
                <div class="grid gap-4">
                    @foreach ($all_permissions as $module => $permissions)
                    <details :open="{{ $loop->first ? true : false }}" class="border border-gray-300 p-4 rounded-lg">
                        <summary class="cursor-pointer mb-2 font-semibold flex items-center gap-2">
                            Permisos de {{ $module }}
                        </summary>
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 rounded p-4 gap-4">
                            @foreach($permissions as $permission)
                                <x-checkbox
                                    wire:model="role.permissions"
                                    :value="$permission->id"
                                    :label="$permission->name"
                                    id="{{ $permission->name }}"
                                    class="text-xs"
                                />
                            @endforeach
                        </div>
                    </details>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-around items-center mt-4">
                <x-button wire:click="resetData" icon="fas.xmark" text="Cancel" color="blue" round loading="resetData" />
                <x-button type="submit" icon="fas.save" text="Save" color="dark" round loading="save" />
            </div>
        </form>
    </x-modal>

    <x-modal wire="modal.edit" title="Edit role">
        <form wire:submit.prevent="update">
            <div class="p-4">
                <x-input wire:model="role.name" label='Name *' icon="fas.edit" required/>
                <div class="flex justify-between my-4 items-center">
                    <h3 class="font-semibold mb-2">Todos los permisos</h3>
                    <x-input 
                        wire:model.live="search_permissions"
                        label="Buscar permisos"
                        icon="fas.search"
                    />
                </div>
                <div class="grid gap-4">
                    @foreach ($all_permissions as $module => $permissions)
                    <details :open="{{ $loop->first ? true : false }}" class="border border-gray-300 p-4 rounded-lg">
                        <summary class="cursor-pointer mb-2 font-semibold flex items-center gap-2">
                            Permisos de {{ $module }}
                        </summary>
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 rounded p-4 gap-4">
                            @foreach($permissions as $permission)
                                <x-checkbox
                                    wire:model.live="role.permissions"
                                    :value="$permission->id"
                                    :label="$permission->name"
                                    id="{{ $permission->name }}"
                                    class="text-xs"
                                />
                            @endforeach
                        </div>
                    </details>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-around items-center mt-4">
                <x-button wire:click="resetData" icon="fas.xmark" text="Cancel" color="blue" round loading="resetData" />
                <x-button type="submit" icon="fas.arrows-rotate" text="Update" color="dark" round loading="update" />
            </div>
        </form>
    </x-modal>

    <x-modal wire="modal.delete" title="Delete role">
        <form wire:submit.prevent="destroy">
            <div class="flex items-center gap-4">
                <x-icon name="fas.exclamation-triangle" class="size-14 text-orange-500"  />
                <p class="text-xl font-semibold">
                    ¿ Esta seguro de quiere eliminar el role {{ $role['name'] ?? null }} ?
                </p>
            </div>
            <div class="flex justify-end gap-4 items-center">
                <x-button wire:click="resetData" text="Cancel" icon="fas.xmark" color="dark" loading="resetData" round />
                <x-button type="submit" text="Yes, delete" icon="fas.trash" color="red" loading="destroy" round />
            </div>
        </div>
    </x-modal>
</div>

