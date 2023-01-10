<?php

/* To validate First Name (for numbers or empty)*/
if (empty($_POST["firstname"])) {
    $firstnameerr = "*Name is required";
} else {
    $firstname = $_POST['firstname'];
    if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
        $firstnameerr = "*Only alphabets and white<br> space are allowed";
    }
}

/* To validate the Last Name*/
if (empty($_POST["lastname"])) {
    $lastnameerr = "*Last Name is required";
} else {
    $lastname = $_POST['lastname'];
    if (!preg_match("/^[a-zA-Z ]*$/", $lastname)) {
        $lastnameerr = "*Only alphabets and white<br> space are allowed";
    }
}

/* To Validate the Email address(required field)*/
if (empty($_POST["email"])) {
    $emailerr = "*Email is required";
} else {
    $email = $_POST["email"];
}

/* Validates the mobile number(max 10 no, required field)*/
if (empty($_POST["mobilenumber"])) {
    $mobilenumbererr = "*Mobile Number is required";
} else {
    $mobilenumber = $_POST["mobilenumber"];
    if (!preg_match('/^[0-9]{10}+$/', $mobilenumber)) {
        $mobilenumbererr = "*Only numeric value is allowed.";
    }

    if (strlen($mobilenumber) != 10) {
        $mobilenumbererr = "*Mobile Number must contain 10 digits.";
    }
}

/* Validates the Password strength (min 8 char)must contain 1 special charaactetr, 1 number , 1 small & 1 capital letter) */
if (empty($_POST["password"])) {
    $passworderr = "*Password is required";
} else {
    $password = $_POST['password'];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $passworderr = '*Password should be at least 8 <br>characters in length and should <br>include at least one upper case<br> letter, one number, and one <br>special character.';
    }
}

/* Validates the DOB (required)*/
if (empty($_POST["dob"])) {
    $doberr = "*Date of Birth is required";
} else {
    $dob = $_POST['dob'];
}

/* Validates the Porfile picture extension(png, jpg, jpeg) */
if ($_FILES["pfp"]) {
    $pfp = $_FILES['pfp'];

    $pfpname = $pfp['name'];
    $pfperror = $pfp['error'];
    $pfptmp = $pfp['tmp_name'];

    $pfpext = explode('.', $pfpname);
    $pfpcheck = strtolower(end($pfpext));

    $validext = array('png', 'jpg', 'jpeg');

    if (!in_array($pfpcheck, $validext)) {
        $pfperr = "Image not valid";
    }
}
?>