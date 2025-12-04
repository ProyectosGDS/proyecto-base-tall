<x-app-layout>
    Bienvenido 
    <x-theme-switch lg/>

    <pre>
        {{ var_dump(Auth::user()->append('menu')->menu) }}
    </pre>
</x-app-layout>
