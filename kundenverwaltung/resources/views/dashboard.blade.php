<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <p>You're logged in!</p>
        <ul>
            <li>Delete Project</li>
            <li>edit Company</li>
            <li>delete Company</li>
            <li>delete customer</li>
        </ul>
    </div>
</x-app-layout>
