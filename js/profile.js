
function GetUserDetails(userId) {
    // Add User ID to the hidden field for furture usage
	$("#hidden_user_id").val(userId);
	$.post("action/profileDetails.php", {
			userId: userId
		},
		function (data, status) {
			// PARSE json data
			var user = JSON.parse(data);
			// Assing existing values to the modal popup fields
			$("#update_f_name").val(user.f_name);
			$("#update_l_name").val(user.l_name);
			$("#update_address").val(user.address);
			$("#update_dob").val(user.dob);
			$("#update_contact_number").val(user.contact_number);
		}
	);
    // Open modal popup
	$("#pawnshopDetails").modal("show");
	
}

function UpdateUserDetails() {
    // get values
	var f_name = $("#update_f_name").val();
    var l_name = $("#update_l_name").val();
    var address = $("#update_address").val();
	var dob = $("#update_dob").val();
	var contact_number = $("#update_contact_number").val();
    // get hidden field value
    var userId = $("#hidden_user_id").val()*1
    // Update the details by requesting to the server using ajax
    $.post("action/updateProfile.php", {
			userId:userId,
            f_name: f_name,
			l_name: l_name,
			address: address,
			dob: dob,
			contact_number: contact_number
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
        }
    );
}
