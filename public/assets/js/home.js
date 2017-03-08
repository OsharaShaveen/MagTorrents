$(document).ready(function(){
  var mySwiper = new Swiper ('.swiper-container', {
    pagination: '.swiper-pagination',
    paginationClickable: true,

    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev',
    direction: 'horizontal',
    loop: true,
    slidesPerView: 3,
    spaceBetween: 30,
    
    preventClicks: false
  });
  var load = 0;
  $(window).scroll(function(){
    if($(window).scrollTop() == ($(document).height() - $(window).height())){
      $('#loading').show();
      load = load+10;
      $.post("application/functions/ajax.php",{load:load, typeRequest: "pagination"}, function(data){
        $("#all-movies").append(data);
        $('#loading').hide();
      });
    }
  });
});
