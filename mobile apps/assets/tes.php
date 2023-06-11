<?php

$a = 'SELECT month,rtpo,class, round(100*(1-outage/quota),1) quo_usage FROM(
  SELECT MONTHname(DATE) MONTH, rtpo, class, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, 
  CASE 
  WHEN class = "diamond" THEN (1-0.994)*(30*86400*COUNT(DISTINCT(siteid)))
  WHEN class = "Platinum" THEN (1-0.99)*(30*86400*COUNT(DISTINCT(siteid)))
  WHEN class = "Gold" THEN (1-0.984)*(30*86400*COUNT(DISTINCT(siteid)))
  WHEN class = "silver" THEN (1-0.97)*(30*86400*COUNT(DISTINCT(siteid)))
  WHEN class = "bronze" THEN (1-0.95)*(30*86400*COUNT(DISTINCT(siteid)))
  END AS quota
  FROM `ict_avail_davina_master_all_site` WHERE MONTH(DATE) = (select max(month(date)) from `ict_avail_davina_master_all_site`) AND YEAR(DATE) = (select max(year(date)) from `ict_avail_davina_master_all_site`)  
  GROUP BY YEAR(DATE), MONTH, rtpo,class) a
  ORDER BY FIELD(rtpo,"bali timur","bali barat","mataram","bima","sumbawa","kupang","maumere","ruteng","waingapu")';

$tw = 'SELECT WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) WEEK, siteid, ns, rtpo, class, mid(enodeb_name,10,25) as name,
SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, ROUND(100*(1-SUM(TOTAL_OUTAGE_ALARM_SECONDS)/(7*86400)),1) avail,
SUM(CASE WHEN DAYOFWEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 1  THEN AVAILABILITY END) AS av1,
SUM(CASE WHEN DAYOFWEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 2  THEN AVAILABILITY END) AS av2,
SUM(CASE WHEN DAYOFWEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 3  THEN AVAILABILITY END) AS av3,
SUM(CASE WHEN DAYOFWEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 4  THEN AVAILABILITY END) AS av4,
SUM(CASE WHEN DAYOFWEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 5  THEN AVAILABILITY END) AS av5,
SUM(CASE WHEN DAYOFWEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 6  THEN AVAILABILITY END) AS av6,
SUM(CASE WHEN DAYOFWEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 7  THEN AVAILABILITY END) AS av7,
ROUND(IFNULL(SUM(CASE WHEN main_problems = "POWER PROBLEM*(PW)" THEN total_outage_alarm_seconds END)/3600,0),1) AS pw,
ROUND(IFNULL(SUM(CASE WHEN main_problems = "TRANSMISSION PROBLEM*(TR)" THEN total_outage_alarm_seconds END)/3600,0),1) AS tr,
ROUND(IFNULL(SUM(CASE WHEN main_problems = "HARDWARE PROBLEM*(HW)" THEN total_outage_alarm_seconds END)/3600,0),1) AS hw,
ROUND(IFNULL(SUM(CASE WHEN main_problems = "OTHERS*(OT)" THEN total_outage_alarm_seconds END)/3600,0),1) AS ot,
ROUND(SUM(total_outage_alarm_seconds)/3600,1) AS tot
FROM `ict_avail_davina_master_all_site` WHERE
WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`)
GROUP BY WEEK, siteid HAVING avail>0.0
ORDER BY outage DESC LIMIT 10 
';

$con = mysqli_connect('localhost', 'root', '', 'ict');
$q = mysqli_query($con, $a);
$o = mysqli_query($con, $tw);
$v = 1;
while ($i = mysqli_fetch_array($o)) {
  $datah[] = array(
    'id' => $v,
    'siteid' => $i['siteid'],
    'ns' => $i['ns'],
    'to' => $i['rtpo'],
    'avail' => $i['avail'],
    'class' => $i['class'],
    'week' => $i['WEEK'],
    'name' => $i['name'],
    'outage' => $i['tot'],
    'graph' => array(
      'datasets' => [array('data' => [$i['av1'], $i['av2'], $i['av3'], $i['av4'], $i['av5'], $i['av6'], $i['av7']])],
      'labels' => [1, 2, 3, 4, 5, 6, 7]
    ),
    'pie' =>  [
      array(
        'name' => 'pw',
        'outage' => $i['pw'],
        'color' => 'lightgrey',
        'legendFontColor' => '#FFF',
        'legendFontSize' => 9
      ),
      array(
        'name' => 'tr',
        'outage' => $i['tr'],
        'color' => '#9A9A9A',
        'legendFontColor' => '#FFF',
        'legendFontSize' => 9
      ), array(
        'name' => 'hw',
        'outage' => $i['hw'],
        'color' =>  '#696969',
        'legendFontColor' => '#FFF',
        'legendFontSize' => 9
      ), array(
        'name' => 'ot',
        'outage' => $i['ot'],
        'color' => '#4C5762',
        'legendFontColor' => '#FFF',
        'legendFontSize' => 9
      )
    ]
  );
  $v += 1;
};



while ($i = mysqli_fetch_array($q)) {
  $bulan = $i['month'];
  if ($i['class'] == 'Bronze') {
    $b['data'][] = $i['quo_usage'];
  }
  if ($i['class'] == 'Silver') {
    $s['data'][] = $i['quo_usage'];
  }
  if ($i['class'] == 'Gold') {
    $g['data'][] = $i['quo_usage'];
  }
  if ($i['class'] == 'Platinum') {
    $p['data'][] = $i['quo_usage'];
  }
  if ($i['class'] == 'Diamond') {
    $f['data'][] = $i['quo_usage'];
  }
};

$bronze = array(
  'id' => 'Bronze',
  'bulan' => $bulan
);
$bronze['bar'] = array(
  'labels' => ['BT', 'BB', 'MT', 'BM', 'SW', 'KP', 'MM', 'RT', 'WP'],
  'datasets' => [$b],
);

$silver = array(
  'id' => 'Silver',
  'bulan' => $bulan
);

$silver['bar'] = array(
  'labels' => ['BT', 'BB', 'MT', 'BM', 'SW', 'KP', 'MM', 'RT', 'WP'],
  'datasets' => [$s],
);

$gold = array(
  'id' => 'Gold',
  'bulan' => $bulan
);

$gold['bar'] = array(
  'labels' => ['BT', 'BB', 'MT', 'BM', 'SW', 'KP', 'MM', 'RT', 'WP'],
  'datasets' => [$g],
);

$platinum = array(
  'id' => 'Platinum',
  'bulan' => $bulan
);

$platinum['bar'] = array(
  'labels' => ['BT', 'BB', 'MT', 'BM', 'SW', 'KP', 'MM', 'RT', 'WP'],
  'datasets' => [$p],
);

$diamond = array(
  'id' => 'Diamond',
  'bulan' => $bulan
);

$z['data'] = [0, 0, 0, 0, 0, $f['data'][0], $f['data'][1], $f['data'][2], 0];
$diamond['bar'] = array(
  'labels' => ['BT', 'BB', 'MT', 'BM', 'SW', 'KP', 'MM', 'RT', 'WP'],
  'datasets' => [$z]
);


$data['quota'] = [$diamond, $platinum, $gold, $silver, $bronze];
$data['top10'] = $datah;
print_r(json_encode($data, JSON_NUMERIC_CHECK));


file_put_contents("data2.json", json_encode($data, JSON_NUMERIC_CHECK));
