$(".btnEditQarz").click(function(){

	var idSale = $(this).attr("idSale");
    var data = new FormData();
	data.append("idSale", idSale);

	$.ajax({

		url: "ajax/qarz.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(answer){
            $("#changePayment").html(answer["paymentMethod"]);
            $("#changePayment").val(answer["paymentMethod"]);
            $("#idPayment").val(answer["id"]);
		}
	})
})