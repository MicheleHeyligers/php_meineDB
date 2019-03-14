<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Datensatz aktualisieren</title>
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
        <h1>Datensatz aktualisieren</h1>
        <?php
            // if (isset($_POST['submit'])) -- ist das Formular denn schon abgeschickt??
            if (isset($_POST["radiovalue"])){
                error_reporting(E_ALL|E_STRICT);

                //create connection; mit 'require' wird Datei mit Zugangsdaten herangezogen
                require 'settings.php';
                $conn = mysqli_connect($servername, $username, $password, $daba);

                // in $id steckt der Wert des Radiobuttons, also welcher Datensatz ausgesucht wurde
                $id = $_POST["radiovalue"];
                
                 // Abfrage: Datensatz aus tbl_personen mit ausgewählter personal_id (steckt im radiovalue) holen
                 $anfrage = "SELECT * 
                 FROM meinedb.tbl_personen
                 WHERE personalnr_ID = ".$id;

                mysqli_query($conn, "SET NAMES utf8");

                // Abfrageergebnis des Select-Statements wird in Variable 'resultat' gespeichert
                $resultat =  mysqli_query($conn, $anfrage) or die(mysqli_error($conn));

                $ds = mysqli_fetch_assoc($resultat); // der selektierte Datensatz
                // print_r($ds); -- zeigt Datensatz auf Bildschirm ungeordnet an, testen, ob Daten ankommen

            }
        ?>
        <div id="wrapper">
            <form action="./db_tbl_aendern_meinedb3.php" method="post">
                <fieldset>
                    <legend>Datensatz aktualisieren</legend>
                    <div class="form">
                        <label for="vorname">Vorname*</label>
                        <input type="text" id="vorname" name="vorname" value="<?php echo $ds['vorname']; ?>" maxlength="300" required>
                    </div>
                    <div class="form">
                        <label for="nachname">Nachname*</label>
                        <input type="text" id="nachname" name="nachname" value="<?php echo $ds['nachname']; ?>"maxlength="300" required>
                    </div>
                    <div class="form">
                        <label for="gehalt">Gehalt*</label>
                        <input type="number" step="0.01" id="gehalt" name="gehalt" value="<?php echo $ds['gehalt']; ?>"maxlength="5" required>
                    </div>
                    <div class="form">
                        <label for="geburtstag">Geburtstag*</label>
                        <input type="date" id="geburtstag" name="geburtstag" value="<?php echo $ds['geburtstag']; ?>"required>
                    </div>
                    <div class="form">
                        <!-- <label for="personalnummer">Personalnummer*</label> -->
                        <input type="hidden" step="1" id="perso" name="personalnr_ID" value="<?php echo $id; ?>"maxlength="5" required>
                    </div>
                    <div class="form">
                        <label></label>
                        <input id="speichern" type="submit" name="submit" value="Datensatz aktualisieren">
                    </div>
                </fieldset>
            </form>
        </div>
        <button onclick="window.location.href = 'db_tbl_anzeigen_meinedb.php'">Daten anzeigen</button>
        <button onclick="window.location.href = 'db_tbl_aendern_meinedb.php'">zurück zur Auswahl</button>
    </body>
</html>

