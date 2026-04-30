<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Tracker | Admin Logs</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="components/main.css">
    <link rel="stylesheet" href="admin1.css">
    <nav>   
        <?php include_once("components/navbarAdmin.html");?>
    </nav>
    <script defer type="text/javascript" src="../scripts/script.js"></script>
</head>
<body>
    <script async>
        $(document).ready(function () {
            $("#myTable").DataTable();
        }); 
    </script>
    <?php include_once("components/adminSideNavbar.html");?>
    <main class="main-border-box main-bottom">
        <table class="centered higlight striped" id="myTable">
            <thead>
                <tr>
                    <th> Room No. </th>
                    <th> Former Status </th>
                    <th> Current Status </th>
                    <th> Time </th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </main>

</body>
</html>