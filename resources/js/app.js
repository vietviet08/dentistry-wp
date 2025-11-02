import "./bootstrap";
import Alpine from "alpinejs";
import "./charts";

// Expose Alpine globally BEFORE Livewire loads
window.Alpine = Alpine;

// DON'T call Alpine.start() - Livewire will do it
// Alpine.start(); // <- REMOVED
