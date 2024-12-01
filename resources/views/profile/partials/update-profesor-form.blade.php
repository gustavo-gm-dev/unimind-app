<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Alterar Professor') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Selecione um novo professor para associar.") }}
        </p>
    </header>

    <form method="post" action="{{ route('professor.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="professor" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Professor</label>
            <select 
                name="professor" 
                id="professor" 
                class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                required
            >
                <option value="">Selecione um professor</option>
                @foreach ($listProfessor as $professor)
                    <option value="{{ $professor->id }}" @if($professor->id == $user->professor_id) selected @endif>
                        {{ $professor->name }}
                    </option>
                @endforeach
            </select>
            @error('professor')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Salvar') }}</x-primary-button>

            @if (session('status') === 'professor-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Salvo.') }}</p>
            @endif
        </div>
    </form>
</section>
