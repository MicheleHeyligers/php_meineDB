<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Datensätze anzeigen lassen</title>
        <link rel="stylesheet" type="text/css" media="screen" href="./db_tbl_meinedb.css">
		<style></style>
        <script>
            // mit Javascript: was passiert, wenn der Button geklickt wird
            window.onload = start;
            function start(){
                // wenn der Button geklickt wird, wird auf die andere Seite verlinkt (wo dann z.B. ein Formular wartet)
                document.getElementsByTagName('button')[0].onclick = function(){
                                                                                window.location.href = "db_tbl_eingeben_meinedb.php";
                                                                                }
                document.getElementsByTagName('button')[1].onclick = function(){
                                                                                window.location.href = "db_tbl_aendern_meinedb.php";
                                                                                }           
                document.getElementsByTagName('button')[2].onclick = function(){
                                                                                window.location.href = "db_tbl_loeschen_meinedb.php";
                                                                                }                                                                                                        
            }
        </script>
	</head>
	<body>
        <h2>Tabelle mit Datensätzen anzeigen</h2>
        <section>
            <?php
                // Fehlerbehandlung
                error_reporting(E_ALL | E_STRICT);
                // Verbindung zur DB
                $daba = mysqli_connect("localhost", "root", "", "meinedb");

                // Abfrage: Datensätze aus tbl_personen anzeigen lassen
                $anfrage = "SELECT * 
                            FROM tbl_personen;";
            
                // global soll alles in Utf-8 ausgegeben werden (muss nicht sein, macht aber vieles einfacher)
                mysqli_query($daba, "SET NAMES utf8");

                // Abfrageergebnis des Select-Statements wird in Variable 'resultat' gespeichert
                $resultat =  mysqli_query($daba, $anfrage) or die(mysqli_error($daba));

                //----- Ausgabe der Tabellenstruktur auf dem Bildschirm (Anzahl der Spalten u. Zeilen)
                // print_r($resultat);

                // Methode mysqli_num_fields/rows($resultat) gibt Anzahl der Felder/Zeilen zurück
                $spaltenAnzahl = mysqli_num_fields($resultat);
                $dsAnzahl =  mysqli_num_rows($resultat);
                //echo "<div>".$dsAnzahl."</div>";       // Ausgabe: 3
                //echo "<div>".$spaltenAnzahl."</div>";  // Ausgabe: 5

                // Verbindung zur DB wird beendet
                mysqli_close($daba);

                //------ Datensätze holen und bearbeiten
                // mit fetch_assoc werden Bezeichner geholt (assoc ist objektorientiert)
                $ds = mysqli_fetch_assoc($resultat);
                // auslesen der Spaltenbezeichnungen
                // Ausgabe: nachname, vorname, gehalt, geburtstag, personalnr_ID -- alle Feldnamen 
                foreach($ds as $index => $wert){
                    echo "<div class='headline'>".$index."</div>";
                }
                
                // Datensatzzeiger zurücksetzen
                mysqli_data_seek($resultat, 0);

                /* Datensätze suchen, vom 1. Wert an (0); <div> um $wert nötig, um Spalten 
                nebeneinander anzuzeigen */
                for($i = 0; $i < $dsAnzahl; $i++){
                    $ds = mysqli_fetch_row($resultat); // $ds = mysqli_fetch_row($result); - extrahiert jeden Datensatz
                    foreach($ds as $wert){
                        echo "<div class='inhalte'>".$wert."</div>";
                    }  
                }
            ?> 
        </section>    
        <div id="buttons_div">
           <!-- onClick-Event könnte auch zum Button gleich mit rein:
            <button onclick="window.location.href='db_tb_aendern_meinedb.php'">Datensatz ändern</button>  -->
            <button id="b_eins">Datensätze eingeben</button>           
            <button id="b_zwei">Datensätze ändern</button>
            <button id="b_drei">Datensätze löschen</button>
        </div>
	</body>
</html>