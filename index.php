<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#">
    <title>萬年曆作業</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./index.css">
    <style>
   .echodate{
    margin-top: 30px;
   }
   .container-2{
    margin-top: -30px;
   }
   .today {
    background: url(./img/ball.png) no-repeat;

    background-size: 10px 10px;
    background-position: 30% 0px;
}

    </style>
</head>

<body>


    <?php
    include "./star.html";
    date_default_timezone_set('Asia/Taipei');
    $month = (isset($_GET["m"])) ? $_GET["m"] : date("m");
    $year =  (isset($_GET["y"])) ? $_GET["y"] : date("Y");
    $today = date("Y-m-j");
    $firstdate = $year . "-" . $month . "-1";
    $firstweekdate = date("N", strtotime($firstdate));
    $space = $firstweekdate;
    $monthdate = date("t", strtotime($firstdate));
    $week = ceil(($monthdate + $space) / 7);
    // echo$week;
    $lastspace = ($week * 7 - ($monthdate + $space));



    $nextyear = $year;
    $preyear = $year;


    if ($month == 1) {
        $premonth = 12;
        $nextmonth = 2;

        $preyear = ($year - 1);
    } elseif ($month == 12) {
        $premonth = 11;
        $nextmonth = 1;
        $nextyear = ($year + 1);
    } else {
        $premonth = ($month - 1);
        $nextmonth = ($month + 1);
    }
    $premonthlastdate = date("t", date(strtotime($year . "-" . $premonth)));
    // echo $premonthlastdate;




    $cal = [];
    $cal[] = "SUN";
    $cal[] = "MON";
    $cal[] = "TUS";
    $cal[] = "WED";
    $cal[] = "THU";
    $cal[] = "FRI";
    $cal[] = "SAT";

    //   print_r($cal);
    if ($space != 7) {
        for ($i = 0; $i < $space; $i++) {
            $cal[] = $preyear . "-" . $premonth . "-" . ($premonthlastdate - $space + $i + 1);
        }
    }
    // print_r($cal);

    for ($i = 0; $i < $monthdate; $i++) {
        $cal[] = date("Y-n-j", strtotime("+$i days", strtotime($firstdate)));
    }
    for ($i = 0; $i < $lastspace; $i++) {
        $cal[] = $nextyear . "-" . $nextmonth . "-" . ($i + 1);
    }
    // print_r($cal);
    $holiday = [
        "10-10" => '國慶日',
        "12-25" => '聖誕節',
        "4-1" => '愚人節',
        "10-7" => '劉老師生日'
    ];
    // print_r($cal);
    // echo "<div class='timer'>".date('H:i:s')."</div>";

    ?>
   
        <!-- <div class="box">
            <div class="poker" id="poker1"></div>
            <div class="poker" id="poker2"></div>
            <div class="poker" id="poker3"></div>
            <div class="poker" id="poker4"></div>
        </div> -->

   

        <div class=" container">

            <div class="top">
                <a href="?y=<?= ($year - 1) ?>&m=<?= $month ?>" class="preyear">
                    << </a>
                        <a href="?y=<?= $preyear ?>&m=<?= $premonth ?>" class="premonth">pre</a>

                        <header class="header">
                            <div class="timer"><?= date("Y.m", strtotime($firstdate)) ?></div>
                            <br>
                            <a href="./index.php" class="comeback">
                                now
                            </a>
                        </header>
                        <a href="?y=<?= $nextyear ?>&m=<?= $nextmonth ?>" class="nextmonth">next</a>
                        <a href="?y=<?= $year + 1 ?>&m=<?= $month ?>" class="nextyear">>></a>
            </div>
            <div class="container-2">
                <?php

                foreach ($cal as $key => $date) {
                    if ($key < 7) {
                        echo "<div class='echodate'>" . $date;
                    } elseif (array_key_exists(date("n-j", strtotime($date)), $holiday)) {
                        if (strtotime($date) == strtotime($today)) {
                            echo "<div class='echodate today holiday'>" . date('j', strtotime($date));
                            echo "<div>{$holiday[date("n-j", strtotime($date))]}</div>";
                        } else {
                            echo "<div class='echodate holiday' style='font-size: 20px;'>" . date('j', strtotime($date));
                            echo "<div style='font-size: 20px;'>{$holiday[date("n-j", strtotime($date))]}</div>";
                        }
                    } elseif ($month != date("m", strtotime($date))) {
                        echo "<div class='echodate notthismonth'>" . date('j', strtotime($date));
                    } else if (strtotime($date) == strtotime($today)) {
                      
                        echo "<div class='echodate today'>" . date('j', strtotime($date));
                    } else {
                      
                        echo "<div class='echodate'>" . date('j', strtotime($date));
                    }
                    echo  "</div>";
                }


                ?>

            </div>

            <footer>




                <a href="./calendar3.php">
                   
                    <br>
                    other calendar
                </a>

            </footer>
        </div>
    </div>
</body>

</html>