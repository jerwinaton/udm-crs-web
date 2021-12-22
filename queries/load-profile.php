 <?php
    include '../includes/connection.php';
    if (isset($_POST['id'])) {
        $load_profile = $conn->prepare("SELECT * FROM xyashmqn_udm.students WHERE student_username=:uname");
        $load_profile->execute(array(':uname' => $_POST["id"]));
        $data_fetched = $load_profile->fetch(PDO::FETCH_ASSOC);
        $data = array();
        if ($data_fetched) {
            $data[] = $data_fetched;
        }
        echo json_encode($data);
    }
