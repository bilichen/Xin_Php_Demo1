<?php require '../inc/connect_mysql.php';
    $del_id = $_GET['id'];
    $sql ="delete from news where new_id='$del_id'";
    echo $sql;
    if(mysqli_query($link,$sql)){
//        echo "删除成功";
        header('location:admin.php');
    }else{
        echo "删除失败";
    }
?>
