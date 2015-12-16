//Ici on utilise la méthode config pour déclarer le routage de l'application
webApp.config(function($stateProvider, $urlRouterProvider,RestangularProvider,USERS_ROLES) {

//Mise en place de l'url de base pour restangular
RestangularProvider.setBaseUrl('http://guilaumehaag.ddns.net/SIO/PPEBackend');


//Cette ligne force toute les routes autres que celles déclarées vers "/"
$urlRouterProvider.otherwise("/");

// NOTA BENE : ui-router utilise la terminologie "state" à la place de "route", mais le principe de base reste le même

//déclaration des states ( ou routes)
$stateProvider
	//D'abord on déclare le nom du state
	.state('accueil', {
	//Puis on crée la liaison avec un url 
	url: "/",
	//Ensuite on indique le template utilisé 
	templateUrl: "view/accueil.html",
	data: {
          authorizedRoles: [USERS_ROLES.administrateur, USERS_ROLES.planificateur, USERS_ROLES.enseignant]
      }
	})
	
	
	//Partie Administrateur
	.state('administration', {
	url: "/administration",
	templateUrl: "view/administration/administration.html",
	controller: "AdminList",
	data: {
          authorizedRoles: [USERS_ROLES.administrateur]
      }
	})
	
	//Partie Planificateur
	.state('planification', {
	url: "/planification",
	templateUrl: "view/planification/navigation.html",
	data: {
          authorizedRoles: [USERS_ROLES.administrateur, USERS_ROLES.planificateur]
      }
	})
	
	.state('planification.classes', {
	url: "/classes",
	templateUrl: "view/planification/listeClasses.html",
	controller: "PlanClassesController",
	data: {
          authorizedRoles: [USERS_ROLES.administrateur, USERS_ROLES.planificateur]
      }
	})

	.state('planification.enseignants', {
	url: "/enseignants",
	templateUrl: "view/planification/listeEnseignants.html",
	controller: "PlanEnseignantsController",
	data: {
          authorizedRoles: [USERS_ROLES.administrateur, USERS_ROLES.planificateur]
      }
	})
		
	.state('planification.enseignants.matieres', {
	url: "/:id/matieres",
	templateUrl: "view/planification/ListeEnseignantsMatieres.html",
	controller: "PlanMatieresController",
	resolve:{
		personne: function(planService, $stateParams){
			return planService.getPersonne($stateParams.id);
		},
		matieres: function(matiereService){
			return matiereService.getMatieres();
		}
	},
	data: {
          authorizedRoles: [USERS_ROLES.administrateur, USERS_ROLES.planificateur]
      }
	})
	
	.state('planification.periodes', {
	url: "/periodes",
	templateUrl: "view/planification/listeClassesCalendar.html",
	controller: "PlanCalendarClasses",
	data: {
          authorizedRoles: [USERS_ROLES.administrateur, USERS_ROLES.planificateur]
      }
	})
	
	.state('planification.periodes.calendar', {
	url: "/periodes/:id",
	templateUrl: "view/planification/calendar.html",
	controller: "PlanCalendar",
	resolve:{
		id: function($stateParams){
			return $stateParams.id
		}
	},
	data: {
          authorizedRoles: [USERS_ROLES.administrateur, USERS_ROLES.planificateur]
      }
	})
	
	//Partie Enseignant
	
	;
});