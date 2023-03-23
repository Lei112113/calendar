<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆</title>
    <link rel="stylesheet" href="./calendar3.css">
    <style>
        div {
            display: flex;
            /* text-align: center; */
            justify-content: center;
        }

        div>* {
            margin: 20px;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            border-color: #000;
        }
    </style>
</head>
<?php
 $month = (isset($_GET['m'])) ? $_GET['m'] : date('m');

$year = (isset($_GET['y'])) ? $_GET['y'] : date('Y');

if ($month >= 2 && $month <= 4) {
    echo "<body class='main1'>";
} elseif ($month >= 5 && $month <= 7) {
    echo "<body class='main2'>";
} elseif ($month >= 8 && $month <= 10) {
    echo "<body class='main3'>";
} else {
    echo "<body class='main4'>";
}


?>


<?php
// $month=(isset($_GET['m']))?$_GET['m']:date("n");
// $year=(isset($_GET['y']))?$_GET['y']:date("Y");
$cal = [];
// $year = date("Y");
// $month = date("m");
$firstdate = $year . "-" . $month . "-1";
$firstdateweek = date("N", strtotime($firstdate));
$space = $firstdateweek - 1;
$lastdate = date("t", strtotime($firstdate));
$premonth = $month - 1;
$nextmonth = $month + 1;
$date = $year . "-" . $month . "-" . date("j");
$today = date("Y-m-j");
$lastspace = 7 - (($lastdate + $space) % 7);
// echo$today;
if ($month == 1) {
    // $nextmonth=$month+1;
    $premonth = 12;
    $nextmonth = $month + 1;
    $preyear = $year - 1;
    $nextyear = $year;
    //$month = (isset($_GET['m'])) ? $_GET['m'] : date('m');
} elseif ($month == 12) {
    $premonth = $month - 1;
    $nextmonth = 1;
    $preyear = $year;
    $nextyear = $year + 1;
    //$month = (isset($_GET['m'])) ? $_GET['m'] : date('m');
} else {
    $premonth = $month - 1;
    $nextmonth = $month + 1;
    $preyear = $year;
    $nextyear = $year;
}




// echo $year . "<br>" . $month . "<br>" . $firstdate . "<br>";
// echo $firstdateweek . "<br>";
// echo $lastdate;
for ($i = 0; $i < $space; $i++) {
    $cal[] = "";
}
for ($i = 1; $i <= $lastdate; $i++) {
    $cal[] = $i;
}

for ($i = 0; $i < $lastspace; $i++) {
    if ($lastspace != 7) {
        $cal[] = "";
    }
}

?>
<?php

if ($month >= 2 && $month <= 4) {
    echo "<div class='container1'>";
} elseif ($month >= 5 && $month <= 7) {
    echo "<div class='container2'>";
} elseif ($month >= 8 && $month <= 10) {
    echo "<div class='container3'>";
} else {
    echo "<div class='container4'>";
}


?>
<div class="top">
    <a href="?y=<?= $preyear; ?>&m=<?= $premonth; ?>" class="bottom bottom1"></a>

    <header><?= $year; ?> 年 <?= $month; ?> 月份

</header>

    <a href="?y=<?= $nextyear; ?>&m=<?= $nextmonth; ?>" class="bottom bottom2"></a>
</div>
<div class="contain">

    <table border="1">
        <tr>
            <th>一</th>
            <th>二</th>
            <th>三</th>
            <th>四</th>
            <th>五</th>
            <th>六</th>
            <th>日</th>
        </tr>
        <?php
        foreach ($cal as $key => $value) {
            if ($key % 7 == 0) {
                echo "<tr>";
            }
            if ($value == date("j", strtotime($today)) && $month == date("n", strtotime($today))) {
                echo "<td class='today'><a href='#'>" . $value . "</a></td>";
            } else {
                echo "<td><a href='#'>" . $value . "</a></td>";
            }


            if ($key % 7 == 6) {
                echo "</tr>";
            }
        }
        // print_r($cal);
        ?>
    </table>
</div>
<a href="?y=<?= date('Y'); ?>&m=<?= date('m'); ?>" class="rabbithead">
    <img src="./img/rabbitback.png" alt="回到現在">
    <br>
    <span>back now</span>
</a>

<a href="./index.php" class="index">back index</a>
</div>
</body>

</html>