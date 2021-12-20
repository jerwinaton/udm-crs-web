<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST">
        <input type="text" name="password">
        <input type="submit" value="asd" name="btn">
    </form>
    <?php
    require 'includes/connection.php';

    if (isset($_POST['btn'])) {
        $select_stmt = $conn->prepare("SELECT expDate FROM udm.students WHERE student_id=:id"); //prepared selct statement
        $select_stmt->execute(array(':id' => 1));
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            echo $row["expDate"];
            $expFormat = mktime(
                date("H"),
                date("i"),
                date("s"),
                date("m"),
                date("d"),
                date("Y")
            );
            $expDate = date("Y-m-d H:i:s", $expFormat);
            echo " -----" . $expDate;
            if ($row["expDate"] > $expDate) {
                echo "not expired";
            } else {
                echo "expired";
            }
        } //execute and bind parameters
    }
    // if (isset($_POST['btn'])) {
    //     $password = $_POST['password']; //password textbox
    //     $options = ['cost' => 4];
    //     $hashedP = password_hash($password, PASSWORD_BCRYPT, $options);
    //     $hashedP = trim($hashedP);
    //     $update_stmt = $conn->prepare("UPDATE udm.students SET student_password=:pass WHERE student_id=:id"); //prepared selct statement
    //     if ($update_stmt->execute(array(':pass' => $hashedP, ':id' => 1))) {
    //         echo $hashedP;
    //         echo "success";
    //     } //execute and bind parameters
    // }
    ?>
</body>

</html>