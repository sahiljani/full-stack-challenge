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
        toggleCheckbox.checked = true;  
    } else {
        document.body.classList.remove('dark');
        toggleCheckbox.checked = false; 
    }

    // Listen for changes on the toggle checkbox
    toggleCheckbox.addEventListener('change', () => {
        document.body.classList.toggle('dark'); 

        if (document.body.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    });
});


function previewImage(event, previewId) {
    const input = event.target;
    const preview = document.getElementById(previewId);
    const file = input.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}



   // Toggle filter drawer on mobile
   const filterToggleBtn = document.getElementById('filterToggleBtn');
   const filterDrawer = document.getElementById('filterDrawer');
   const closeFilterBtn = document.getElementById('closeFilterBtn');
   
   if (filterToggleBtn && filterDrawer && closeFilterBtn) {
       filterToggleBtn.addEventListener('click', () => {
           filterDrawer.classList.toggle('hidden');
           filterDrawer.firstElementChild.classList.toggle('-translate-x-full');
       });
   
       closeFilterBtn.addEventListener('click', () => {
           filterDrawer.classList.add('hidden');
           filterDrawer.firstElementChild.classList.add('-translate-x-full');
       });
   
       filterDrawer.addEventListener('click', (e) => {
           if (e.target === filterDrawer) {
               filterDrawer.classList.add('hidden');
               filterDrawer.firstElementChild.classList.add('-translate-x-full');
           }
       });
   }
   
   // Submit the form on filter change (Mobile)
   const filterFormMobile = document.getElementById('filterFormMobile');
   if (filterFormMobile) {
       filterFormMobile.querySelectorAll('input, select').forEach(function(element) {
           element.addEventListener('change', function() {
               filterFormMobile.submit();
           });
       });
   }
   
   // Submit the form on filter change (Desktop)
   const filterFormDesktop = document.getElementById('filterFormDesktop');
   if (filterFormDesktop) {
       filterFormDesktop.querySelectorAll('input, select').forEach(function(element) {
           element.addEventListener('change', function() {
               filterFormDesktop.submit();
           });
       });
   }
   
 

