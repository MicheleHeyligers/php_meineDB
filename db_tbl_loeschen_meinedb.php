<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Datensätze anzeigen lassen</title>
        <link rel="stylesheet" type="text/css" media="screen" href="./db_tbl_meinedb.css">
        <style>
            section#delete, form {
                display: grid;
                max-width: 1000px;
                grid-template-columns: 18% 18% 16% 16% 16% 16% ;
                /*grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;*/
                background: lightblue;
                border: 2px solid #086A87;
                margin: 1px auto 0;
            }
            form {
                margin: 0 auto; 
            }
            span {
                padding: 10px 20px;
                border-right: 1px solid black;
                border-bottom: 1px solid black;
            }
            input#loeschen{
               
                margin: 2px auto;
            }
        </style>
        <script>
        </script>
	</head>
	<body>
        <h2>Datensätze löschen</h2>
        <!-- <section id='delete'> -->
        <?php
            error_reporting(E_ALL|E_STRICT);
            // Verbindung zur DB
            //create connection; mit 'require' wird Datei mit Zugangsdaten herangezogen
            require 'settings.php';
            $daba = mysqli_connect($servername, $username, $password, $daba);
            // Abfrage: Datensätze aus tbl_personen anzeigen lassen
            $anfrage = "SELECT * 
                        FROM tbl_personen;";

            mysqli_query($daba, "SET NAMES utf8");
            // Abfrageergebnis des Select-Statements wird in Variable 'resultat' gespeichert
            $resultat =  mysqli_query($daba, $anfrage) or die(mysqli_error($daba));

            // Methode mysqli_num_fields/rows($resultat) gibt Anzahl der Felder/Zeilen zurück
            $spaltenAnzahl = mysqli_num_fields($resultat);
            $dsAnzahl =  mysqli_num_rows($resultat);

            //------ Datensätze holen und bearbeiten
            // mit fetch_assoc werden Bezeichner (Überschriften) geholt (assoc ist objektorientiert)
            echo "<section id='delete'><span class='headline'>Auswahl</span>";
            $ds = mysqli_fetch_assoc($resultat);
            // Ausgabe: nachname, vorname, gehalt, geburtstag, personalnr_ID -- alle Feldnamen 
            foreach($ds as $index => $wert){
                echo "<div class='headline'>".$index."</div>";
            }
            echo"</section>";
            // Datensatzzeiger zurücksetzen
            mysqli_data_seek($resultat, 0);

            // Alle Datensätze aus Tabelle tbl_personen anzeigen u. selektieren
            // Formular erstellen für die radio-Buttons
            echo "<form method='POST' action='loeschen_meinedbB.php'>";
            for($i = 0; $i < $dsAnzahl; $i++){
                $ds = mysqli_fetch_row($resultat); // extrahiert jeden Datensatz
                //radio-button vor jedem Datensatz
                echo"<span class='radios'><input type='radio' name='radiovalue' value='".$ds[4]."'></span>";
                foreach($ds as $wert){
                    echo "<div class='inhalte'>".$wert."</div>";
                }  
            }
            echo"<p><input id='loeschen' type='submit' name='loeschen' value='Daten löschen'></p>";
            echo"</form>";    
        ?>
        <!-- </section> -->
        <div id="buttons_div">
            <button onclick="window.location.href = 'db_tbl_anzeigen_meinedb.php'">Daten anzeigen</button>
        </div>
    </body>
</html>