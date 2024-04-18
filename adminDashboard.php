<?php
// Database Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_pass = '';
$db_name = 'HRMS';

// Database connection
$db = new mysqli($db_host, $db_username, $db_pass, $db_name);

// Check Database Connection
if ($db->connect_error) {
    die("Connection failed" . $db->connect_error);
}

if (isset($_POST["task"]) && !empty($_POST["task"])) {
    $task = $_POST["task"];

    // Prepare and bind the INSERT statement
    $stmt = $db->prepare("INSERT INTO todolist (task) VALUES (?)");
    $stmt->bind_param('s', $task);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Task Added Successfully');</script>";
    } else {
        echo "<script>alert('Insertion failed: " . $db->error . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human Resource Management System</title>
    <link href="adminDashboard.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="Logo">
            <div id="logo"></div>
            <h3 id="logoName">Innovate Nepal</h3>
        </div>

        <nav>
            <a href="adminDashboard.php" id="home">Home</a>
        </nav>

        <div class="userlogo">
            <p>Bijay Gurung</p>
            <div class="image"></div>
        </div>

        <p class="role">Admin</p>
    </header>

    <section>
        <div class="sideNavbar">
            <button id="dashboard" onclick="dashboard()">Dashboard</button>
            <button id="employeeDataManagement" onclick="edm()">Employee Data Management</button>
            <button id="payroll">Payroll Management</button>
            <button id="Benefits">Benefits Management</button>
            <button id="performanceEvaluation">performance Evaluation</button>
            <button id="logout">Logout</button>

            <script>
                function dashboard(){
                    location = 'adminDashboard.php';
                }

                function edm(){
                    location = 'adminEmployeeDataManagement.php';
                }
            </script>
        </div>    

        <div class="content1">
            <div class="totalEmployees">
                <i class="fa-solid fa-users" style="color: #fff;"></i>
                <h3>Total Employees</h3>
            </div>
            <p id="employees">400</p>

            <div class="girls">
                <p>Female</p>
                <p>150</p>
            </div>

            <div class="boys">
                <p>Male</p>
                <p>250</p>
            </div>
        </div>

        <div class="content2">
            <div class="newEmployee">
                <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                <h3>New Employee</h3>
            </div>
            <p id="newEmployee">30</p>
        </div>

        <div class="content3">
            <div class="GNP">
                <i class="fa-solid fa-arrow-up" style="color: #ffffff;"></i>
                <h3>Gross Net Profit</h3>
            </div>
            <p id="grossNetProfit">100000</p>
        </div>

        <div class="content4">
            <div class="present">
                <h3>Present</h3>
                <p>250</p>
            </div>

            <div class="late">
                <h3>Late</h3>
                <p>100</p>
            </div>

            <div class="absent">
                <h3>Absent</h3>
                <p>50</p>
            </div>

            <div class="EAC">
                <i class="fa-solid fa-calendar-days" style="color: #ffffff;"></i>
                <h3>Employee Attendance Checker</h3>
            </div>
        </div>

        <div class="content6">
            <h3>To DO List</h3>
            <form method="post" action="adminDashboard.php">
                <input type="text" id="task" name="task" placeholder="Add Task">
                <button type="submit">Add</button>
                </form>
            </div>

            <?php
            // Retrieve tasks from database
            $sql = "SELECT * FROM `todolist`";
            $result = $db->query($sql);
            echo "<div class='output'>";
            if ($result->num_rows > 0) {
                echo "<ul>";
                $index = 0; // $index is used to give unique identifier
                while ($row = $result->fetch_assoc()) {
                    $index++;
                    echo "<div class='new'>";
                    echo "<input type='checkbox' id='check$index' onclick='completeTask($index)'>";
                    echo "<li id='tasklist$index'>" . $row["task"] . "</li>";
                    echo "<button type='submit' id='delete'><i class='fa-solid fa-trash' style='color: #000000;'></i></button>";
                    echo "<br>";
                    echo "</div>";
                }
                echo "</ul>";
                echo "";
            }
        echo "</div>";
        ?>
        </div>
        
    </section>

    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/4f9d824da5.js" crossorigin="anonymous"></script>
</body>
</html>