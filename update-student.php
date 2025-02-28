<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if ($input) {
        $filename = 'data.json';
      
        $data = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];

       
        foreach ($data as &$student) {
            if ($student['sid'] === $input['sid']) {
                $student['firstName'] = $input['firstName'];
                $student['lastName'] = $input['lastName'];
                $student['email'] = $input['email'];
                $student['city'] = $input['city'];
                $student['course'] = $input['course'];
                $student['guardian'] = $input['guardian'];
                $student['subjects'] = $input['subjects'];
                break;
            }
        }

        
        file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));

        echo json_encode(["message" => "Record updated successfully"]);
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
        #updateStudentSection {
            margin-left: 3rem;
            margin-right: 3rem;
        }
        @media (min-width: 768px) {
            #updateStudentSection {
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

    <div id="updateStudentSection">
        <div id="updateSection">
            <h3 class="text-primary">Update Student</h3>
            <form id="updateForm">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sid" class="form-label">Student ID (SID)</label>
                        <input type="text" class="form-control" id="sid" placeholder="Enter Student ID to Update" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="Enter First Name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter Email" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="city" class="form-label">Nearest City</label>
                        <input type="text" class="form-control" id="city" placeholder="Enter City">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="course" class="form-label">Course</label>
                        <input type="text" class="form-control" id="course" placeholder="Enter Course">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="guardian" class="form-label">Guardian</label>
                        <input type="text" class="form-control" id="guardian" placeholder="Enter Guardian Name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="subjects" class="form-label">Subjects</label>
                        <textarea class="form-control" id="subjects" placeholder="Enter Subjects"></textarea>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="updateStudentButton">Update Student</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $("#updateStudentButton").click(function () {
                const studentData = {
                    sid: $("#sid").val(),
                    firstName: $("#firstName").val(),
                    lastName: $("#lastName").val(),
                    email: $("#email").val(),
                    city: $("#city").val(),
                    course: $("#course").val(),
                    guardian: $("#guardian").val(),
                    subjects: $("#subjects").val()
                };

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
                        alert("An error occurred: " );
                    }
                });
            });
        });
    </script><script src="script.js"></script>
</body>
</html>
