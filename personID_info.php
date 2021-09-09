<!DOCTYPE HTML>
<html>
    <head>
        <title>Person Information</title> 
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

<?php $personID=isset($_GET['personID']) ? $_GET['personID'] : die('ERROR: Record ID not found.'); ?>
 
    <!-- container -->
    <div class="container">
 
        <div class="page-header">
            <h1>Information for Person Number <?php echo htmlspecialchars($personID, ENT_QUOTES); ?></h1>
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
    $query = "SELECT loan.loanID, person.personID, person.prefix, person.firstName, person.lastName, person.title, person.affiliation, person.relationship, person.email, person.interest, person.fossils, person.diatoms, person.minerals, person.crystalGazers, person.homePhone, person.officePhone, person.altPhone, person.fax, person.address1, person.address2, person.address3, person.address4, person.city, person.state, person.postalCode, person.country, person.notes FROM person, loan WHERE person.personID = ? AND loan.personID = ?";

    $stmt = $con->prepare($query);
 
    // this is the first question mark
    $stmt->bindParam(1, $personID);
     // second question mark
    $stmt->bindParam(2, $personID);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $personID = $row['personID'];
    $prefix = $row['prefix'];
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $title = $row['title'];
    $affiliation = $row['affiliation'];
    $relationship = $row['relationship'];
    $email = $row['email'];
    $interest = $row['interest'];
    $fossils = $row['fossils'];
    $diatoms = $row['diatoms'];
    $minerals = $row['minerals'];
    $crystalGazers = $row['crystalGazers'];
    $homePhone = $row['homePhone'];
    $officePhone = $row['officePhone'];
    $altPhone = $row['altPhone'];
    $fax = $row['fax'];
    $address1 = $row['address1'];
    $address2 = $row['address2'];
    $address3 = $row['address3'];
    $address4 = $row['address4'];
    $city = $row['city']; 
    $state = $row['state'];
    $postalCode = $row['postalCode']; 
    $country = $row['country'];
    $notes = $row['notes'];

}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

// don't need this here since this is from loan page. may put other links here though so keeping to replace in future
// $personID_url = "personID_info.php?personID=" . "{$personID}";
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
      <td>Prefix</td>
      <td><?php echo htmlspecialchars($prefix, ENT_QUOTES);  ?></td>
    </tr>                
    <tr>
      <td>First Name</td>
      <td><?php echo htmlspecialchars($firstName, ENT_QUOTES);  ?></td>
    </tr>     
    <tr>
      <td>Last Name</td>
      <td><?php echo htmlspecialchars($lastName, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>Title</td>
      <td><?php echo htmlspecialchars($title, ENT_QUOTES);  ?></td>
    </tr>  
    <tr>
      <td>Affiliation</td>
      <td><?php echo htmlspecialchars($affiliation, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>Relationship</td>
      <td><?php echo htmlspecialchars($relationship, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo htmlspecialchars($email, ENT_QUOTES);  ?></td>
    </tr>  
    <tr>
      <td>Interest</td>
      <td><?php echo htmlspecialchars($interest, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>Fossils</td>
      <td><?php echo htmlspecialchars($fossils, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>Diatoms</td>
      <td><?php echo htmlspecialchars($diatoms, ENT_QUOTES);  ?></td>
    </tr>   

    <tr>
      <td>Minerals</td>
      <td><?php echo htmlspecialchars($minerals, ENT_QUOTES);  ?></td>
    </tr> 
   <tr>
      <td>Crystal Gazers</td>
      <td><?php echo htmlspecialchars($crystalGazers, ENT_QUOTES);  ?></td>
    </tr> 
   <tr>
      <td>Home Phone</td>
      <td><?php echo htmlspecialchars($homePhone, ENT_QUOTES);  ?></td>
    </tr> 
   <tr>
      <td>Office Phone</td>
      <td><?php echo htmlspecialchars($officePhone, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>Alt Phone</td>
      <td><?php echo htmlspecialchars($altPhone, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>Fax</td>
      <td><?php echo htmlspecialchars($fax, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
      <td>Address 1</td>
      <td><?php echo htmlspecialchars($address1, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>Address 2</td>
      <td><?php echo htmlspecialchars($address2, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>Address 3</td>
      <td><?php echo htmlspecialchars($address3, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>Address 4</td>
      <td><?php echo htmlspecialchars($address4, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>City</td>
      <td><?php echo htmlspecialchars($city, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>State</td>
      <td><?php echo htmlspecialchars($state, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>Postal Code</td>
      <td><?php echo htmlspecialchars($postalCode, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>Country</td>
      <td><?php echo htmlspecialchars($country, ENT_QUOTES);  ?></td>
    </tr> 
    <tr>
      <td>Notes</td>
      <td><?php echo htmlspecialchars($notes, ENT_QUOTES);  ?></td>
    </tr> 
</table>
        
        
        
        
        
        
        
        </div> <!-- end .container -->
 </body>
</html>