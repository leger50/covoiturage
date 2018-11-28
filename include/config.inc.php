<?php
// Param�tres de l'application Covoiturage
// A modifier en fonction de la configuration

define('DBHOST', "localhost");
define('DBNAME', "covoiturage");
define('DBUSER', "bd");
define('DBPASSWD', "bede");
define('ENV','prod');
define('DBPORT',3306);
define('SALT','48@!alsd');
define('PRECISION', 3);
// pour un environememnt de production remplacer 'dev' (d�veloppement) par 'prod' (production)
// les messages d'erreur du SGBD s'affichent dans l'environememnt dev mais pas en prod
?>
