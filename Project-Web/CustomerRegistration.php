<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/Customer_registration.css">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <form action="php/register_customer.php" method="POST" class="w-50 border border-dark p-4">
                    <div class="text-center">
                        <img src="images/C.png"alt="logo" height="150px" width="350px">
                    </div>
                    <div class="col-12 ms-3 pb-4 d-flex justify-content-center">
                        <div class="fs-2">Customer Registration Form</div>
                    </div>
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="text" name="address" class="form-control" id="address" placeholder="Permanent Address"
                                aria-label="Address" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email-Address"
                                aria-describedby="emailHelp">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <input type="number" name="phone" class="form-control" id="contact" placeholder="Contact Number"
                                aria-describedby="emailHelp">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <select class="form-select" aria-label="Default select example" name="Gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="age" id="age" placeholder="Age"
                                        aria-label="Age" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                                aria-describedby="passwordHelpBlock">
                            <div class="input-group-append"><span class="input-group-text"><p id = "togglePassword">Show</p></span></div>
                            <div id="passwordHelpBlock" class="form-text">
                                Your password must be 8-20 characters long, contain letters and numbers, and must
                                not
                                contain spaces, special characters, or emoji.
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="password" id="repassword" name="repassword" class="form-control" placeholder="Re-enter Password" onfocusout="pwdcheck()"
                                aria-describedby="passwordHelpBlock">
                            <div class="input-group-append"><span class="input-group-text"><p id = "togglePassword1">Show</p></span></div>
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
                    <button type="button" class="btn btn-outline-danger w-100">Register as Trader</button>
                    <div class="fs-6 py-3 text-center">Already have an account?</div>
                    <button type="button" class="btn btn-outline-danger w-100">Signin</button>
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
            const togglePassword = document.querySelector('#togglePassword');
            const togglePassword1 = document.querySelector('#togglePassword1');
            const password = document.querySelector('#password');
            const repassword = document.querySelector('#repassword');

            //password checker
        function pwdcheck(){
            const password_val = document.querySelector('#password').value;
            const repassword_val = document.querySelector('#repassword').value;
            if (repassword_val === password_val) {
                document.getElementById('pmatch').style.visibility = 'visible';
                document.getElementById('pmatch').style.color = 'green';
                document.getElementById('pmatch').innerHTML = 'Password Match';
            }
            else{
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