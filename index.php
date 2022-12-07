<?php
    include("function.php");

    $objCrudAdmin=new crudApp();
    if(isset($_POST['add_info'])){
        $return_msg=$objCrudAdmin->add_data($_POST);
    }
    $students=$objCrudAdmin->display_data();
    if(isset($_GET['status'])){
        if($_GET['status']='delete'){
            $delete_id=$_GET['id'];
            $del_msg=$objCrudAdmin->delete_data($delete_id);

        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>CRUD App</title>
  </head>
  <body>
     <!-- form create -->
    <div class="container my-4 p-4 shadow">
        <h2><a style=" text-decoration:none" href="index.php">Student Database</a></h2>
        <?php 
            if(isset($del_msg)){
            echo $del_msg;
            }
        ?>
        <form class="form" action="" method="POST" enctype="multipart/form-data">
            <?php 
            if(isset($return_msg)){
            echo $return_msg;
            }
            ?>
            <input class="form-control mb-2" type="text" name="std_name" placeholder="Enter Your Name">
            <input class="form-control mb-2" type="number" name="std_roll" placeholder="Enter Your Roll">
            <label for="image">Upload Your Image</label>
            <input class="form-control mb-2" type="file" name="std_image">
            <input class="form-control bg-warning " type="submit" value="Add Information" name="add_info">
        </form>
    </div>
    <!-- data table create -->
    <div class="container my-4 p-4 shadow">
       <table class="table table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Roll</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($student=mysqli_fetch_assoc($students)){ ?>
                <tr>
                    <td><?php echo $student['Std_ID']; ?></td>
                    <td><?php echo $student['Std_Name']; ?></td>
                    <td><?php echo $student['Std_Roll']; ?></td>
                    <td><img style="height:100px; width:100px;" src="upload/<?php echo $student['Std_Image']; ?>" alt=""></td>
                    <td>
                        <a class="btn btn-success" href="edit.php?status=edit&&id=<?php echo $student['Std_ID']; ?>">Edit</a>
                        <a class="btn btn-warning" href="?status=delete&&id=<?php echo $student['Std_ID']; ?>">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
       </table>
    </div>

    
  </body>
</html>