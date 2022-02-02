jQuery('document').ready(function($){
  var menuBtn = $('.menu-icon'),
  men=$('.menu');
  menuBtn.click(function(){
      if(men.hasClass('menu'))
      {
          men.removeClass('menu')
          men.addClass('show')
      }
      else
      men.addClass('show')
  });
});