<?php
    include '../include/conn.php';

    #GET PROFILE IMAGE AS SOON AS PROFILE IMAGE IS UPDATED
    if (isset($_POST['profile'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $sql1 = $conn->query("SELECT * FROM users WHERE email= '$email'");
        $data1 = $sql1->fetch_array();
        $profileImg = $data1['profileImg'];
        exit($profileImg);
    }
    
    #GET ALL UPLOADED IMAGES AS SOON AS AN IMAGE IS UPLOADED
    if (isset($_POST['uploads'])) {
        $email = $conn->real_escape_string($_POST['email']);
        #SELECT UPLOADS OF CURRENT USER AND DISPLAY
        $sql3 = $conn->query("SELECT image from uploads WHERE email='$email'");
        if($sql3->num_rows > 0){
            $response = "";
            while ($data3 = $sql3->fetch_array()) {
                $response .= "
                    <div class='prod'>
                        <img src='". $data3['image']. "' >
                        <a target='_blank' href='". $data3['image']. "' class='click'>
                            <i >view</i>
                        </a>
                    </div>
                ";
            }
            exit($response);
        } else {
            $no = "";
            $no .= "
                <p>No Uploads Yet!</p>
            ";
            exit($no);
        }
    }

    #PHP CRUD FOR PROFILE SECTION
    if (isset($_FILES['file'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);
        $country = $conn->real_escape_string($_POST['country']);
        $phone = $conn->real_escape_string($_POST['phone']);
        # ENCRYPT PASSWORD
        $encrypt_password = md5($password);

        # profile image
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allow = array('jpg', 'jpeg', 'png', 'pdf');

        if (!empty($email) && !empty($phone) && !empty($password) && !empty($country) && !empty($file)) {
            # code...
            if(in_array($fileActualExt, $allow)) {
                if($fileError === 0) {
                    if($fileSize <= 4000000) {
                        $fileNewName = $email.time().".".$fileActualExt;
                        $fileDestination = 'profileImg/'.$fileNewName;
                        $fileMove = '../profileImg/'.$fileNewName;

                        //update users profile
                        $sqlupdate = $conn->query("UPDATE users SET password='$encrypt_password', phone='$phone', country='$country', profileImg='$fileDestination' WHERE email='$email'");
                        if ($sqlupdate) {
                            move_uploaded_file($fileTmpName, $fileMove);
                            exit('<font>Update Successful!</font>');
                        }else {
                            exit('<font>Update Failed!</font>');
                        }
                    }else {
                        exit('<font>Image File is too Large!</font>');
                    }
                }else {
                    exit('<font>Image Error, try Image Upload Again!</font>');
                }
            }else {
                exit('<font>Image Type not Accepted!</font>');
            }
        }else {
            exit('<font>Empty Inputs!</font>');
        }
    }

    #PHP CRUD FOR UPLOAD SECTION
    if (isset($_FILES['picture'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $text = $conn->real_escape_string($_POST['posttext']);

        # upload image
        $file = $_FILES['picture'];
        $fileName = $_FILES['picture']['name'];
        $fileTmpName = $_FILES['picture']['tmp_name'];
        $fileSize = $_FILES['picture']['size'];
        $fileError = $_FILES['picture']['error'];
        $fileType = $_FILES['picture']['type'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allow = array('jpg', 'jpeg', 'png', 'pdf');
        if (!empty($email) && !empty($text) && !empty($file)) {
            # code...
            if(strlen($text) < 250){
                if(in_array($fileActualExt, $allow)) {
                    if($fileError === 0) {
                        if($fileSize <= 4000000) {
                            //getting Number of uploads from database
                            $getCount = $conn->query("SELECT * from uploads WHERE email= '$email'");
                            $count = $getCount-> num_rows;
                            $uploadCount = $count + 1;
                            $fileNewName = $email.$uploadCount.".".$fileActualExt;
                            $fileDestination = 'uploadsImg/'.$fileNewName;
                            $fileMove = '../uploadsImg/'.$fileNewName;
    
                            #INSERT INTO DATABASE
                            $sql = "INSERT INTO uploads (email, image, imageText)
                            VALUES ('$email', '$fileDestination', '$text')";
                            if (mysqli_query($conn, $sql)) {
                                move_uploaded_file($fileTmpName, $fileMove);
                                exit('<font>Update Successful!</font>');
                            }else {
                                exit('<font>Update Failed!</font>');
                            }
                        }else {
                            exit('<font>Image File is too Large!</font>');
                        }
                    }else {
                        exit('<font>Image Error, try Image Upload Again!</font>');
                    }
                }else {
                    exit('<font>Image Type not Accepted!</font>');
                }
            }else {
                exit('<font>Your Text too Long!</font>');
            }
        }else {
            exit('<font>Empty Inputs!</font>');
        }
    }



?>