<?php
    $step = 1;
    $rows = 0;
    $cols = 0;
    $array_last = [];
    $message = '';
    if(isset($_POST['step'])){
        if($_POST['step'] == 2){
            $rows = (int)$_POST['rows'];
            $cols = (int)$_POST['cols'];
            if($rows == 0 && $cols == 0){
                $message = 'Masukan baris dan colom lebih dari 0';
            }
        }
        if($_POST['step'] == 3){
            $array_last = $_POST['input'];
        }
        if($message == ''){
            $step = (int)$_POST['step'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soal1a</title>
    <style>
        .card{
            /* width:30%; */
            padding:15px 10px;
            /* border:1px solid black; */
        }
        .form-input{
            margin-bottom:10px;
        }
        .button-style{
            padding:5px 5px;
            background-color:white;
            border:1px solid black;
            border-radius:2px;
            cursor:pointer;
        }
        .input-style{
            width: 50px;
        }
        .span-contoh{
            margin-left:70px;
        }
        .alert-text{
            color:red;
        }
        .li-style{
            font-weight:bold;
            list-style-type:none;
            padding:0;
            margin:0;
        }
    </style>
</head>
<body>
    <div class="card">
        <?php
            if($step == 1){
        ?>
            <form method="POST">
                <input type="hidden" name="step" value="2">
                <div class="form-input">
                    <label for="">Inputkan Jumlah Baris :</label>
                    <input type="number" class="input-style" name='rows' value='<?= $rows ?>'>
                    <span class="span-contoh">Contoh: 1</span>
                </div>
                <div class="form-input">
                    <label for="">Inputkan Jumlah Kolom :</label>
                    <input type="number" class="input-style" name='cols' value='<?= $cols ?>'>
                    <span class="span-contoh">Contoh: 3</span>
                </div>
                <button class="button-style" type='submit'>Submit</button>
                <p class="alert-text"><?= $message ?></p>
            </form>
        <?php
            }
        ?>
        <?php
            if($step == 2){
        ?>
            <form method="POST">
                <input type="hidden" name="step" value="3">
                <?php
                    for ($i=1; $i <= $rows ; $i++) {
                ?>
                    <div class="form-input">
                        <?php
                            for ($j = 1; $j <= $cols; $j++){
                        ?>
                            <label for=""><?= $i ?>.<?= $j ?></label>
                            <input type='text' name='input[<?= $i ?>][<?= $j ?>]'>
                        <?php } ?>
                    </div>
                <?php } ?>
                <button class="button-style" type='submit'>Submit</button>
            </form>
        <?php
            }
        ?>
        <?php
            if($step == 3){
        ?>
            <?php foreach ($array_last as $row => $cols) {
                foreach ($cols as $col => $value) {?>
                <ul>
                    <li class="li-style"><?= $row ?>.<?= $col ?>: <?= $value ?></li>
                </ul>
            <?php
                }
            }
            ?>
        <?php
            }
        ?>
    </div>
</body>
</html>