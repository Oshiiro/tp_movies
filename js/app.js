
// affichage de la recherche
$('.buttonrecherche1').click(function(e) {
  e.preventDefault();
  $('.buttonrecherche2').removeClass('hidden');
  $('.buttonrecherche1').addClass('hidden');
  $('.choixchoix').removeClass('hidden');
});

$('#plusDeFilm').click(function() {
  $(location).attr('href', 'index.php')
});


$('#zoneTel').click(function() {
  var win=window.open("http://www.zone-telechargement.com/", '_blank');
  win.focus();
});
