<div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4">
    <div class="col-span-full xl:col-auto">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">                    
                
                <div>
                    <h3 class="mb-1 text-xl font-bold ">Profile picture</h3>
                    <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                        JPG, GIF or PNG. Max size of 800K
                    </div>
                    <div class="flex items-center space-x-4">
                        <x-button.circle color="secondary" icon="fas.arrows-rotate" title="Upload image"/>
                        <x-button.circle color="secondary" icon="fas.upload" title="Save picture" />
                        <x-button.circle color="secondary" icon="fas.trash" title="Delete picture"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="flow-root">
                <h3 class="text-xl font-semibold ">Sessions</h3>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($sessions as $session)
                        <li  class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex shrink-0">
                                    <x-icon icon="{{ in_array($session->os,['Android','iOS']) ? 'fas.mobile-screen' : 'fas.desktop' }}" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-base font-semibold truncate ">
                                        {{ $session->ip_address }}
                                    </p>
                                    <p class="text-sm font-normal text-gray-500 truncate dark:text-gray-400">
                                        {{ $session->browser.' - '.$session->os }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center">
                                    <p class="text-xs font-normal text-gray-500 truncate dark:text-gray-400">
                                        {{ $session->last_activity->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="flex gap-5 items-center justify-between">
                <h3 class="text-xl font-semibold ">Themes</h3>
                <x-theme-switch lg/>
            </div>
        </div>
    </div>
    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold ">General information</h3>
            <form>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="First name" icon="fas.edit" maxlength="60" wire:model="information.first_name" required />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="Last name" icon="fas.edit" maxlength="60" wire:model="information.last_name" required />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="Dpi" icon="fas.address-card" maxlength="13" wire:model="information.cui" required />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="Birthday" icon="cake" wire:model="information.birthday" type="date" required />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="Email" icon="fas.envelope" wire:model="information.email" type="email" required />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="Phone" icon="fas.phone" maxlength="8" minlength="8" wire:model="information.phone" type="tel" required />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="City" icon="fas.city" maxlength="60" wire:model="information.city"/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="Address" icon="fas.location-dot" maxlength="255" wire:model="information.address"/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="Role" icon="fas.id-card-clip" wire:model="user.role_name" disabled/>
                    </div>
                    <div class="col-span-6 sm:col-full">
                        <x-button
                            type="submit" 
                            text="Save all" 
                            icon="fas.save"
                            round
                            color="blue"
                        />
                    </div>
                </div>
            </form>
        </div>
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold ">Password information</h3>
            <form>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <x-input wire:model="passwords.current" label="Current password" icon="fas.key" type="password" placeholder="*******" required />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input wire:model="passwords.new" label="New password" icon="fas.lock" type="password" placeholder="*******" required />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input wire:model="passwords.new_confirmation" label="Confirm password" icon="fas.lock" type="password" placeholder="*******" required />
                    </div>
                    <div class="col-span-6 sm:col-full">
                        <x-button 
                            type="submit" 
                            text="Save all" 
                            icon="fas.save" 
                            round
                            color="blue"
                        />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
