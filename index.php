<?php
	require("action/db_connection.php");
	$str = "SELECT student_id, name, course, year
			FROM student
			GROUP BY student_id;
			";
	$res = mysqli_query($conn, $str);
	
	if(!$res) {
		echo "Error in collecting data";
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<title>School</title>
 
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/ml.css?nocache={timestamp}" rel="stylesheet"> 
	<!-- Jquery JS file -->
<!-- Bootstrap Core JavaScript -->
	
<!-- Custom JS file -->
		<script src="datatable_files/jquery-1.12.4.js"></script>	
		<script src="js/bootstrap.min.js"></script>
		<script src="js/redirect.js"></script>
		<link rel="stylesheet" href="datatable_files/datatables.min.css">
		<link rel="stylesheet" href="datatable_files/dataTables.bootstrap.css">
		<link rel="stylesheet" href="datatable_files/jquery.dataTables.css">
		<link rel="stylesheet" href="datatable_files/editor.dataTables.min.css"></link>
		<link rel="stylesheet" href="datatable_files/editor.bootstrap.min.css"></link>
		<link rel="stylesheet" href="datatable_files/buttons.dataTables.min.css"></link>
		<link rel="stylesheet" href="datatable_files/select.dataTables.min.css"></link>
		<link rel="stylesheet" href="datatable_files/jquery.dataTables.min.css"></link>
		<link rel="stylesheet" href="datatable_files/editor.dataTables.min.css"></link>
		
		<script src="datatable_files/jquery.dataTables.min.js"></script>
		<script src="datatable_files/dataTables.buttons.min.js"></script>
		<script src="datatable_files/dataTables.select.min.js"></script>
		<script src="datatable_files/dataTables.editor.min.js"></script>
		<script src="js/datetime.js"></script>
</head>

<body>
	
	<div class="container box">
	
		<div class="row">
			<div class="col-md-12">
			
				<h5 class="text-center">Students</h5>
				<table id="studentTable" class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Course</th>
							<th>Year</th>
						</tr>
					</thead>
					<tbody id="studBody">
						<?php
						while($arrStud = mysqli_fetch_assoc($res)) {
							echo "
							<tr data-studid='{$arrStud['student_id']}'>
								<td>{$arrStud['student_id']}</td>
								<td>{$arrStud['name']}</td>
								<td>{$arrStud['course']}</td>
								<td>{$arrStud['year']}</td>
							</tr>
							";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	<!-- /Content Section -->
	<!-- // Modal -->
				
		<!-- // STANDARD MODAL -->
		<div class="modal fade"  tabindex="-1" role="dialog"  id="studModal" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title"></h4>
					</div>
					<div class="modal-body">
					</div>
					<div class="modal-footer">
						
					</div>
				</div>
			</div>
		</div>
		
		<!-- // EDIT MODAL -->
		<div class="modal fade"  tabindex="-1" role="dialog"  id="editstud" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit</h4>
					</div>
					<div class="modal-body">
						<div class='form-group'>
							<label for='update_student_id'>ID</label>
							<input type='text' id='update_student_id' placeholder='ID' class='form-control'/>
						</div>
						<div class='form-group'>
							<label for='update_name'>Name</label>
							<input type='text' id='update_name' placeholder='name' class='form-control'/>
						</div>
						<div class='form-group'>
							<label for='update_course'>Course</label>
							<input type='text' id='update_course' placeholder='course' class='form-control'/>
						</div>
						<div class='form-group'>
							<label for='update_year'>Year</label>
							<input type='text' id='update_year' placeholder='year' class='form-control'/>
						</div>
						
					</div>
					<div class="modal-footer">
						<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
						<button type='button' class='btn btn-primary' id='edidone' >Save Changes</button>
						<input type='hidden' id='hidden_user_id'>
					</div>
				</div>
			</div>
		</div>
		
		<!-- // CREATE MODAL -->
		<div class="modal fade"  tabindex="-1" role="dialog"  id="createstud" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Create</h4>
					</div>
					<div class="modal-body">
						<div class='form-group'>
							<label for='create_student_id'>ID</label>
							<input type='text' id='create_student_id' name='student_id' placeholder='ID' class='form-control'/>
						</div>
						<div class='form-group'>
							<label for='create_name'>Name</label>
							<input type='text' id='create_name' name='name' placeholder='name' class='form-control'/>
						</div>
						<div class='form-group'>
							<label for='create_course'>Course</label>
							<input type='text' id='create_course' name='course' placeholder='course' class='form-control'/>
						</div>
						<div class='form-group'>
							<label for='create_year'>Year</label>
							<input type='text' id='create_year' name='year' placeholder='year' class='form-control'/>
						</div>
					</div>
					<div class="modal-footer">
						<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
						<button type='submit' id='credone' class='btn btn-success' >Save</button>
						<input type='hidden' id='hidden_user_id'>
					</div>
				</div>
			</div>
		</div>
		
		<!-- // EXPORT MODAL -->
		<div class="modal fade"  tabindex="-1" role="dialog"  id="exportstud" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Export</h4>
					</div>
					<div class="modal-body">
						
						<div class='form-group'>
							<label for='exported_id'>ID</label>
							<input type='text' id='exported_id' placeholder='ID' class='form-control'  />
						</div>
						<div class='form-group'>
							<label for='exported_name'>Name</label>
							<input type='text' id='exported_name' placeholder='name' class='form-control'  />
						</div>
						<div class='form-group'>
							<label for='exported_course'>Course</label>
							<input type='text' id='exported_course' placeholder='course' class='form-control'  />
						</div>
						<div class='form-group'>
							<label for='exported_year'>Year</label>
							<input type='text' id='exported_year' placeholder='year' class='form-control'  />
						</div>
						<div class='form-group'>
							<label for='exported_filename'>New Filename</label>
							<div class="input-group">
								<input type='text' id='exported_filename' placeholder='file name' class='form-control' required />
								<div class='input-group-btn'>
									<button type='button' class='btn btn-default disabled' >.xml</button>
								</div>
							</div>
						</div>
						<div class='form-group'>
							<label for='file_input'>Segment to Extract</label>
							<input type='file' id='file_input'>
							<pre id='file-content'></pre>
						</div>
						
					</div>
					<div class="modal-footer">
						<button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
						<button type='submit' form='export_form' class='btn btn-primary' id='expdone' >EXPORT</button>
						<input type='hidden' id='hidden_user_id'>
						
					</div>
				</div>
			</div>
		</div>
		
		<!-- // INFORMATION MODAL -->
		<div class="modal fade"  tabindex="-1" role="dialog"  id="infostud" >
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="infostudTit"></h4>
					</div>
					<div class="modal-body" id="infostudBod">
					</div>
					<div class="modal-footer" id="infostudFoo">
						
					</div>
				</div>
			</div>
		</div>
		
		
    </div>
	
	
    <!-- /.container -->
	


</body>
</html>

<script>
$(document).ready(function() {
	var fileresult;
	var table2;
	var table = $("#studentTable").DataTable({
		"createdRow": function(row, data, dataIndex){
			$(row).attr('data-studid', data[0]);
		},
		dom: "Bfrtip",
		select: {
			style: 'multi'
		},
		buttons: [
			{
				// CREATE MODAL
				text: "Create",
				action: function ( e, dt, node, config ) {
					$("#createstud").modal("show");
				}
			},
			{
				// INFORMATION MODAL
				extend: "selectedSingle",
				text: "Info",
				action: function ( e, dt, node, config ) {
					//$("#infostud").modal("show");
					var currentRow = table.row( { selected: true } ).data();
					var studID = currentRow[0];
					
					$.ajax({
						url: "action/indexGetClass.php",
						method: "POST",
						data:{
							student_id: studID
						},
						success: function(tbl){
							$("#infostudTit").html("Class List of ID No.<strong>"+ studID +"</strong>");
							$("#infostudBod").html(tbl);
							table2 = $("#classTable").DataTable({
								select: true,
							});
							$("#infostudFoo").html("<button  style='display: inline' type='submit' id='edi' class='btn btn-default' name='id' value='" +studID+ "'>Edit</button>");
							$("#infostudFoo").append("<button  style='display: inline' type='submit' id='del' class='btn btn-danger' name='id' value='" +studID+ "'>Delete</button>");
							$("#infostudFoo").append("<button  style='display: inline' type='submit' id='exp' class='btn btn-default' name='id' value='" +studID+ "'>Export to XML</button>");
							$("#infostudFoo").append("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>");
							$("#infostud").modal("show");
						}
					});
				}
			},
			{
				// EXPORT MULTIPLE STUDENT
				extend: "selected",
				text: "Export Multiple Students",
				action: function ( e, dt, node, config ) {
					var currentRow = table.rows( { selected: true } ).data();
					var multiS = [];
					var i;
					
					console.log(currentRow[0][1]);
					for(i = 0; i < currentRow.length; i++){
						multiS[i] = {
							student_id: currentRow[i][0],
							name: currentRow[i][1],
							course: currentRow[i][2],
							year: currentRow[i][3],
							
						};
						
					}
					i++;
					multiS[i] = {
						filestr: fileresult,
						//filename: filename
					};
					console.log(multiS);
					/*var toXml = (array1) => {
					  return array1.reduce((result, el) => {
					   return result + '<student><student_id>${el.student_id}</student_id><name>${el.name}</name><course>${el.course}</course><year>${el.year}</year></student>'
					  }, '')
					};
					table.rows('.selected').every(function(rowIdx) {
						 array1.push(table.row(rowIdx).data());
					  });
					console.log(toXml(array1));
					var xmled = toXml(array1);
					xmled.toString();
					$.redirect('action/multipleExport.php',{xmled:xmled});*/
				}
			}
			
		]
	});
	
	/*table.on('select.dt', function() {
		  
		  table.rows('.selected').every(function(rowIdx) {
			 array1.push(table.row(rowIdx).data())
		  });
		  console.log(array1);
	});*/
	
	// XML FILE READER
	$("#exportstud").on("change", "#file_input", function(e){
		var file = e.target.files[0];
		if (!file) {
			return;
		}
		var reader = new FileReader();
		reader.onload = function(e) {
			var contents = e.target.result;
			displayContents(contents);
		};
		reader.readAsText(file);
		fileresult = file.name;
	});
	
	
	
	
	// EDIT MODAL
	$("#infostud").on("click", "#edi", function(){
		var studID = $(this).val();
		$(".modal").hide();
		$("#editstud").modal("show");
		
		var currentRow=table.row( { selected: true } ).data();
		GetUserDetails(studID);
	});
	
	// EXPORT MODAL
	$("#infostud").on("click", "#exp", function(){
		var studID = $(this).val();
		
		$(".modal").hide();
		$("#exportstud").modal("show");
		
		var currentRow=table.row( { selected: true } ).data();
		GetUserDetails(studID);
	});
	
	// SAVING CREATED STUDENT
	$("#createstud").on("click", "#credone", function() {
		var student_id = $("#create_student_id").val();
		var name = $("#create_name").val();
		var course = $("#create_course").val();
		var year = $("#create_year").val();
		
		$.ajax({
			url: "action/createStud.php",
			method: "POST",
			data:{
				student_id: student_id,
				name:name,
				course:course,
				year:year
			},
			dataType: "json",
			success: function(newStudent){
				//readRecords();
				var newStud = [
					newStudent.student_id,
					newStudent.name,
					newStudent.course,
					newStudent.year
				];
				var newrow;
				alert("Student added!");
				$('.modal').modal('hide');
				
				newrow = table.row.add(newStud).draw(false);
				console.log("halo");
			}
		});
	});
	
	// SAVING EDITED STUDENT
	$("#editstud").on("click", "#edidone", function() {
		// get values id
		var student_id = $("#update_student_id").val();
		var name = $("#update_name").val();
		var course = $("#update_course").val();
		var year = $("#update_year").val();

		// get hidden field value
		//var student_id = $("#hidden_user_id").val();
		// Update the details by requesting to the server using ajax
		
		$.ajax({
			url: "action/upStud.php",
			method: "POST",
			data:{
				student_id: student_id,
				name: name,
				course: course,
				year: year
			},
			dataType: "json",
			success: function(upStudent){
				//readRecords();
				var updateRow = [
					upStudent.student_id,
					upStudent.name,
					upStudent.course,
					upStudent.year
				];
				console.log(upStudent);
				alert("Student updated!");
				$('.modal').modal('hide');
				table.row({selected: true}).data(updateRow).draw(false);
			}
		});
	});
	
	// EXPORTING SELECTED STUDENT
	$("#exportstud").on("click", "#expdone", function () {
		var student_id = $("#exported_id").val();
		var name = $("#exported_name").val();
		var course = $("#exported_course").val();
		var year = $("#exported_year").val();
		var filename = $("#exported_filename").val();
		if(filename){
			$.ajax({
				url: "action/exportStud.php",
				method: "POST",
				data:{
					student_id: student_id,
					name: name,
					course: course,
					year: year,
					filestr: fileresult,
					filename: filename
				},
				success: function(){
					//readRecords();
					
					alert("Student exported!");
					$('.modal').modal('hide');
					
					
					console.log("halo");
				}
			});
			//$.redirect('action/exportStud.php', {student_id: student_id, name: name, course: course, year: year, filestr: fileresult, filename: filename});
		} else{
			alert("Missing input!");
		}
	});
	
	// DELETE STUDENT
	$("#infostud").on("click", "#del", function (){
		var student_id = $(this).val();
		var conf = confirm("Are you sure, do you really want to delete Item?");
		if (conf == true) {
			console.log(student_id);
			$.post("action/delStud.php", {
					student_id: student_id
				},
				function (data, status) {
					$(".modal").modal("hide");
					table.row( { selected: true } ).remove().draw();
				}
			);
		}
	});
});

//test
function readSingleFile(e) {
	
}

function displayContents(contents) {
	var element = document.getElementById('file-content');
	element.textContent = contents;
}


//test
var dataT=[];

// READ records
function readRecords() {
	// 	 $('#studentTable').DataTable().clear();
	table.clear().draw();
    $.get("action/studDB.php", {}, function (data, status) {
		dataT=JSON.parse(data);
		//$('#studentTable').dataTable().fnAddData(dataT);	
    });
}



function DeleteUser(student_id) {
    
}

function GetUserDetails(student_id) {
    // Add User ID to the hidden field for furture usage
	if(student_id){//edit
		$("#hidden_user_id").val(student_id);
		$.post("action/readStud.php", {
				student_id: student_id
			},
			function (data, status) {
				// PARSE json data
				var user = JSON.parse(data);
				console.log(data);
				// Assing existing values to the modal popup fields
				$("#update_student_id").val(user.student_id);
				$("#update_name").val(user.name);
				$("#update_course").val(user.course);
				$("#update_year").val(user.year);
				
				// export modals
				$("#exported_id").val(user.student_id);
				$("#exported_name").val(user.name);
				$("#exported_course").val(user.course);
				$("#exported_year").val(user.year);
			}
			
		);
	}
    // Open modal popup
}


function exportStud() {
    var student_id = $("#exported_id").val();
	var name = $("#exported_name").val();
	var course = $("#exported_course").val();
	var year = $("#exported_year").val();
	$.get("action/exportStud.php", {
			student_id: student_id,
			name:name,
			course:course,
			year:year
		},
		function (data, status) {
			console.log(student_id);
		}
	);
}




var editor;
var table;
</script>