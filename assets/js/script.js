$(function (){
    //Menu Drop/Down
    $('li').hover(function (){
       $(this).find('.menucatitem').slideDown();
   }, function (){
       $(this).find('.menucatitem').slideUp();
   });
});