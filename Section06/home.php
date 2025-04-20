<html>

<head>
</head>

<body>
    <h2>Save Your Data</h2>
    <form action="home.php" method="post">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address">
        <input type="submit" value="Save" name="Save">
        <input type="submit" value="Edit" name="Edit">
        <input type="submit" value="Delete" name="Delete">
        <input type="submit" value="Display" name="Display">
    </form>
</body>

</html>



<?php
if (isset($_POST['Save'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    require_once 'connection.php';
    $result = mysqli_query($link, "INSERT INTO  users (`id`,`name`, `address`) 
VALUES ('$id','$name','$address')");
    header('Location:home.php');
    echo "<h3> Data saved Successfuly </h3>";
    mysqli_close($link);
}
if (isset($_POST['Edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    require_once 'connection.php';
    $sql1 = ("update users set name= '$name' WHERE id like '$id'");
    $result = mysqli_query($link, $sql1);
    $sql2 = ("update users set address= '$address' WHERE id like '$id'");
    $result = mysqli_query($link, $sql2);
    header('Location:home.php');
    mysqli_close($link);
}
if (isset($_POST['Delete'])) {
    $id = $_POST['id'];
    require_once 'connection.php';
    $result = mysqli_query($link, "DELETE FROM  users where id =$id");
    header('Location:home.php');
    mysqli_close($link);
}

if (isset($_POST['Display'])) {
    require_once 'connection.php';
    $sql = ("SELECT * FROM users");
    $result = mysqli_query($link, $sql);
    $count = mysqli_num_rows($result);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    if ($count == 0) {
        echo "<No result matches </h3>";
    } else {
        echo "<table border=1>
                            <tr>
                                 <th >ID</th>
                                 <th >Name</th>
                                  <th >Address</th>                                                       
                            </tr>";
        for ($i = 0; $i < $count; $i++) {
            $id = $data[$i]["id"];
            $name = $data[$i]["name"];
            $address = $data[$i]["address"];
            echo "<tr>";
            echo "<td>" . $id . "</td>";
            echo "<td>" . $name . "</td>";
            echo "<td>" . $address . "</td>";
        }
        echo "</table>";
    }
}
?>