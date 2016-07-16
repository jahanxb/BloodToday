	 	 <script type="text/javascript">

		 function country() {
		 $('#country1').empty();
		 $('#country1').append("<option> Loading --- </option>");
		 $('#province1').append("<option value='0'>--Select Province-- </option>");
		 $.ajax({
		 type:"POST",
		 url:"country_dropdown.php",
		 contentType:"application/json; charset=utf-8",
		 datatype:"json",
		 success: fuction(data) {
		 $('#country1').empty();
		 $('#country1').append("<option value='0'>-- Select Country---</option>");
		 $.each(data,function(i,item){
		 	 $('#country1').append('<option value="'+data[i].CountryID + '">'+ data[i].CountryName +'</option>');
		 });
		 },

		  complete : function() {
		 		 
		 	}
		 });
		 }
		 $(document).ready(function(){

 			alert('after func');
		 	country();
			alert('after func');

		 });

	 	 function province(id) {
	 	 $('#province1').empty();
	 	 $('#province1').append("<option> Loading --- </option>");
	 	 $.ajax ({
	 	 type:"POST",
	 	 url:"province_dropdown.php?id"+id,
	 	 contentType:"application/json"
		  charset:"utf-8",
	 	 dataType:"json",
	 	 success: function(data){
	 	 $('#province1').empty();
	 	 $('#province1').append("<option value='0'> --Select Province-- </option>");
	 	 $.each(data,function(i.item)
	 	 $('#province1').append('<option value="'+data[i].ProvinceID+'">'+data[i].ProvinceName+'</option>');
	 	 });
	 	 complete: function() {

	 	 }
	 	 });

	 	 }

	 </script>
