<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Datensatz aktualisiert</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="./db_tbl_meinedb.css">
        <!-- <script></script> -->
    </head>
    <body>
        <h1>Datensatz aktualisiert</h1>
        <?php
            // if (isset($_POST['submit'])) -- ist das Formular denn schon abgeschickt??
            if (isset($_POST["submit"])){
                error_reporting(E_ALL|E_STRICT);

                require 'settings.php';
                $conn = mysqli_connect($servername, $username, $password, $daba);

                /*Daten aus Formularfeldern in Variablen speichern
                Die mysqli_real_escape_string()-Funktion dient zum
                maskieren von Zeichen, die sonst in einem sql-Statement 
                stören würden*/            
                $vorname = mysqli_real_escape_string($conn, $_POST['vorname']);
                $nachname = mysqli_real_escape_string($conn, $_POST['nachname']);
                $gehalt = mysqli_real_escape_string($conn, $_POST['gehalt']);
                $geburtstag = mysqli_real_escape_string($conn, $_POST['geburtstag']);
                $id = mysqli_real_escape_string($conn, $_POST['personalnr_ID']);

                 // Abfrage: Datensatz aktualisieren mit update-Befehl
                 $anfrage = "UPDATE meinedb.tbl_personen SET  
                            nachname = '" .$nachname. "', 
                            vorname = '" .$vorname. "', 
                            gehalt = " .$gehalt. ", 
                            geburtstag = '" .$geburtstag. "'
                            WHERE personalnr_ID = ".$id;
                     
                mysqli_query($conn, "SET NAMES utf8");

                // eigentliche Abfrage
                mysqli_query($conn, $anfrage) or die(mysqli_error($conn));

                // Verbindung zur DB wird beendet
                mysqli_close($conn); 
            }    
        ?>
        <button onclick="window.location.href = 'db_tbl_anzeigen_meinedb.php'">Daten anzeigen</button>
    </body>
</html>    