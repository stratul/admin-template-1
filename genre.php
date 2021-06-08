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
            <h4 class="page-title">Genre</h4>
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
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-12">
            <div class="white-box">
                <h2 class="box-title mb-4">Add New Genre</h2>
                <ul class="list-inline mb-0">
                    <form method="POST">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Genre Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="gen_name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Genre Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="gen_desc"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="gen_add">Add Genre</button>
                    </form>
                </ul>
            </div>

                <?php
                            
                    if(isset($_GET['edit_id'])){
                        $edit_id = $_GET['edit_id'];

                        $sql4 = "SELECT * FROM genre WHERE gen_id = '$edit_id'";
                        $result4 = mysqli_query($db, $sql4);

                        while($row = mysqli_fetch_assoc($result4)){
                            $gen_name = $row['gen_name'];
                            $gen_desc = $row['gen_desc'];
                            $gen_status = $row['gen_status'];
                ?>

                    <div class="white-box">
                    <h2 class="box-title mb-4">Edit Genre</h2>
                        <ul class="list-inline mb-0">
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Genre Name</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="edit_gen_name" value="<?php echo $gen_name;?>">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Genre Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="edit_gen_desc"><?php echo $gen_desc;?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Genre Status</label>
                                    <select class="form-select" aria-label="Default select example" name="edit_gen_status">
                                        <option value="0" <?php if($gen_status == 0){echo 'Selected';};?>>Inactive</option>
                                        <option value="1" <?php if($gen_status == 1){echo 'Selected';};?>>Active</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary" name="gen_edit">Edit</button>
                            </form>
                        </ul>
                    </div>
                
                <?php
                    
                        }

                    }                               

                ?>

                <?php
                
                    if(isset($_POST['gen_edit'])){
                        $gen_name = $_POST['edit_gen_name'];
                        $gen_desc = $_POST['edit_gen_desc'];
                        $gen_status = $_POST['edit_gen_status'];

                        $sql5 = "UPDATE genre SET gen_name = '$gen_name', gen_desc = '$gen_desc', gen_status = '$gen_status' WHERE gen_id = '$edit_id'";
                        $result5 = mysqli_query($db, $sql5);

                        if($result5){
                            header('location: genre.php');
                        } else{
                            echo 'Failed!';
                        }
                    }

                ?>
                
            
        </div>
        
        <?php
        
            if(isset($_POST['gen_add'])){
                $gen_name = $_POST['gen_name'];
                $gen_desc = $_POST['gen_desc'];

                $sql ="INSERT INTO genre (gen_name, gen_desc, gen_status) VALUES ('$gen_name','$gen_desc', 0)";
                $result = mysqli_query($db,$sql);

                if($result){
                    header('location: genre.php');
                }else{
                    die('Genre Add Failed!'.error($db));
                }
            }
        
        ?>

        <div class="col-lg-8 col-md-12">
            <div class="white-box">
                <h3 class="box-title">Genre List</h3>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">Serial</th>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Description</th>
                                <th class="border-top-0">Status</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $sql2 = "SELECT * FROM genre";
                                $result2 = mysqli_query($db, $sql2);
                                $counter = 0;

                                while($row = mysqli_fetch_assoc($result2)){
                                    $gen_id = $row['gen_id'];
                                    $gen_name = $row['gen_name'];
                                    $gen_desc = $row['gen_desc'];
                                    $gen_status = $row['gen_status'];
                                    $counter++;
                            ?>                            

                                <tr>
                                    <td><?php echo $counter;?></td>
                                    <td><?php echo $gen_name;?></td>
                                    <td><?php echo $gen_desc;?></td>
                                    <td>
                                        <?php 
                                            if($gen_status == 0){
                                                echo '<span class="badge bg-danger">Inactive</span>';
                                            }else{
                                                echo '<span class="badge bg-success">Active</span>';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="genre.php?edit_id=<?php echo $gen_id;?>"><i class="fas fa-edit text-warning"></i></a>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#delete<?php echo $gen_id;?>"><i class="fas fa-trash-alt text-danger ms-3"></i></a>
                                    </td>
                                </tr>
                                <!-- Modal for Delete  -->
                                <div id="delete<?php echo $gen_id;?>" class="modal fade" tabindex="-1" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body modal-filled bg-warning">
                                                <div class="text-center">
                                                    <h4 class="modal-title text-white mb-5" id="warning-header-modalLabel">Are You Sure Want to Delete?</h4>
                                                    <a type="button" class="btn btn-success" data-bs-dismiss="modal">Close</a>
                                                    <a href="genre.php?delete_id=<?php echo $gen_id;?>" type="button" class="btn btn-danger text-light ms-3">Confirm</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                                
                                }

                            ?>

                            <?php
                            
                                if(isset($_GET['delete_id'])){
                                    $delete_id = $_GET['delete_id'];

                                    $sql3 = "DELETE FROM genre WHERE gen_id = '$delete_id'";
                                    $result3 = mysqli_query($db, $sql3);

                                    if($result3){
                                        header('location: genre.php');
                                    } else{
                                        echo "Delete Failed!";
                                    }

                                }                               

                            ?>

                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    

</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

<?php 

    include "inc/footer.php";

?>