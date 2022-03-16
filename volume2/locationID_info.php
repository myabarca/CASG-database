<!DOCTYPE HTML>
<html>
    <head>
        <title>Locality Information</title> 
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
<!-- // get passed parameter value, in this case, the location ID
// moved this up after body tag and before page header to get location ID number in page header -->

<!-- container for whole page-->
    <div class="container">
 
        <div class="page-header">
            <h1>Information for Location ID <?php echo htmlspecialchars($locationID, ENT_QUOTES);  ?></h1>
        </div>
<?php


 
//include database connection
include 'config/database.php';
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT * FROM locality WHERE locality.locationID = ?";

    $stmt = $con->prepare($query);
 
    // this is the first question mark
    $stmt->bindParam(1, $locationID);
    
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $recordedBy = $row['recordedBy'];
    $verbatimEventDate = $row['verbatimEventDate'];
    $continent = $row['continent'];
    $waterBody = $row['waterBody'];
    $islandGroup = $row['islandGroup'];
    $island = $row['island'];
    $country = $row['country'];
    $stateProvince = $row['stateProvince'];
    $county = $row['county'];
    $fieldNumber = $row['fieldNumber'];
    $prevCollection = $row['prevCollection'];
    $prevCollLocNumber = $row['prevCollLocNumber'];
    $verbatimLocality = $row['verbatimLocality'];
    $locality = $row['locality'];
    $localitySource = $row['localitySource'];
    $alternateLocalitySource = $row['alternateLocalitySource'];
    $sectionTownRange = $row['sectionTownRange'];
    $cleanedSTR = $row['cleanedSTR'];
    $earliestEonOrLowestEonothem = $row['earliestEonOrLowestEonothem'];
    $latestEonOrHighestEonothem = $row['latestEonOrHighestEonothem'];
    $earliestEraOrLowestErathem = $row['earliestEraOrLowestErathem'];
    $latestEraOrHighestErathem = $row['latestEraOrHighestErathem'];
    $earliestPeriodOrLowestSystem = $row['earliestPeriodOrLowestSystem'];
    $latestPeriodOrHighestSystem = $row['latestPeriodOrHighestSystem'];
    $earliestEpochOrLowestSeries = $row['earliestEpochOrLowestSeries'];
    $latestEpochOrHighestSeries = $row['latestEpochOrHighestSeries'];
    $earliestAgeOrLowestStage = $row['earliestAgeOrLowestStage'];
    $latestAgeOrHighestStage = $row['latestAgeOrHighestStage'];
    $ageQualifier = $row['ageQualifier'];
    $stage = $row['stage'];
    $stratGroup = $row['stratGroup'];
    $stratFormation = $row['stratFormation'];
    $stratMember = $row['stratMember'];
    $stratBed = $row['stratBed'];
    $bioZone = $row['bioZone'];
    $lithology = $row['lithology'];
    $map = $row['map'];
    $USGSLocalityPlaceName = $row['USGSLocalityPlaceName'];
    $localityNotes = $row['localityNotes'];
    $verbatimLatitude = $row['verbatimLatitude'];
    $verbatimLongitude = $row['verbatimLongitude'];
    $geodeticDatum = $row['geodeticDatum'];
    $verbatimCoordinates = $row['verbatimCoordinates'];
    $verbatimSRS = $row['verbatimSRS'];
    $depthMeters = $row['depthMeters'];
    $verbatimDepth = $row['verbatimDepth'];
    $elevationMeters = $row['elevationMeters'];
    $verbatimElevation = $row['verbatimElevation'];
    $donor = $row['donor'];
    $donationDate = $row['donationDate'];
    $associatedSpecimens = $row['associatedSpecimens'];
    $modHistory = $row['modHistory'];
    $enteredBy_loc = $row['enteredBy'];
    $enteredByDate_loc = $row['enteredByDate'];
    $remarks = $row['remarks'];


    
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

;
?>

<?php $georef_locationID_url = "georef_info.php?locationID=" . "{$locationID}"; 
// print_r ($georef_locationID_url); ?>


