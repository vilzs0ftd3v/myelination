$(document).ready(function(){

$.ajax({
	url:"home/displayData",
	//url:"data/home/home_data.php",
	method:"GET",
	dataType:"json",
	success:function(data){
		console.log(data);
		console.log("hel");
	}
})

});