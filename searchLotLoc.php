<?php
include 'config/database.php';

if (isset($_POST['search_button'])) { 
        // means "if the search button is clicked, do what's in this if block"
        //echo "user entered the genus: " . $searched_genus;

        // note that empty(0) returns true (0 is seen as "empty"), so empty won't work for fields where 0 is an acceptable value. php just thinks it's empty. so have to combine isset & < 0 to check that locs and lots with ID's of 0 can be passed into search    

        if (empty($_POST['genus_search']) && empty($_POST['species_search']) && empty($_POST['taxon_search']) && empty($_POST['continent_search']) &&empty($_POST['country_search']) && empty($_POST['state_search']) && empty($_POST['county_search']) && empty($_POST['eon_search']) && empty($_POST['era_search']) && empty($_POST['period_search']) && empty($_POST['epoch_search']) && empty($_POST['age_search']) && empty($_POST['stage_search']) && empty($_POST['stratgrp_search']) && empty($_POST['stratform_search']) && empty($_POST['stratmem_search']) && isset($_POST['locationID_search']) && $_POST['locationID_search'] < 0 && isset($_POST['lotID_search']) && $_POST['lotID_search'] < 0 && isset($_POST['previousColln_search']) && $_POST['previousColln_search'] < 0 && empty($_POST['collector_search'])) {

            echo 'Please enter valid data in fields above to search.' ;

        } elseif (($_POST['minlat_search']=="") && ($_POST['minlong_search']=="") && ($_POST['maxlong_search']=="") && ($_POST['maxlat_search']=="")) {

            $sql = 'SELECT lot.caseColln, lot.collnDrawerID, lot.lotID, lot.genus, lot.species, locality.locationID, locality.country, locality.stateProvince, locality.county, 
            locality.earliestEraOrLowestErathem, locality.earliestPeriodOrLowestSystem, locality.earliestEpochOrLowestSeries 
            FROM lot INNER JOIN locality ON lot.locationID = locality.locationID WHERE';

            $sql_arr = array();

            if (!empty($_POST['genus_search'])) {
            $searched_genus = $_POST['genus_search'];

            array_push($sql_arr, ' lot.genus LIKE :entered_genus');
            // array_push($bind_arr, "'entered_genus' => %$searched_genus%"); this did not work
            // array_push($placeholder_keys, ':entered_genus');
            // array_push($placeholder_values, "'%$searched_genus%'"); these did kinda work      
            }

            if (!empty($_POST['species_search'])) {
            $searched_species = $_POST['species_search'];

            array_push($sql_arr, ' lot.species LIKE :entered_species');
            // array_push($bind_arr, "'entered_species' => %$searched_species%");   
            }

            if (!empty($_POST['taxon_search'])) {
            $searched_taxon = $_POST['taxon_search'];

            array_push($sql_arr, ' lot.lowestTaxonName LIKE :entered_taxon');
            // array_push($bind_arr, "'entered_species' => %$searched_species%");    
            }

            if (!empty($_POST['continent_search'])) {
            $searched_continent = $_POST['continent_search'];

            array_push($sql_arr, ' locality.continent LIKE :entered_continent');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

    
            if (!empty($_POST['country_search'])) {
            $searched_country = $_POST['country_search'];

            array_push($sql_arr, ' locality.country LIKE :entered_country');
            // array_push($bind_arr, "'entered_county' => %$searched_county%");
            // array_push($placeholder_keys, ':entered_country');
            // array_push($placeholder_values, "'%$searched_country%'");
            // array_push($bind_arr, array_combine($placeholder_keys, $placeholder_values));
            }

            if (!empty($_POST['state_search'])) {
            $searched_state = $_POST['state_search'];

            array_push($sql_arr, ' locality.stateProvince LIKE :entered_state');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");   
            }

            if (!empty($_POST['county_search'])) {
            $searched_county = $_POST['county_search'];

            array_push($sql_arr, ' locality.county LIKE :entered_county');
            // array_push($bind_arr, "'entered_county' => %$searched_county%");
            // array_push($placeholder_keys, ':entered_county');
            // array_push($placeholder_values, "'%$searched_county%'");
            // array_push($bind_arr, array_combine($placeholder_keys, $placeholder_values));
            }

            if (!empty($_POST['eon_search'])) {
            $searched_eon = $_POST['eon_search'];

            array_push($sql_arr, ' locality.earliestEonOrLowestEonothem OR locality.latestEonOrHighestEonothem LIKE :entered_eon');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }


            if (!empty($_POST['era_search'])) {
            $searched_era = $_POST['era_search'];

            array_push($sql_arr, ' locality.earliestEraOrLowestErathem OR locality.latestEraOrHighestErathem LIKE :entered_era');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if (!empty($_POST['period_search'])) {
            $searched_period = $_POST['period_search'];

            array_push($sql_arr, ' locality.earliestPeriodOrLowestSystem OR locality.latestPeriodOrHighestSystem LIKE :entered_period');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if (!empty($_POST['epoch_search'])) {
            $searched_epoch = $_POST['epoch_search'];

            array_push($sql_arr, ' locality.earliestEpochOrLowestSeries OR locality.latestEpochOrHighestSeries LIKE :entered_epoch');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if (!empty($_POST['age_search'])) {
            $searched_age = $_POST['age_search'];

            array_push($sql_arr, ' locality.earliestAgeOrLowestStage OR locality.latestAgeOrHighestStage LIKE :entered_age');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if (!empty($_POST['stage_search'])) {
            $searched_stage = $_POST['stage_search'];

            array_push($sql_arr, ' locality.stage LIKE :entered_stage');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if (!empty($_POST['stratgrp_search'])) {
            $searched_stratgrp = $_POST['stratgrp_search'];

            array_push($sql_arr, ' locality.stratGroup LIKE :entered_stratgrp');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if (!empty($_POST['stratform_search'])) {
            $searched_stratform = $_POST['stratform_search'];

            array_push($sql_arr, ' locality.stratFormation LIKE :entered_stratform');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if (!empty($_POST['stratmem_search'])) {
            $searched_stratmem = $_POST['stratmem_search'];

            array_push($sql_arr, ' locality.stratMember LIKE :entered_stratmem');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if //similarly as above, can't use empty() here because 0 is a valid value and doesn't mean null/false here
            (isset($_POST['locationID_search']) && $_POST['locationID_search'] >= 0) {
            $searched_locationID = $_POST['locationID_search'];

            array_push($sql_arr, ' locality.locationID LIKE :entered_locationID');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if (isset($_POST['lotID_search']) && $_POST['lotID_search'] >= 0) {
            $searched_lotID = $_POST['lotID_search'];

            array_push($sql_arr, ' lot.lotID LIKE :entered_lotID');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if (isset($_POST['previousColln_search']) && $_POST['previousColln_search'] >= 0) {
            $searched_previousColln = $_POST['previousColln_search'];

            array_push($sql_arr, ' lot.previousCollection LIKE :entered_previousColln');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if (!empty($_POST['collector_search'])) {
            $searched_collector = $_POST['collector_search'];

            array_push($sql_arr, ' locality.recordedBy LIKE :entered_collector');
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

            // or do it like the sql array. build it up like sql array and store in a bind array, then call the bind array?

            // BECAUSE THIS IS REALLY HORRIBLE

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

            if (!empty($_POST['eon_search'])) {
            $stmt->bindValue(':entered_eon', '%'.$searched_eon.'%', PDO::PARAM_STR);
            }

            if (!empty($_POST['era_search'])) {
            $stmt->bindValue(':entered_era', '%'.$searched_era.'%', PDO::PARAM_STR);
            }

            if (!empty($_POST['period_search'])) {
            $stmt->bindValue(':entered_period', '%'.$searched_period.'%', PDO::PARAM_STR);
            }

            if (!empty($_POST['epoch_search'])) {
            $stmt->bindValue(':entered_epoch', '%'.$searched_epoch.'%', PDO::PARAM_STR);
            }

            if (!empty($_POST['age_search'])) {
            $stmt->bindValue(':entered_age', '%'.$searched_age.'%', PDO::PARAM_STR);
            }

            if (!empty($_POST['stage_search'])) {
            $stmt->bindValue(':entered_stage', '%'.$searched_stage.'%', PDO::PARAM_STR);
            }

            if (!empty($_POST['stratgrp_search'])) {
            $stmt->bindValue(':entered_stratgrp', '%'.$searched_stratgrp.'%', PDO::PARAM_STR);
            }

            if (!empty($_POST['stratform_search'])) {
            $stmt->bindValue(':entered_stratform', '%'.$searched_stratform.'%', PDO::PARAM_STR);
            }

            if (!empty($_POST['stratmem_search'])) {
            $stmt->bindValue(':entered_stratmem', '%'.$searched_stratmem.'%', PDO::PARAM_STR);
            }

            //similarly as above, can't use empty() here because 0 is a valid value and doesn't mean null/false here
            if (isset($_POST['locationID_search']) && $_POST['locationID_search'] >= 0) {
            $stmt->bindValue(':entered_locationID', $searched_locationID, PDO::PARAM_STR);
            }

            if (isset($_POST['lotID_search']) && $_POST['lotID_search'] >= 0) {
            $stmt->bindValue(':entered_lotID', '%'.$searched_lotID.'%', PDO::PARAM_STR);
            }

            if (isset($_POST['previousColln_search']) && $_POST['previousColln_search'] >= 0) {
            $stmt->bindValue(':entered_previousColln', '%'.$searched_previousColln.'%', PDO::PARAM_STR);
            }

            if (!empty($_POST['collector_search'])) {
            $stmt->bindValue(':entered_collector', '%'.$searched_collector.'%', PDO::PARAM_STR);
            }
              
            //print_r($stmt); echo "<br>";
            //print_r($searched_previousColln); echo "<br>";
    
            $stmt->execute();
    
            $numrows=$stmt->rowCount();

            // table column creation

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
            $lotID_url = "lotID_info.php?lotID=" . "{$lotID}";
            $locationID_url = "locationID_info.php?locationID=" . "{$locationID}";
            // the urls go here in the stmt fetch iteration because all of the links will be made in each iteration
            //neat!

            echo "<tr>"; // had added break here at beginning of each row, but don't need it anymore now that there's css and bootstrap formatting
            echo "<td>{$caseColln} </td>";
            echo "<td>{$collnDrawerID} </td>";
            echo "<td>" . "<a href='".$lotID_url."'> {$lotID}  </a>" . "</td>"; 
            echo "<td>{$genus} </td>";
            echo "<td>{$species} </td>";
            echo "<td>" . "<a href='".$locationID_url."'> {$locationID}  </a>" . "</td>";
            echo "<td>{$country} </td>";
            echo "<td>{$stateProvince} </td>";
            echo "<td>{$county} </td>";
            echo "<td>{$earliestEraOrLowestErathem} </td>";
            echo "<td>{$earliestPeriodOrLowestSystem} </td>";
            echo "<td>{$earliestEpochOrLowestSeries} </td>";
            echo "</tr>";
       
            //end while loop
            };

            // end table
            echo "</table>"; 



            // echo "<script>
            // $(document).ready(function() {
            // $('#sortTable').DataTable();
            // } );
            // </script>"; having script here or in html head doesn't matter; they both work

        } else  {
        
            $sql = 'SELECT lot.caseColln, lot.collnDrawerID, lot.lotID, lot.genus, lot.species, locality.locationID, locality.country, locality.stateProvince, locality.county, 
            locality.earliestEraOrLowestErathem, locality.earliestPeriodOrLowestSystem, locality.earliestEpochOrLowestSeries 
            FROM lot INNER JOIN locality ON lot.locationID = locality.locationID 
            INNER JOIN georeference on locality.locationID = georeference.locationID WHERE'; 

            $sql_arr = array();
    
            if (!empty($_POST['genus_search'])) {
                $searched_genus = $_POST['genus_search'];

                array_push($sql_arr, ' lot.genus LIKE :entered_genus');
                // array_push($bind_arr, "'entered_genus' => %$searched_genus%"); this did not work
                // array_push($placeholder_keys, ':entered_genus');
                // array_push($placeholder_values, "'%$searched_genus%'"); these did kinda work      
            }

            if (!empty($_POST['species_search'])) {
                $searched_species = $_POST['species_search'];

                array_push($sql_arr, ' lot.species LIKE :entered_species');
                // array_push($bind_arr, "'entered_species' => %$searched_species%");   
            }

            if (!empty($_POST['taxon_search'])) {
                $searched_taxon = $_POST['taxon_search'];

                array_push($sql_arr, ' lot.lowestTaxonName LIKE :entered_taxon');
                // array_push($bind_arr, "'entered_species' => %$searched_species%");    
            }

            if (!empty($_POST['continent_search'])) {
            $searched_continent = $_POST['continent_search'];

            array_push($sql_arr, ' locality.continent LIKE :entered_continent');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

    
            if (!empty($_POST['country_search'])) {
            $searched_country = $_POST['country_search'];

            array_push($sql_arr, ' locality.country LIKE :entered_country');
            // array_push($bind_arr, "'entered_county' => %$searched_county%");
            // array_push($placeholder_keys, ':entered_country');
            // array_push($placeholder_values, "'%$searched_country%'");
            // array_push($bind_arr, array_combine($placeholder_keys, $placeholder_values));
            }

            if (!empty($_POST['state_search'])) {
            $searched_state = $_POST['state_search'];

            array_push($sql_arr, ' locality.stateProvince LIKE :entered_state');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");   
            }

            if (!empty($_POST['county_search'])) {
                $searched_county = $_POST['county_search'];

                array_push($sql_arr, ' locality.county LIKE :entered_county');
                // array_push($bind_arr, "'entered_county' => %$searched_county%");
                // array_push($placeholder_keys, ':entered_county');
                // array_push($placeholder_values, "'%$searched_county%'");
                // array_push($bind_arr, array_combine($placeholder_keys, $placeholder_values));
            }

            if (!empty($_POST['era_search'])) {
                $searched_era = $_POST['era_search'];

                array_push($sql_arr, ' locality.earliestEraOrLowestErathem LIKE :entered_era');
                // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if  //similarly as above, can't use empty() here because 0 is a valid value and doesn't mean null/false here
                (isset($_POST['locationID_search']) && $_POST['locationID_search'] >= 0) {
                $searched_locationID = $_POST['locationID_search'];

                array_push($sql_arr, ' locality.locationID LIKE :entered_locationID');
            // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if (isset($_POST['lotID_search']) && $_POST['lotID_search'] >= 0) {
                $searched_lotID = $_POST['lotID_search'];

                array_push($sql_arr, ' lot.lotID LIKE :entered_lotID');
                // array_push($bind_arr, "'entered_locationID' => %$searched_locationID%");
            }

            if (isset($_POST['previousColln_search']) && $_POST['previousColln_search'] >= 0) {
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

            //similarly as above, can't use empty() here because 0 is a valid value and doesn't mean null/false here
            if (isset($_POST['locationID_search']) && $_POST['locationID_search'] >= 0) {
            $stmt->bindValue(':entered_locationID', $searched_locationID, PDO::PARAM_STR);
            }

            if (isset($_POST['lotID_search']) && $_POST['lotID_search'] >= 0) {
            $stmt->bindValue(':entered_lotID', '%'.$searched_lotID.'%', PDO::PARAM_STR);
            }

            if (isset($_POST['previousColln_search']) && $_POST['previousColln_search'] >= 0) {
            $stmt->bindValue(':entered_previousColln', '%'.$searched_previousColln.'%', PDO::PARAM_STR);
            }
              
            //print_r($stmt); echo "<br>";
            //print_r($searched_previousColln); echo "<br>";
    
            $stmt->execute();
    
            $numrows=$stmt->rowCount();

            // table column creation
            
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
            $lotID_url = "lotID_info.php?lotID=" . "{$lotID}";
            $locationID_url = "locationID_info.php?locationID=" . "{$locationID}";
            
       	    echo "<tr>"; 
            echo "<td>{$caseColln} </td>";
       	    echo "<td>{$collnDrawerID} </td>";
            echo "<td>" . "<a href='".$lotID_url."'> {$lotID}  </a>" . "</td>"; 
            echo "<td>{$genus} </td>";
            echo "<td>{$species} </td>";
            echo "<td>" . "<a href='".$locationID_url."'> {$locationID}  </a>" . "</td>";
            echo "<td>{$country} </td>";
            echo "<td>{$stateProvince} </td>";
            echo "<td>{$county} </td>";
            echo "<td>{$earliestEraOrLowestErathem} </td>";
            echo "<td>{$earliestPeriodOrLowestSystem} </td>";
            echo "<td>{$earliestEpochOrLowestSeries} </td>";
            echo "</tr>";
       
            //end while loop
 	          };
            // end table
            echo "</table>"; 



        //end final else
        }
 // end first if loop from clicking submit button  
 }



?>
