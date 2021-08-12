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
	$('#loanDetails').DataTable({
			
        		dom: 'lBfrtip',
        		buttons: [
           		 'copy', 'csv', 'excel', 'pdf', 'print'
        		],
    		} );

	} );
	</script>

</head>
<body>

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
?>



<!-- html table -->
<table class='table table-hover table-responsive table-bordered' id='loanDetails' >
	<!-- <thead>
		<tr>
			<td></td>
			<td></td>
		</tr>
	</thead> --> 
	<!-- look into getting print button without it being a sortable data table -->
 	<tr>
        <td>Person ID</td>
        <td><?php echo htmlspecialchars($personID, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
    	<td>Date Requested</td>
    	<td><?php echo htmlspecialchars($dateRequested, ENT_QUOTES);  ?></td>
   	</tr>                
    <tr>
    	<td>Date Sent</td>
    	<td><?php echo htmlspecialchars($dateSent, ENT_QUOTES);  ?></td>
   	</tr>   	
    <tr>
    	<td>Date Due</td>
    	<td><?php echo htmlspecialchars($dateDue, ENT_QUOTES);  ?></td>
   	</tr> 
   	<tr>
    	<td>Date Closed</td>
    	<td><?php echo htmlspecialchars($dateClosed, ENT_QUOTES);  ?></td>
   	</tr>  
   	<tr>
    	<td>Authorized By</td>
    	<td><?php echo htmlspecialchars($authorizedBy, ENT_QUOTES);  ?></td>
   	</tr> 
   	<tr>
    	<td>Sent By</td>
    	<td><?php echo htmlspecialchars($sentBy, ENT_QUOTES);  ?></td>
   	</tr>
   	<tr>
    	<td>Processed By</td>
    	<td><?php echo htmlspecialchars($processedBy, ENT_QUOTES);  ?></td>
   	</tr>  
   	<tr>
    	<td>Purpose</td>
    	<td><?php echo htmlspecialchars($purpose, ENT_QUOTES);  ?></td>
   	</tr> 
   	<tr>
    	<td>Loan Notes</td>
    	<td><?php echo htmlspecialchars($loanNotes, ENT_QUOTES);  ?></td>
   	</tr> 
   	<tr>
    	<td>Number of Lots</td>
    	<td><?php echo htmlspecialchars($numberLots, ENT_QUOTES);  ?></td>
   	</tr> 	

   	<tr>
    	<td>Total Number of Specimens</td>
    	<td><?php echo htmlspecialchars($totalNumberSentSpecimens, ENT_QUOTES);  ?></td>
   	</tr> 
   <tr>
    	<td>First Name of Borrower</td>
    	<td><?php echo htmlspecialchars($personsFirstName, ENT_QUOTES);  ?></td>
   	</tr> 
   <tr>
    	<td>Last Name of Borrower</td>
    	<td><?php echo htmlspecialchars($personsLastName, ENT_QUOTES);  ?></td>
   	</tr> 
   <tr>
    	<td>Email of Borrower</td>
    	<td><?php echo htmlspecialchars($email, ENT_QUOTES);  ?></td>
   	</tr> 
</table>
        
        
        
        
        
        
        
        </div> <!-- end .container -->
 </body>
</html>