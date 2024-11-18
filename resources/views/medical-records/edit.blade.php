<form method="POST" action="{{ route('patients.update', $patient->id) }}">
    @csrf
    @method('PUT')

    <div class="mt-4">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $patient->name)" required autofocus autocomplete="name" />
    </div>

    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $patient->email)" required autocomplete="username" />
    </div>

    <!-- Adicione outros campos aqui -->

    <div class="mt-4">
        <x-primary-button type="submit" class="ms-4">
            {{ __('Salvar Alterações') }}
        </x-primary-button>
    </div>
</form>
