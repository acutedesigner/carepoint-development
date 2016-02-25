// You will need this for the menu toggle
jQuery(document).ready(function($){

  //------ MAIN MENU ------//
  $('.to-main-nav').click(function(e) {
    e.preventDefault();
    $('#primary-nav').slideToggle();
  });
  $(window).resize(function(){
    var winwidth = $(window).innerWidth();
    if(winwidth > 900){
      $('#primary-nav').removeAttr("style");
    }
  });

  //------ SEARCH FORM ------//
  $('.search-toggle').click(function(e) {
    e.preventDefault();
    $('.block-form').slideToggle();
  });

  $('.atoz-toggle').click(function(e){
    e.preventDefault();
    $('.block-atoz-index').slideToggle();
  });



  //------ EMAIL FORM ------//
  $('.email-form-button').click(function(e){
    e.preventDefault();
    $('.email-form').slideToggle();
  });

  $('.bxslider').bxSlider({
    adaptiveHeight: true,
    auto: true,
    mode: 'fade',
    captions: true,
    controls: false
  });

  //------ TOOLTIPS ------//

  $('.tooltip').tooltipster({
    multiple:true
  });

  function last_child() {
    if ($.browser.msie && parseInt($.browser.version, 10) <= 8) {
      $('*:last-child').addClass('last-child');
    }
  }

});

jQuery(window).load(function(){


  // http://codepen.io/micahgodbolt/pen/FgqLc
  // NOTE! Refactor this code

  //------ EQUAL HEIGHTS HOME PAGE -----//

  // Get all the heights and store them in an array
  home_arr = new Array();

  jQuery('.block-thumb').find('.text-block').each(function(index){
    home_arr.push( jQuery( this ).height()+20 );
  });

  // Sort the array | Get the new height
  newheight = home_arr.sort(function(a, b){return a-b}).pop();

  // Apply the height value of the tallest to
  // all elements other elements of that type
  jQuery('.block-thumb').find('.text-block').css('min-height', newheight)


  //------ EQUAL HEIGHTS LANDING PAGES -----//

  // Get all the heights and store them in an array
  land_arr = new Array();

  jQuery('.text-block-green, .text-block-blue').each(function(index){
    land_arr.push( jQuery( this ).height()+20 );
  });

  console.log(land_arr.sort(function(a, b){return a-b}));

  // Sort the array | Get the new height
  newheight = land_arr.sort(function(a, b){return a-b}).pop();

  // Apply the height value of the tallest to
  // all elements other elements of that type
  jQuery('.text-block-green, .text-block-blue').css('height', newheight)



});
