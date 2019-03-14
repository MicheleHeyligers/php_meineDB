<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Datensätze gelöscht</title>
        <link rel="stylesheet" type="text/css" media="screen" href="./db_tbl_meinedb.css">
        <!-- <script>alert('Wollen sie den Datensatz wirklich löschen?');</script> -->
    </head>
    <body>
        <h1>Datensatz gelöscht</h1>
        <?php
             if (isset($_POST['radiovalue'])){
                error_reporting(E_ALL|E_STRICT);
                // Verbindung zur DB
                $daba = mysqli_connect("localhost", "root", "", "meinedb");

                $id = mysqli_real_escape_string($daba, $_POST["radiovalue"]);
                $anfr = "DELETE FROM meinedb.tbl_personen
                        WHERE personalnr_ID =".$id;

                mysqli_query($daba, "SET NAMES utf8");
                mysqli_query($daba, $anfr) or die(mysqli_error($daba)); // Datensatz wird gelöscht
                mysqli_close($daba);
             }
        ?>
        <div id="buttons_div">
            <button onclick="window.location.href = 'db_tbl_anzeigen_meinedb.php'">Daten anzeigen</button>
        </div> 
    </body>
</html>