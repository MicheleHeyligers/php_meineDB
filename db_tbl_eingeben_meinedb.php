<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Datensätze hinzufügen</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="./db_tbl_meinedb.css">
        <style>
            #speichern {
                background-color: #B404AE;
                color: white;
            }
        </style>
    </head>

    <body>
        <h1>Datensatz hinzufügen</h1>
        <?php
            if (isset($_POST['submit'])){
                error_reporting(E_ALL|E_STRICT);
                $servername = "localhost";
                $username = "root";
                $password = "";

                //create connection
                $conn = mysqli_connect($servername, $username, $password);
                //check connection
                if(!$conn){
                    die("Connection failed: ".mysqli_connect_error());
                }

                /*Eingabe der Formularfelder in Variablen speichern
                Die mysqli_real_escape_string()-Funktion dient zum
                maskieren von Zeichen, die sonst in einem sql-Statement 
                stören würden*/
                
                $vorname = mysqli_real_escape_string($conn, $_POST['vorname']);
                $nachname = mysqli_real_escape_string($conn, $_POST['nachname']);
                $gehalt = mysqli_real_escape_string($conn, $_POST['gehalt']);
                $geburtstag = mysqli_real_escape_string($conn, $_POST['geburtstag']);

                //Werte der Variablen in die Datenbankanweisung packen; 'Null' steht für den PK 
                $query = "INSERT INTO meinedb.tbl_personen
                          VALUES
                          ('".$vorname."','".$nachname."','".$gehalt."','".$geburtstag."', null)";

                mysqli_query($conn, "SET NAMES UTF8");

                mysqli_query($conn, $query);

                mysqli_close($conn);
            }
        ?>
        <div id="wrapper">
            <form action="./db_tbl_eingeben_meinedb.php" method="post">
                <fieldset>
                    <legend>Neuen Datensatz anlegen</legend>
                    <div class="form">
                        <label for="vorname">Vorname*</label>
                        <input type="text" id="vorname" name="vorname" maxlength="300" required>
                    </div>
                    <div class="form">
                        <label for="nachname">Nachname*</label>
                        <input type="text" id="nachname" name="nachname" maxlength="300" required>
                    </div>
                    <div class="form">
                        <label for="gehalt">Gehalt*</label>
                        <input type="number" step="0.01" id="gehalt" name="gehalt" maxlength="5" required>
                    </div>
                    <div class="form">
                        <label for="geburtstag">Geburtstag*</label>
                        <input type="date" id="geburtstag" name="geburtstag" required>
                    </div>
                    <div class="form">
                        <label></label>
                        <input id="speichern" type="submit" name="submit" value="Datensatz speichern">
                    </div>
                </fieldset>
            </form>
        </div>
        <button onclick="window.location.href = 'db_tbl_anzeigen_meinedb.php'">Daten anzeigen</button>
    </body>
</html>

