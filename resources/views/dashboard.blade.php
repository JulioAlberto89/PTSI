<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Página principal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Bienvenido") }}
                    <div class="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.holidays = @json($holidays);
    </script>
    <script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>
    <script src="https://unpkg.com/js-year-calendar/locales/js-year-calendar.es.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
        let tooltip = null;

        const calendarElement = document.querySelector('.calendar');
        if (calendarElement) {
            const holidays = window.holidays.map(holiday => ({
                startDate: new Date(holiday.year, holiday.month - 1, holiday.day),
                endDate: new Date(holiday.year, holiday.month - 1, holiday.day),
                color: holiday.color,
                name: holiday.name
            }));
            new Calendar(calendarElement, {
                style: 'background',
                dataSource: holidays,
                language: 'es',
                mouseOnDay: function(e) {
                    if (e.events.length > 0) {
                        var content = '';

                        for (var i in e.events) {
                            content += '<div class="event-tooltip-content">'
                                + '<div class="event-name" style="color:' + e.events[i] + '">' + e.events[i].name + '</div>'
                                + '</div>';
                        }

                        if (tooltip !== null) {
                            tooltip.destroy();
                            tooltip = null;
                        }

                        tooltip = tippy(e.element, {
                            content: content,
                            placement: 'right',
                            animation: 'shift-away',
                            arrow: true,
                            allowHTML: true
                        });
                        tooltip.show();
                    }
                },
                mouseOutDay: function() {
                    if (tooltip !== null) {
                        tooltip.destroy();
                        tooltip = null;
                    }
                },
            });
        }
    });
    </script>
</x-app-layout>
