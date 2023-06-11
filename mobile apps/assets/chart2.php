<?php
$con = mysqli_connect('localhost', 'root', '', 'ICT');

$maxweek = "select max(week(date_add(date, interval 2 day))) from `ict_avail_davina_master_all_site`";

$sql = 'SELECT left(monthname(DATE),3) month, ROUND(AVG(availability),2) al,
    ROUND(AVG(CASE WHEN ns = "NS DENPASAR" THEN availability END),2) dps,
    ROUND(AVG(CASE WHEN ns = "NS MATARAM" THEN availability END),2) mtr,
    ROUND(AVG(CASE WHEN ns = "NS KUPANG" THEN availability END),2) kpg
    FROM `ict_avail_davina_master_all_site` 
    WHERE year(date) = "2022"
    GROUP BY month order by month(date)';

$sqna = 'SELECT left(monthname(DATE),3) month,
    ROUND(AVG(CASE WHEN RTPO = "BALI BARAT" THEN availability END),2) dpsB,
    ROUND(AVG(CASE WHEN RTPO = "BALI TIMUR" THEN availability END),2) dpsA
    FROM `ict_avail_davina_master_all_site` 
    WHERE year(date) = "2022"
    GROUP BY month order by month(date)';


$sqnb = 'SELECT left(monthname(DATE),3) month,
    ROUND(AVG(CASE WHEN RTPO = "MATARAM" THEN availability END),2) mtrA,
    ROUND(AVG(CASE WHEN RTPO = "BIMA" THEN availability END),2) mtrB,
    ROUND(AVG(CASE WHEN  RTPO = "SUMBAWA" THEN availability END),2) mtrC
    FROM `ict_avail_davina_master_all_site` 
    WHERE year(date) = "2022"
    GROUP BY month order by month(date)';

$sqnc = 'SELECT left(monthname(DATE),3) month,
    ROUND(AVG(CASE WHEN RTPO = "Kupang" THEN availability END),2) kpgA,
    ROUND(AVG(CASE WHEN RTPO = "Ruteng" THEN availability END),2) kpgB,
    ROUND(AVG(CASE WHEN RTPO = "Maumere" THEN availability END),2) kpgC,
    ROUND(AVG(CASE WHEN RTPO = "Waingapu" THEN availability END),2) kpgD
    FROM `ict_avail_davina_master_all_site` 
    WHERE year(date) = "2022"
    GROUP BY month order by month(date)';

$sqo = 'SELECT 
SUM( CASE WHEN main_problems = "power problem*(pw)" THEN TOTAL_OUTAGE_ALARM_SECONDS END)  pw,
SUM( CASE WHEN main_problems = "transmission problem*(tr)" THEN TOTAL_OUTAGE_ALARM_SECONDS END) tr,
SUM( CASE WHEN main_problems = "hardware problem*(hw)" THEN TOTAL_OUTAGE_ALARM_SECONDS END) hw,
SUM( CASE WHEN main_problems = "others*(ot)" THEN TOTAL_OUTAGE_ALARM_SECONDS END) ot,
SUM( CASE WHEN main_problems = "exclude" THEN TOTAL_OUTAGE_ALARM_SECONDS END) exc
FROM `ict_avail_davina_master_all_site` WHERE YEAR(DATE) = "2022"';

$sqo2 = 'SELECT 
SUM( CASE WHEN main_problems = "power problem*(pw)" AND ns = "ns denpasar" THEN TOTAL_OUTAGE_ALARM_SECONDS END) pw,
SUM( CASE WHEN main_problems = "transmission problem*(tr)" AND ns = "ns denpasar" THEN TOTAL_OUTAGE_ALARM_SECONDS END) tr,
SUM( CASE WHEN main_problems = "hardware problem*(hw)" AND ns = "ns denpasar" THEN TOTAL_OUTAGE_ALARM_SECONDS END) hw,
SUM( CASE WHEN main_problems = "others*(ot)" AND ns = "ns denpasar" THEN TOTAL_OUTAGE_ALARM_SECONDS END) ot
FROM `ict_avail_davina_master_all_site` WHERE YEAR(DATE) = "2022"';

$sqo3 = 'SELECT 
SUM( CASE WHEN main_problems = "power problem*(pw)" AND ns = "ns mataram" THEN TOTAL_OUTAGE_ALARM_SECONDS END) pw,
SUM( CASE WHEN main_problems = "transmission problem*(tr)" AND ns = "ns mataram" THEN TOTAL_OUTAGE_ALARM_SECONDS END) tr,
SUM( CASE WHEN main_problems = "hardware problem*(hw)" AND ns = "ns mataram" THEN TOTAL_OUTAGE_ALARM_SECONDS END) hw,
SUM( CASE WHEN main_problems = "others*(ot)" AND ns = "ns mataram" THEN TOTAL_OUTAGE_ALARM_SECONDS END) ot
FROM `ict_avail_davina_master_all_site` WHERE YEAR(DATE) = "2022"';

