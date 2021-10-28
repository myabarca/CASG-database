<!DOCTYPE HTML>
<html>
<head>
    <title>Saved Loan</title>
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
<?php
// include database connection 
include 'config/database.php';

if (isset($_POST['saveLoanButton'])){
 
 
   
 
    try{
 
       // insert query
        $query = "INSERT INTO loan (personID, dateRequested, dateSent, dateDue, dateClosed, authorizedBy, sentBy, processedBy, purpose, loanNotes) VALUES (:personID, :dateRequested, :dateSent, :dateDue, :dateClosed, :authorizedBy, :sentBy, :processedBy, :purpose, :loanNotes)";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
 
        // posted values
        $personID_loan=htmlspecialchars(strip_tags($_POST['personID_loan']));
        $dateRequested_loan=htmlspecialchars(strip_tags($_POST['dateRequested_loan']));
        $authorizedBy_loan=htmlspecialchars(strip_tags($_POST['authorizedBy_loan']));
        $dateSent_loan=htmlspecialchars(strip_tags($_POST['dateSent_loan']));
        $dateDue_loan=htmlspecialchars(strip_tags($_POST['dateDue_loan']));
        $sentBy_loan=htmlspecialchars(strip_tags($_POST['sentBy_loan']));
        $processedBy_loan=htmlspecialchars(strip_tags($_POST['processedBy_loan']));
        $dateClosed_loan=htmlspecialchars(strip_tags($_POST['dateClosed_loan']));
        $purpose_loan=htmlspecialchars(strip_tags($_POST['purpose_loan']));
        $notes_loan=htmlspecialchars(strip_tags($_POST['notes_loan']));
 
        // bind the parameters
        $stmt->bindParam(':personID', $personID_loan);
        $stmt->bindParam(':dateRequested', $dateRequested_loan);
        $stmt->bindParam(':authorizedBy', $authorizedBy_loan);
        $stmt->bindParam(':dateSent', $dateSent_loan);
        $stmt->bindParam(':dateDue', $dateDue_loan);
        $stmt->bindParam(':dateClosed', $dateClosed_loan);
        $stmt->bindParam(':sentBy', $sentBy_loan);
        $stmt->bindParam(':purpose', $purpose_loan);
        $stmt->bindParam(':loanNotes', $notes_loan);
        $stmt->bindParam(':processedBy', $processedBy_loan);

 
        // specify when this record was inserted to the database
        // $created=date('Y-m-d H:i:s');
        // $stmt->bindParam(':created', $created);

        // $stmt->execute();
 
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Loan record was created. Now enter the lots that are part of this loan</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record. Please try again.</div>";
        }
 
    }
 
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>

</body>
</html>
 