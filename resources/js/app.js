import Calendar from "js-year-calendar";
import "js-year-calendar/dist/js-year-calendar.css";
import "js-year-calendar/locales/js-year-calendar.es";
console.log(Calendar.locales);
import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
