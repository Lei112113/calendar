<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="#">
  <title>萬年曆作業</title>
  <link rel="stylesheet" href="./calendar.css">
  <style>
   /* .comeback{
    display: block;
    width: 20%;
    height: 40px;
    position: relative;
    bottom: 0px;

} */
  </style>
</head>

<body>


  <?php

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

    $preyear = $year - 1;
  } elseif ($month == 12) {
    $premonth = 11;
    $nextmonth = 1;
    $nextyear = $year + 1;
  } else {
    $premonth = $month - 1;
    $nextmonth = $month + 1;
  }
  $premonthlastdate = date("t", date(strtotime($year . "-" . $premonth)));
  // echo $premonthlastdate;




  $cal = [];
  if ($space != 7) {
    for ($i = 0; $i < $space; $i++) {
      $cal[] = $preyear . "-" . $premonth . "-" . $premonthlastdate - $space + $i + 1;
    }
  }
  // print_r($cal);

  for ($i = 0; $i < $monthdate; $i++) {
    $cal[] = date("Y-n-j", strtotime("+$i days", strtotime($firstdate)));
  }
  for ($i = 0; $i < $lastspace; $i++) {
    $cal[] = $nextyear . "-" . $nextmonth . "-" . $i + 1;
  }
  // print_r($cal);
  $holiday = [
    "國慶日" => '10-10',
    "聖誕節" => '12-25',
    "愚人節" => '4-1',
    "劉老師生日" => '10-7'
  ];

  ?>




  <div class=" container">

  <div class="top">
    <a href="?y=<?= $preyear ?>&m=<?= $premonth ?>" class="premonth">pre</a>

    <header class="header"><?= date("Y.m", strtotime($firstdate)) ?></header>
    <a href="?y=<?= $nextyear ?>&m=<?= $nextmonth ?>" class="nextmonth">next</a>
  </div>
  <table class="table">
    <tr>
      <td>SUN</td>
      <td>MON</td>
      <td>TUE</td>
      <td>WED</td>
      <td>THU</td>
      <td>FRI</td>
      <td>SAT</td>
    </tr>
    <?php

    foreach ($cal as $key => $date) {

      if (($key % 7 == 0)) {
        echo "<tr>";
      }
      if ($date == $today) {
        echo "<td ><div class='today'>";
        echo date("j", strtotime($date));
        echo "</div>";
      } elseif ($month != date("m", strtotime($date))) {
        echo "<td class='othermonth'>";
        echo date("j", strtotime($date));
        // echo "</td>";

      } else {
        echo "<td>";
        echo date("j", strtotime($date));
      }
      foreach ($holiday as $match => $holi) {

        if ($holi == date("n-j", strtotime($date))) {
          echo "<div>$match</div>";
        }
      }
      echo "</td>";

      if (($key % 7 == 6)) {
        echo "</tr>";
      }
    }
    // print_r($holiday);
    // print_r($cal);
    ?>


  </table>
  <a href="./index.php" class="comeback">
    now
  </a>
  </div>
  </body>

</html>