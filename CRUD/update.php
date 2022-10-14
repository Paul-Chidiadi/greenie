<?php
    include '../include/conn.php';

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
                        $fileNewName = uniqid('IMG-', true).".".$fileActualExt;
                        $fileDestination = 'profileImg/'.$fileNewName;
                        $fileMove = '../profileImg/'.$fileNewName;

                        //update number of refers
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

    #PHP CRUD FOR PROFILE SECTION
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
                            $fileNewName = uniqid('IMG-', true).".".$fileActualExt;
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