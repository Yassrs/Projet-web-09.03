/**
 * Ludothèque — Scripts principaux
 * Projet Web APP 2026 - ECE ING3
 */

$(document).ready(function() {
    
    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);

    // Confirm delete actions
    $('[data-confirm]').on('click', function(e) {
        if (!confirm($(this).data('confirm'))) {
            e.preventDefault();
        }
    });

    // Password confirmation validation
    $('form').on('submit', function() {
        var pwd = $(this).find('[name="mot_de_passe"]').val();
        var confirm = $(this).find('[name="confirm_mot_de_passe"]').val();
        if (pwd && confirm && pwd !== confirm) {
            alert('Les mots de passe ne correspondent pas.');
            return false;
        }
    });

    // Tooltip initialization
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (el) {
        return new bootstrap.Tooltip(el);
    });

    // Active nav link highlighting based on URL
    var currentPath = window.location.pathname;
    $('.navbar-nav .nav-link').each(function() {
        var href = $(this).attr('href');
        if (href && currentPath.indexOf(href.replace(/^.*\/\/[^\/]+/, '')) === 0) {
            $(this).addClass('active');
        }
    });
});
