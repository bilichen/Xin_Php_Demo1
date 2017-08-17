<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>updata</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <script>
        function check(){
            var v = document.getElementById('content').value;
            if(v==""){
                alert("请输入新闻内容");
                return false;
            }

        }
        function change(val){
            var type_id = document.getElementById('type_id');
            if("国内"== val){
                type_id.value = 1;
            }else if("国外"== val){
                type_id.value = 2;
            }else if("电视"== val){
                type_id.value = 3;
            }else if("图片"== val){
                type_id.value = 4;
            }
        }
    </script>
</head>
<body>
<?php
require '../inc/connect_mysql.php';

    $id_get=$_GET['id'];
    $sql_content = "select * from news where new_id={$id_get}";
    $result_content = mysqli_query($link,$sql_content);
    while($row_content = mysqli_fetch_assoc($result_content)){
        $id_u = $row_content['new_type_id'];
        $name_u = $row_content['new_type_name'];
        $content_u = $row_content['new_contents'];
    }

//    echo $id_u;
//    echo $name_u;
//    echo $content_u;
//
//    echo $sql_content;

    $sql = 'select * from title';
    $result = mysqli_query($link,$sql);

if(isset($_GET['submit'])){
    $f_id =  $_GET['id1'];
    $t_id =  $_GET['type_id'];
    $sel =  $_GET['sel'];
    $content = $_GET['con'];
//    echo $f_id.'<br>';
//    echo $t_id.'<br>';
//    echo $sel.'<br>';
//    echo $content.'<br>';
    if($content!=null){
        //echo $content;
        if("国内"== $sel){
            $id = 1;
        }else if("国外"== $sel){
            $id = 2;
        }else if("电视"== $sel){
            $id = 3;
        }else if("图片"== $sel){
            $id = 4;
        }
        $sql = "update news set new_type_id='$t_id',new_type_name='$sel',new_contents='$content' where new_id='$f_id'";
       echo $sql;
        if(mysqli_query($link,$sql)){
            echo "修改成功";
            header('location:admin.php');
        }else{
            echo "修改失败";
        }
    }
}
?>

<div class="container">
    <div class="add_form">
        <form action="" method="get" onsubmit="return check()">
            <p><h2>修改新闻</h2></p>
            id:<input type="text" name="id1" value="<?php echo $id_get?>" readonly>
            类别:<input type="text" name="type_id" id="type_id" value="<?php echo $id_u?>" readonly>
            <p>  名称:<select name="sel" onchange="change(this.value)">
                        <?php
                        while($row = mysqli_fetch_assoc($result)){?>
                            <option <?php if ($name_u == $row['title_type_name']) { ?>selected="selected" <?php } ?>><?php echo $row['title_type_name']?></option>;
                        <?php }?>
                     </select>
            </p>
            <p>内容：<textarea id="content" name="con"><?php echo $content_u?></textarea></p>
            <label><input type="submit" name="submit" value="提交"></label>
            <label><input type="button" name="back" value="返回" onclick="location.href='admin.php'"></label>

        </form>
    </div>
</div>
</body>
</html>