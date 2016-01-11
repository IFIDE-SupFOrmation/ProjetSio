<?php

/**
 * \file        model.php
 * \author      SIO-SLAM 2014-2016
 * \version     1.1
 * \date        11/19/2015
 * \brief       model for classes
 *
 * \details     this file contains all the models built with slim framework
 */

// Connexion à la BDD
$settings = array(
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'test',
    'username' => 'root',
    'password' => '020395',
    'collation' => 'utf8_general_ci',
    'charset' => 'utf8',
    'prefix' => ''
);

$container = new \Illuminate\Container\Container;
$connFactory = new \Illuminate\Database\Connectors\ConnectionFactory($container);
$conn = $connFactory->make($settings);
$resolver = new \Illuminate\Database\ConnectionResolver();
$resolver->addConnection('default', $conn);
$resolver->setDefaultConnection('default');
\Illuminate\Database\Eloquent\Model::setConnectionResolver($resolver);

use \Illuminate\Database\Eloquent\Model;

/**
* \class        Users model.php "Backend/model.php
* \brief        corresponding to the registered users
*/
class Users extends Model {
    public $timestamps = false;

    public function roles() {
        return $this->belongsToMany('Roles', 'users_roles', 'id_Users', 'id_Roles');
    }

    public function matieres() {
        return $this->belongsToMany('Matieres', 'users_matieres', 'id_Users', 'id_Matieres');
    }
    
    public function classes() {
        return $this->hasMany('Classes');
    }
}

/**
* \class        Classes model.php "Backend/model.php
* \brief        corresponding to the classes
* \details		corresponding to the "classes". A "classe" is composed by many students
*/
class Classes extends Model {
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('Users', 'id');
    }
    
    public function cours() {
        return $this->belongsToMany('Cours', 'cours_classes', 'id_Classes', 'id_Cours');
    }
}

/**
* \class        Fermeture model.php "Backend/model.php
* \brief        corresponding to the day the school is close
*/ 
class Fermeture extends Model {
    public $timestamps = false;
}

/**
* \class        Indisponibilite model.php "Backend/model.php
* \brief        corresponding to the unusable hours in the teacher's schedule
*/
class Indisponibilite extends Model {
    public $timestamps = false;

    public function user() {
        return $this->hasOne('Users', 'id');
    }
}

/**
* \class        Matieres model.php "Backend/model.php
* \brief        corresponding to the lesson's subject f.e. : mathematics, english
*/
class Matieres extends Model {
    public $timestamps = false;

    public function user() {
        return $this->belongsToMany('Users', 'users_matieres', 'id_Matieres', 'id_Users');
    }
}

/**
* \class        Cours Cours.php "Backend/model.php
* \brief        corresponding to lessons
*/
class Cours extends Model {
    public function user() {
        return $this->hasOne('Users', 'id')->select('id', 'firstName', 'lastName');
    }

    public function matiere() {
        return $this->hasOne('Matieres', 'id')->select('id', 'nom', 'code');
    }

    public function classes() {
        return $this->belongsToMany('Classes', 'cours_classes', 'id_Cours', 'id_Classes')->select('id', 'nom');
    }
}

/**
* \class        Roles model.php "Backend/model.php
* \brief        Keeping the different roles an user can have
* \details		corresponding to the role an user has. He can be : Administrateur,Planificateur or Enseignant
*/
class Roles extends Model {
    public $timestamps = false;

    public function user() {
        return $this->belongsToMany('Users', 'users_matieres', 'id_Roles', 'id_Users');
    }
}
?>