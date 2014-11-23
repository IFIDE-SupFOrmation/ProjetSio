CREATE TABLE  `login` (

	/* un id unique par ligne ; unsigned -> pas de nombre n�gatif; NOT NULL -> pas de null possible;
		auto_increment -> s'incr�mente automatiquement de 1 */
  loginId int unsigned NOT NULL auto_increment,
 
	/*Nom d'utilisateur, mot de passe et email du compte; varchar -> string/char* avec (x) comme max 
	 Je rajoute deux champs, "firstName" et "lastName" pour avoir une meilleure vision de qui est l'utilisateur*/
  login varchar(30) NOT NULL,
  firstName varchar(30) NOT NULL,
  lastName varchar(30) NOT NULL,
  password varchar(50) NULL,
  email varchar(255) NOT NULL,
  
  /* Permet d'activer ou de d�sactiver un compte utilisateur */
  enabled boolean NOT NULL,
  
  /* le token qui sera utilis� pour envoy� un lien d'activation unique � l'utilisateur */
  token varchar(50) NULL,
  /* une date sur laquelle on va se baser pour le temps de validit� du lien d'activation*/
  tokenCDate datetime NULL,
  
  /*indique la cl� primaire */
  PRIMARY KEY  (`loginId`)
);

/*Cr�ation d'une table pour les r�les*/
Create table `roles` (
	
	roleId int unsigned not null,
	name varchar(50) not null,
	
	PRIMARY KEY (`roleId`)
);

/* La cr�ation d'une table interm�diaire qui permet d'affecter plus d'un r�le � un utilisateur*/ 
Create table `user_roles` ( 
	roleId int unsigned not null,
	loginId int unsigned not null,
	
	PRIMARY KEY (roleId, loginId),
	
	/* Les lignes suivantes permettent d'�tablir une connexion entre les tables */
	FOREIGN KEY (loginId) 
	REFERENCES `login`(loginId),
	
	FOREIGN KEY (roleId) 
	REFERENCES `roles`(roleId) 
);


/* Insertion des r�les demand�s par le cahier des charges */
INSERT INTO `roles` values
(1,"administrateur"),
(2,"planificateur"),
(3,"enseignant");
	