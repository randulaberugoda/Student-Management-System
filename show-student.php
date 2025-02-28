<?php

if (isset($_GET['fetch'])) {
    header("Content-Type: application/json");

    $filename = 'data.json';
    if (file_exists($filename)) {
        echo file_get_contents($filename);
    } else {
        echo json_encode(["message" => "No student records found"]);
    }
    exit; 
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            background-color: #E3F2FD;
            color: #333333;
        }
        #showStudentSection {
            margin-left: 1rem;
            margin-right: 1rem;
        }
        @media (min-width: 768px) {
            #showStudentSection {
                margin-left: auto;
                margin-right: auto;
                max-width: 1100px;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center text-primary">Student Record Management System</h1>
        <nav class="nav nav-pills nav-fill my-4">
            <a class="nav-link" href="home.php">Home</a>
            <a class="nav-link" href="insert-student.php">Insert Student</a>
            <a class="nav-link" href="show-student.php">Show All Students</a>
            <a class="nav-link" href="find-student.php">Find Student</a>
            <a class="nav-link" href="update-student.php">Update Student</a>
            <a class="nav-link" href="delete-student.php">Delete Student</a>
        </nav>
        <hr><br>
    </div>


    <div id="showStudentSection">
    <div id="viewStudentsSection">
        <h3 class="text-info">All Students</h3>
        <div id="studentList" class="table-responsive">
            <?php
            $filename = 'data.json';
            if (file_exists($filename)) {
                $data = json_decode(file_get_contents($filename), true);

                if (!empty($data)) {
                    echo '<table class="table table-bordered table-striped">';
                    echo '<thead><tr>';
                    echo '<th>SID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>City</th><th>Course</th><th>Guardian</th><th>Subjects</th>';
                    echo '</tr></thead><tbody>';

                    foreach ($data as $student) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($student['sid']) . '</td>';
                        echo '<td>' . htmlspecialchars($student['firstName']) . '</td>';
                        echo '<td>' . htmlspecialchars($student['lastName']) . '</td>';
                        echo '<td>' . htmlspecialchars($student['email']) . '</td>';
                        echo '<td>' . htmlspecialchars($student['city']) . '</td>';
                        echo '<td>' . htmlspecialchars($student['course']) . '</td>';
                        echo '<td>' . htmlspecialchars($student['guardian']) . '</td>';
                        echo '<td>' . htmlspecialchars($student['subjects']) . '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody></table>';
                } else {
                    echo '<p class="text-danger">No student records found.</p>';
                }
            } else {
                echo '<p class="text-danger">Data file not found.</p>';
            }
            ?>
        </div>
    </div></div>

    <script src="script.js"></script>
</body>
</html>
