<<<<<<< HEAD
// $('.buttonrecherche').on('submit',function(e) {
//   e.preventDefault();
//   $('.choixchoix').removeClass('hide');
// })
$('.choixchoix').on('submit',function(e) {
  e.preventDefault();
  $('.choixchoix').hide();
})
$('.').mouseleave(function(e) {
  e.preventDefault();
  $('.choixchoix').hide();
})
=======


$('.buttonrecherche1').click(function(e) {
  e.preventDefault();
  $('.buttonrecherche2').removeClass('hidden');
  $('.buttonrecherche1').addClass('hidden');
  $('.choixchoix').removeClass('hidden');
});
>>>>>>> c09fb1a32668d9fa9ac45b3fe7fff8355ba25fa5
