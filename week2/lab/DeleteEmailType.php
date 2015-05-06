<?php
include './bootstrap.php';



 $dbConfig = array(
    "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
    "DB_USER"=>'root',
    "DB_PASSWORD"=>''
    );
    $pdo = new DB($dbConfig);
    $db = $pdo->getDB();
    
    $model = new EmailModel();
    $DAO = new EmailDAO($db);
    
    // get values from URL
    $emailDAO = filter_input(INPUT_GET, 'id');
    
    $DAO->delete($model->getEmailid());
    if ( NULL !== $emailDAO ) {
        

        if ( $DAO->delete($emailDAO) ) {
            echo 'Email was deleted';
        }
    }


echo '<p><a href="',filter_input(INPUT_SERVER, 'HTTP_REFERER'),'">Go back</a></p>';



