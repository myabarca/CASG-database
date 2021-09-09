<!DOCTYPE HTML>
<html>
    <head>
        <title>Georeference Data</title> 
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
    </head>

  <body>

	    <nav class="navbar navbar-expand-sm">

  	   <!-- Links -->
  		    <ul class="navbar-nav">
  			   <li class="nav-item">
      			   <a class="navbar-brand" href="index.php">Back to Home</a>
    		   </li>

      		 <li class="nav-item">
      			<a class="nav-link" href="lot-loc-search-form.php">Lot Locality Search</a>
    		   </li>

    		   <li class="nav-item">
      			<a class="nav-link" href="loan-search-form.php">Loan Search</a>
    		   </li>

    		   <li class="nav-item">
      			<a class="nav-link" href="reference-search-form.php">Reference Search</a>
    		   </li>
		      </ul>
	    </nav>

<?php $locationID=isset($_GET['locationID']) ? $_GET['locationID'] : die('ERROR: Location ID not found.'); ?>

<?php 
//error handler function
function georefError($errno, $errstr) {
  echo "<b>Location ID not yet georeferenced</b>";
  die();
}

//set error handler
set_error_handler("georefError",2);
?>
 
    <!-- container -->
    <div class="container">
 
        <div class="page-header">
            <h1>Georeference Data for Location ID <?php echo htmlspecialchars($locationID, ENT_QUOTES);  ?></h1>
        </div>
<?php

// get passed parameter value, in this case, the location ID
// moved this up after body tag and before page header to get loan ID number in page header
 
//include database connection
include 'config/database.php';
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT * FROM georeference WHERE locationID = ?";

    $stmt = $con->prepare($query);
 
    // this is the first question mark
    $stmt->bindParam(1, $locationID);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $georeferenceVerificationStatus = $row['georeferenceVerificationStatus'];
    $georeferencedBy = $row['georeferencedBy'];
    $georeferencedDate = $row['georeferencedDate'];
    $georeferenceRemarks = $row['georeferenceRemarks'];
    $geodeticDatum = $row['geodeticDatum'];
    $georeferenceProtocol = $row['georeferenceProtocol'];
    $georeferenceSources = $row['georeferenceSources'];
    $decimalLongitude = $row['decimalLongitude'];
    $decimalLatitude = $row['decimalLatitude'];
    $coordinateUncertaintyInMeters = $row['coordinateUncertaintyInMeters'];
    $allTopoInput = $row['allTopoInput'];
    $allTopoOutput = $row['allTopoOutput'];
    $allTopoNotes = $row['allTopoNotes'];
    // $personsFirstName = $row['personsFirstName'];
    // $personsLastName = $row['personsLastName'];
    // $email = $row['personsEmail'];

}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

;
?>



<!-- html table -->
<table class='table table-hover table-responsive' id='georefData' >
	<!-- <thead>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</thead> --> 
	<!-- look into getting print button without it being a sortable data table -->

	<!-- add lot info to loan page -->
	<!-- would be nice to add link to photo/scans of original loan paperwork -->
 	  <tr>
        <td>Verification Status</td> 
        <td><?php echo htmlspecialchars($georeferenceVerificationStatus);  ?> </a> </td>
    </tr>
    <tr>
    	<td>Georeferenced By</td>
    	<td><?php echo htmlspecialchars($georeferencedBy);  ?></td>
   	</tr>                
    <tr>
    	<td>Date Georeferenced</td>
    	<td><?php echo htmlspecialchars($georeferencedDate);  ?></td>
   	</tr>   	
    <tr>
    	<td>Remarks</td>
    	<td><?php echo htmlspecialchars($georeferenceRemarks);  ?></td>
   	</tr> 
   	<tr>
    	<td>Geodetic Datum</td>
    	<td><?php echo htmlspecialchars($geodeticDatum);  ?></td>
   	</tr>  
   	<tr>
    	<td>Protocol</td>
    	<td><?php echo htmlspecialchars($georeferenceProtocol);  ?></td>
   	</tr> 
   	<tr>
    	<td>Sources</td>
    	<td><?php echo htmlspecialchars($georeferenceSources);  ?></td>
   	</tr>
   	<tr>
    	<td>Decimal Longitude</td>
    	<td><?php echo htmlspecialchars($decimalLatitude);  ?></td>
   	</tr>  
   	<tr>
    	<td>Decimal Latitude</td>
    	<td><?php echo htmlspecialchars($decimalLatitude);  ?></td>
   	</tr> 
   	<tr>
    	<td>Coordinate Uncertainty in Meters</td>
    	<td><?php echo htmlspecialchars($coordinateUncertaintyInMeters);  ?></td>
   	</tr> 
   	<tr>
    	<td>All Topo Input</td>
    	<td><?php echo htmlspecialchars($allTopoInput);  ?></td>
   	</tr> 	

   	<tr>
    	<td>All Topo Output</td>
    	<td><?php echo htmlspecialchars($allTopoOutput);  ?></td>
   	</tr> 
   <tr>
    	<td>All Topo Notes</td>
    	<td><?php echo htmlspecialchars($allTopoNotes);  ?></td>
   	</tr> 
   
</table>
        
        
        
        
        
        
        
        </div> <!-- end .container -->
 </body>
</html>