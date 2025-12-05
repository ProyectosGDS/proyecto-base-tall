@props(['pages' => []])

<div>
    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <a href="{{ route('home') }}" class="flex items-center ps-2.5 mb-5">
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
                                    <li>
                                        <button type="button" class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer " aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                                            <x-icon :name="$page['icon']" class="size-5" />
                                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $page['label'] }}</span>
                                            <x-icon icon="chevron-down" class="w-3 h-3 shrink-0" />
                                        </button>
                                        <ul id="dropdown-example" class="hidden py-2 space-y-2">
                                            @foreach ($page['childrens'] as $children)
                                                <li>
                                                    <a href="{{ $children['route'] ? route($children['route']) : '#' }}" class="flex cursor-pointer items-center w-full p-2 transition duration-75 rounded-lg pl-5 group hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->routeIs($children['route']) ? 'bg-gray-100 dark:bg-gray-700' : '' }}" >
                                                    <x-icon :name="$children['icon']" class="size-5" />
                                                    <span class="ms-3">{{ $children['label'] }}</span>
                                                </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else	
                                    <li>
                                        <a href="{{ $page['route'] ? route($page['route']) : '#' }}" class="flex cursor-pointer pages-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 group" >
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
    
</div>
