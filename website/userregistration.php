<?php


$showAlert = false;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'Config/constant.php';
    
    $username = $_POST["username"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/', $email)) {
        $errors['email'] = "Invalid email format. Email must be like userexample@gmail.com";
    }
    
    // Validate phone number
    if (!preg_match('/^9[78][0-9]{8}$/', $phone)) {
        $errors['phone'] = "Invalid phone number. Phone number must start with 97 or 98.";
    }
    
    // Validate username 
    if (strlen($username) < 5) {
        $errors['username'] = "Username must be at least 5 characters long.";
    }
    
    // Check whether this username exists
    if (empty($errors)) {
        $existSql = "SELECT * FROM `users` WHERE username = '$username'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
    
        if ($numExistRows > 0) {
            $errors['username'] = "Username Already Exists";
        }
    }

    // If no errors, proceed with the registration
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`username`, `firstName`, `lastName`, `email`, `phone`, `address`, `password`, `joinDate`) VALUES ('$username', '$firstName', '$lastName', '$email', '$phone', '$address', '$hash', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            $showAlert = true;
            header('location:' . SITEURL . 'userlogin.php?signupsuccess=true');
        } else {
            $errors['general'] = "Registration failed. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Register Form</title>
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Register Window</h2>
            <form method="post" action="">
                <input class="input-box" type="text" name="username" placeholder="Your username" value="<?php echo isset($username) ? $username : ''; ?>" required>
                <?php if (isset($errors['username'])) { echo '<span class="error">' . $errors['username'] . '</span>'; } ?>
                
                <input class="input-box" type="text" name="firstName" placeholder="Your First Name" value="<?php echo isset($firstName) ? $firstName : ''; ?>" required>
                
                <input class="input-box" type="text" name="lastName" placeholder="Your Last Name" value="<?php echo isset($lastName) ? $lastName : ''; ?>" required>

                <input class="input-box" type="email" name="email" placeholder="Your Email Address" value="<?php echo isset($email) ? $email : ''; ?>" required>
                <?php if (isset($errors['email'])) { echo '<span class="error">' . $errors['email'] . '</span>'; } ?>
                
                <input class="input-box" type="text" name="address" placeholder="Your Address" value="<?php echo isset($address) ? $address : ''; ?>" required>
                
                <input type="tel" class="input-box" id="phone" name="phone" placeholder="Enter Phone No" value="<?php echo isset($phone) ? $phone : ''; ?>" >
                <?php if (isset($errors['phone'])) { echo '<span class="error">' . $errors['phone'] . '</span>'; } ?>

                <input class="input-box" type="password" name="password" placeholder="Your Password" required>
                <?php if (isset($errors['general'])) { echo '<span class="error">' . $errors['general'] . '</span>'; } ?>
                
                <label class="text-color-white">
                    <input type="checkbox" required>
                    Agree with <a href="#" class="text-color-white">Terms & Condition</a>
                </label>
                <button class="login-btn" type="submit" name="submit">Register</button>
                <button class="secondary-btn"><a href="userlogin.php" class="text-color-white text-decoration-none">Already a User?</a></button>
            </form>
        </div>
    </div>
</body>
</html>

<style>
.error {
    color: red;
    font-size: 0.8em;
}
</style>