<!-- html table -->

<!-- 1st div container holds all info tables -->
<!-- row class will contain all three tables in one row -->
<!-- each col class will size the tables responsively in that one row -->
<div class="container">
  <div class="row"> 
    <div class="col"><b>Geographic Information</b>
      <table class='table table-hover table-responsive table-sm' id='locationInfo_geography'>

        <tr>  
          <td>Georeference Data</td>
          <td><a href="<?php echo $georef_locationID_url;?>" class="btn btn-link btn-sm" name="georef_button">See georeference data</a></td>
        </tr>

        <tr>
          <td>Continent</td> 
          <td><?php echo htmlspecialchars($continent, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Country</td>
          <td><?php echo htmlspecialchars($country, ENT_QUOTES);  ?></td>
        </tr>  

        <tr>
          <td>State/Province</td>
          <td><?php echo htmlspecialchars($stateProvince, ENT_QUOTES);  ?></td>
        </tr>  

        <tr>
          <td>County</td>
          <td><?php echo htmlspecialchars($county, ENT_QUOTES);  ?></td>
        </tr>   

        <tr>
         <td>Verbatim Locality</td>
         <td><?php echo htmlspecialchars($verbatimLocality, ENT_QUOTES);  ?></td>
        </tr>  

        <tr>
         <td>Interpreted Locality</td>
         <td><?php echo htmlspecialchars($locality, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
        <td>Water Body</td>
        <td><?php echo htmlspecialchars($waterBody, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
         <td>Island Group</td>
         <td><?php echo htmlspecialchars($islandGroup, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Island</td>
          <td><?php echo htmlspecialchars($island, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
         <td>Section Town Range</td>
         <td><?php echo htmlspecialchars($sectionTownRange, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
         <td>Cleaned Section Town Range</td>
         <td><?php echo htmlspecialchars($cleanedSTR, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Map</td>
          <td><?php echo htmlspecialchars($map, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>USGS Locality Place Name</td>
          <td><?php echo htmlspecialchars($USGSLocalityPlaceName, ENT_QUOTES);  ?></td>
        </tr>

         <tr>
         <td>Depth (meters)</td>
         <td><?php echo htmlspecialchars($depthMeters, ENT_QUOTES);  ?></td>
        </tr>

        <tr>
          <td>Verbatim Depth</td>
          <td><?php echo htmlspecialchars($verbatimDepth);  ?></td>
         </tr>
        

        <tr>
          <td>Elevation (meters)</td>
          <td><?php echo htmlspecialchars($elevationMeters, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Verbatim Elevation</td>
          <td><?php echo htmlspecialchars($verbatimElevation, ENT_QUOTES);  ?></td>
       </tr> 

      </table>
    <!-- end div for geographic info table (1st table) -->
    </div>

    <!-- div for second table -->
    <div class="col"><b>Age and Stratigraphy</b>
      <table class='table table-hover table-responsive' id='locationInfo_age-and-strat'>

       <tr>
         <td>Earliest Eon</td>
         <td><?php echo htmlspecialchars($earliestEonOrLowestEonothem, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
         <td>Latest Eon</td>
         <td><?php echo htmlspecialchars($latestEonOrHighestEonothem, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
         <td>Earliest Era</td>
         <td><?php echo htmlspecialchars($earliestEraOrLowestErathem, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Latest Era</td>
         <td><?php echo htmlspecialchars($latestEraOrHighestErathem, ENT_QUOTES);  ?></td>
         </tr> 

        <tr>
         <td>Earliest Period</td>
         <td><?php echo htmlspecialchars($earliestPeriodOrLowestSystem, ENT_QUOTES);  ?></td>
        </tr> 

         <tr>
          <td>Latest Period</td>
          <td><?php echo htmlspecialchars($latestPeriodOrHighestSystem, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Earliest Epoch</td>
          <td><?php echo htmlspecialchars($earliestEpochOrLowestSeries, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
         <td>Latest Epoch</td>
         <td><?php echo htmlspecialchars($latestEpochOrHighestSeries, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
         <td>Earliest Age</td>
         <td><?php echo htmlspecialchars($earliestAgeOrLowestStage, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
          <td>Latest Age</td>
          <td><?php echo htmlspecialchars($latestAgeOrHighestStage, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Age Qualifier</td>
          <td><?php echo htmlspecialchars($ageQualifier, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Stage</td>
          <td><?php echo htmlspecialchars($stage, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Strat Group</td>
          <td><?php echo htmlspecialchars($stratGroup, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Strat Formation</td>
          <td><?php echo htmlspecialchars($stratFormation, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Strat Member</td>
          <td><?php echo htmlspecialchars($stratMember, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Strat Bed</td>
          <td><?php echo htmlspecialchars($stratBed, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Bio Zone</td>
          <td><?php echo htmlspecialchars($bioZone, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Lithology</td>
          <td><?php echo htmlspecialchars($lithology, ENT_QUOTES);  ?></td>
       </tr> 
      </table>
    <!-- end div for age & strat info table (2nd table) -->
    </div>


    <!-- div for third table with col class to make responsive -->
    <div class="col"><b>Collection Information</b>
      <table class='table table-hover table-responsive' id='locationInfo_colln'>
    
       <tr>
    	   <td>Recorded By</td>
    	   <td><?php echo htmlspecialchars($recordedBy, ENT_QUOTES);  ?></td>
   	    </tr> 

   	    <tr>
    	   <td>Collection Date</td>
    	   <td><?php echo htmlspecialchars($verbatimEventDate, ENT_QUOTES);  ?></td>
   	    </tr>  

   	    <tr>
    	   <td>Field Number</td>
    	   <td><?php echo htmlspecialchars($fieldNumber, ENT_QUOTES);  ?></td>
   	    </tr> 

   	    <tr>
           <td>Previous Collection</td>
           <td><?php echo htmlspecialchars($prevCollection, ENT_QUOTES);  ?></td>
        </tr> 

        <tr>
    	   <td>Previous Collection Location Number</td>
    	   <td><?php echo htmlspecialchars($prevCollLocNumber, ENT_QUOTES);  ?></td>
   	    </tr>
   	
   	    <tr>
    	     <td>Locality Source</td>
    	     <td><?php echo htmlspecialchars($localitySource, ENT_QUOTES);  ?></td>
   	     </tr> 

   	    <tr>
    	   <td>Alternate Locality Source</td>
    	   <td><?php echo htmlspecialchars($alternateLocalitySource, ENT_QUOTES);  ?></td>
   	    </tr> 	

        <tr>
          <td>Locality Notes</td>
          <td><?php echo htmlspecialchars($localityNotes, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Donor</td>
          <td><?php echo htmlspecialchars($donor, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Donation Date</td>
          <td><?php echo htmlspecialchars($donationDate, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Associated Specimens</td>
          <td><?php echo htmlspecialchars($associatedSpecimens, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Mod History</td>
          <td><?php echo htmlspecialchars($modHistory, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Entered By</td>
          <td><?php echo htmlspecialchars($enteredBy_loc, ENT_QUOTES);  ?></td>
       </tr> 
       <tr>
          <td>Entered By Date</td>
          <td><?php echo htmlspecialchars($enteredByDate_loc, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>
          <td>Remarks</td>
          <td><?php echo htmlspecialchars($remarks, ENT_QUOTES);  ?></td>
       </tr> 

       <tr>  
          <td>Collection Documents</td>
          <td><a href="locality-pdfs/dry-creek1.pdf" target="_blank">See scans of available collection documents</a></td>
        </tr>
        <!-- this will probably be a url to a page that will execute new query selecting all pdfs related to a locationID -->
   	    
      </table>
    <!-- end 3rd table div -->
    </div>
  <!-- end div for row that contains all tables in one row -->
  </div>
<!-- end container for the row that contains all tables -->
</div>
        
        
        
        
        
        
        
  </div>  --><!-- end container for whole page
 </body>
</html>