$sqo4 = 'SELECT 
SUM( CASE WHEN main_problems = "power problem*(pw)" AND ns = "ns kupang" THEN TOTAL_OUTAGE_ALARM_SECONDS END) pw,
SUM( CASE WHEN main_problems = "transmission problem*(tr)" AND ns = "ns kupang" THEN TOTAL_OUTAGE_ALARM_SECONDS END) tr,
SUM( CASE WHEN main_problems = "hardware problem*(hw)" AND ns = "ns kupang" THEN TOTAL_OUTAGE_ALARM_SECONDS END) hw,
SUM( CASE WHEN main_problems = "others*(ot)" AND ns = "ns kupang" THEN TOTAL_OUTAGE_ALARM_SECONDS END) ot
FROM `ict_avail_davina_master_all_site` WHERE YEAR(DATE) = "2022"';

$sq = 'SELECT WEEK, COUNT(ach) ttl, 
IFNULL(SUM(CASE WHEN class = "Diamond" THEN 1 END),0) AS dia,
IFNULL(SUM(CASE WHEN class = "Platinum" THEN 1 END),0) AS pla,
IFNULL(SUM(CASE WHEN class = "Gold" THEN 1 END),0) AS gol,
IFNULL(SUM(CASE WHEN class = "Silver" THEN 1 END),0) AS sil,
IFNULL(SUM(CASE WHEN class = "Bronze" THEN 1 END),0) AS bron
FROM(
SELECT WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) AS WEEK, CONCAT(kabupaten,"_",class) kabupaten, class, AVG(availability), COUNT(DISTINCT(siteid)),
CASE 
WHEN class = "DIAMOND" AND AVG(availability) >= 99.4 THEN "Ach"
WHEN class = "PLATINUM" AND AVG(availability) >= 99 THEN "Ach"
WHEN class = "GOLD" AND AVG(availability) >= 98.4 THEN "Ach"
WHEN class = "SILVER" AND AVG(availability) >= 97 THEN "Ach"
WHEN class = "BRONZE" AND AVG(availability) >= 95 THEN "Ach"
ELSE "nAch" END AS ach
FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = (select max(week(date_add(date, interval 2 day))) from `ict_avail_davina_master_all_site`)  GROUP BY WEEK, kabupaten, class) a
WHERE ach = "Nach"';

$sq2 = 'SELECT WEEK, COUNT(ach) ttl,
IFNULL(SUM(CASE WHEN class = "Diamond" THEN 1 END),0) AS dia,
IFNULL(SUM(CASE WHEN class = "Platinum" THEN 1 END),0) AS pla,
IFNULL(SUM(CASE WHEN class = "Gold" THEN 1 END),0) AS gol,
IFNULL(SUM(CASE WHEN class = "Silver" THEN 1 END),0) AS sil,
IFNULL(SUM(CASE WHEN class = "Bronze" THEN 1 END),0) AS bron
FROM(
SELECT WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) AS WEEK, siteid, class, AVG(availability) avail,
CASE 
WHEN class = "DIAMOND" AND AVG(availability) >= 99.4 THEN "Ach"
WHEN class = "PLATINUM" AND AVG(availability) >= 99 THEN "Ach"
WHEN class = "GOLD" AND AVG(availability) >= 98.4 THEN "Ach"
WHEN class = "SILVER" AND AVG(availability) >= 97 THEN "Ach"
WHEN class = "BRONZE" AND AVG(availability) >= 95 THEN "Ach"
ELSE "nAch" END AS ach
FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) 
FROM `ict_avail_davina_master_all_site`) GROUP BY WEEK, siteid) a
WHERE ach = "Nach"';


$reskabtw = mysqli_query($con, $sq);
while ($i = mysqli_fetch_array($reskabtw)) {
  $kabtw = array(
    'week' => $i['WEEK'],
    'lvl' => 'Kabupaten',
    'total' => $i['ttl'],
    'dia' => $i['dia'],
    'pla' => $i['pla'],
    'gol' => $i['gol'],
    'sil' => $i['sil'],
    'bron' => $i['bron'],
  );
};

$ressittw = mysqli_query($con, $sq2);
while ($i = mysqli_fetch_array($ressittw)) {
  $sittw = array(
    'week' => $i['WEEK'],
    'lvl' => 'Site',
    'total' => $i['ttl'],
    'dia' => $i['dia'],
    'pla' => $i['pla'],
    'gol' => $i['gol'],
    'sil' => $i['sil'],
    'bron' => $i['bron'],
  );
};

