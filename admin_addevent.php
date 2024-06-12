<?php

@include 'config.php';

if (isset($_POST['upload_evt'])) {

    // ============= EVENT DATA ==================
    $evt_name = $_POST['evt_name'];
    $evt_desc = $_POST['evt_desc'];
    $evt_date = $_POST['evt_date'];

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

    // ============= CREATING ==================
    if(empty($evt_name) || empty($evt_desc) || empty($evt_date)){
        echo "<script>alert('Please fill out the inputs');</script>";

    } else{ // ============= INSERTION ==================
        $insert = "INSERT INTO events(name,description,date,event_image)
        VALUES('$evt_name','$evt_desc','$evt_date','$newImgName')";

        $upload = mysqli_query($conn, $insert);

        if($upload){
            echo "<script>alert('Event added!');</script>";
        }
        else{
            echo "<script>alert('Could not add that event');</script>";
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

    <!--================================== CREATING EVENT FORM ============================================-->
    <div class="event-container">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" autocomplete="off" enctype="multipart/form-data">

            <!--== HEADER ==-->
            <div class="head">
                <h1>Upload an event</h1>
            </div>

            <!--== EVENT NAME ==-->
            <input type="text" id="evt_name" name="evt_name" placeholder="event name">
            <br>

            <!--== EVENT DESC ==-->
            <textarea id="evt_desc" name="evt_desc" placeholder="event description" rows="4" cols="50"></textarea>
            <br>
            
            <!--== EVENT DATE ==-->
            <label for="evt_date">Date of the event</label><br>
            <input type="date" id="evt_date" name="evt_date">
            <br>

            <!--== EVENT IMG ==-->
            <label for="evt_img">Upload event banner</label>
            <input type="file" accept=".jpg, .jpeg, .png" id="evt_img" name="evt_img">
            <br>

            <!--== EVENT SUBMIT ==-->
            <button class="form-btn" type="submit" name="upload_evt" value="add evt">Upload event</button>
        </form>
    </div>
    <div class="head">
        <h1>Upcoming events</h1>
    </div>
    
    <!---======== READING ==========-->
    <?php 

        // === SELECTION ===
        $sql = "SELECT * FROM events ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        
        // === LOOP START ===
        while($row = mysqli_fetch_assoc($result)){
            $name = $row["name"];
            $desc = $row["description"];
            $date = $row["date"];
        ?>
        
        <div class="card-main">
                <!--== EVENT CARD ==-->
            <div class="card-container">
                <div class="eimg">
                        <img src="uploads/<?php echo $row["event_image"]?>">
                </div>
                <div class="card-info">
                    <div class="left">  
                        <p class="evt_title"><?php echo $name; ?></p>
                        <p><?php echo $desc; ?></p>
                        <p><?php echo $date; ?></p>
                    </div>
                       
                <div class="card-option">   
                <a href="admin_editevent.php?id=<?php echo $row['id'];?>"> 
                <button class="form-btn" type="submit" name="edit_event" value="edit_event">Edit</button></a>
                <button class="form-btn" type="submit" name="delete_event" value="delete_event">Delete</button>
                </div>
                </div>
                
            </div>
            <!--== LOOP END ==-->
            <?php } ?>
        </div>
</body>
</html>