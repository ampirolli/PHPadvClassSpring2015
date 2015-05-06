<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include './bootstrap.php'; ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
        
        $email = filter_input(INPUT_POST, 'email');
        $emailTypeId = filter_input(INPUT_POST, 'emailtypeid');
        $active = filter_input(INPUT_POST, 'active');
        
        
        $emailTypeDAO = new EmailTypeDAO($db);
        $emailTypes = $emailTypeDAO->getAllRows();
        
        $emailDAO = new EmailDAO($db);
        
        $util = new Util();
        
        if($util->isPostRequest())
        {
            $validator = new Validator(); 
            $errors = array();
                if( !$validator->emailIsValid($email) ) {
                    $errors[] = 'Email is invalid';
                } 
                if ( !$validator->activeIsValid($active) ) {
                     $errors[] = 'Active is invalid';
                }
                if( $validator->emailTypeIsValid($emailTypes) ) {
                    $errors[] = 'Email type is invalid';
                } 
                if ( count($errors) > 0 ) {
                    foreach ($errors as $value) {
                        echo '<p>',$value,'</p>';
                }
                }else{
            
                    $emailModel = new EmailModel();
                    
                    $emailModel->map(filter_input_array(INPUT_POST));
                    
                    // var_dump($emailtypeModel);
                    if ( $emailDAO->save($emailModel) ) {
                        echo 'Email Added';
                    } else {
                        echo 'Email not added';
                    }
            
            
        
                } 
        }       
        
        ?>
        <h3>Add Email</h3>
        <form action="#" method="post">
            <label>Email:</label>            
            <input type="text" name="email" value="<?php echo $email; ?>" placeholder="" />
            <br /><br />
            <label>Active:</label>
            <input type="number" max="1" min="0" name="active" value="<?php echo $active; ?>" />
            
            <br /><br />
            <label>Email Type:</label>
            <select name="emailtypeid">
            <?php 
                foreach ($emailTypes as $value) {
                    if ( $value->getEmailtypeid() == $emailTypeid ) {
                        echo '<option value="',$value->getEmailtypeid(),'" selected="selected">',$value->getEmailtype(),'</option>';  
                    } else {
                        echo '<option value="',$value->getEmailtypeid(),'">',$value->getEmailtype(),'</option>';
                    }
                }
            ?>
            </select>
            
             <br /><br />
            <input type="submit" value="Submit" />
        </form>
         
            <table border="1" cellpadding="5">
                <tr>
                    <th>Email</th>
                    <th>Email Type</th>
                    <th>Last updated</th>
                    <th>Logged</th>
                    <th>Active</th>
                    <th>Delete</th>
                </tr>
         <?php 
            $emails = $emailDAO->getAllRows(); 
            foreach ($emails as $value) {
                echo '<tr><td>',$value->getEmail(),'</td><td>',$value->getEmailtype(),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLastupdated())),'</td><td>',date("F j, Y g:i(s) a", strtotime($value->getLogged())),'</td>';
                echo  '<td>', ( $value->getActive() == 1 ? 'Yes' : 'No') ,'</td><td><a href="DeleteEmail.php?id=',$value->getEmailid(),'">Delete</a></td> <td><a href="UpdateEmail.php?id=',$value->getEmailid(),'">Update</a></td> </tr>';
            }

         ?>
    </body>
</html>
