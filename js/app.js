// affichage de la recherche
$('.buttonrecherche1').click(function(e) {
  e.preventDefault();
  $('.buttonrecherche2').removeClass('hidden');
  $('.retour').removeClass('hidden');
  $('.buttonrecherche1').addClass('hidden');
  $('.choixchoix').removeClass('hidden');
});


// désaffichage de la recherche
$('.retour').click(function(e) {
  e.preventDefault();
  $('.buttonrecherche2').addClass('hidden');
  $('.retour').addClass('hidden');
  $('.buttonrecherche1').removeClass('hidden');
  $('.choixchoix').addClass('hidden');
});

// plus de films
$('#plusDeFilm').click(function() {
  $(location).attr('href', 'index.php')
});

// zone telechargement
$('#zoneTel').click(function() {
  var win=window.open("http://www.zone-telechargement.com/", '_blank');
  win.focus();
});

// cocher
$('#allGenres').click(function() {
  $("input[type=checkbox]").prop( "checked", true )
});

// décocher
$('#noGenres').click(function() {
  $("input[type=checkbox]").prop( "checked", false )
});


//  NOTATION étoiles

$('#rating-input-1-1').click(function(e) {
  e.preventDefault();

      $.ajax({
        method : "POST",
        url : url,
        data : $(this).serialize(),
        success : function(response) {
          console.log("SUCCESS", response);

          $('.votrenote').html( "Cimer pour le vote!");

        } // Success
      }) // Ajax POST


})
