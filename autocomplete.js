var MIN_LENGTH = 3;
$( document ).ready(function() {
	$("#country1").keyup(function() {
		var country = $("#country1").val();
		if (country.length >= MIN_LENGTH) {
			$.get( "country_dropdown.php", { country: country } )
			  .done(function( data ) {
			    console.log(data);
			  });
		}
	});

});