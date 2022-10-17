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

    #PHP CRUD FOR TREE SECTION
    if (isset($_FILES['treeimage'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $name = $conn->real_escape_string($_POST['treename']);
        $price = $conn->real_escape_string($_POST['treeprice']);
        $features = $conn->real_escape_string($_POST['treefeatures']);

        # tree image
        $file = $_FILES['treeimage'];
        $fileName = $_FILES['treeimage']['name'];
        $fileTmpName = $_FILES['treeimage']['tmp_name'];
        $fileSize = $_FILES['treeimage']['size'];
        $fileError = $_FILES['treeimage']['error'];
        $fileType = $_FILES['treeimage']['type'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allow = array('jpg', 'jpeg', 'png', 'pdf');

        if (!empty($email) && !empty($name) && !empty($price) && !empty($features) && !empty($file)) {
            # code...
            if(strlen($features) < 395){
                if(in_array($fileActualExt, $allow)) {
                    if($fileError === 0) {
                        if($fileSize <= 4000000) {
                            $fileNewName = $name.".".$fileActualExt;
                            $fileDestination = 'store/trees/'.$fileNewName;
                            $fileMove = '../store/trees/'.$fileNewName;

                            #INSERT INTO DATABASE
                            $sql = "INSERT INTO treestore (email, treeName, treePrice, treeImage, treeFeatures)
                            VALUES ('$email', '$name', '$price', '$fileDestination', '$features')";
                            if (mysqli_query($conn, $sql)) {
                                move_uploaded_file($fileTmpName, $fileMove);
                                exit('<font>Upload Successful!</font>');
                            }else {
                                exit('<font>Upload Failed!</font>');
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
                exit('<font>Feature text too Long!</font>');
            }
        }else {
            exit('<font>Empty Inputs!</font>');
        }
    }

    #PHP CRUD FOR WITHDRAW SECTION
    if (isset($_POST['amount'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $amount = $conn->real_escape_string($_POST['amount']);

        if (!empty($email) && !empty($amount)) {
            #INSERT INTO DATABASE
            $sql = "INSERT INTO withdraws (email, requestedAmt)
            VALUES ('$email', '$amount')";
            if (mysqli_query($conn, $sql)) {
                exit('<font>Request Sent Successfully!</font>');
            }else {
                exit('<font>Withdraw Request not sent!</font>');
            }
        }else {
            exit('<font>Empty Inputs!</font>');
        }
    }

    #PHP CRUD FOR PAYMETHOD SECTION BTC
    if (isset($_POST['btc'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $btc = $conn->real_escape_string($_POST['btc']);
        $walletadd = $conn->real_escape_string($_POST['walletadd']);
        $paymethod = $btc.'->'.$walletadd;

        if (!empty($email) && !empty($btc) && !empty($walletadd)) {
            #INSERT INTO DATABASE
            $sqlupdate = $conn->query("UPDATE user_info SET paymethod='$paymethod'  WHERE email='$email'");
            if ($sqlupdate) {
                exit('<font>Update Successful!</font>');
            }else {
                exit('<font>Update Failed!</font>');
            }
        }else {
            exit('<font>Empty Inputs!</font>');
        }
    }

    #PHP CRUD FOR PAYMETHOD SECTION ETH
    if (isset($_POST['eth'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $eth = $conn->real_escape_string($_POST['eth']);
        $walletadd = $conn->real_escape_string($_POST['walletadd']);
        $paymethod = $eth.'->'.$walletadd;

        if (!empty($email) && !empty($eth) && !empty($walletadd)) {
            #INSERT INTO DATABASE
            $sqlupdate = $conn->query("UPDATE user_info SET paymethod='$paymethod'  WHERE email='$email'");
            if ($sqlupdate) {
                exit('<font>Update Successful!</font>');
            }else {
                exit('<font>Update Failed!</font>');
            }
        }else {
            exit('<font>Empty Inputs!</font>');
        }
    }

    #PHP CRUD FOR PAYMETHOD SECTION BANK
    if (isset($_POST['bank'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $bank = $conn->real_escape_string($_POST['bank']);
        $bankname = $conn->real_escape_string($_POST['bankname']);
        $accname = $conn->real_escape_string($_POST['accname']);
        $accnumber = $conn->real_escape_string($_POST['accnumber']);
        $paymethod = $bank.'->'.$bankname.'->'.$accname.'->'.$accnumber;

        if (!empty($email) && !empty($bank) && !empty($bankname) && !empty($accname) && !empty($accnumber)) {
            #INSERT INTO DATABASE
            $sqlupdate = $conn->query("UPDATE user_info SET paymethod='$paymethod'  WHERE email='$email'");
            if ($sqlupdate) {
                exit('<font>Update Successful!</font>');
            }else {
                exit('<font>Update Failed!</font>');
            }
        }else {
            exit('<font>Empty Inputs!</font>');
        }
    }



?>