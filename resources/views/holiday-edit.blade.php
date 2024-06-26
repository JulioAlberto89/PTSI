<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar día festivo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Información del día festivo') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Actualiza la información del día festivo") }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('holidays.update', $holiday->id) }}" class="mt-6 space-y-6">
                            @csrf
                            @method('put')

                            <!-- Nombre -->
                            <div class="w-1/5">
                                <x-input-label for="name" :value="__('Nombre')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $holiday->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <!-- Color -->
                            <div class="w-1/5">
                                <x-input-label for="color" :value="__('Color')" />
                                <x-text-input id="color" name="color" type="color" class="mt-1 block w-full" :value="old('color', $holiday->color)" required autocomplete="color" />
                                <x-input-error class="mt-2" :messages="$errors->get('color')" />
                            </div>

                            <!-- Día -->
                            <div class="w-1/5">
                                <x-input-label for="day" :value="__('Día')" />
                                <select id="day" name="day" class="mt-1 block w-full">
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ $holiday->day == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('day')" />
                            </div>

                            <!-- Mes -->
                            <div class="w-1/5">
                                <x-input-label for="month" :value="__('Mes')" />
                                <select id="month" name="month" class="mt-1 block w-full">
                                    @foreach ([
                                        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                                        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                                        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre']
                                        as $number => $name)
                                        <option value="{{ $number }}" {{ $holiday->month == $number ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('month')" />
                            </div>

                            <!-- Año -->
                            <div class="w-1/5">
                                <x-input-label for="year" :value="__('Año')" />
                                <x-text-input id="year" name="year" type="number" class="mt-1 block w-full" :value="old('year', $holiday->year)" autocomplete="year" />
                                <x-input-error class="mt-2" :messages="$errors->get('year')" />
                            </div>

                            <!-- Recurrente -->
                            <div class="w-1/5">
                                <x-input-label for="recurrent" :value="__('Recurrente')" />
                                <div class="mt-1 block w-full">
                                    <input type="checkbox" id="recurrent" name="recurrent" value="1" {{ $holiday->recurrent == 1 ? 'checked' : '' }}>
                                    <label for="recurrent">Sí</label>
                                </div>
                                <x-input-error class="mt-2" :messages="$errors->get('recurrent')" />
                            </div>

                            <div class="w-full flex items-center justify-end mt-4">
                                <x-primary-button class="ml-4">
                                    {{ __('Actualizar') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
