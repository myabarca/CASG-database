<!DOCTYPE html>
<html lang="en">
<head>

<title>CASG Loan Search</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- datatables css, jquery, bootstrap -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"> 
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<!-- datatables buttons css and function -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> 
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<!-- JS for sortable, searchable datatable; still need jquery libraries from above -->
<script>
$(document).ready(function() {
$('#sortTable').DataTable({
			
        		dom: 'lBfrtip',
        		buttons: [
           		 'copy', 'csv', 'excel', 'pdf', 'print'
        		],
    		} );

} );
</script>

</head>


<body>
		<!-- old navbar and under construction box -->
		<!-- <nav class="navbar navbar-default">
		<div class="container-fluid">
		<a href="index.html" class="navbar-brand">Back to Home</a> 
		</div>
 		-->
		<!-- <div class="container d-flex align-items-center">
		
			<div class="container p-3 my-3 bg-primary text-white"> 
			<h1>CASG Loan Search</h1>
			</div>
			<p>Under construction. Please check back later.</p>
		
		</div> -->

<nav class="navbar navbar-expand-sm">

  	<!-- Links -->
  	<ul class="navbar-nav">
  		<li class="nav-item">
      	<a class="navbar-brand" href="index.html">Back to Home</a>
    	</li>

      	<li class="nav-item">
      	<a class="nav-link" href="search-form.php">Lot Locality Search</a>
    	</li>

    	<li class="nav-item">
      	<a class="nav-link" href="reference-search-form.php">Reference Search</a>
    	</li>
	</ul>

</nav>

<!-- div for all searches -->
<div class="container-fluid">	

<!-- div container form group for loan info searches -->
<div class="form-group">
<h5 class="text-primary"><u>Loan Information</u></h5>	

		<form action="" method="POST" class="form-inline">
			<!-- utlities add spacing to label and input fields -->
			<!-- right margin = mr-sm-2 and bottom margin = mb-2 -->	

				
			<label for="loanID_search" class="mr-sm-2">Loan ID:</label>
			<input type="text" name="loanID_search" placeholder="Enter Loan ID" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['loanID_search']) ? htmlspecialchars($_POST['loanID_search'], ENT_QUOTES) : ''; ?>">
			

			<label for="personID_search" class="mr-sm-2">Person ID:</label>
			<input type="text" name="personID_search" placeholder="Enter Person ID" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['personID_search']) ? htmlspecialchars($_POST['personID_search'], ENT_QUOTES) : ''; ?>">

			<label for="personLastName_search" class="mr-sm-2">Person Last Name:</label>
			<input type="text" name="personLastName_search" placeholder="Enter Last Name" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['personLastName_search']) ? htmlspecialchars($_POST['personLastName_search'], ENT_QUOTES) : ''; ?>">


<!-- end div container form group for loan info searches -->
</div>
				
<!-- div container form group for locality searches -->
<div class="form-group">
			<h5 class="text-primary mr-sm-2"><u>Locality</u></h5>	

			<div class="form-inline">
			
			<label for="continent_search" class="mr-sm-2">Continent:</label>
			<input type="text" name="continent_search" placeholder="Enter Continent" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['continent_search']) ? htmlspecialchars($_POST['continent_search'], ENT_QUOTES) : ''; ?>">

			<label for="country_search" class="mr-sm-2">Country:</label>
			<input type="text" name="country_search" placeholder="Enter Country" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['country_search']) ? htmlspecialchars($_POST['country_search'], ENT_QUOTES) : ''; ?>">

			<label for="state_search" class="mr-sm-2">State/Province:</label>
			<input type="text" name="state_search" placeholder="Enter State or Province" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['state_search']) ? htmlspecialchars($_POST['state_search'], ENT_QUOTES) : ''; ?>">

			<label for="county_search" class="mr-sm-2">County:</label>
			<input type="text" name="county_search" placeholder="Enter County" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['county_search']) ? htmlspecialchars($_POST['county_search'], ENT_QUOTES) : ''; ?>">

			<label for="era_search" class="mr-sm-2">Era:</label>
			<input type="text" name="era_search" placeholder="Enter Era" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['era_search']) ? htmlspecialchars($_POST['era_search'], ENT_QUOTES) : ''; ?>">
			</div>
<!-- end div container form group for locality searches  -->
</div>

<button class="btn-success mb-2" name="search_button">Search</button>
			
		

</div>
<!-- end div for all searches -->



 
	
	
	<br><br>
	<?php 
	include 'searchLoan.php';
	?>



</body>
</html>
