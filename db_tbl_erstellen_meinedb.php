<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Datenbank und Tabelle erstellen</title>
		<!-- style --> 
	</head>
	<body>
        <h2>DB und Tbl. erstellen</h2>
        <?php
            // Was passiert, wenn Fehler passieren?
            error_reporting(E_ALL | E_STRICT);
            // $create_DB = "CREATE DATABASE kaffeeautomat IF NOT EXISTS";
            // um sich mit DB zu verbinden, Befehl eingeben: mysqli_connect(Servername, Username, Passwort, DB-Name)
            // und in Variable $daba abspeichern
            $daba = mysqli_connect("localhost", "root", "", "meinedb");

            // löschen einer Tabelle, falls es sie gibt
            $anfrage = "DROP TABLE IF EXISTS tbl_personen";
           
            // bei Anfrage sollen Namen in utf-8 sein (Zeichensatz definieren)
            mysqli_query($daba, "SET NAMES utf8");
            // Anfrage an DB abschicken: mysqli_query(DB-Verbindung, SQL-Befehl), "or die" dient zum Fehlerabfangen
            mysqli_query($daba, $anfrage) or die(mysqli_error($daba));

            // decimal(6,2) => 6 Stellen insgesamt, 2 Stellen hinter dem Komma (d.h. 4 Stellen vor dem Komma)
            $anfrage = "CREATE TABLE tbl_personen (
                                                    nachname varchar(30) NOT NULL, 
                                                    vorname varchar(30) NOT NULL,
                                                    gehalt decimal(6,2) NOT NULL,
                                                    geburtstag date NOT NULL,
                                                    personalnr_ID int auto_increment, 
                                                    PRIMARY KEY (personalnr_ID) 
                                                    );
                        ";
            // Primary Key könnte man auch als Constraint setzen: 
            // CONSTRAINT person PRIMARY KEY (personalnr)

            mysqli_query($daba, "SET NAMES utf8");
            mysqli_query($daba, $anfrage) or die(mysqli_error($daba));

            $eingabe = "INSERT INTO tbl_personen (nachname, vorname, gehalt, geburtstag)
                        VALUES 
                            ('Page', 'Jimmy', 8235.76, '1909-08-17'),
                            ('Meier', 'Peter', 2000.89, '1971-04-24'),
                            ('Moellekes', 'Klaus-Dieter', 6003.99, '1952-05-14')
                            ;
                        ";
             mysqli_query($daba, "SET NAMES utf8");
             mysqli_query($daba, $eingabe) or die(mysqli_error($daba));
 
            // Verbindung zu DB wird beendet
            mysqli_close($daba);
        ?>
	</body>
</html>