<!DOCTYPE HTML>
<html>
    <head>
        <title>Lot Information</title> 
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

<?php $lotID=isset($_GET['lotID']) ? $_GET['lotID'] : die('ERROR: Lot ID not found.'); ?>
<!-- // get passed parameter value, in this case, the lot ID
// moved this up after body tag and before page header to get lot ID number in page header -->

<!-- container -->
    <div class="container">
 
        <div class="page-header">
            <h1>Information for Lot Number <?php echo htmlspecialchars($lotID, ENT_QUOTES);  ?></h1>
        </div>
<?php


 
//include database connection
include 'config/database.php';
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT * FROM lot WHERE lotID = ?";

    $stmt = $con->prepare($query);
 
    // this is the first question mark
    $stmt->bindParam(1, $lotID);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $caseColln = $row['caseColln'];
    $collnDrawerID = $row['collnDrawerID'];
    $genus = $row['genus'];
    $species = $row['species'];
    $subSpecies = $row['subSpecies'];
    $synonym = $row['synonym'];
    $specimenID1 = $row['specimenID1'];
    $specimenID2 = $row['specimenID2'];
    $lowestTaxon = $row['lowestTaxon'];
    $lowestTaxonName = $row['lowestTaxonName'];
    $authorDate = $row['authorDate'];
    $locationID = $row['locationID'];
    $oldCASGNumber = $row['oldCASGNumber'];
    $previousCollection = $row['previousCollection'];
    $previousCollectionNo = $row['previousCollectionNo'];
    $fieldNumber = $row['fieldNumber'];
    $individualCount = $row['individualCount'];
    $identifiedBy = $row['identifiedBy'];
    $identifiedByDate = $row['identifiedByDate'];
    $previousID = $row['previousID'];
    $previousIDByDate = $row['previousIDByDate'];
    $taxonRemarks = $row['taxonRemarks'];
    $specimenCondition = $row['specimenCondition'];
    $collnNotes = $row['collnNotes'];
    $typeStatus = $row['typeStatus'];
    $photoID = $row['photoID'];
    $enteredBy = $row['enteredBy'];
    $enteredByDate = $row['enteredByDate'];
    $associatedSpecies = $row['associatedSpecies'];
    $authors = $row['authors'];
    $description = $row['description'];
    $sizeInCM = $row['sizeInCM'];
    $giftValue = $row['giftValue'];
    $latestValue = $row['latestValue'];
    $gramWeight = $row['gramWeight'];
    $informalName = $row['informalName'];
    $markingField = $row['markingField'];
    $datasetName = $row['datasetName'];

}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

;
?>



<!-- html table -->

