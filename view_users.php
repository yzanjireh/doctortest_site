<html> 
    <?php
    session_start();
    require_once "./functions/database_functionsp.php";
        require_once "./header.php";
    $conn = db_connect();

    if (!isset($_SESSION['admin'])) {
        echo "لطفا ابتدا وارد سایت شوید" . mysqli_error($conn);

        exit;
    }
    if (!$_SESSION['admin']) {
        echo "لطفا ابتدا وارد سایت شوید" . mysqli_error($conn);

        exit;
    }
    ?>
    <head lang="en">  
        <meta charset="UTF-8">  
        <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css"> <!--css file link in bootstrap folder-->  
        <title>View Users</title>  
    <style>  
        .login-panel {  
            margin-top: 150px;  
        }  
        .table {  
            margin-top: 50px;  

        }  

    </style>  
    </head>  
    

    <body>  

        <div class="table-scrol">  
            <h1 align="center">All the Users</h1>  

            <div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->  


                <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">  
                    <thead>  

                        <tr>  

                            <th>User Id</th>  
                            <th>User Name</th>  
                            <th>User sName</th>  

                            <th>User E-mail</th>  
                            <th>Cell Number</th>  
                            <th>Delete User</th>  
                        </tr>  
                    </thead>  

                    <?php
                    $view_users_query = "select * from users"; //select query for viewing users.  
                    $run = mysqli_query($conn, $view_users_query); //here run the sql query.  

                    while ($row = mysqli_fetch_row($run)) {//while look to fetch the result and store in a array $row.  
                        $user_id = $row[0];
                        $user_name = $row[3];
                        $user_sname = $row[4];
                        $user_email = $row[5];
                        $cell_number = $row[6];
                        ?>  

                        <tr>  
                            <!--here showing results in the table -->  
                            <td><?php echo $user_id; ?></td>  
                            <td><?php echo $user_name; ?></td>  
                            <td><?php echo $user_sname; ?></td>  

                            <td><?php echo $user_email; ?></td>  
                            <td><?php echo $cell_number; ?></td>  
                            <td><a href="delete.php?del=<?php echo $user_id ?>"><button class="btn btn-danger">Delete</button></a></td>   
                        </tr>  

                    <?php }
                    ?>  

                </table>  
            </div>  
        </div>  
        <div>
        <a href="admin_package.php" >برگشت به صفحه لیست بسته ها</a></div>

    </body>  
</html> 