﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Rented</title>
    <style type="text/css">
        #Year
        {
            width: 100px;
        }
        #Make
        {
            width: 100px;
        }
        #Model
        {
            width: 125px;
        }
    </style>
</head>
<body>
    
        <?php
        // put your code here
        $dbConfig = array(
            "DB_DNS"=>'mysql:host=localhost;port=3306;dbname=PHPadvClassSpring2015',
            "DB_USER"=>'root',
            "DB_PASSWORD"=>''
        );
        
    $pdo = new DB($dbConfig);
    $db = $pdo->getDB();
        
    $cars = new CarDao($db);
    $availableCars = $cars->getAvailable();
    
    
    ?>
    
<div>
<a href="" style="border-style: outset; border-width: medium"> Avaliable for Rent </a>&nbsp;&nbsp;
<a href="" style="border-style: outset; border-width: medium"> Out for Rent </a>&nbsp;&nbsp;
<a href="" style="border-style: outset; border-width: medium"> Customer Status </a>&nbsp;&nbsp;
<a href="" style="border-style: outset; border-width: medium"> Admin </a>&nbsp;&nbsp;
</div>
<br />
<br />
<div>

    <select id="Year" name="Year">
        <option></option>
    </select>&nbsp;&nbsp;

    <select id="Make" name="Make">
        <option></option>
    </select>&nbsp;&nbsp;
    
    <select id="Model" name="Model">
        <option></option>
    </select><br />
    </div>

<div id = "results" style="border-style: inset; border-width: medium">

    
    <ul>
        <?php 
        foreach($availableCars as $value)
        {
            
            
            
        }
        
        ?>
        
    </ul>
    
</div>




</body>
</html>