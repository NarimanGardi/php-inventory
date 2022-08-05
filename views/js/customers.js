 /*=============================================
	edit customer
	=============================================*/
    $(".btnEditCustomer").click(function(){
        var idCustomer = $(this).attr("idCustomer");

	var data = new FormData();
	data.append("idCustomer", idCustomer);

	$.ajax({

		url: "ajax/customers-ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(answer){
			$("#idCustomer").val(answer["id"]);
            $("#editCustomer1").val(answer["name"]);
            $("#editPhone").val(answer["phone"]);
            $("#editAddress").val(answer["address"]);
            

		}
	})
});

/*=============================================
	delete customer
	=============================================*/

$(".btnDeleteCustomer").click(function(){

	var idCustomer = $(this).attr("idCustomer");


	swal({
		title: 'دڵنیای کە دەتەوێت ئەم کریارە بسریتەوە ؟',
		text: "ئەگەر ناتەوێت پەشیمان بوونەوە داگرە",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'پەشیمان بوونەوە',
		  confirmButtonText: 'بەڵی ، بیسرەوە'
		}).then(function(result){

		if(result.value){

		  window.location = "index.php?route=customers&idCustomer="+idCustomer;

		}

	})
});