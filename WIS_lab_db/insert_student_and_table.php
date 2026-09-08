<?php

$message = "";
$message_type = "";

$conn = new mysqli("localhost", "root", "");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $database_name = trim($_POST["database_name"] ?? "");
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $age = trim($_POST["age"] ?? "");
    $course = trim($_POST["course"] ?? "");

    // Validation
    if (
        empty($database_name) ||
        empty($name) ||
        empty($email) ||
        empty($age) ||
        empty($course)
    ) {
        $message = "Please fill in all fields.";
        $message_type = "danger";
    }

    elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $database_name)) {
        $message = "Invalid database name.";
        $message_type = "danger";
    }

    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email.";
        $message_type = "danger";
    }

    elseif (!is_numeric($age) || $age < 1 || $age > 100) {
        $message = "Age must be between 1 and 100.";
        $message_type = "danger";
    }

    else {

        // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS `$database_name`";

        if ($conn->query($sql)) {

            // Select database
            $conn->select_db($database_name);

            // Create table
            $sql = "CREATE TABLE IF NOT EXISTS students (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(150) NOT NULL,
                age INT NOT NULL,
                course VARCHAR(100) NOT NULL
            )";

            if ($conn->query($sql)) {

                // Insert student using prepared statement
                $stmt = $conn->prepare(
                    "INSERT INTO students (name, email, age, course)
                     VALUES (?, ?, ?, ?)"
                );

                $stmt->bind_param("ssis", $name, $email, $age, $course);

                if ($stmt->execute()) {
                    $message = "Student record inserted successfully!";
                    $message_type = "success";
                } else {
                    $message = "Insert failed: " . $stmt->error;
                    $message_type = "danger";
                }

                $stmt->close();

            } else {
                $message = "Table creation failed: " . $conn->error;
                $message_type = "danger";
            }

        } else {
            $message = "Database creation failed: " . $conn->error;
            $message_type = "danger";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Student Registration</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <h3 class="text-center mb-0">
                        Student Registration
                    </h3>

                </div>

                <div class="card-body">

                    <?php if (!empty($message)): ?>

                        <div class="alert alert-<?php echo $message_type; ?>">
                            <?php echo htmlspecialchars($message); ?>
                        </div>

                    <?php endif; ?>


                    <form method="POST" action="">

                        <!-- Database Name -->

                        <div class="mb-3">

                            <label class="form-label">
                                Database Name
                            </label>

                            <input
                                type="text"
                                name="database_name"
                                class="form-control"
                                placeholder="e.g. school_db"
                                required
                            >

                        </div>


                        <!-- Student Name -->

                        <div class="mb-3">

                            <label class="form-label">
                                Student Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Enter student name"
                                required
                            >

                        </div>


                        <!-- Email -->

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="student@example.com"
                                required
                            >

                        </div>


                        <!-- Age -->

                        <div class="mb-3">

                            <label class="form-label">
                                Age
                            </label>

                            <input
                                type="number"
                                name="age"
                                class="form-control"
                                min="1"
                                max="100"
                                placeholder="Enter age"
                                required
                            >

                        </div>


                        <!-- Course -->

                        <div class="mb-3">

                            <label class="form-label">
                                Course
                            </label>

                            <select
                                name="course"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Select Course
                                </option>

                                <option value="PHP">
                                    PHP
                                </option>

                                <option value="Python">
                                    Python
                                </option>

                                <option value="JavaScript">
                                    JavaScript
                                </option>

                                <option value="Database">
                                    Database
                                </option>

                            </select>

                        </div>


                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Create Database & Add Student
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>