$res3 = mysqli_query($con, $sqo);
while ($dg = mysqli_fetch_array($res3)) {
  $dataop = array(
    'name' => 'power',
    'outage' => $dg['pw'],
    'color' => 'darkslategrey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
  $dataot = array(
    'name' => 'transmisi',
    'outage' => $dg['tr'],
    'color' => 'grey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
  $dataoh = array(
    'name' => 'hardware',
    'outage' => $dg['hw'],
    'color' => 'lightgrey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
  $dataoo = array(
    'name' => 'other',
    'outage' => $dg['ot'],
    'color' =>  'darkgrey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
}

$res4 = mysqli_query($con, $sqo3);
while ($dg = mysqli_fetch_array($res4)) {
  $datamp = array(
    'name' => 'power',
    'outage' => $dg['pw'],
    'color' => 'darkslategrey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
  $datamt = array(
    'name' => 'transmisi',
    'outage' => $dg['tr'],
    'color' => 'grey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
  $datamh = array(
    'name' => 'hardware',
    'outage' => $dg['hw'],
    'color' => 'lightgrey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
  $datamo = array(
    'name' => 'other',
    'outage' => $dg['ot'],
    'color' =>  'darkgrey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
}

$res = mysqli_query($con, $sqo2);

while ($d = mysqli_fetch_array($res)) {
  $datadp = array(
    'name' => 'power',
    'outage' => $d['pw'],
    'color' => 'darkslategrey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
  $datadt = array(
    'name' => 'transmisi',
    'outage' => $d['tr'],
    'color' => 'grey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
  $datadh = array(
    'name' => 'hardware',
    'outage' => $d['hw'],
    'color' => 'lightgrey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
  $datado = array(
    'name' => 'other',
    'outage' => $d['ot'],
    'color' =>  'darkgrey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
}

$res7 = mysqli_query($con, $sqo4);
while ($d = mysqli_fetch_array($res7)) {
  $datakp = array(
    'name' => 'power',
    'outage' => $d['pw'],
    'color' => 'darkslategrey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
  $datakt = array(
    'name' => 'transmisi',
    'outage' => $d['tr'],
    'color' => 'grey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
  $datakh = array(
    'name' => 'hardware',
    'outage' => $d['hw'],
    'color' => 'lightgrey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
  $datako = array(
    'name' => 'other',
    'outage' => $d['ot'],
    'color' =>  'darkgrey',
    'legendFontColor' => '#7F7F7F',
    'legendFontSize' => 8
  );
}

$res6 = mysqli_query($con, $sqnc);
while ($i = mysqli_fetch_object($res6)) {
  $kpgS[] = $i->month;
  $kpga['data'][] = $i->kpgA;
  $kpgb['data'][] = $i->kpgB;
  $kpgc['data'][] = $i->kpgC;
  $kpgd['data'][] = $i->kpgD;
};

$res2 = mysqli_query($con, $sqna);
while ($i = mysqli_fetch_object($res2)) {
  $dpsS[] = $i->month;
  $dpsa['data'][] = $i->dpsA;
  $dpsb['data'][] = $i->dpsB;
};

$res5 = mysqli_query($con, $sqnb);
while ($z = mysqli_fetch_object($res5)) {
  $mtrS[] = $z->month;
  $mtra['data'][] = $z->mtrA;
  $mtrb['data'][] = $z->mtrB;
  $mtrc['data'][] = $z->mtrC;
};

$result = mysqli_query($con, $sql) or die(mysqli_error($con));
while ($ds = mysqli_fetch_object($result)) {
  $datam['labels'][] = $ds->month;
  $datak['data'][] = $ds->al;
  $dataw['data'][] = $ds->dps;
  $datap['data'][] = $ds->mtr;
  $datas['data'][] = $ds->kpg;
};

$dtkp['legend'] = ['kupang', 'ruteng', 'maumere', 'waingapu'];
$dtkp['datasets'] = [$kpga, $kpgb, $kpgc, $kpgd];
$dtkp['labels'] = $kpgS;
$datam['datasets'] = [$datak, $dataw, $datap, $datas];
$datam['legend'] = ['reg7', 'dps', 'mtr', 'kpg'];
$dataj['legend'] = ['mataram', 'bima', 'sumbawa'];
$dataj['labels'] = $mtrS;
$dataj['datasets'] = [$mtra, $mtrb, $mtrc];
$datad['legend'] = ['bali barat', 'bali timur'];
$datad['labels'] = $dpsS;
$datad['datasets'] = [$dpsa, $dpsb];

$dtreg7 = array(
  'id' => 'REG7',
  'line' => $datam,
  'pie' => [$dataop, $dataot, $dataoo, $dataoh],
);

$dtdps = array(
  'id' => 'DPS',
  'line' =>  $datad,
  'pie' => [$datadp, $datadt, $datado, $datadh]
);

$dtmtr = array(
  'id' => 'MTR',
  'line' => $dataj,
  'pie' => [$datamp, $datamt, $datamo, $datamh]
);

$dtkpg = array(
  'id' => 'KPG',
  'line' => $dtkp,
  'pie' => [$datakp, $datakt, $datako, $datakh]
);

$dtall['avail'] = [$dtreg7, $dtdps, $dtmtr, $dtkpg];
$dtall['ach']['kab'] = $kabtw;
$dtall['ach']['site'] = $sittw;

print_r(json_encode($dtall, JSON_NUMERIC_CHECK));

file_put_contents("data.json", json_encode($dtall, JSON_NUMERIC_CHECK));
