<?php
include 'config/database.php';

if (isset($_POST['search_button'])) { // means "if the search button is clicked, do what's in this if block"
        //echo "user entered the genus: " . $searched_genus;

        if 
        (empty($_POST['genus_search']) && empty($_POST['species_search']) && empty($_POST['taxon_search']) && empty($_POST['continent_search']) && empty($_POST['country_search']) && empty($_POST['state_search']) && empty($_POST['county_search']) && empty($_POST['era_search']) && empty($_POST['locationID_search']) && empty($_POST['lotID_search']) && empty($_POST['previousColln_search'])) {

                  echo 'Please enter data in fields above to search.' ;
        } else {


    $sql = 'SELECT lot.caseColln, lot.collnDrawerID, lot.lotID, lot.genus, lot.species, locality.locationID, locality.country, locality.stateProvince, locality.county, 
            locality.earliestEraOrLowestErathem, locality.earliestPeriodOrLowestSystem, locality.earliestEpochOrLowestSeries 
            FROM lot INNER JOIN locality ON lot.locationID = locality.locationID WHERE';

    $sql_arr = array();

    // abandoned the key and binding array. went with binding parameters below
    // $placeholder_keys = array();
    // $placeholder_values = array();
    // $bind_arr = array();

   if 
        (!empty($_POST['genus_search'])) {
        $searched_genus = $_POST['genus_search'];

        array_push($sql_arr, ' lot.genus LIKE :entered_genus');
        // array_push($bind_arr, "'entered_genus' => %$searched_genus%"); this did not work
        // array_push($placeholder_keys, ':entered_genus');
        // array_push($placeholder_values, "'%$searched_genus%'"); these did kinda work      
    }

    if 
        (!empty($_POST['species_search'])) {
        $searched_species = $_POST['species_search'];

        array_push($sql_arr, ' lot.species LIKE :entered_species');
        // array_push($bind_arr, "'entered_species' => %$searched_species%");   
    }

    if 
        (!empty($_POST['taxon_search'])) {
        $searched_taxon = $_POST['taxon_search'];

        array_push($sql_arr, ' lot.lowestTaxonName LIKE :entered_taxon');
        // array_push($bind_arr, "'entered_species' => %$searched_species%");    
    }

    if 
        (!empty($_POST['continent_search'])) {
        $searched_continent = $_POST['continent_search'];

        array_push($sql_arr, ' locality.continent LIKE :entered_continent');
        // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
    }

    
    if 
        (!empty($_POST['country_search'])) {
        $searched_country = $_POST['country_search'];

        array_push($sql_arr, ' locality.country LIKE :entered_country');
        // array_push($bind_arr, "'entered_county' => %$searched_county%");
        // array_push($placeholder_keys, ':entered_country');
        // array_push($placeholder_values, "'%$searched_country%'");
        // array_push($bind_arr, array_combine($placeholder_keys, $placeholder_values));
    }

    if 
        (!empty($_POST['state_search'])) {
        $searched_state = $_POST['state_search'];

        array_push($sql_arr, ' locality.stateProvince LIKE :entered_state');
        // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");   
    }

    if 
        (!empty($_POST['county_search'])) {
        $searched_county = $_POST['county_search'];

        array_push($sql_arr, ' locality.county LIKE :entered_county');
        // array_push($bind_arr, "'entered_county' => %$searched_county%");
        // array_push($placeholder_keys, ':entered_county');
        // array_push($placeholder_values, "'%$searched_county%'");
        // array_push($bind_arr, array_combine($placeholder_keys, $placeholder_values));
    }

    if 
        (!empty($_POST['era_search'])) {
        $searched_era = $_POST['era_search'];

        array_push($sql_arr, ' locality.earliestEraOrLowestErathem LIKE :entered_era');
        // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
    }

    if 
        (!empty($_POST['locationID_search'])) {
        $searched_locationID = $_POST['locationID_search'];

        array_push($sql_arr, ' locality.locationID LIKE :entered_locationID');
        // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
    }

    if 
        (!empty($_POST['lot_search'])) {
        $searched_lotID = $_POST['lotID_search'];

        array_push($sql_arr, ' lot.lotID LIKE :entered_lotID');
        // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
    }

    if 
        (!empty($_POST['previousColln_search'])) {
        $searched_previousColln = $_POST['previousColln_search'];

        array_push($sql_arr, ' lot.previousCollection LIKE :entered_previousColln');
        // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
    }

    
    

    // print_r($sql_arr); echo "<br>";
    $sql .= implode(' AND ', $sql_arr);
    
    // $bind_param .= implode(', ', $bind_arr);
    // array_push($bind_arr, array_combine($placeholder_keys, $placeholder_values)); note that this did work to make a final array of keys
    //everything else in this commented block was for checking string generation. keeping for debugging later if things go awry.
    // print_r($sql); echo "<br>";
    // print_r($placeholder_keys); echo "<br>";
    // print_r($placeholder_values); echo "<br>";
    // print_r($bind_arr);




    // return to this code later. 
    // think you can add all the posted values into an array like above
    // then foreach $postedValue as $x
        //$stmt->bindValue($key, $value)
    // explore solution like that or this: 

    // $bind_arr = array_combine($placeholder_keys, $placeholder_values);
    // 
    // foreach ($bind_arr as $key => $value) {...

    $stmt = $con->prepare($sql);
        if (!empty($_POST['genus_search'])) {
            $stmt->bindValue(':entered_genus', '%'.$searched_genus.'%', PDO::PARAM_STR);
        }

        if (!empty($_POST['species_search'])) {
            $stmt->bindValue(':entered_species', '%'.$searched_species.'%', PDO::PARAM_STR);
        }

        if (!empty($_POST['taxon_search'])) {
            $stmt->bindValue(':entered_taxon', '%'.$searched_taxon.'%', PDO::PARAM_STR);
        }

        if (!empty($_POST['continent_search'])) {
            $stmt->bindValue(':entered_continent', '%'.$searched_continent.'%', PDO::PARAM_STR);
        }

        if (!empty($_POST['country_search'])) {
            $stmt->bindValue(':entered_country', '%'.$searched_country.'%', PDO::PARAM_STR);
        }

        if (!empty($_POST['state_search'])) {
            $stmt->bindValue(':entered_state', '%'.$searched_state.'%', PDO::PARAM_STR);
        }

        if (!empty($_POST['county_search'])) {
            $stmt->bindValue(':entered_county', '%'.$searched_county.'%', PDO::PARAM_STR);
        }

        if (!empty($_POST['era_search'])) {
            $stmt->bindValue(':entered_era', '%'.$searched_era.'%', PDO::PARAM_STR);
        }

        if (!empty($_POST['locationID_search'])) {
            $stmt->bindValue(':entered_locationID', $searched_locationID, PDO::PARAM_STR);
        }

        if (!empty($_POST['lotID_search'])) {
            $stmt->bindValue(':entered_lotID', '%'.$searched_lotID.'%', PDO::PARAM_STR);
        }

        if (!empty($_POST['previousColln_search'])) {
            $stmt->bindValue(':entered_previousColln', '%'.$searched_previousColln.'%', PDO::PARAM_STR);
        }
              
    
    
    $stmt->execute();
    
    $numrows=$stmt->rowCount();


    echo "<table class='table table-hover table-bordered' id='sortTable' >";
 
    //creating our table heading
	echo "<thead>";

    echo "<tr>";
        echo "<th>Case/Collection</th>";
        echo "<th>Drawer ID</th>"; 
        echo "<th>Lot ID</th>";
        echo "<th>Genus</th>";
        echo "<th>Species</th>";
        echo "<th>Location ID</th>";
        echo "<th>Country</th>";
        echo "<th>State/Province</th>";
        echo "<th>County</th>";
        echo "<th>Earliest Era</th>";
        echo "<th>Earliest Period</th>";
        echo "<th>Earliest Epoch</th>";
        
    echo "</tr>";
    echo "</thead>";
     
    // table body
    //loop through each post
    // this while loop was orginally right underneath stmt execute, but had to move it down to make way for table creation
  
   
   

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

       extract($row); // extract row
        // this will make $row['firstname'] to
        // just $firstname only
       	echo "<tr>"; // had added break here at beginning of each row, but don't need it anymore now that there's css and bootstrap formatting
        echo "<td>{$caseColln} </td>";
       	echo "<td>{$collnDrawerID} </td>";
        echo "<td>{$lotID} </td>"; 
        echo "<td>{$genus} </td>";
        echo "<td>{$species} </td>";
        echo "<td>{$locationID} </td>";
        echo "<td>{$country} </td>";
        echo "<td>{$stateProvince} </td>";
        echo "<td>{$county} </td>";
        echo "<td>{$earliestEraOrLowestErathem} </td>";
        echo "<td>{$earliestPeriodOrLowestSystem} </td>";
        echo "<td>{$earliestEpochOrLowestSeries} </td>";
        echo "</tr>";
       
        
 	};
// end table
echo "</table>"; 



// echo "<script>
// $(document).ready(function() {
// $('#sortTable').DataTable();
// } );
// </script>"; having script here or in html head doesn't matter; they both work




// end if loop for clicking search button and no fields are entered (inner loop)
}  
// end if loop for executing all other searches (outer loop) 
}
?>

