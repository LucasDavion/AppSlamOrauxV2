<?php
// On démarre la session
session_start ();

// On détruit notre session
session_destroy ();

// On redirige le visiteur vers la page d'accueil
header ('location: connexion_app.php');
?>