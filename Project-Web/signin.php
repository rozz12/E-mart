<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Signinstyles.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>SignIn</title>
     <script type="text/javascript"> 

    </script>
</head>
<body style="background-color:#b7d87b;">

    <form action="php/login.php" method="POST" enctype="multipart/form-data" >

        <img src="images/C.png" ></img>
        <h2>SIGN IN TO YOUR CHF ACCOUNT</h2>
        <div class="form-group">
        	<p>
        		<label for="Email" class="floatLabel">Email</label>
        		<input id="Email" name="Email" type="text" class="form-control" value="<?php if(isset($_POST['Email'])){
                        echo $_POST['Email'];
                    }?>">
        	</p>
        	<p>
        		<label for="password" class="floatLabel">Password</label>
        		<input id="password" class="form-control" name="password" type="password"  value="<?php if(isset($_POST['password'])){
                        echo $_POST['password'];
                    }?>">
            </p>

        </div>
         <div class="form-group">
                <label class=" floatLabel">Account Type</label>
                <div>
                    <select name="user_type" class="form-control">
                        <option value="Trader" <?php if(isset($_POST['user_type'])&&$_POST['user_type']=='Trader'){
                        echo 'selected';
                    } ?> >Trader</option>
                        <option value="Customer" <?php if(isset($_POST['user_type'])&&$_POST['user_type']=='Customer'){
                        echo 'selected';
                    } ?> >Customer</option>
                    </select>
                </div>
        </div>
        <div class="form-forgotpass">
            <p class="align-right">
                <a href="forgotpassword.php" name="forget">Forgot Password?</a>
            </p>	
        	<p class="align-left">
                <input id="checkbox" type="checkbox" name="remember" value="1"/>Keep me Signed in <br/>
            </p>
        </div>
        <div style="color: red; font-family: Noto; display: inline-block;">
            <?php
                if (isset($_GET['error'])) {
                    echo '<h4>'.$_GET['error'].'</h4>';
                }
            ?>   
        </div>
        <div class="form-buttons">
            <div class="submit-btn">
                <button class="submit-btn1" name="login">Sign-in</button>
                <p class="text-align">Don't Have a Account? <br/> </p>
                <button type="button" class="reg submit-btn2">Register now</button>
            </div>
        </div>
	</form>
        <script>
            document.querySelector('.reg').addEventListener('click', function(){
                window.location.href = 'php/register_customer.php';
            });

        </script>
   
</body>
</html>