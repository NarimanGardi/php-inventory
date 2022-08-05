/*=============================================
New code for new products
=============================================*/

$("#newCategory1").change(function(){
    var idCategore = $(this).val();
    var datas = new FormData();
    datas.append("idCategore",idCategore);
    $.ajax({
		url: "ajax/products.ajax.php",
        method: "POST",
		data: datas,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(answer){
            if(!answer){
               var newCode = idCategore + "001";
               $("#newCode").val(newCode);
            }else{
                var newCode= Number(answer["code"])+1;
                $("#newCode").val(newCode);
            }
            
        }
    })
})

/*=============================================
datatable in json
=============================================*/


// $.ajax({
// 	url: "ajax/datatable-product.ajax.php",
// 	success: function(answer){
// 		console.log("answer",answer);
		
// 	}
// })

var profileValue = $("#profileValue").val();

$('.tableProdcuts').DataTable({
	"ajax": "ajax/datatable-product.ajax.php?profileValue="+profileValue, 
	"deferRender": true,
	"retrieve": true,
	"processing": true
});


/*=============================================
UPLOADING Product PICTURE
=============================================*/

$(".newImage").change(function(){

	var newImage = this.files[0];

	/*===============================================
	=            validating image format            =
	===============================================*/
	
	if (newImage["type"] != "image/jpeg" && newImage["type"] != "image/png"){

		$(".newPics").val("");

		swal({
			type: "error",
			title: "وێنەکە بەرزنەکرایەوە",
			text: "بێت png یان jpeg وێنەکە دەبێت ",
			showConfirmButton: true,
			confirmButtonText: "داخستن"
		});

	}else if(newImage["size"] > 2000000){

		$(".newPics").val("");

		swal({
			type: "error",
			title: "وێنەکە بەرزنەکرایەوە",
			text: "قەبارەی وێنەکە زۆر، نابێت لە ٢ مێگابایت زیاتر بێت",
			showConfirmButton: true,
			confirmButtonText: "داخستن"
		});

	}else{

		var imgData = new FileReader;
		imgData.readAsDataURL(newImage);

		$(imgData).on("load", function(event){
			
			var routeImg = event.target.result;

			$(".preview").attr("src", routeImg);

		});

	}
		
	/*=====  End of validating image format  ======*/
	
})

/*=============================================
Edit Product 
=============================================*/
$(".tableProdcuts tbody").on("click","button.btnEditProduct", function(){
    var idProduct = $(this).attr("idProduct");
    var datas = new FormData();
    datas.append("idProduct",idProduct);
    $.ajax({
		url: "ajax/products.ajax.php",
        method: "POST",
		data: datas,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(answer){
            var datasCategory = new FormData();
            datasCategory.append("idCategory",answer["id_category"]);
            $.ajax({
                url: "ajax/category.ajax.php",
                method: "POST",
                data: datasCategory,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(answer){
					
                    $("#editCategory1").val(answer["id"]);
                    $("#editCategory1").html(answer["category"]);
                }
            })
			$("#editCode").val(answer["code"]);
			$("#editDescription").val(answer["description"]);
			$("#editStock").val(answer["stock"]);
			$("#editBuy").val(answer["buy_price"]);
			$("#editSell").val(answer["sell_price"]);
			if(answer["image"] != ""){
				$("#actualImage").val(answer["image"]);
				$(".preview").attr("src" , answer["image"]);
			}
			
        }
    })
})
$(".tableProdcuts tbody").on("click","button.btnDeleteProduct", function(){
    var idProduct = $(this).attr("idProduct");
	var codeProduct = $(this).attr("codeProduct");
	var imageProduct = $(this).attr("imageProduct");
	swal({
		title: 'دڵنیای کە دەتەوێت ئەم کاڵایە بسریتەوە ؟',
		text: "ئەگەر ناتەوێت پەشیمان بوونەوە داگرە",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'پەشیمان بوونەوە',
		  confirmButtonText: 'بەڵی ، بیسرەوە'
		}).then(function(result){

		if(result.value){

		  window.location = "index.php?route=products&idProduct="+idProduct+"&codeProduct="+codeProduct+"&imageProduct="+imageProduct;

		}

	})

})