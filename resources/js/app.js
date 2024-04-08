import './bootstrap';

import Alpine from 'alpinejs';



window.Alpine = Alpine;

Alpine.start();

$(document).ready(function() {
    $('.annonce-titre').click(function(e) {
        e.preventDefault();
        var descriptionId = $(this).data('description-id');
        $('#' + descriptionId).toggle('fade');
    });
});
