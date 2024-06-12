<?php

@include 'config.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "SELECT * FROM events WHERE id = $id";

    $result = mysqli_query($conn, $query);

    if (!$result){
        die("query failed". mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);

    if (isset($_POST["update_evt"])) {

        echo "test";
        echo "<script>alert('ZESTY');</script>";

        // === SELECTION ===
        $sql = "SELECT * FROM events ORDER BY id DESC";
        $name = $row["name"];
        $desc = $row["description"];
        $date = $row["date"];

        // ============= IMAGE DATA ==================
        $evt_img_name = $_FILES['evt_img']['name'];
        $evt_img_size = $_FILES['evt_img']['size'];
        $tmpName = $_FILES['evt_img']['tmp_name'];

        $evt_img_valid_extension = ['jpg','jpeg', 'png'];
        $evt_img_extension= explode('.', $evt_img_name);
        $evt_img_extension = strtolower(end($evt_img_extension));

        // ================= IMAGE VALIDATION ====================
        if (!in_array($evt_img_extension, $evt_img_valid_extension)) {
            echo "<script>alert('Invalid file upload.');</script>";
        }
        else if ($evt_img_size > 10000000) {
            echo "<script>alert('File size is too big');</script>";
        }
        else{
            $newImgName = uniqid();
            $newImgName .= ".". $evt_img_extension;

            move_uploaded_file($tmpName, 'uploads/' . $newImgName);
        }

        // ================= UPDATING ====================

        $query = "UPDATE 'events' 
        SET 
        'name' = '$name', 
        'description' = '$desc', 
        'date' = '$date', 
        'event_image' = '$newImgName'
        WHERE 'id' = '$id';   
        ";

        $result = mysqli_query($conn, $query);

        if (!$result){
            die("query failed". mysqli_error($conn));
        }

        else{
            header('location:admin_addevent.php?update_msg=Event updated!');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <title>Lycee</title>
        <!--============== META ===============-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--============== CSS ===============-->
        <link rel="stylesheet" href="event_styles.css">

        <!--============== REMIX ICON ===============-->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"rel="stylesheet"/>
        
        <!--============== FONT ===============-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Changa+One:ital@0;1&display=swap" rel="stylesheet">
    </head>
<body>
    <!--================================== EVENT FORM ============================================-->
    <div class="event-container">
        <form action="admin_editevent.php?id_new=<?php echo $id?>?>" method="post" autocomplete="off" enctype="multipart/form-data">

            <!--== HEADER ==-->
            <div class="head">
                <h1>Update eventname</h1>
            </div>

            <!--== EVENT NAME ==-->
            <input type="text" id="evt_name" name="evt_name" placeholder="event name" value="<?php echo $row['name']?>">
            <br>

            <!--== EVENT DESC ==-->
            <textarea id="evt_desc" name="evt_desc" rows="4" cols="50"><?php echo $row['description']?></textarea>
            <br>
            
            <!--== EVENT DATE ==-->
            <label for="evt_date">Date of the event</label><br>
            <input type="date" id="evt_date" name="evt_date" value="<?php echo $row['date']?>">
            <br>

            <!--== EVENT IMG ==-->
            <label for="evt_img">Upload event banner</label>
            <input type="file" accept=".jpg, .jpeg, .png" id="evt_img" name="evt_img"> 
            <br>

            <!--== EVENT SUBMIT ==-->
            <button class="form-btn" type="submit" name="update_evt" value="update_evt">Update event</button>
        </form>
    </div>
</body>
</html>