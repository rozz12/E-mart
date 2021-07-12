<?php
    session_start();
    require('connection.php');
        use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    //Load Composer's autoloader
    require '../../vendor/autoload.php';

    //An empty array to store the errors
    $errors=[];
    
    
    //enters if the Register button has been set
    if (isset($_POST['Register'])) {
        $firstname = filter_var(trim($_POST['firstname']));
        $lastname = filter_var(trim($_POST['lastname']));
        $email = filter_var(trim($_POST['email'],FILTER_SANITIZE_EMAIL));
        $contact = filter_var(trim($_POST['contact'],FILTER_SANITIZE_STRING));
        $password = htmlentities(trim($_POST['password']));
        $repassword= htmlentities(trim($_POST['repassword']));


        if(empty($firstname)){
            $errors['firstname'] = "Firstname is required";
        }
        if(empty($lastname)){
            $errors['lastname'] = "Lastname is required";
        }
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address'; 
        }
        //validate email
        if(empty($email)){
            $errors['email'] = "Email is required";
        }
        //validate phone number
        if(strlen($contact)>9||strlen($contact)<9){
            $errors['contact']='Phone should be 10 digits.';
            echo strlen($contact);
        }
        if(empty($contact)){
            $errors['contact'] = "Contact number is required";
        }
        //check the password field for specified regex pattern
        $pwd_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])/';
        if (!preg_match($pwd_pattern, $password)) {
            $errors['password']= 'Password does not match required criterias';
        }
        if(empty($password)){
            $errors['password'] = "Password is required";
        }
                
    

        

        //enters this block if none of the input field is empty in the form in order to process the input values in the form
        if (count($errors)==0){ 
            $user_type='Customer';
            $password = md5($password);

            //create a vkey for verification
            $vkey = md5(time());

            $qry = "INSERT INTO customer(username, email, password, firstname, surname, user_type, contact_no,verify_key,status)
             VALUES (:username,:email,:password,:firstname,:lastname,:user_type,:contact,:vkey,0)";
            $insert=oci_parse($conn,$qry);
            oci_bind_by_name($insert,':username',$email);
            oci_bind_by_name($insert,':email',$email);
            oci_bind_by_name($insert,':password', $password);
            oci_bind_by_name($insert,':firstname', $firstname);
            oci_bind_by_name($insert,':lastname', $lastname);
            oci_bind_by_name($insert,':user_type', $user_type);
            oci_bind_by_name($insert,':contact', $contact);
            oci_bind_by_name($insert,':vkey', $vkey);
            $r = oci_execute($insert);

            if (!$r) {
                        //if there are multiple errors during previous processing then error message is displayed with the same respect
                    $message = 'Register unsuccesful';  
                }
            else{

                       
                    //send mail for verification
                    function sendmail($email,$vkey,$user_type){

                        //Create an instance; passing `true` enables exceptions
                        $mail = new PHPMailer(true);

                            try {
                                //Server settings
                                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                                $mail->isSMTP();                                            //Send using SMTP
                                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                $mail->Username   = 'naastha19@tbc.edu.np';                     //SMTP username
                                $mail->Password   = 'Nepal@253';                               //SMTP password
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                //Recipients
                                $mail->setFrom('Ceckhuddersfaxcommunal@gmail.com', 'Mailer');
                                $mail->addAddress($email);     //Add a recipient

                                //Content
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = 'CleckhHuddersFax Registration Verification';
                                $mail->Body    = "<b>Please verify your cleckhuddersfax E-Mart account by clicking this link</b><a href = 'http://localhost/E-mart-main/Project-web/verify_user.php?vkey=$vkey&user=$user_type'>Register Account</a>";

                                $mail->send();
                                //echo 'Message has been sent';
                            } catch (Exception $e) {
                                //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }
                            

                        }
                         sendmail($email,$vkey,$user_type);
                          $message = 'Registered Sucessfully. Please check your mail for verification.';
                    }
                    $_SESSION['message']=$message;
        }
            $_SESSION['errors']=$errors;
            
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../Style/CustomerRegistration.css">
    <title>Register</title>
</head>

<body style="background-color:#b7d87b;">
    <div class="container" style="background-color:#b7d87b;">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <form action="" method="POST" class="w-50 border border-dark p-4" style="background-color:#fff;">
                    <div class="d-flex justify-content-center">
                        <img src="../images/C.png" class="img-fluid" height="370px" width="400px">
                    </div>
                    <div class="col-12 ms-3 pb-4 d-flex justify-content-center">
                        <div class="fs-2">Customer Registration Form</div>
                    </div>
                    <div style="color: red; font-family: Noto; display: inline-block;">
                        <?php
                            if(isset($message)){
                                echo $_SESSION['message'];
                            }
                        ?>
                    </div>
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                placeholder="First Name" aria-label="Username" aria-describedby="basic-addon1"
                                value="<?php if(isset($_POST['firstname'])){echo $_POST['firstname'];} ?>">
                        </div>
                        <span class="error">
                            <?= $errors['firstname']??""?>
                        </span>
                    </div>

                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="text" name="lastname" class="form-control" id="lastname"
                                placeholder="Last Name" aria-label="Username" aria-describedby="basic-addon1"
                                value="<?php if(isset($_POST['lastname'])){echo $_POST['lastname'];} ?>">
                        </div>
                        <span class="error">
                            <?= $errors['lastname']??""?>
                        </span>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email-Address"
                                aria-describedby="emailHelp"
                                value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                        </div>
                        <span class="error">
                            <?= $errors['email']??""?>
                        </span>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <input type="text" name="contact" class="form-control" id="contact"
                                placeholder="Contact Number" aria-describedby="emailHelp"
                                value="<?php if(isset($_POST['contact'])){echo $_POST['contact'];} ?>">
                        </div>
                        <span class="error">
                            <?= $errors['contact']??""?>
                        </span>
                    </div>


                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Password" aria-describedby="passwordHelpBlock">
                            <div class="input-group-append"><span class="input-group-text">
                                    <p id="togglePassword">Show</p>
                                </span></div>
                            <div id="passwordHelpBlock" class="form-text">
                                Your password must include atleast one uppercase letter, one lowercase letter,a special
                                character and a number.
                            </div>
                            <span class="error">
                                <?= $errors['password']??""?>
                            </span>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="password" id="repassword" name="repassword" class="form-control"
                                placeholder="Re-enter Password" onfocusout="pwdcheck()"
                                aria-describedby="passwordHelpBlock">
                            <div class="input-group-append"><span class="input-group-text">
                                    <p id="togglePassword1">Show</p>
                                </span></div>
                        </div>
                        <label id="pmatch" style="color: red; visibility: hidden;"></label>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="Agreement" id="exampleCheck1">
                        <label class="form-check-label" for="KeepMeSigned">Keep me signed in</label>
                    </div>

                    <div class="fs-6 py-3">By clicking on Register, you acknowledge to have read our <a
                            href="https://www.seb.ee/files/tingimused/interneti_kaupmehelepingu_tingimused_eng.pdf">Terms
                            and Conditions</a></div>

                    <button type="submit" name="Register" class="btn btn-primary w-100">Register</button>
                    <div class="fs-5 py-3 text-center">--- OR ---</div>
                    <button type="reset"  class="btn btn-outline-danger w-100 trader_reg">Register as Trader</button>
                    <div class="fs-6 py-3 text-center">Already have an account?</div>
                    <button type="reset" class="btn btn-outline-danger w-100 signin">Signin</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
        crossorigin="anonymous"></script>
    <script type="text/javascript">

        //button click actions
        document.querySelector('.trader_reg').addEventListener('click', function(){
                window.location.href = '../trader_reg.php';
            });

         document.querySelector('.signin').addEventListener('click', function(){
                window.location.href = '../signin.php';
            });


        const togglePassword = document.querySelector('#togglePassword');
        const togglePassword1 = document.querySelector('#togglePassword1');
        const password = document.querySelector('#password');
        const repassword = document.querySelector('#repassword');

        //password checker
        function pwdcheck() {
            const password_val = document.querySelector('#password').value;
            const repassword_val = document.querySelector('#repassword').value;
            if (repassword_val === password_val) {
                document.getElementById('pmatch').style.visibility = 'visible';
                document.getElementById('pmatch').style.color = 'green';
                document.getElementById('pmatch').innerHTML = 'Password Match';
            }
            else {
                document.getElementById('pmatch').style.visibility = 'visible';
                document.getElementById('pmatch').style.color = 'red';
                document.getElementById('pmatch').innerHTML = 'Password Mismatch';
            }
        }

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            //this.classList.toggle('fa-eye-slash');
        });
        togglePassword1.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = repassword.getAttribute('type') === 'password' ? 'text' : 'password';
            repassword.setAttribute('type', type);
        });


    </script>
</body>

</html>