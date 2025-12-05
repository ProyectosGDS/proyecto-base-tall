@props(['pages' => []])

<aside
    class="fixed top-0 left-0 z-40 w-64 h-screen" :class="open_sidebar ? 'hidden' : '' ">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <a href="{{ route('home') }}" wire:navigate class="flex items-center ps-2.5 mb-5">
            <x-Logo class="h-14" />
        </a>
        <ul class="space-y-2 font-medium">
            @auth
                @foreach ($pages as $page)
                    @if ($page['state'])
                        @if($page['type'] == 'header')
                            <li class="p-3  text-gray-400 uppercase">{{ $page['header'] }}</li>
                        @else
                            @if (count($page['childrens']) > 0)
                                <li x-data="{ open_submenu: {{ request()->routeIs(mb_strtolower($page['label']).'*') ? 'true' : 'false' }} }">
                                    <button
                                        x-on:click="open_submenu = !open_submenu" 
                                        type="button" 
                                        class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer {{ request()->routeIs(mb_strtolower($page['label']).'*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                                        <x-icon :name="$page['icon']" class="size-5" />
                                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $page['label'] }}</span>
                                        <x-icon icon="chevron-down" class="w-3 h-3 shrink-0" />
                                    </button>
                                    <ul x-show="open_submenu" class="py-2 space-y-2">
                                        @foreach ($page['childrens'] as $children)
                                            <li>
                                                <a 
                                                    href="{{ $children['route'] ? route($children['route']) : '#' }}" 
                                                    class="flex cursor-pointer items-center w-full p-2 transition duration-75 rounded-lg pl-5 group hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs($children['route']) ? 'bg-gray-100 dark:bg-gray-700' : '' }}" 
                                                    wire:navigate>
                                                    <x-icon :name="$children['icon']" class="size-5" />
                                                    <span class="ms-3">{{ $children['label'] }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else	
                                <li>
                                    <a 
                                        href="{{ $page['route'] ? route($page['route']) : '#' }}" 
                                        class="flex cursor-pointer pages-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group {{ request()->routeIs($page['route']) ? 'bg-gray-100 dark:bg-gray-700' : '' }}" 
                                        wire:navigate >
                                        <x-icon :name="$page['icon']" class="size-5" />
                                        <span class="ms-3">{{ $page['label'] }}</span>
                                    </a>
                                </li>
                            @endif
                        @endif
                    @endif
                @endforeach
            @endauth
        </ul>
    </div>
    @auth
    <div class="absolute bottom-0 left-0 justify-center w-full p-4 space-x-4 bg-white lg:flex dark:bg-gray-800" sidebar-bottom-menu="">
        <x-dropdown>
            <x-slot:header>
                <p>Role: {{ auth()->user()?->role_name }}</p>
            </x-slot:header>
            <x-slot:action>
                <x-button x-on:click="show = !show" round color="blue">
                    <x-avatar text="NV" sm/>
                    {{ auth()->user()->small_name }}
                </x-button>
            </x-slot:action>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown.items icon="fas.user-cog" :text="__('Profile')" :href="route('profile')" />
                <x-dropdown.items icon="arrow-left-on-rectangle" :text="__('Logout')" onclick="event.preventDefault(); this.closest('form').submit();" separator />
            </form>
        </x-dropdown>
    </div>
    @endauth
</aside>
    

