<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

$factory = (new Factory)
    ->withServiceAccount('bp-klinec-firebase-adminsdk-oc4cm-46199ba722.json')
    ->withDatabaseUri('https://bp-klinec-default-rtdb.europe-west1.firebasedatabase.app/');

$database = $factory->createDatabase();
$auth = $factory->createAuth();


?>