<!DOCTYPE html>
<html>

<head>
    <title>Student Profile</title>
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
        }

        h1, table {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <center>
        <h1>Edit Pet Record</h1>

        <form action="controller.php" method="POST" enctype="multipart/form-data">
        <table>
            <?php
                getRecord($_GET['id']);  
            ?> 
        </table>
        <button type="submit" name="update_record">Update Record</button>
        </form>
    </center>
</body>

</html>

<?php
    function getRecord($recno){
        include("includes/sqlconnection.php");
        $sql = "SELECT * FROM petinfo WHERE id='$recno'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo"
                <tr>
                    <input type='hidden' name='txtid' value='".$row['id']."'>
                    <th>Pet Name</th>
                    <td><input type='text' name='txtname' value='".$row['petname']."'></td>
                    <td rowspan='4'><img src='uploads/$row[pic]' width='100' height='75' alt='$row[pic]'></td>
                </tr>
                <tr>
                    <th>Owner Contact Number</th>
                    <td><input type='text' name='txtcontact' value='".$row['contact']."'></td>
                </tr>
                <tr>
                    <th>Pet Status</th>
                    <td><input type='text' name='txtstatus' value='".$row['petstatus']."'></td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td><input type='file' name='txtpic'></td>
                    <input type='hidden' name='txtpic_old' value='".$row['pic']."'>
                </tr>";
            }
        }
        else{
            echo "no record found";
        }
        $conn->close();
    }
?>