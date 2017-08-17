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
    </script>
</head>
<body>
<?php
require '../inc/connect_mysql.php';
$sql = 'select * from title';
$result = mysqli_query($link,$sql);

if(isset($_GET['submit'])){
    $sel =  $_GET['sel'];
    // echo $sel;
    $content = $_GET['con'];
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
        $sql = "insert into news(new_type_id,new_type_name,new_contents) value ('$id','$sel','$content')";
        if(mysqli_query($link,$sql)){
            echo "添加成功";
        }else{
            echo "添加失败";
        }
    }
}
?>

<div class="container">
    <div class="add_form">
        <form action="" method="get" onsubmit="return check()">
            <p><h2>修改新闻</h2></p>
            <p>
                名称:<select name="sel">
                    <?php
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<option>'.$row['title_type_name'].'</option>';
                    }
                    ?>
                </select>
            </p>
            <p>内容：<textarea id="content" name="con"></textarea></p>
            <label><input type="submit" name="submit" value="提交"></label>
            <label><input type="button" name="back" value="返回" onclick="location.href='admin.php'"></label>

        </form>
    </div>
</div>
</body>
</html>