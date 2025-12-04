<div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4">
    <div class="col-span-full xl:col-auto">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">                    
                <x-avatar text="NV" lg/>
                <div>
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
                    @foreach($user->sessions as $session)
                        <li  class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex shrink-0">
                                    <x-icon :name="in_array($session->os,['Android','iOS']) ? 'fas.mobile-screen' : 'fas.desktop'" class="size-6" />
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
    </div>
    <div class="col-span-2">
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold ">General information</h3>
            <form wire:submit.prevent="updateInformation">
                <div class="grid grid-cols-6 gap-4">
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="First name *" icon="fas.edit" maxlength="60" wire:model="information.first_name" required  :value="old('information.first_name')"/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="Last name *" icon="fas.edit" maxlength="60" wire:model="information.last_name" required  :value="old('information.last_name')"/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="Dpi *" icon="fas.address-card" maxlength="13" wire:model="information.cui" required  :value="old('information.cui')"/>
                    </div>
                    <div class="flex gap-4 col-span-6 sm:col-span-3">
                        <x-date label="Birthday *" icon="cake" wire:model="information.birthday" required format="YYYY, MMMM, DD"  :value="old('information.birthday')"/>
                        <div class="grid justify-items-center">
                            <label class="font-semibold text-sm text-gray-400"> Gender </label>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-1">
                                    <x-icon name="fas.person" class="size-6 text-blue-500" />
                                    <x-radio wire:model="information.gender" name="gender" color="blue" value="M" title="MALE" />
                                </label>

                                <label class="flex items-center gap-1">
                                    <x-icon name="fas.person-dress" class="size-6 text-fuchsia-500" />
                                    <x-radio wire:model="information.gender" name="gender" color="fuchsia" value="F" title="FEMALE" />
                                </label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="Email *" icon="fas.envelope" wire:model="information.email" type="email" required  :value="old('information.email')"/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="Phone *" icon="fas.phone" maxlength="8" minlength="8" wire:model="information.phone" type="tel" required  :value="old('information.phone')"/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="City" icon="fas.city" maxlength="60" wire:model="information.city" :value="old('information.city')"/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-input label="Address *" icon="fas.location-dot" maxlength="255" wire:model="information.address" :value="old('information.address')"/>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-select.native wire:model="user_to_update.role_id" 
                            :options="$roles"
                            select="label:name|value:id"
                            label="Role" 
                            icon="fas.id-card-clip"
                        />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <x-select.native wire:model="user_to_update.area_id" 
                            :options="$areas"
                            select="label:name|value:id"
                            label="Areas" 
                            icon="fas.building"
                        />
                    </div>
                    
                    <div class="col-span-6 sm:col-full">
                        <x-button
                            type="submit" 
                            text="Save all" 
                            icon="fas.save"
                            round
                            color="blue"
                            loading="updateInformation"
                        />
                    </div>
                </div>
            </form>
        </div>
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold ">Reset Password ?</h3>
            <x-button
                wire:click="resetPassword"
                text="Yes, reset password" 
                color="red"
                round 
                icon="fas.exclamation-triangle"
                loading="resetPassword"
            />
        </div>
    </div>
</div>
