$(function() {
    $('a.page-scroll').on('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Met en évidence la navigation supérieure lorsque le défilement se produit
$('body').scrollspy({
    target: '.navbar-fixed-top'
});

// Ferme le menu responsive lorsqu'un élément du menu est cliqué
$('.navbar-collapse ul li a').on('click', function() {
    $('.navbar-toggle:visible').click();
});
