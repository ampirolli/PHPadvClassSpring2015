<?php include './bootstrap.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        $utility = new Utility();
        $validator = new Validator();
        $emailFunctions = new emailTypeDb();
        
        $emailType = filter_input(INPUT_POST, 'emailType');
        //var_dump($emailType);
        
        $errors = array();
        
        if($utility->isPostRequest())
        {      
            if(!$validator->emailTypeIsValid($emailType))
            {
                $errors[] = 'Email Type isnt Valid';
            }
        }
        
        if(count($errors) > 0)
        {
            foreach($errors as $value)
            {
                echo '<p>',$value,'</p>';
            }
        }else{
            $emailFunctions->saveEmailType($emailType);
        }
        
        ?>
        <h3>Add Email type</h3>
        <form action="#" method="post">
            <label>Email Type:</label> 
            <input type="text" name="emailType" value="<?php echo $emailType; ?>" placeholder="" />
            <input type="submit" value="Submit" />
        </form>
        
        <?php 
        
        $emailFunctions->displayEmailType();
        
        ?>
        
    </body>
</html>
