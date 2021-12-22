<?php
session_start();
include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update_stmt = $conn->prepare("UPDATE udm.students SET first_name=:first_name, 
    middle_name=:middle_name, last_name=:last_name, lrn=:lrn, gender=:gender, birthdate=:birthdate, 
    birthplace=:birthplace, address=:address,district=:district,town=:town,barangay=:barangay,
    zip_code=:zip_code,contact_no=:contact_no,email=:email,mothers_name=:mothers_name,
    mothers_contact_no=:mothers_contact_no,mothers_work=:mothers_work,fathers_name=:fathers_name,
    fathers_contact_no=:fathers_contact_no,fathers_work=:fathers_work, last_school_attended=:last_school_attended 
    WHERE student_username=:student_username"); //prepared selct statement
    if ($update_stmt->execute(array(
        ':first_name' => $_POST["first_name"],
        ':middle_name' => $_POST["middle_name"], ':last_name' => $_POST["last_name"],
        ':lrn' => $_POST["lrn"], ':gender' => $_POST["gender"], ':birthdate' => $_POST["birthdate"],
        ':birthplace' => $_POST["birthplace"], ':address' => $_POST["address"], ':district' => $_POST["district"],
        ':town' => $_POST["town"], ':barangay' => $_POST["barangay"], ':zip_code' => $_POST["zip_code"],
        ':contact_no' => $_POST["contact_no"], ':email' => $_POST["email"], ':mothers_name' => $_POST["mothers_name"],
        ':mothers_contact_no' => $_POST["mothers_contact"], ':mothers_work' => $_POST["mothers_occupation"], ':fathers_name' => $_POST["fathers_name"],
        ':fathers_contact_no' => $_POST["fathers_contact"], ':fathers_work' => $_POST["fathers_occupation"], ':last_school_attended' => $_POST["last_school_attended"],
        ':student_username' => $_SESSION["student_username"]
    ))) {
        echo "success";
    } else {
        echo "failed";
    }
}
