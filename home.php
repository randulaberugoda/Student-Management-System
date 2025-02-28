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
        .center-img {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .welcome-card {
            background-color: #FFFFFF;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 20px;
        }
        .nav-link {
            font-weight: bold;
            transition: all 0.3s ease-in-out;
        }
        .nav-link:hover {
            background-color: #007BFF;
            color: #FFFFFF;
            border-radius: 5px;
        }
        .get-started-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .get-started-btn:hover {
            background-color: #0056b3;
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
        <hr>

        <div class="welcome-card text-center">
            <img src="img/gd.png" alt="Image" class="center-img">
            
            <a href="home.php" class="get-started-btn">Get Started</a>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            
            const currentPage = window.location.pathname.split("/").pop();
            $(".nav-link").each(function() {
                if ($(this).attr("href") === currentPage) {
                    $(this).addClass("active").attr("aria-current", "page");
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
