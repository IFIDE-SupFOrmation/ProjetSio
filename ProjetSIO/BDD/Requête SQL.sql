CREATE TABLE  `login` (

	/* un id unique par ligne ; unsigned -> pas de nombre n�gatif; NOT NULL -> pas de null possible;
		auto_increment -> s'incr�mente automatiquement de 1 */
  loginId int(10) unsigned NOT NULL auto_increment,
 
	/*Nom d'utilisateur, mot de passe et email du compte; varchar -> string/char* avec (x) comme max */
  name varchar(30) NOT NULL,
  password varchar(50) NOT NULL,
  email varchar(255) NOT NULL,
  
  /* role -> va nous permettre de donner les diff�rents niveaux d'acc�s aux utilisateurs ( admin, user,...etc) */
  roleCode varchar(45) NOT NULL,
  
  /* Permet d'activer ou de d�sactiver un compte utilisateur */
  disabled tinyint(1) NOT NULL default '0',
  
  /* On va utiliser ce champ pour v�rifier si un utilisateur est d�j� connect�*/
  activated tinyint(1) NOT NULL default '0',
  
  /*indique la cl� primaire */
  PRIMARY KEY  (`loginid`)
);