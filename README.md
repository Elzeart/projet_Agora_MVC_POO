Pour tester l'espace administrateur et l'espace membre, des utilisateurs sont préenregistrés dans la base de donnée à importer. Les mots de passe sont 123456789ab!
  	pseudo=> admin     (C'est l'administrateur)
	pseudo=> membre1   (C'est un membre qui a activé par mail son inscription. Il a donc accès à l'espace membre) 
(Toutes les adresses mails sont fictives. Elles ont été enregistrées au préalable avec de vrais adresses puis changées en bdd pour une question de confidentialité)

-----

En local : Pour tester l'inscription via l'interface, il est nécessaire de paramètrer l'envois de mails depuis un serveur local

Exemple de configuration pour xampp et gmail : 

Pour xampp :	
	=> ouvrir le fichier php.ini. Rechercher [mail function]. 
  		Mettre en commentaire les deux lignes : 
			SMTP=localhost 
			smtp_port=25. 
  		Rajouter les quatre lignes : 
			SMTP=smtp.gmail.com	
			smtp_port=587
			sendmail_from = votre_adresse_gmail@gmail.com 
			sendmail_path="\"C:\xampp\sendmail\sendmail.exe" -t"
	=> ouvrir le fichier sendmail.ini. 
  		Mettre en commentaire les deux lignes : 
			smtp_server=mail.mydomain.com 
			smtp_port=25
	=> Rajouter sous [sendmail] les lignes :  
    		smtp_server=smtp.gmail.com
		smpt_port=587
		error_logfile=error.log
		debug_logfile=debug.log
		auth_username=votre_adresse_gmail@gmail.com
		auth_password=votre_mot_de_pass_gmail
		force_sender=votre_adresse_gmail@gmail.com
      
Pour gmail (il est préférable d'avoir un boite mail de testing) : 
	Débloquer le fait de pouvoir utiliser des applications tierces. 
	Sur gmail cliquer sur "gérer votre compte google", "sécurité",  activer "accès moins sécurisé des applications"
