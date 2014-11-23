/* La cr�ation d'une table interm�diaire permet d'affecter plus d'un r�le un utilisateur*/

Create table `user_roles` (

	roleId int unsigned not null,
	userId int unsigned not null,
	
	FOREIGN KEY (`userId`) REFERENCES (`login`),
	FOREIGN KEY (`roleId`) REFERENCES (`roles`)
);