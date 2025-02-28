<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['key'], $_GET['value'])) {
    $data = file_get_contents('data.json'); 
    $students = json_decode($data, true);
    $key = $_GET['key'];
    $value = $_GET['value'];
    $results = [];

    foreach ($students as $student) {
        if (isset($student[$key]) && stripos($student[$key], $value) !== false) {
            $results[] = $student;
        }
    }

    echo json_encode($results);
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

    <div class="container mt-5">
        <h3 class="text-warning">Find Student</h3>
        <form id="searchForm">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="searchKey" class="form-label">Search By</label>
                    <select id="searchKey" class="form-select">
                        <option value="sid">SID</option>
                        <option value="firstName">First Name</option>
                        <option value="lastName">Last Name</option>
                        <option value="email">Email</option>
                        <option value="city">Nearest City</option>
                        <option value="course">Course</option>
                        <option value="guardian">Guardian</option>
                    </select>
                </div>
                <div class="col-md-6">
                <label for="searchValue" id="searchValueLabel" class="form-label">Search Value</label>
                <input type="text" class="form-control" id="searchValue" placeholder="Enter search value">
                </div>
            </div>
            <button type="button" class="btn btn-warning" id="searchButton">Search</button>
        </form>
    </div>

   
    <div class="container mt-4" id="results"></div>

    <script>
        $(document).ready(function () {
            $('#searchButton').click(function () {
                const key = $('#searchKey').val();
                const value = $('#searchValue').val();

                if (value.trim() === '') {
                    $('#results').html('<p class="text-danger">Please enter a value to search.</p>');
                    return;
                }

                $.get('find-student.php', { key, value }, function (data) {
                    const students = JSON.parse(data);
                    if (students.length > 0) {
                        let resultHTML = '<h5 class="text-success">Results:</h5><ul class="list-group">';
                        students.forEach(student => {
                            resultHTML += `<li class="list-group-item">
                                <strong>${student.sid}</strong> - ${student.firstName} ${student.lastName} 
                                (${student.email}, ${student.city}, ${student.course},${student.guardian})
                            </li>`;
                        });
                        resultHTML += '</ul>';
                        $('#results').html(resultHTML);
                    } else {
                        $('#results').html('<p class="text-danger">No students found.</p>');
                    }
                });
            });
        });
    </script>
    <script src="script.js"></script>
</body>
</html>
