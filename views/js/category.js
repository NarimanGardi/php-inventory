$("#newCategory").change(function(){

	$(".alert").remove();

	var category = $(this).val();

	var data = new FormData();
 	data.append("validateCategory", category);

  	$.ajax({

	  url:"ajax/category.ajax.php",
	  method: "POST",
	  data: data,
	  cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){ 

      	// console.log("answer", answer);

      	if(answer){

      		$("#newCategory").parent().after('<div style="font-family: NRT;" class="alert alert-warning">ئەم بابەتە بوونی هەیە</div>');
      		
      		$("#newCategory").val('');
      	}

      }

    });

});

$("#editCategory").change(function(){

	$(".alert").remove();

	var category = $(this).val();

	var data = new FormData();
 	data.append("validateCategory", category);

  	$.ajax({

	  url:"ajax/category.ajax.php",
	  method: "POST",
	  data: data,
	  cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){ 

      	// console.log("answer", answer);

      	if(answer){

      		$("#editCategory").parent().after('<br><div style="font-family: NRT;" class="alert alert-warning">ئەم بابەتە بوونی هەیە</div>');
      		
      		$("#editCategory").val('');
      	}

      }

    });

});

$(document).on("click", ".btnEditCategory", function(){

	var idCategory = $(this).attr("idCategory");

	var data = new FormData();
	data.append("idCategory", idCategory);

	$.ajax({

		url: "ajax/category.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(answer){
			$("#editCategory").val(answer["category"]);
			$("#idCategory").val(answer["id"]);
		}
	})
});

$(".btnDeleteCategory").click(function(){

	var idCategory = $(this).attr("idCategory");


	swal({
		title: 'دڵنیای کە دەتەوێت ئەم بابەتە بسریتەوە ؟',
		text: "ئەگەر ناتەوێت پەشیمان بوونەوە داگرە",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'پەشیمان بوونەوە',
		  confirmButtonText: 'بەڵی ، بیسرەوە'
		}).then(function(result){

		if(result.value){

		  window.location = "index.php?route=categories&idCategory="+idCategory;

		}

	})
});