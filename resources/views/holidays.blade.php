<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Días Festivos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Lista de días festivos</h1>
                    @foreach ($days as $day)
                        <p><a href="{{ route('holidays.edit', $day) }}">
                            <span class="font-bold">Nombre:</span> {{$day->name}}
                            <span class="font-bold">Color:</span>
                            <span class="inline-block w-4 h-4 rounded-full" style="background-color: {{ $day->color }}"></span>
                            <span class="font-bold">Día:</span> {{$day->day}}
                            <span class="font-bold">Mes:</span> {{$day->month}}
                            <span class="font-bold">Año:</span> {{$day->year}}
                            <span class="font-bold">Recurrente:</span>
                            @if ($day->recurrent == 0)
                                No
                            @else
                                Sí
                            @endif
                        </a></p>
                        <form action="{{ route('holidays.destroy', $day) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
{{-- ////////////////////////////////////////////////////////////// --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Agregar Día Festivo</h1>

                    <form method="POST" action="{{ route('holidays.store') }}" class="flex flex-wrap gap-4">
                        @csrf

                        <!-- Nombre -->
                        <div class="w-1/5">
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Color -->
                        <div class="w-1/5">
                            <x-input-label for="color" :value="__('Color')" />
                            <x-text-input id="color" name="color" type="color" class="mt-1 block w-full" :value="old('color')" required autocomplete="color" />
                            <x-input-error class="mt-2" :messages="$errors->get('color')" />
                        </div>

                        <!-- Día -->
                        <div class="w-1/5">
                            <x-input-label for="day" :value="__('Día')" />
                            <select id="day" name="day" class="mt-1 block w-full">
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
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
                                    <option value="{{ $number }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('month')" />
                        </div>

                        <!-- Año -->
                        <div class="w-1/5">
                            <x-input-label for="year" :value="__('Año')" />
                            <x-text-input id="year" name="year" type="number" class="mt-1 block w-full" :value="old('year')" autocomplete="year" />
                            <x-input-error class="mt-2" :messages="$errors->get('year')" />
                        </div>

                        <!-- Recurrente -->
                        <div class="w-1/5">
                            <x-input-label for="recurrent" :value="__('Recurrente')" />
                            <select id="recurrent" name="recurrent" class="mt-1 block w-full">
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('recurrent')" />
                        </div>

                        <div class="w-full flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Agregar') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
