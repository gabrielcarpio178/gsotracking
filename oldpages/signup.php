<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/signup.css">
    <title>Sign_up</title>
</head>
<body>


<div class="container">
<div class="box1">

            <div class="toptext">
                <h1>Welcome</h1>
                <p>
                Welcome to our website! We're thrilled to have you here. <br>
                Explore our feature, join our community, and enjoy a seamless experience tailored just for you.
            </p>
            </div>

            <div class="midimage">

                <img src="../styles/images/col.jpg" alt="">

            </div>

            <div class="bottomtext">
                <button><a href="../index.php">Already have an account?</a></button>
            </div>
        

            

        </div>



<div class="box2">
        <h1>REGISTER NOW</h1>

        <form action="../logic/signup_script.php" method="post" onsubmit="return validateLogin()">
            <span>Fullname</span>
        <input type="fullname" name="fullname" id="fullname" placeholder="fullname"/>


         <div class="bsex">

         <span>Birthdate</span>
             <input type="date" name="birthdate" id="birthdate" placeholder="birthdate"/>

             <span>Sex</span>

            <input type="radio" name="gender" id="male" value="male"/> <p>Male</p>
            <input type="radio" name="gender" id="female" value="female"/><p>Female</p>

         </div>
       

        <span>Email</span>
        <input type="email" name="email" id="email" placeholder="email"/>
        <span>Phone</span>
        <input type="text" maxlength="11" name="phonenumber" id="phonenumber" placeholder="Phone number" oninput="validatePhoneNumber(this)">

        <span>Password</span>
        <input type="password" name="password" id="password" placeholder="password"/>
        <span>Confirm Password</span>
        <input type="password" name="confirmpassword" id="confirmpassword" placeholder="confirm password"/>

        
        <button type="submit">Register</button>
    </form>
</div>

</div>























    <!-- <form action="../logic/signup_script.php" method="post" onsubmit="return validateLogin()">
        <input type="fullname" name="fullname" id="fullname" placeholder="fullname"/><br>
        <input type="date" name="birthdate" id="birthdate" placeholder="birthdate"/><br>
        <div>
            sex
            <input type="radio" name="gender" id="male" value="male"/>male
            <input type="radio" name="gender" id="female" value="female"/>female
        </div><br>
        <input type="email" name="email" id="email" placeholder="email"/><br>
        <input type="text" maxlength="11" name="phonenumber" id="phonenumber" placeholder="Phone number" oninput="validatePhoneNumber(this)"><br>
        <input type="password" name="password" id="password" placeholder="password"/><br>
        <input type="password" name="confirmpassword" id="confirmpassword" placeholder="confirm password"/><br>
        <button type="submit">signup</button>
    </form>

 -->







    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../scripts/signup.js"></script>
</body>
</html>