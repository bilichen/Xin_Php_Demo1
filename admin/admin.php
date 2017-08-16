<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>PHP模版</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
<?php require '../inc/connect_mysql.php';

    if($num==null){
        $num = 1;
//        echo '$num0='.$num.'<br>';
    }
//    echo '$num1='.$num.'<br>';
    //选择类别
//    echo '$_GET_index='.$_GET['index'].'<br>';
    $index = isset($_GET['index'])?$_GET['index']:$num;
//    echo '$index='.$index.'<br>';
    $num = $index;
//    echo '$num2='.$num.'<br>';
    //选择当前类别的第几页
    $countIndex = isset($_GET['countIndex'])?$_GET['countIndex']:1;
//    echo '$countIndex='.$countIndex;


    $sql = 'select * from title';
    $sql1 = "select count(*) from news where new_type_id= {$index}";
    $result1 = mysqli_query($link,$sql1);
    $row1 = mysqli_fetch_row($result1);
    $count = ceil($row1[0]/5);


    $sql2 = "select * from news where new_type_id= {$index} limit 0,5";

    $result = mysqli_query($link,$sql);
    $result2 = mysqli_query($link,$sql2);

?>

<div class="container">
    <a href="">添加新闻</a>
    </br>
        <?php
            while($row = mysqli_fetch_assoc($result)){
                echo '<a href="?index='.$row['title_type_id'].'&countIndex=1">'.$row['title_type_name'].'</a>';
            }
        ?>
    </br></br>

        <table>
            <tr>
                <th>id</th>
                <th>类别</th>
                <th>名称</th>
                <th>内容</th>
                <th>修改</th>
                <th>删除</th>
            </tr>
            <?php
                $id = 1;
                while($row2 = mysqli_fetch_assoc($result2)){
                    echo '<tr>';
                    echo '<td>'.$id++.'</td>';
                    echo '<td>'.$row2['new_type_id'].'</td>';
                    echo '<td>'.$row2['new_type_name'].'</td>';
                    echo '<td>'.$row2['new_contents'].'</td>';
                    echo '<td><input type="button" value="修改" name="updata"/></td>';
                    echo '<td><input type="button" value="删除" name="del"/></td>';
                    echo '</tr>';
                 }
            ?>
        </table>

        <div class="fool">
            <?php
                for($i=1;$i<=$count;$i++){
//                    '<a href="?index='.$row['title_type_id'].'">'.$row['title_type_name'].'</a>';
                    echo '<a href="?index='.$num.'&countIndex='.$i.'">'.$i.'</a>';

                }
            ?>

        </div>

</div>

</body>
</html>