<?php

/**
 * \file        index.php
 * \author      SIO-SLAM 2014-2016
 * \version     1.1
 * \date        11/19/2015
 * \brief       backend index
 *
 * \details     this file contains the includes for the backend
 */

require "vendor/twig/twig/lib/Twig/Autoloader.php";
Twig_Autoloader::register();
require 'vendor/autoload.php';
$app = new \Slim\Slim([
    'view' => new \Slim\Views\Twig(),
    'templates.path' => 'templates/'
    ]);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require_once 'model.php';
require_once 'functions.php';
require_once 'login.php';
require_once 'planificateur.php';
require_once 'enseignant.php';
require_once 'admin.php';

$app->get('/roles', $authenticateWithRole('administrateur'), function () use ($app) {

    $roles = Roles::get();
    
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode($roles));
});

$app->get('/matieres', $authenticateWithRole('planificateur'), function () use ($app) {

    $matieres = Matieres::get();
    
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response->setBody(json_encode($matieres));
});

$app->get('/:id/:token', function($id, $token) use ($app) {
    $user = Users::where('id', $id)->firstOrFail();
    if ($user->token == $token){
        $password = generatePassword();
        $password_hache = sha1($user->name . $password);
        $user->password = $password_hache;
        $user->enabled = 1;
        $user->save();
    }
});

$app->run();
?>