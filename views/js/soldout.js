$(".btnEditStock").click(function(){

	var idProductStock = $(this).attr("idProductStock");
    var data = new FormData();
	data.append("idProductStock", idProductStock);

	$.ajax({

		url: "ajax/soldout.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(answer){
			$("#renewStock").val(answer["stock"]);
            $("#idstock").val(answer["id"]);
		}
	})
})