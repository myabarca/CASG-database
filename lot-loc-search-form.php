<!DOCTYPE html>
<html lang="en">
<head>

<title>CASG Lot & Locality Search</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 <!-- data tables styling and scripts --> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"> 
<!-- using 1.10.25 of the above css file doesn't work. makes the sorting buttons on columns disappear
the above link also provides style that clashes with the jquery.dataTables.min.css below. this one does the skinny sorting arrows  -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">  -->
<!-- PROBLEM SOLVED. THE ABOVE jquery.dataTables.min.css stylesheet does not work for including export buttons!
		must use the dataTables.bootstrap4.min.css from line 16. it's not just a data table, it's a bootstrap-styled data table -->

<!-- behold the export buttons styling and scripts -->
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



	<!-- old nav bar
	<nav class="navbar navbar-default">
	<div class="container-fluid">
	<a href="index.php" class="navbar-brand">Back to Home</a> 
	</div>
    </nav> -->

    <!-- improved nav bar with more links -->
	<nav class="navbar navbar-expand-sm">

  	<!-- Links -->
  	<ul class="navbar-nav">
  		<li class="nav-item">
      	<a class="navbar-brand" href="index.php">Back to Home</a>
    	</li>

    	<li class="nav-item">
      	<a class="nav-link" href="loan-search-form.php">Loan Search</a>
    	</li>

    	<li class="nav-item">
      	<a class="nav-link" href="reference-search-form.php">Reference Search</a>
    	</li>
	</ul>

	</nav>


<!-- div for all searches -->
<div class="container-fluid">	

<!-- div container form group for taxonomy searches -->
<div class="form-group">
<h5 class="text-primary"><u>Taxonomy</u></h5>	

		<form action="" method="POST" class="form-inline">
			<!-- utlities add spacing to label and input fields -->
			<!-- right margin = mr-sm-2 and bottom margin = mb-2 -->	

				
			<label for="genus_search" class="mr-sm-2">Genus:</label>
			<input type="text" name="genus_search" placeholder="Enter Genus Name" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['genus_search']) ? htmlspecialchars($_POST['genus_search'], ENT_QUOTES) : ''; ?>">
			

			<label for="species_search" class="mr-sm-2">Species:</label>
			<input type="text" name="species_search" placeholder="Enter Species Name" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['species_search']) ? htmlspecialchars($_POST['species_search'], ENT_QUOTES) : ''; ?>">

			<label for="taxon_search" class="mr-sm-2">Taxon:</label>
			<input type="text" name="taxon_search" placeholder="Enter taxon, e.g. Mollusca" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['taxon_search']) ? htmlspecialchars($_POST['taxon_search'], ENT_QUOTES) : ''; ?>">


<!-- end div container form group for taxonomy searches -->
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

<!-- div container form group for collection info searches -->
<div class="form-group">
			<h5 class="text-primary mr-sm-2"><u>Collection Information</u></h5>	

			<div class="form-inline">
			<label for="locationID_search" class="mr-sm-2">Location ID:</label>
			<input type="text" name="locationID_search" placeholder="Enter Location ID" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['locationID_search']) ? htmlspecialchars($_POST['locationID_search'], ENT_QUOTES) : ''; ?>">

			<label for="lotID_search" class="mr-sm-2">Lot ID:</label>
			<input type="text" name="lotID_search" placeholder="Enter Lot ID" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['lotID_search']) ? htmlspecialchars($_POST['lotID_search'], ENT_QUOTES) : ''; ?>">

			<label for="previousColln_search" class="mr-sm-2">Previous Collection:</label>
			<input type="text" name="previousColln_search" placeholder="Enter Previous Collection" class="form-control mb-2 mr-sm-2" value="<?php echo isset($_POST['previousColln_search']) ? htmlspecialchars($_POST['previousColln_search'], ENT_QUOTES) : ''; ?>">
			</div>
<!-- end div containter form group for locality searches  -->
</div>
			
			<button class="btn-success mb-2" name="search_button">Search</button>
			
			
		</form>
		<!-- form is in div container for all searches -->

</div>
<!-- end div for all searches -->



 
	
	
	<br><br>
	<?php 
	include 'searchLotLoc.php';
	?>



</body>
</html>




