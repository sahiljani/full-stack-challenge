import './bootstrap';

import Alpine from 'alpinejs';
import persist from '@alpinejs/persist'

Alpine.plugin(persist)

window.Alpine = Alpine;


Alpine.start();
document.addEventListener('DOMContentLoaded', () => {
    const toggleCheckbox = document.getElementById('toggle-checkbox');

    // Check if the user has a saved theme preference in localStorage
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark');
        toggleCheckbox.checked = true;  // Set checkbox to checked if theme is dark
    } else {
        document.body.classList.remove('dark');
        toggleCheckbox.checked = false;  // Uncheck if the theme is not dark
    }

    // Listen for changes on the toggle checkbox
    toggleCheckbox.addEventListener('change', () => {
        document.body.classList.toggle('dark');  // Toggle the dark class

        // Update localStorage with the current theme preference
        if (document.body.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    });
});



   // Submit the form on filter change
   const filterForm = document.getElementById('filterForm');
   filterForm.querySelectorAll('input, select').forEach(function(element) {
       element.addEventListener('change', function() {
           filterForm.submit();
       });
   });

   // Submit the search form on search field change
   const searchForm = document.getElementById('searchForm');
   searchForm.querySelectorAll('input, select').forEach(function(element) {
       element.addEventListener('change', function() {
           searchForm.submit();
       });
   });


