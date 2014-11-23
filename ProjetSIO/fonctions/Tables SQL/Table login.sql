CREATE TABLE  `login` (

	/* un id unique par ligne ; unsigned -> pas de nombre n�gatif; NOT NULL -> pas de null possible;
		auto_increment -> s'incr�mente automatiquement de 1 */
  loginId int(10) unsigned NOT NULL auto_increment,
 
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
  /* une date sur laquelle on va se baser le temps de validit� du lien d'activation*/
  tokenCDate datetime NULL,
  
  /*indique la cl� primaire */
  PRIMARY KEY  (`loginId`)
);