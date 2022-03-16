<!DOCTYPE HTML>
<html>
    <head>
        <title>Loan Information</title> 
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

<?php $loanID=isset($_GET['loanID']) ? $_GET['loanID'] : die('ERROR: Record ID not found.'); ?>
 
    <!-- container -->
    <div class="container">
 
        <div class="page-header">
            <h1>Information for Loan Number <?php echo htmlspecialchars($loanID, ENT_QUOTES);  ?></h1>
        </div>
<?php

// get passed parameter value, in this case, the record ID
// $loanID=isset($_GET['loanID']) ? $_GET['loanID'] : die('ERROR: Record ID not found.');
// moved this up after body tag and before page header to get loan ID number in page header
 
//include database connection
include 'config/database.php';
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT loan.loanID, loan.personID, loan.dateRequested, loan.dateSent, loan.dateDue, loan.dateClosed, loan.authorizedBy, loan.sentBy, loan.processedBy, loan.purpose, loan.loanNotes, loan.numberLots, loan.totalNumberSentSpecimens, loan.personsFirstName, loan.personsLastName, loan.personsEmail FROM loan WHERE loanID = ?";

    $stmt = $con->prepare($query);
 
    // this is the first question mark
    $stmt->bindParam(1, $loanID);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $personID = $row['personID'];
    $dateRequested = $row['dateRequested'];
    $dateSent = $row['dateSent'];
    $dateDue = $row['dateDue'];
    $dateClosed = $row['dateClosed'];
    $authorizedBy = $row['authorizedBy'];
    $sentBy = $row['sentBy'];
    $processedBy = $row['processedBy'];
    $purpose = $row['purpose'];
    $loanNotes = $row['loanNotes'];
    $dateSent = $row['dateSent'];
    $numberLots = $row['numberLots'];
    $totalNumberSentSpecimens = $row['totalNumberSentSpecimens'];
    $personsFirstName = $row['personsFirstName'];
    $personsLastName = $row['personsLastName'];
    $email = $row['personsEmail'];

}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

$personID_url = "personID_info.php?personID=" . "{$personID}";
?>



<!-- html table -->
<table class='table table-hover table-responsive' id='loanDetails' >
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
        <td>Person ID</td> 
        <td><a href= "<?php echo htmlspecialchars($personID_url, ENT_QUOTES); ?>"> <?php echo htmlspecialchars($personID, ENT_QUOTES);  ?> </a> </td>
    </tr>
    <tr>
    	<td>Date Requested</td>
    	<td><?php echo htmlspecialchars($dateRequested);  ?></td>
   	</tr>                
    <tr>
    	<td>Date Sent</td>
    	<td><?php echo htmlspecialchars($dateSent);  ?></td>
   	</tr>   	
    <tr>
    	<td>Date Due</td>
    	<td><?php echo htmlspecialchars($dateDue);  ?></td>
   	</tr> 
   	<tr>
    	<td>Date Closed</td>
    	<td><?php echo htmlspecialchars($dateClosed);  ?></td>
   	</tr>  
   	<tr>
    	<td>Authorized By</td>
    	<td><?php echo htmlspecialchars($authorizedBy);  ?></td>
   	</tr> 
   	<tr>
    	<td>Sent By</td>
    	<td><?php echo htmlspecialchars($sentBy);  ?></td>
   	</tr>
   	<tr>
    	<td>Processed By</td>
    	<td><?php echo htmlspecialchars($processedBy);  ?></td>
   	</tr>  
   	<tr>
    	<td>Purpose</td>
    	<td><?php echo htmlspecialchars($purpose);  ?></td>
   	</tr> 
   	<tr>
    	<td>Loan Notes</td>
    	<td><?php echo htmlspecialchars($loanNotes);  ?></td>
   	</tr> 
   	<tr>
    	<td>Number of Lots</td>
    	<td><?php echo htmlspecialchars($numberLots);  ?></td>
   	</tr> 	

   	<tr>
    	<td>Total Number of Specimens</td>
    	<td><?php echo htmlspecialchars($totalNumberSentSpecimens);  ?></td>
   	</tr> 
   <tr>
    	<td>First Name of Borrower</td>
    	<td><?php echo htmlspecialchars($personsFirstName);  ?></td>
   	</tr> 
   <tr>
    	<td>Last Name of Borrower</td>
    	<td><?php echo htmlspecialchars($personsLastName);  ?></td>
   	</tr> 
   <tr>
    	<td>Email of Borrower</td>
    	<td><?php echo htmlspecialchars($email);  ?></td>
   	</tr> 
</table>
        
        
        
        
        
        
        
        </div> <!-- end .container -->
 </body>
</html>