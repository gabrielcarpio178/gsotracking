<?php
include '../logic/dbCon.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update</title>
</head>

<body>
    <?php
    $usercode = $_SESSION['usercode'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE usercode = ?");
    $stmt->bind_param("i", $usercode);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $birthdate = $row['birthdate'];
    $birthDate = new DateTime($birthdate);
    $currentDate = new DateTime();

    // Calculate age
    $age = $currentDate->diff($birthDate);
    $ageYears = $age->y;

    // Adjust for birthday not yet occurred this year
    if ($currentDate < $birthDate->add(new DateInterval('P' . ($ageYears + 1) . 'Y'))) {
        $ageYears--;
    }

    $ageFormatted = $ageYears == 1 ? $ageYears . ' yr old' : $ageYears . ' yrs old';

    // echo "Birthdate from DB: " . htmlspecialchars($birthdate) . "<br>";
    // echo "Current Date: " . $currentDate->format('Y-m-d') . "<br>";
    // echo "Age: " . $ageFormatted . "<br>";
    ?>

    <form action="../logic/updateProfile.php" method="post" onsubmit="return checkInputs()">
        <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($row['fullname']); ?>" placeholder="Full Name" /><br />

        <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" placeholder="bithdate" />
        <?php echo $ageFormatted; ?><br />

        <label for="gender">Sex:</label><br />
        <input type="radio" id="male" name="gender" value="male" <?php echo $row['gender'] == "male" ? "checked" : ""; ?> />
        <label for="male">Male</label><br />
        <input type="radio" id="female" name="gender" value="female" <?php echo $row['gender'] == "female" ? "checked" : ""; ?> />
        <label for="female">Female</label><br />

        <input type="text" id="phone_number" name="phone_number" value="0<?php echo htmlspecialchars($row['phone_number']); ?>" placeholder="Phone Number" /><br />
        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" placeholder="Email" /><br />

        <input type="password" id="password" name="password" value="" placeholder="New Password" /><button type="button" onclick="showPassword()">Show</button><br />
        <input type="password" id="confirmPassword" name="confirmPassword" value="" placeholder="Confirm Password" /><br />

        <button type="submit">Save</button>
    </form>

    <script>
        function checkInputs() {
            var fullname = document.getElementById("fullname").value;
            var phone_number = document.getElementById("phone_number").value;
            var birthdate = document.getElementById("birthdate").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            var male = document.getElementById("male").checked;
            var female = document.getElementById("female").checked;

            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }

            if (fullname === '' || email === '' || password === '' || confirmPassword === '' || phone_number === '' || birthdate === '') {
                alert("Please fill in all fields!");
                return false;
            }

            if (!male && !female) {
                alert("Please select a gender!");
                return false;
            }

            return true;
        }

        function showPassword() {
            var confirmPassword = document.getElementById("confirmPassword");
            var password = document.getElementById("password");
            if (password.type === "password") {
                password.type = "text";
                confirmPassword.type = "text";
            } else {
                password.type = "password";
                confirmPassword.type = "password";
            }
        }
    </script>
</body>

</html>