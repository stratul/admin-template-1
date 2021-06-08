<?php 

    include "inc/header.php";
    include "inc/menu.php";

?>

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb bg-white">
    <div class="row align-items-center">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">User Information</h4>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">

    <?php
    
        // if(isset($_GET['do'])){
        //     $do = $_GET['do'];
        // } else {
        //     $do = 'manage';
        // }

        $do = isset($_GET['do']) ? $_GET['do'] : 'manage';

        // Manage all user

        if($do == 'manage'){
            ?>

                <div class="row justify-content-center">
                    <div class="col-lg-12 col-md-12">
                        <div class="white-box">
                            <h3 class="box-title">All Users List</h3>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Serial</th>
                                            <th class="border-top-0">Thumbnail</th>
                                            <th class="border-top-0">User Name</th>
                                            <th class="border-top-0">Full Name</th>
                                            <th class="border-top-0">Gender</th>
                                            <th class="border-top-0">Email</th>
                                            <!-- <th class="border-top-0">Password</th> -->
                                            <th class="border-top-0">Date of Birth</th>
                                            <th class="border-top-0">Address</th>
                                            <th class="border-top-0">Phone</th>
                                            <!-- <th class="border-top-0">Biodata</th> -->
                                            <!-- <th class="border-top-0">Education</th> -->
                                            <th class="border-top-0">Role</th>
                                            <th class="border-top-0">Status</th>
                                            <th class="border-top-0">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                            $sql = "SELECT * FROM users";
                                            $result = mysqli_query($db, $sql);
                                            $count = 0;

                                            while($row = mysqli_fetch_assoc($result)){
                                                $u_id           = $row['u_id'];
                                                $u_image        = $row['u_image'];
                                                $u_username     = $row['u_username'];
                                                $u_fullname     = $row['u_fullname'];
                                                $u_dateofbirth  = $row['u_dateofbirth'];
                                                $u_email        = $row['u_email'];
                                                $u_password     = $row['u_password'];
                                                $u_gender       = $row['u_gender'];
                                                $u_address      = $row['u_address'];
                                                $u_phone        = $row['u_phone'];
                                                $u_bio          = $row['u_bio'];
                                                $u_edu          = $row['u_edu'];
                                                $u_role         = $row['u_role'];
                                                $u_status       = $row['u_status'];
                                                $count++;


                                            ?>

                                            <tr>
                                                <td><?php echo $count;?></td>
                                                <td><img src="image/users/<?php echo $u_image;?>" alt="" width="100"></td>
                                                <td><?php echo $u_username;?></td>
                                                <td><?php echo $u_fullname;?></td>                                            
                                                <td><?php echo $u_gender;?></td>
                                                <td><?php echo $u_email;?></td>
                                                <td><?php echo $u_dateofbirth;?></td>
                                                <td><?php echo $u_address;?></td>
                                                <td><?php echo $u_phone;?></td>
                                                <td>
                                                    <?php
                                                        if($u_role == 0){
                                                            echo '<span class="badge bg-success">Subscriber</span>';
                                                        }
                                                        if($u_role == 1){
                                                            echo '<span class="badge bg-warning">Editor</span>';}
                                                        if($u_role == 2){
                                                            echo '<span class="badge bg-danger">Admin</span>';
                                                        }                                                 
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($u_status == 0){
                                                            echo '<span class="badge bg-danger">Inactive</span>';
                                                        }else{
                                                            echo '<span class="badge bg-success">Active</span>';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href=""><i class="fas fa-eye text-success" data-bs-toggle="tooltip" data-bs-placement="top" title="View User"></i></a>
                                                    <a href=""><i class="fas fa-edit text-warning ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit User"></i></a>
                                                    <a href=""><i class="fas fa-trash-alt text-danger ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete User"></i></a>                                                
                                                </td>
                                            </tr>
                                            <td></td>

                                            <?php
                                            }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
        }

        // Add new user

        if($do == 'add'){
            ?>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add New User</h4>
                        <form method="POST" class="">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlFile1" class="form-label">Add Profile Picture</label>
                                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="user_photo"><br>
                                        <small id="fileHelp" class="form-text text-muted">Select photo only. Don't upload a photo more than 1mb file size. Also try to upload jpg, jpeg, png format.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputUsername" class="form-label">User Name</label>
                                        <input type="text" class="form-control" id="exampleInputUsername" name="user_username">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputFullName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="exampleInputFullName" name="user_fullname">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail"  name="user_email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword" name="user_password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gender">Select Your Gender</label>
                                        <select class="form-select" id="gender" aria-label="Default select example" name="user_gender">
                                            <option selected></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-date-input" class="form-label">Date of Birth</label>
                                        <input class="form-control" type="date" value="0000-00-00" id="example-date-input" name="user_dateofbirth">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputAddress" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="exampleInputAddress" name="user_address">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputNumber" class="form-label">Phone Number</label>
                                        <input type="number" class="form-control" id="exampleInputNumber" name="user_phone">
                                    </div>
                                    <div class="mb-3">
                                        <label for="role">Select User Role</label>
                                        <select class="form-select" id="role" aria-label="Default select example" name="user_role">
                                            <option selected></option>
                                            <option value="0">Subscriber</option>
                                            <option value="1">Editor</option>
                                            <option value="2">Admin</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status">Select User Role</label>
                                        <select class="form-select" id="status" aria-label="Default select example" name="user_status">
                                            <option selected></option>
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputBiodata" class="form-label">Biodata</label>
                                        <textarea rows="3" type="textarea" class="form-control" id="exampleInputBiodata" name="user_biodata"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEducation" class="form-label">Education</label>
                                        <textarea rows="4" type="textarea" class="form-control" id="exampleInputEducation" name="user_education"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="user_submit">Submit</button>
                                </div>
                            
                            </div>
                        </form>

                        <?php
                        
                            if(isset($_POST['user_submit'])){

                                // $user_photo = $_POST['user_photo'];
                                $user_username = $_POST['user_username'];
                                $user_fullname = $_POST['user_fullname'];
                                $user_email = $_POST['user_email'];
                                $user_password = $_POST['user_password'];
                                $user_gender = $_POST['user_gender'];
                                $user_dateofbirth = $_POST['user_dateofbirth'];
                                $user_address = $_POST['user_address'];
                                $user_phone = $_POST['user_phone'];
                                $user_role = $_POST['user_role'];
                                $user_status = $_POST['user_status'];
                                $user_biodata = $_POST['user_biodata'];
                                $user_education = $_POST['user_education'];

                                if(!empty($user_username) && !empty($user_fullname) && !empty($user_email) && !empty($user_password)){

                                    $encrypted_pass = sha1($user_password);

                                    $sql_add = "INSERT INTO users(u_image, u_username, u_fullname, u_dateofbirth, u_email, u_password, u_gender, u_address, u_phone, u_bio, u_edu, u_role, u_status) VALUES ('', '$user_username', '$user_fullname', '$user_dateofbirth', '$user_email', '$encrypted_pass', '$user_gender', '$user_address', '$user_phone', '$user_biodata', '$user_education', '$user_role', '$user_status' )";

                                    $result_add = mysqli_query($db, $sql_add);

                                    if($result_add){
                                        header('location: users.php');
                                    } else {
                                        echo "User Insertion Failed!";
                                    }

                                } else {

                                    echo '<span class="alert alert-danger" role="alert">Please Fill Up All the Required Information</span>';

                                }                                
                            }

                        ?>
                    </div>
                </div>

        <?php
        }

        // Edit user

        if($do == 'edit'){
            
        }

        // update user

        if($do == 'update'){
            
        }

        // Delete user

        if($do == 'delete'){
            
        }

    
    ?>
    
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

<?php 

    include "inc/footer.php";

?>