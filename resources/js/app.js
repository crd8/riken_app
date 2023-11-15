import './bootstrap';

import Alpine from 'alpinejs';

import 'flowbite';


window.Alpine = Alpine;

Alpine.start();
/**
 * switch tema dark dan light
*/
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
} else {
    document.documentElement.classList.remove('dark')
}

var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    themeToggleLightIcon.classList.remove('hidden');
} else {
    themeToggleDarkIcon.classList.remove('hidden');
}

var themeToggleBtn = document.getElementById('theme-toggle');

themeToggleBtn.addEventListener('click', function() {

    // toggle icons inside button
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');

    // if set via local storage previously
    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }

    // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }
    
});

/**
 * validate input email pattern
*/
document.addEventListener('alpine:init', () => {
    Alpine.directive('input', (el, { expression, modifiers }, { evaluateLater, cleanup }) => {
        const evaluate = evaluateLater(expression);
        
        const inputHandler = () => {
            evaluate();
            // Validasi format email jika modifier 'email' digunakan
            if (modifiers.includes('email')) {
                validateEmail(el);
            }
        };

        el.addEventListener('input', inputHandler);

        cleanup(() => {
            el.removeEventListener('input', inputHandler);
        });
    });

    // Fungsi untuk validasi format email
    const validateEmail = (el) => {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const isValid = emailPattern.test(el.value);

        if (!isValid) {
            el.setCustomValidity('Invalid email format');
        } else {
            el.setCustomValidity('');
        }
    };
});


// document.addEventListener('alpine:init', () => {
//     Alpine.directive('input', (el, { expression }, { evaluateLater, cleanup }) => {
//         const evaluate = evaluateLater(expression);
        
//         const inputHandler = () => {
//             evaluate();
//         };

//         el.addEventListener('input', inputHandler);

//         cleanup(() => {
//             el.removeEventListener('input', inputHandler);
//         });
//     });
// });
