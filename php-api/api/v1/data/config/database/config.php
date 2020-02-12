<?php
/**
 * Das sind die Login-Angaben für die Datenbank
 * Dies ist eine standard Datei, welche als Vorlage für die echte auf dem produktiven System gilt
 */  
define("HOST", "127.0.0.1");     					// Der Host mit dem du dich verbinden willst.
define("USER", "root");    						// Der Datenbank-Benutzername. 
define("PASSWORD", "u60pHtXULzK5bKm8");    			// Das Datenbank-Passwort. 
define("INSERTUSER", USER);   			// Der Datenbank-Benutzername für Inserts. 
define("INSERTPASSWORD", PASSWORD);  		// Das Datenbank-Passwort für Inserts. 
define("UPDATEUSER", USER);   			// Der Datenbank-Benutzername für Inserts. 
define("UPDATEPASSWORD", PASSWORD);    	// Das Datenbank-Passwort für Inserts. 
define("CONTROLUSER", USER);   			// Der Datenbank-Benutzername für DBControl. 
define("CONTROLPASSWORD", PASSWORD);    	// Das Datenbank-Passwort für DBControl. 
define("DATABASE", "website_data");    				// Der Datenbankname.

 
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);    						// NUR FÜR DIE ENTWICKLUNG!!!!