<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pacientes') }}
        </h2>
    </x-slot>
    <div class="pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-add-client/>
        </div>
    </div>
    <div class="pt-1">
        <div class="flex items-center justify-center">
            <div class="max-w-2xl w-full p-6 bg-white shadow-lg rounded-lg">
                <x-client-attract/>
            </div>
        </div>
    </div>
    <div class="pt-8">
        <div class="flex items-center justify-center">
            <div class="max-w-6xl w-full p-6 bg-white shadow-lg rounded-lg">
                <x-table-client/>
            </div>
        </div>
    </div>
</x-app-layout>
