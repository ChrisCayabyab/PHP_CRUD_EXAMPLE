<!DOCTYPE html>

<?php session_start(); ?>

<html>

<head>
    <title>Pet Records</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <style>
        body {
            background-image: url(./images/bg.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: #333;
        }

        h1 {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            display: inline-block;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            display: inline-block;
            margin-top: 20px;
            width: 80%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            width: 100px;
            height: 75px;
        }

        button[type="submit"] {
            background-color: #5cb85c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #4cae4c;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
    </style>

</head>

<body>
    <div class="container">
        <h1>Pet Records</h1>
        <?php
        if (isset($_SESSION['status']) && $_SESSION != '') {
            echo $_SESSION['status'];
            echo "<br><br>";
            unset($_SESSION['status']);
        }
        ?>

        <div class="table-container">
            <table>
                <tr>
                    <th>Pet ID</th>
                    <th>Pet Name</th>
                    <th>Owner Contact No</th>
                    <th>Pet Status</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
                <?php viewAll(); ?>
            </table>
        </div>

        <form action="insert.php" method="POST">
            <button type="submit" name="add_record">Add New Record</button>
        </form>
    </div>
</body>

</html>

<?php
function viewAll()
{
    include("includes/sqlconnection.php");
    $sql = "SELECT * FROM petinfo ORDER BY id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['petname']}</td>
                    <td>{$row['contact']}</td>
                    <td>{$row['petstatus']}</td>
                    <td><img src='uploads/{$row['pic']}' alt='{$row['pic']}'></td>
                    <td>
                        <a href='edit.php?id={$row['id']}'>Edit</a> |
                        <a href='controller.php?id={$row['id']}&pic={$row['pic']}'>Delete</a>
                    </td>
                </tr>
            ";
        }
    } else {
        echo "
            <tr>
                <td colspan='6' style='text-align: center;'>No records found</td>
            </tr>
        ";
    }

    $conn->close();
}
?>
