/*=============================================
UPLOADING USER PICTURE
=============================================*/

$(".newPics").change(function(){

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
			confirmButtonText: "Close"
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
EDITING USER PICTURE
=============================================*/
$(document).on("click", ".btnEditUser", function(){

 	var idUser = $(this).attr("idUser");

 	var data = new FormData();
 	data.append("idUser", idUser);

 	$.ajax({

 		url: "ajax/users.ajax.php",
 		method: "POST",
 		data: data,
 		cache: false,
 		contentType: false,
 		processData: false,
 		dataType: "json",
 		success: function(answer){
 			
 			// console.log("answer", answer);

 			$("#EditName").val(answer["name"]);

 			$("#EditUser").val(answer["user"]);

 			$("#EditProfile").html(answer["profile"]);

 			$("#EditProfile").val(answer["profile"]);

 			$("#currentPasswd").val(answer["password"]);

 			$("#currentPicture").val(answer["photo"]);
 			
 			if(answer["photo"] != ''){

 				$('.preview').attr('src', answer["photo"]);

 			}

 		}

 	});

 });


/*=============================================
ACTIVATE USER
=============================================*/
$(document).on("click", ".btnActivate", function(){

	var userId = $(this).attr("userId");
	var userStatus = $(this).attr("userStatus");

	var datum = new FormData();
 	datum.append("activateId", userId);
  	datum.append("activateUser", userStatus);

  	$.ajax({

	  url:"ajax/users.ajax.php",
	  method: "POST",
	  data: datum,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(answer){
      	
      	// console.log("answer", answer);

      	if(window.matchMedia("(max-width:767px)").matches){
		
			swal({
				title: "The user status has been updated",
				type: "success",
				confirmButtonText: "Close"	
			}).then(function(result) {

				if (result.value) {
					window.location = "users";
				}

			})

		}
		
      }

  	})

  	if(userStatus == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('نا چالاکە');
  		$(this).attr('userStatus',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('چالاکە');
  		$(this).attr('userStatus',0);

  	}

});


/*=============================================
VALIDATE IF USER ALREADY EXISTS
=============================================*/

$("#newUser").change(function(){

	$(".alert").remove();

	var user = $(this).val();

	var data = new FormData();
 	data.append("validateUser", user);

  	$.ajax({

	  url:"ajax/users.ajax.php",
	  method: "POST",
	  data: data,
	  cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){ 

      	// console.log("answer", answer);

      	if(answer){

      		$("#newUser").parent().after('<div style="font-family: NRT;" class="alert alert-warning">ئەم بەکارهێنەرە بوونی هەیە</div>');
      		
      		$("#newUser").val('');
      	}

      }

    });

});

/*=============================================
DELETE USER
=============================================*/

$(document).on("click", ".btnDeleteUser", function(){

	var userId = $(this).attr("userId");
	var userPhoto = $(this).attr("userPhoto");
	var username = $(this).attr("username");

	swal({
		title: 'دڵنیای کە دەتەوێت ئەم بەکارهێنەرە بسریتەوە ؟',
		text: "ئەگەر ناتەوێت پەشیمان بوونەوە داگرە",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'پەشیمان بوونەوە',
		  confirmButtonText: 'بەڵی ، بیسرەوە'
		}).then(function(result){

		if(result.value){

		  window.location = "index.php?route=users&userId="+userId+"&username="+username+"&userPhoto="+userPhoto;

		}

	})

});



