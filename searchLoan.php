<?php
include 'config/database.php';

if (isset($_POST['search_button'])) { // means "if the search button is clicked, do what's in this if block"
        //echo "user entered the genus: " . $searched_genus;

        if 
        (empty($_POST['loanID_search']) && empty($_POST['personID_search']) && empty($_POST['personLastName_search'])

        	//  && empty($_POST['continent_search']) && empty($_POST['country_search']) && empty($_POST['state_search']) && empty($_POST['county_search']) && empty($_POST['era_search']) && empty($_POST['locationID_search']) && empty($_POST['lotID_search']) && empty($_POST['previousColln_search'])
    			) {

                  echo 'Please enter data in fields above to search.' ;
        } else {


    $sql = 'SELECT loan.loanID, loan.personID, loan.dateSent, loan.dateDue, loan.dateClosed, loan.authorizedBy, loan.loanNotes, loan.personsFirstName, loan.personsLastName

    	-- not ready to join lot and loc info to loan yet. need to sort out table in db first
     	-- lot.caseColln, lot.collnDrawerID, lot.lotID, lot.genus, lot.species, locality.locationID, locality.country, locality.stateProvince, locality.county, locality.earliestEraOrLowestErathem, locality.earliestPeriodOrLowestSystem, locality.earliestEpochOrLowestSeries 
            FROM loan WHERE';

    $sql_arr = array();

    if 
        (!empty($_POST['loanID_search'])) {
        $searched_loanID = $_POST['loanID_search'];

        array_push($sql_arr, ' loan.loanID LIKE :entered_loanID');
    }

	if 
        (!empty($_POST['personID_search'])) {
        $searched_personID = $_POST['personID_search'];

        array_push($sql_arr, ' loan.personID LIKE :entered_personID');

    }


    $sql .= implode(' AND ', $sql_arr);


    $stmt = $con->prepare($sql);
        if (!empty($_POST['loanID_search'])) {
            $stmt->bindValue(':entered_loanID', '%'.$searched_loanID.'%', PDO::PARAM_STR);
        }

        if (!empty($_POST['personID_search'])) {
            $stmt->bindValue(':entered_personID', '%'.$searched_personID.'%', PDO::PARAM_STR);
        }



$stmt->execute();
    
    $numrows=$stmt->rowCount();


    echo "<table class='table table-hover table-bordered' id='sortTable' >";
 
    //creating our table heading
	echo "<thead>";

    echo "<tr>";
        echo "<th>Loan ID</th>";
        echo "<th>Person ID</th>"; 
        echo "<th>Date Sent</th>";
        echo "<th>Date Due</th>";
        echo "<th>Date Closed</th>";
        echo "<th>Authorized By</th>";
        echo "<th>Loan Notes</th>";
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        // echo "<th>Earliest Era</th>";
        // echo "<th>Earliest Period</th>";
        // echo "<th>Earliest Epoch</th>";
        
    echo "</tr>";
    echo "</thead>";
     

     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

       extract($row); // extract row
        // this will make $row['firstname'] to
        // just $firstname only
       $loanID_url = "loanID_info.php?loanID=" . "{$loanID}";
       	echo "<tr>"; // had added break here at beginning of each row, but don't need it anymore now that there's css and bootstrap formatting
        echo "<td>" . "<a href='".$loanID_url."'> {$loanID}  </a>" . "</td>";
       	echo "<td>{$personID} </td>";
        echo "<td>{$dateSent} </td>"; 
        echo "<td>{$dateDue} </td>";
        echo "<td>{$dateClosed} </td>";
        echo "<td>{$authorizedBy} </td>";
        echo "<td>{$loanNotes} </td>";
        echo "<td>{$personsFirstName} </td>";
        echo "<td>{$personsLastName} </td>";
        // echo "<td>{$earliestEraOrLowestErathem} </td>";
        // echo "<td>{$earliestPeriodOrLowestSystem} </td>";
        // echo "<td>{$earliestEpochOrLowestSeries} </td>";
        echo "</tr>";
       
        
 	};
// end table
echo "</table>"; 

// end if loop for clicking search button and no fields are entered (inner loop)
}  
// end if loop for executing all other searches (outer loop) 
}
?>