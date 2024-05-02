<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $template["title"]?></title>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="css\base.css">
        <?php
            if(!empty($template["style"])){
                echo "<link href=\"". "css/" . $template["style"] ."\" type=\"text/css\" rel=\"stylesheet\" />";
            }
        ?>
    </head>
    <body>
        <nav>
            <a href="#"><i class="fa-solid fa-bars"></i></a>
            <a href="#"><i class="fa-solid fa-magnifying-glass"></i></i></a> 
            <a href="#"><i class="fa-solid fa-house"></i></a> 
            <a href="#"><i class="fa-solid fa-envelope"></i></a> 
            <a href="#"> 
                <?php if(!empty($_SESSION['user']['Immagine'])){?>
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_SESSION['user']['Immagine']); ?>" />
                <?php }else{?>
                    <img src="../../images/user/placeholder.jpg" alt=""/>
                <?php }?>
            </a>    
        </nav>
        <?php require($template["file"])?>
        <script src="https://kit.fontawesome.com/06a34675f0.js" crossorigin="anonymous"></script>
    </body>
</html>