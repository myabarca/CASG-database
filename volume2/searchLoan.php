<?php
include 'config/database.php';

if (isset($_POST['search_button'])) { // means "if the search button is clicked, do what's in this if block"
        

        if 
        (empty($_POST['loanID_search']) && empty($_POST['personID_search']) && empty($_POST['personLastName_search']) && empty($_POST['dateSent_search']
        ) && empty($_POST['lotID_search'])

        	//  && empty($_POST['continent_search']) && empty($_POST['country_search']) && empty($_POST['state_search']) && empty($_POST['county_search']) && empty($_POST['era_search']) && empty($_POST['locationID_search']) && empty($_POST['lotID_search']) && empty($_POST['previousColln_search'])
    			) {

                  echo 'Please enter data in fields above to search.' ;
        } else {


    $sql = 'SELECT * FROM loan_lots WHERE';

    	//  not ready to join lot and loc info to loan yet. need to sort out table in db first. DONE 10/8/2021
    	// also, relationship for last name and first name will change since that info is only in persons table going forward
            // same for other columns 
     // lot.caseColln, lot.collnDrawerID, lot.lotID, lot.genus, lot.species, locality.locationID, locality.country, locality.stateProvince, locality.county, locality.earliestEraOrLowestErathem, locality.earliestPeriodOrLowestSystem, locality.earliestEpochOrLowestSeries 
     //        FROM loan WHERE

    $sql_arr = array();

    if 
        (!empty($_POST['loanID_search'])) {
        $searched_loanID = $_POST['loanID_search'];

        array_push($sql_arr, ' loan_lots.loanID = :entered_loanID');
    }

    if 
        (!empty($_POST['lotID_search'])) {
        $searched_lotID = $_POST['lotID_search'];

        array_push($sql_arr, ' loan_lots.lotID = :entered_lotID');
    }

	if 
        (!empty($_POST['personID_search'])) {
        $searched_personID = $_POST['personID_search'];

        array_push($sql_arr, ' loan_lots.personPersonID = :entered_personID');

    }
    
    if 
        (!empty($_POST['personLastName_search'])) {
        $searched_personLastName = $_POST['personLastName_search'];

        array_push($sql_arr, ' loan_lots.personLastName LIKE :entered_lastName');

    }

    if 
        (!empty($_POST['dateSent_search'])) {
        $searched_dateSent = $_POST['dateSent_search'];

        array_push($sql_arr, ' loan_lots.loansDateSent LIKE :entered_dateSent');

    }
 

    $sql .= implode(' AND ', $sql_arr);


    $stmt = $con->prepare($sql);
        if (!empty($_POST['loanID_search'])) {
            $stmt->bindValue(':entered_loanID', $searched_loanID, PDO::PARAM_STR);
        }

        if (!empty($_POST['lotID_search'])) {
            $stmt->bindValue(':entered_lotID', $searched_lotID, PDO::PARAM_STR);
        }

        if (!empty($_POST['personID_search'])) {
            $stmt->bindValue(':entered_personID', $searched_personID, PDO::PARAM_STR);
        }
        
        if (!empty($_POST['personLastName_search'])) {
            $stmt->bindValue(':entered_lastName', '%'.$searched_personLastName.'%', PDO::PARAM_STR);
        }

        if (!empty($_POST['dateSent_search'])) {
            $stmt->bindValue(':entered_dateSent', '%'.$searched_dateSent.'%', PDO::PARAM_STR);
        }


    $stmt->execute();


    $numrows=$stmt->rowCount();


    echo "<table class='table table-hover table-bordered' id='loanTable' >";
 
    //creating our table heading
	echo "<thead>";

    echo "<tr>";
        echo "<th>Action</th>";
        echo "<th>Lot ID</th>";
        echo "<th>Loan ID</th>";
        echo "<th>Person ID</th>"; 
        echo "<th>Date Sent</th>";
        echo "<th>Date Closed</th>";
        echo "<th>Notes</th>";
        echo "<th>Last Name</th>";  
                
    echo "</tr>";
    echo "</thead>";
     
     // loop through table body
     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

       extract($row); // extract row
       echo "<tr>";
        // this will make $row['firstname'] to
        // just $firstname only
       $loanID_url = "loanID_info.php?loanID=" . "{$loanID}";
       $personID_url = "personID_info.php?personID=" . "{$personPersonID}";
       $lotID_url = "lotID_info.php?lotID=" . "{$lotID}";
       // in order to add links for lotID, going to need to access lot table in query eventually
       // the urls go here in the stmt fetch iteration because all of the links will be made in each iteration
       //neat!
        echo "<td>" . "<a href='update-loan-form.php?loanID={$loanID}'class='btn btn-primary m-r-1em' name='updateLoanButton'>Edit</a>" . "</td>";
       	echo "<td>" . "<a href='".$lotID_url."'>{$lotID} </a>" . "</td>";   
        echo "<td>" . "<a href='".$loanID_url."'>{$loanID}  </a>" . "</td>";
       	echo "<td>" . "<a href='".$personID_url."'>{$personPersonID} </a>" . "</td>";      
        
        //echo "<td>{$loanID}</td>"; 
        //echo "<td>{$personPersonID}</td>"; 
        echo "<td>{$loansDateSent}</td>";
        echo "<td>{$loansDateClosed}</td>";
        echo "<td>{$notes}</td>";
        echo "<td>{$personLastName}</td>";
        echo "</tr>";
       
        
 	};
// end table
echo "</table>"; 

// end if loop for clicking search button and no fields are entered (inner loop)
}  
// end if loop for executing all other searches (outer loop) 
}
?>