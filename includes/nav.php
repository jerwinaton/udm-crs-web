<?php
echo '<nav class="navbar fixed-top navbar-expand-lg bg-white fw-bold  default-size">
<div class="container">
    <a class="navbar-brand lightgray hover-lightgreen" href="index.php">
        <img src="assets/images/udm_logo_300px.png" alt="udm logo" width="50" class="d-inline-block align-text-center">
        UDM Student Portal</a>
    <button class="navbar-toggler navbar-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse bg-white navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-end ">
            <li class="nav-item mx-2">
                <a class="nav-link announcements-link lightgray hover-lightgreen" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link lightgray view-schedule-link hover-lightgreen" href="view-schedule.php">View Schedule</a>
            </li>
            <li class="nav-item mx-2 ">
                <a class="nav-link lightgray view-grades-link hover-lightgreen " aria-current="page" href="view-grades.php">View Grades</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link lightgray profile-link hover-lightgreen" href="profile.php">Profile</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link nav-link password-link lightgray hover-lightgreen" href="change-password.php">Password</a>
            </li>
            <li class="nav-item mx-2">
                <form action="queries/logout.php" class="d-flex justify-content-center align-items-center" style="height:100%;" method="POST">
                    <button class="btn-logout" name="btn-logout">logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>
</nav>';
