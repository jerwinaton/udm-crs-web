<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    echo '<pre>';
    var_dump($_SESSION);
    echo '</pre>';
    ?>

</body>

</html>




<!-- <form action="" method="POST">
        <input type="text" required name="subject_code" placeholder="subject_code">
        <input type="text" required name="section" placeholder="section">
        <input type="text" required name="description" placeholder="description">
        <input type="text" name="units" placeholder="units">
        <input type="text" required name="day" placeholder="day">
        <input type="text" required name="time_from" placeholder="time_from">
        <input type="text" required name="time_to" placeholder="time_to">
        <input type="text" required name="room" placeholder="room">
        <input type="text" required name="faculty" placeholder="faculty">
        <input type="text" required name="block_no" placeholder="block_no">
        <input type="text" required name="school_year" placeholder="school_year">
        <input type="text" required name="semester" placeholder="semester">
        <input type="submit" value="insert" name="btn">
        <!--  -->
<!-- </form> -->
<!-- 
    // require 'includes/connection.php';
    // if (isset($_POST['btn'])) {
    //     try {
    //         $sql = "INSERT INTO udm.schedule (subject_code, section, description, units, day, time_from, time_to, room, faculty, block_no, school_year, semester) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    //         if ($conn->prepare($sql)->execute([$_POST["subject_code"], $_POST["section"], $_POST["description"], $_POST["units"], $_POST["day"], $_POST["time_from"], $_POST["time_to"], $_POST["room"], $_POST["faculty"], $_POST["block_no"], $_POST["school_year"], $_POST["semester"]])) {
    //             echo "success";
    //         } else {
    //             echo "failed";
    //         }
    //     } catch (PDOException $err2_select) {
    //         $err2_select->getMessage();
    //     }
    // }
    // ?>
    // 
    // if (isset($_POST['btn'])) {
    // if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W\_])[A-Za-z\d\W\_]{8,}$/", $_POST['password'])) {
    // echo 'awit';
    // } else {
    // echo "nani";
    // }
    // }
    // if (isset($_POST['btn'])) {
    // $select_stmt = $conn->prepare("SELECT expDate FROM udm.students WHERE student_id=:id"); //prepared selct statement
    // $select_stmt->execute(array(':id' => 1));
    // $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    // if ($row) {
    // echo $row["expDate"];
    // $expFormat = mktime(
    // date("H"),
    // date("i"),
    // date("s"),
    // date("m"),
    // date("d"),
    // date("Y")
    // );
    // $expDate = date("Y-m-d H:i:s", $expFormat);
    // echo " -----" . $expDate;
    // if ($row["expDate"] > $expDate) {
    // echo "not expired";
    // } else {
    // echo "expired";
    // }
    // } //execute and bind parameters
    // }
    // if (isset($_POST['btn'])) {
    // $password = $_POST['password']; //password textbox
    // $options = ['cost' => 4];
    // $hashedP = password_hash($password, PASSWORD_BCRYPT, $options);
    // $hashedP = trim($hashedP);
    // $update_stmt = $conn->prepare("UPDATE udm.students SET student_password=:pass WHERE student_id=:id"); //prepared selct statement
    // if ($update_stmt->execute(array(':pass' => $hashedP, ':id' => 1))) {
    // echo $hashedP;
    // echo "success";
    // } //execute and bind parameters
    // }
    ?>
</body>

</html>