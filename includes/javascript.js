$(function(){

  $('.col--sub-nav').on('click', 'a', function(e){
    $('.col--sub-nav a').removeClass('active');
    $(e.target).closest('a').addClass('active');
  });

});