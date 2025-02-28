

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if ($input && isset($input['sid'])) {
        $filename = 'data.json';

        $data = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];

        $data = array_filter($data, function($student) use ($input) {
            return $student['sid'] !== $input['sid'];
        });

        $data = array_values($data);

        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));


        echo json_encode(["message" => "Record deleted successfully"]);
    } else {
        echo json_encode(["message" => "Invalid input data"]);
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
        #deleteStudentSection {
            margin-left: 2rem;
            margin-right: 2rem;
        }
        @media (min-width: 768px) {
            #deleteStudentSection {
                margin-left: auto;
                margin-right: auto;
                max-width: 900px;
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

    <div id="deleteStudentSection">
        <div id="deleteSection">
            <h3 class="text-danger">Delete a Student</h3>
            <form id="deleteForm">
                <div class="mb-3">
                    <label for="deleteSid" class="form-label">Student ID</label>
                    <input type="text" class="form-control" id="deleteSid" placeholder="Enter Student ID">
                </div>
                <button type="button" class="btn btn-danger" id="deleteButton">Delete Student</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#deleteButton").click(function () {
                const sid = $("#deleteSid").val();

                
                if (sid) {
                    const studentData = { sid: sid };

                    $.ajax({
                        url: '',  
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(studentData),
                        success: function (response) {
                            const res = JSON.parse(response);
                            alert(res.message);
                        },
                        error: function (xhr, status, error) {
                            alert("An error occurred: ");
                        }
                    });
                } else {
                    alert("Please enter a valid Student ID.");
                }
            });
        });
    </script>
    <script src="script.js"></script>
</body>
</html>
