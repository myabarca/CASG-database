<!DOCTYPE HTML>
<html>
<head>
    
    <title>Update Loan</title>
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
    <!-- improved nav bar with more links -->
    <nav class="navbar navbar-expand-sm">

        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="navbar-brand" href="index.php">Back to Home</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="lot-loc-search-form.php">Lot Loc Search</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="loan-search-form.php">Loan Search</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href="reference-search-form.php">Reference Search</a>
            </li>
        </ul>
    </nav>

<!-- storing loanID from previous page, which is the search-loan-form table results provided by searchLoan.php -->
<?php $loanID=isset($_GET['loanID']) ? $_GET['loanID'] : die('ERROR: Loan ID not found.'); ?>

<?php
//include database connection
include 'config/database.php';
 
// read current record's data
try {
    // prepare select query
    $query = "SELECT * FROM loan WHERE loanID = ?";

    $stmt = $con->prepare($query);
 
    // this is the first question mark
    $stmt->bindParam(1, $loanID);
    
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $personID_loanUpdate = $row['personID'];
    $dateRequested_loanUpdate = $row['dateRequested'];
    $dateSent_loanUpdate = $row['dateSent'];
    $dateDue_loanUpdate = $row['dateDue'];
    $dateClosed_loanUpdate = $row['dateClosed'];
    $authorizedBy_loanUpdate = $row['authorizedBy'];
    $sentBy_loanUpdate = $row['sentBy'];
    $processedBy_loanUpdate = $row['processedBy'];
    $purpose_loanUpdate = $row['purpose'];
    $loanNotes_loanUpdate = $row['loanNotes'];
}

catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

?>

    <div class="container">
 
        <div class="page-header">
            <h1>Update Loan <?php echo htmlspecialchars($loanID, ENT_QUOTES);  ?></h1>
            
        </div>

<!-- not ending the div for container here makes the search boxes centered on the page which is nice -->


        <form action="" method="post">
            <table class='table table-responsive'>
                <tr>
                    <td>Person ID</td>
                    <td><input type='text' name='personID_loan' class='form-control' value='<?php echo htmlspecialchars($personID_loanUpdate, ENT_QUOTES);  ?>' />
                </tr>
            </table>

            <table class='table table-responsive'> 
                <tr>
                    <td>Date Requested</td>
                    <td><input type='date' name='dateRequested_loan' class='form-control' </td>

                    <td>Authorized By</td>
                    <td><input type='text' name='authorizedBy_loan' class='form-control' /></td>
                </tr>

                <tr>
                    <td>Date Sent</td>
                    <td><input type='date'name='dateSent_loan' class='form-control' value='<?php echo htmlspecialchars($dateSent_loanUpdate, ENT_QUOTES);  ?>'></td>
                    <td>Processed By</td>
                    <td><input type='text' name='processedBy_loan' class='form-control' /></td>
                    
                </tr>
                <tr>
                    <td>Date Due</td>
                    <td><input type='date' name='dateDue_loan' class='form-control'/></td>
                    <td>Purpose</td>
                    <td><input type='text' name='purpose_loan' class='form-control'/></td>
                    
                </tr>
                <tr>
                    <td>Date Closed</td>
                    <td><input type="date" name='dateClosed_loan' class='form-control'></td>
                <tr>
                    <td>Sent Via</td>
                    <td><input type='text' name='sentBy_loan' class='form-control'/></td>
                    <td>Notes</td>
                    <td><textarea type='text' name='notes_loan' class='form-control' rows="3"> </textarea></td>
                </tr>      
                                 
                <tr>
                    <td></td>
                    <td>
                    <input type='submit' value='Update Loan' name='updateLoanButton' class='btn btn-primary' />
                    </td>
                </tr>
            </table>
        </form>
 
    </div> <!-- end .container -->

    <br><br>

    
    </div>
    <!-- end page container div -->





</body>
</html>
