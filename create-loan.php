<!DOCTYPE HTML>
<html>
<head>
    <title>Create Loan</title>
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
            <a class="navbar-brand" href="index.html">Back to Home</a>
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
 
    <!-- container -->
    <div class="container">
 
        <div class="page-header">
            <h1>Create Loan</h1>
        </div>
 
    
            <!-- html form here where the information will be entered -->
        <form action="" method="post">
            <table class='table table-responsive'>
                <tr>
                    <td>Person ID</td>
                    <td><input type='text' name='personID_loan' class='form-control' />
                    <span class="help-block">If the borrower does not have a Person ID yet, please enter their details <a href="create-person.php">here</a> first.<br>To check if a person has an ID or not, search for their last name <a href="loan-search-form.php">here.</span></td>
                </tr>
            </table>

            <table class='table table-responsive'> 
                <tr>
                    <td>Date Requested</td>
                    <td><input type='date' name='dateRequested_loan' class='form-control' /></td>

                    <td>Authorized By</td>
                    <td><input type='text' name='authorizedBy_loan' class='form-control' /></td>
                </tr>

                <tr>
                    <td>Date Sent</td>
                    <td><input type='date'name='dateSent_loan' class='form-control'></td>

                    <td>Sent Via</td>
                    <td><input type='text' name='sentBy_loan' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Date Due</td>
                    <td><input type='date' name='dateDue_loan' class='form-control' /></td>

                    <td>Processed By</td>
                    <td><input type='text' name='processedBy_loan' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Date Closed</td>
                    <td><input type='date' name='dateClosed_loan' class='form-control' /></td>

                    <td>Purpose</td>
                    <td><input type='text' name='purpose_loan' class='form-control' /></td>
                </tr>
        
                <tr>
                    <td>Notes</td>
                    <td><input type='text' name='notes_loan' class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <input type='submit' value='Save New Loan' name='saveLoanButton' class='btn btn-primary' />
                    </td>
                </tr>
            </table>
        </form>
 
    </div> <!-- end .container -->

    <br><br>

    <?php include 'createLoan.php';
    ?>
 

 
</body>
</html>