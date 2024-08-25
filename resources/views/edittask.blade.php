<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $pageName }}
        </h2>
    </x-slot>

    <x-task-form :routeName="$routeName" :task="$task" :teams="$teams" />

</x-app-layout>