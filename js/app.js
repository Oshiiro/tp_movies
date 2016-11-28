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

// affichage de la recherche
$('.buttonrecherche1').click(function(e) {
  e.preventDefault();
  $('.buttonrecherche2').removeClass('hidden');
  $('.buttonrecherche1').addClass('hidden');
  $('.choixchoix').removeClass('hidden');
});
<<<<<<< HEAD
>>>>>>> c09fb1a32668d9fa9ac45b3fe7fff8355ba25fa5
=======

$('#plusDeFilm').click(function() {
  $(location).attr('href', 'index.php')
});


$('#zoneTel').click(function() {
  var win=window.open("http://www.zone-telechargement.com/", '_blank');
  win.focus();
});
>>>>>>> c700766156f0294b561a376c1b782014975b691d