<!-- 1st container for colln info table -->
<!-- row class will contain all three tables in one row -->
<!-- each col class will size the tables responsively in that one row -->
<div class="container">
  <div class="row"> 
    <div class="col"><b>Collection Information</b>
      <table class='table table-hover table-responsive table-sm' id='lotDetails_collnInfo'>
        <tr>
          <td>Accession ID</td> 
          <td><a href= "#"> php tag for accn ID will go here </a> </td>
        </tr> 

        <tr>
          <td>Case/Collection</td>
          <td><?php echo htmlspecialchars($caseColln, ENT_QUOTES);  ?></td>
        </tr>  

        <tr>
          <td>Drawer ID</td>
          <td><?php echo htmlspecialchars($collnDrawerID, ENT_QUOTES);  ?></td>
        </tr>  

        <tr>
          <td>Type Status</td>
          <td><?php echo htmlspecialchars($typeStatus, ENT_QUOTES);  ?></td>
        </tr>   

        <tr>
         <td>Specimen ID 1</td>
         <td><?php echo htmlspecialchars($specimenID1, ENT_QUOTES);  ?></td>
        </tr>  

        <tr>
         <td>Specimen ID 2</td>
         <td><?php echo htmlspecialchars($specimenID2, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
        <td>Photo ID</td>
        <td><a href= "#"> <?php echo htmlspecialchars($photoID, ENT_QUOTES);  ?> </a></td>
        </tr> 

        <tr>
         <td>Location ID</td>
         <td><?php echo htmlspecialchars($locationID, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Old CASG Number</td>
          <td><?php echo htmlspecialchars($oldCASGNumber, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
         <td>Previous Collection</td>
         <td><?php echo htmlspecialchars($previousCollection, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
         <td>Previous Collection Number</td>
         <td><?php echo htmlspecialchars($previousCollectionNo, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Field Number</td>
          <td><?php echo htmlspecialchars($fieldNumber, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Individual Count</td>
          <td><?php echo htmlspecialchars($individualCount, ENT_QUOTES);  ?></td>
        </tr>

         <tr>
         <td>Specimen Condition</td>
         <td><?php echo htmlspecialchars($specimenCondition, ENT_QUOTES);  ?></td>
        </tr>

        <tr>
          <td>Collection Notes</td>
          <td><?php echo htmlspecialchars($collnNotes);  ?></td>
         </tr>
        

        <tr>
          <td>Entered By</td>
          <td><?php echo htmlspecialchars($enteredBy, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Date Entered</td>
          <td><?php echo htmlspecialchars($enteredByDate, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
         <td>Associated Species</td>
         <td><?php echo htmlspecialchars($associatedSpecies, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
         <td>Authors</td>
         <td><?php echo htmlspecialchars($authors, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
         <td>Description</td>
         <td><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Size in CM</td>
         <td><?php echo htmlspecialchars($sizeInCM, ENT_QUOTES);  ?></td>
         </tr> 

        <tr>
         <td>Gift Value</td>
         <td><?php echo htmlspecialchars($giftValue, ENT_QUOTES);  ?></td>
        </tr> 

         <tr>
          <td>Latest Value</td>
          <td><?php echo htmlspecialchars($latestValue, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Weight in Grams</td>
          <td><?php echo htmlspecialchars($gramWeight, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
         <td>Informal Name</td>
         <td><?php echo htmlspecialchars($informalName, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
         <td>Marking Field</td>
         <td><?php echo htmlspecialchars($markingField, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Dataset Name</td>
          <td><?php echo htmlspecialchars($datasetName, ENT_QUOTES);  ?></td>
       </tr> 
      </table>
    <!-- end div for colln info table (1st table) -->
    </div>


    <!-- div for second table with col class to make responsible -->
    <div class="col"><b>Taxonomy</b>
      <table class='table table-hover table-responsive' id='lotDetails_taxonomy'>
    
       <tr>
    	   <td>Genus</td>
    	   <td><?php echo htmlspecialchars($genus, ENT_QUOTES);  ?></td>
   	    </tr> 

   	    <tr>
    	   <td>Species</td>
    	   <td><?php echo htmlspecialchars($species, ENT_QUOTES);  ?></td>
   	    </tr>  

   	    <tr>
    	   <td>Subspecies</td>
    	   <td><?php echo htmlspecialchars($subSpecies, ENT_QUOTES);  ?></td>
   	    </tr> 

   	    <tr>
           <td>Author Date</td>
           <td><?php echo htmlspecialchars($authorDate, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
    	   <td>Synonym</td>
    	   <td><?php echo htmlspecialchars($synonym, ENT_QUOTES);  ?></td>
   	    </tr>
   	
   	    <tr>
    	     <td>Lowest Taxon</td>
    	     <td><?php echo htmlspecialchars($lowestTaxon, ENT_QUOTES);  ?></td>
   	     </tr> 
   	    <tr>
    	   <td>Lowest Taxon Name</td>
    	   <td><?php echo htmlspecialchars($lowestTaxonName, ENT_QUOTES);  ?></td>
   	    </tr> 	

   	    
      </table>
    <!-- end 2nd table div -->
    </div>
    <div class="col"><b>Identification Information</b>
      <table class='table table-hover table-responsive' id='lotDetails_IDinfo'>
        <tr>
    	   <td>Identified By</td>
    	   <td><?php echo htmlspecialchars($identifiedBy, ENT_QUOTES);  ?></td>
   	    </tr> 
   	    <tr>
    	   <td>Date Identified</td>
    	   <td><?php echo htmlspecialchars($identifiedByDate, ENT_QUOTES);  ?></td>
   	    </tr> 
   	    <tr>
    	   <td>Previous ID</td>
    	   <td><?php echo htmlspecialchars($previousID, ENT_QUOTES);  ?></td>
   	    </tr> 
   	    <tr>
    	   <td>Date of Previous ID</td>
    	   <td><?php echo htmlspecialchars($previousIDByDate, ENT_QUOTES);  ?></td>
    	 </tr> 
    	 <tr>
    	   <td>Taxon Remarks</td>
    	   <td><?php echo htmlspecialchars($taxonRemarks, ENT_QUOTES);  ?></td>
   	    </tr> 	
      </table>
    <!-- end div for last table -->
    </div>
  <!-- end div for row that contains all tables in one row -->
  </div>
<!-- end container for the row that contains all tables -->
</div>
        
        
        
        
        
        
        
        </div> <!-- end .container -->
 </body>
</html>