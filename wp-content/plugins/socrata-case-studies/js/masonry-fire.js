$(window).load(function() {

  var $boxes = $('.item');
  $boxes.hide();

  var $container = $('#container');
  $container.imagesLoaded( function() {
    $boxes.fadeIn(500);

    $container.masonry({
        itemSelector : '.item',
        columnwidth: 0,
        isFitWidth: false,
        isAnimated: !Modernizr.csstransitions
    });    
  });
});