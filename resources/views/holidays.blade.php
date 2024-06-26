<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Días Festivos') }}
        </h2>
    </x-slot>

    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="font-bold mb-4">Lista de días festivos</h1>
                    <table class="table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Color</th>
                                <th class="px-4 py-2">Día</th>
                                <th class="px-4 py-2">Mes</th>
                                <th class="px-4 py-2">Año</th>
                                <th class="px-4 py-2">Recurrente</th>
                                <th class="px-4 py-2">Editar</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($days as $day)
                                <tr>
                                    <td class="border px-4 py-2"><a href="{{ route('holidays.edit', $day) }}">{{$day->name}}</a></td>
                                    <td class="border px-4 py-2"><span class="inline-block w-4 h-4 rounded-full" style="background-color: {{ $day->color }}"></span></td>
                                    <td class="border px-4 py-2">{{$day->day}}</td>
                                    <td class="border px-4 py-2">{{$day->month}}</td>
                                    <td class="border px-4 py-2">{{$day->year}}</td>
                                    <td class="border px-4 py-2">
                                        @if ($day->recurrent == 0)
                                            No
                                        @else
                                            Sí
                                        @endif
                                    </td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('holidays.edit', $day) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <form action="{{ route('holidays.destroy', $day) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                            <div class="mt-1 block w-full">
                                <input type="checkbox" id="recurrent" name="recurrent" value="1">
                                <label for="recurrent">Sí</label>
                            </div>
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
