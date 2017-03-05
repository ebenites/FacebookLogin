<?php
// https://developers.facebook.com/docs/php/gettingstarted

require_once './vendor/autoload.php';

try {
    $fb = new Facebook\Facebook([
        'app_id' => '613254335543514',
        'app_secret' => 'XXXXXXXXXXXXXXXXXXXXXXX',
        'default_graph_version' => 'v2.8',
    ]);

    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get('/me?fields=id,name,picture,gender,email', $_GET['id_token']);
    
    $user = $response->getGraphUser();
    //var_dump($user);
    
    // Registramos el user id y el email en BD 
    // o hacemos matching por id o email con un usuario de nuestra BD
    // UsuarioDAO::register($user) / UsuarioDAO::findByGoogleID($user->items['id']) or UsuarioDAO::findByEmail($user->items['email'])
    
    session_start();
    $_SESSION['user'] = $user;

    include './profile.php';
    
} catch(Exception $e) {
    die('Error: ' . $e->getMessage());
}