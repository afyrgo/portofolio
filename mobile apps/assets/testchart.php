<?php
$con = mysqli_connect('localhost', 'root', '', 'ICT');
$maxweek = "select max(week(date_add(date, interval 2 day))) from `ict_avail_davina_master_all_site`";

$a2 = 'SELECT concat("w",week(date_add(date, interval 2 day))) week,
      ROUND(AVG(CASE WHEN Class = "Diamond" THEN availability END),2) diareg7,
      ROUND(AVG(CASE WHEN Class = "Platinum" THEN availability END),2) plareg7,
      ROUND(AVG(CASE WHEN Class = "Gold" THEN availability END),2) golreg7,
      ROUND(AVG(CASE WHEN Class = "Silver" THEN availability END),2) silreg7,
      ROUND(AVG(CASE WHEN Class = "Bronze" THEN availability END),2) broreg7,
      ROUND(AVG(CASE WHEN Class = "Diamond" and NS = "NS KUPANG" THEN availability END),2) diakup,
      ROUND(AVG(CASE WHEN Class = "Platinum" and NS = "NS KUPANG" THEN availability END),2) plakup,
      ROUND(AVG(CASE WHEN Class = "Gold" and NS = "NS KUPANG" THEN availability END),2) golkup,
      ROUND(AVG(CASE WHEN Class = "Silver" and NS = "NS KUPANG" THEN availability END),2) silkup,
      ROUND(AVG(CASE WHEN Class = "Bronze" and NS = "NS KUPANG" THEN availability END),2) brokup,
      ifnull(ROUND(AVG(CASE WHEN Class = "Diamond" and NS = "NS MATARAM" THEN availability END),2),0) diamtr,
      ROUND(AVG(CASE WHEN Class = "Platinum" and NS = "NS MATARAM" THEN availability END),2) plamtr,
      ROUND(AVG(CASE WHEN Class = "Gold" and NS = "NS MATARAM" THEN availability END),2) golmtr,
      ROUND(AVG(CASE WHEN Class = "Silver" and NS = "NS MATARAM" THEN availability END),2) silmtr,
      ROUND(AVG(CASE WHEN Class = "Bronze" and NS = "NS MATARAM" THEN availability END),2) bromtr,
      ifnull(ROUND(AVG(CASE WHEN Class = "Diamond" and NS = "NS DENPASAR" THEN availability END),2),0) diadps,
      ROUND(AVG(CASE WHEN Class = "Platinum" and NS = "NS DENPASAR" THEN availability END),2) pladps,
      ROUND(AVG(CASE WHEN Class = "Gold" and NS = "NS DENPASAR" THEN availability END),2) goldps,
      ROUND(AVG(CASE WHEN Class = "Silver" and NS = "NS DENPASAR" THEN availability END),2) sildps,
      ROUND(AVG(CASE WHEN Class = "Bronze" and NS = "NS DENPASAR" THEN availability END),2) brodps,
      ROUND(AVG(CASE WHEN Class = "Diamond" and RTPO = "KUPANG" THEN availability END),2) diakpg,
      ROUND(AVG(CASE WHEN Class = "Platinum" and RTPO = "KUPANG" THEN availability END),2) plakpg,
      ROUND(AVG(CASE WHEN Class = "Gold" and RTPO = "KUPANG" THEN availability END),2) golkpg,
      ROUND(AVG(CASE WHEN Class = "Silver" and RTPO = "KUPANG" THEN availability END),2) silkpg,
      ROUND(AVG(CASE WHEN Class = "Bronze" and RTPO = "KUPANG" THEN availability END),2) brokpg,
      ROUND(AVG(CASE WHEN Class = "Diamond" and RTPO = "MAUMERE" THEN availability END),2) diamau,
      ROUND(AVG(CASE WHEN Class = "Platinum" and RTPO = "MAUMERE" THEN availability END),2) plamau,
      ROUND(AVG(CASE WHEN Class = "Gold" and RTPO = "MAUMERE" THEN availability END),2) golmau,
      ROUND(AVG(CASE WHEN Class = "Silver" and RTPO = "MAUMERE" THEN availability END),2) silmau,
      ROUND(AVG(CASE WHEN Class = "Bronze" and RTPO = "MAUMERE" THEN availability END),2) bromau,
      ROUND(AVG(CASE WHEN Class = "Diamond" and RTPO = "RUTENG" THEN availability END),2) diartg,
      ROUND(AVG(CASE WHEN Class = "Platinum" and RTPO = "RUTENG" THEN availability END),2) plartg,
      ROUND(AVG(CASE WHEN Class = "Gold" and RTPO = "RUTENG" THEN availability END),2) golrtg,
      ROUND(AVG(CASE WHEN Class = "Silver" and RTPO = "RUTENG" THEN availability END),2) silrtg,
      ROUND(AVG(CASE WHEN Class = "Bronze" and RTPO = "RUTENG" THEN availability END),2) brortg,
      ifnull(ROUND(AVG(CASE WHEN Class = "Diamond" and RTPO = "WAINGAPU" THEN availability END),2),0) diawai,
      ROUND(AVG(CASE WHEN Class = "Platinum" and RTPO = "WAINGAPU" THEN availability END),2) plawai,
      ROUND(AVG(CASE WHEN Class = "Gold" and RTPO = "WAINGAPU" THEN availability END),2) golwai,
      ROUND(AVG(CASE WHEN Class = "Silver" and RTPO = "WAINGAPU" THEN availability END),2) silwai,
      ROUND(AVG(CASE WHEN Class = "Bronze" and RTPO = "WAINGAPU" THEN availability END),2) browai,
      ifnull(ROUND(AVG(CASE WHEN Class = "Diamond" and RTPO = "MATARAM" THEN availability END),2),0) diamat,
      ROUND(AVG(CASE WHEN Class = "Platinum" and RTPO = "MATARAM" THEN availability END),2) plamat,
      ROUND(AVG(CASE WHEN Class = "Gold" and RTPO = "MATARAM" THEN availability END),2) golmat,
      ROUND(AVG(CASE WHEN Class = "Silver" and RTPO = "MATARAM" THEN availability END),2) silmat,
      ROUND(AVG(CASE WHEN Class = "Bronze" and RTPO = "MATARAM" THEN availability END),2) bromat,
      ifnull(ROUND(AVG(CASE WHEN Class = "Diamond" and RTPO = "SUMBAWA" THEN availability END),2),0) diasum,
      ROUND(AVG(CASE WHEN Class = "Platinum" and RTPO = "SUMBAWA" THEN availability END),2) plasum,
      ROUND(AVG(CASE WHEN Class = "Gold" and RTPO = "SUMBAWA" THEN availability END),2) golsum,
      ROUND(AVG(CASE WHEN Class = "Silver" and RTPO = "SUMBAWA" THEN availability END),2) silsum,
      ROUND(AVG(CASE WHEN Class = "Bronze" and RTPO = "SUMBAWA" THEN availability END),2) brosum,
      ifnull(ROUND(AVG(CASE WHEN Class = "Diamond" and RTPO = "BIMA" THEN availability END),2),0) diabim,
      ROUND(AVG(CASE WHEN Class = "Platinum" and RTPO = "BIMA" THEN availability END),2) plabim,
      ROUND(AVG(CASE WHEN Class = "Gold" and RTPO = "BIMA" THEN availability END),2) golbim,
      ROUND(AVG(CASE WHEN Class = "Silver" and RTPO = "BIMA" THEN availability END),2) silbim,
      ROUND(AVG(CASE WHEN Class = "Bronze" and RTPO = "BIMA" THEN availability END),2) brobim,
      ifnull(ROUND(AVG(CASE WHEN Class = "Diamond" and RTPO = "BALI BARAT" THEN availability END),2),0) diabb,
      ROUND(AVG(CASE WHEN Class = "Platinum" and RTPO = "BALI BARAT" THEN availability END),2) plabb,
      ROUND(AVG(CASE WHEN Class = "Gold" and RTPO = "BALI BARAT" THEN availability END),2) golbb,
      ROUND(AVG(CASE WHEN Class = "Silver" and RTPO = "BALI BARAT" THEN availability END),2) silbb,
      ROUND(AVG(CASE WHEN Class = "Bronze" and RTPO = "BALI BARAT" THEN availability END),2) brobb,
      ifnull(ROUND(AVG(CASE WHEN Class = "Diamond" and RTPO = "BALI TIMUR" THEN availability END),2),0) diabt,
      ROUND(AVG(CASE WHEN Class = "Platinum" and RTPO = "BALI TIMUR" THEN availability END),2) plabt,
      ROUND(AVG(CASE WHEN Class = "Gold" and RTPO = "BALI TIMUR" THEN availability END),2) golbt,
      ROUND(AVG(CASE WHEN Class = "Silver" and RTPO = "BALI TIMUR" THEN availability END),2) silbt,
      ROUND(AVG(CASE WHEN Class = "Bronze" and RTPO = "BALI TIMUR" THEN availability END),2) brobt
      FROM `ict_avail_davina_master_all_site` 
      WHERE YEAR(DATE) = "2022"
      GROUP BY week ORDER BY week(date)';


$b2 = 'SELECT WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) WEEK, MAIN_PROBLEMS,
      IFNULL(ROUND(SUM( CASE WHEN class = "BRONZE" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  r7bro,
      IFNULL(ROUND(SUM( CASE WHEN class = "SILVER" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  r7sil,
      IFNULL(ROUND(SUM( CASE WHEN class = "Gold" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  r7gold,
      IFNULL(ROUND(SUM( CASE WHEN class = "Platinum" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  r7pla,
      IFNULL(ROUND(SUM( CASE WHEN class = "Diamond" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  r7dia,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS DENPASAR" AND class = "BRONZE" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  dpsbro,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS DENPASAR" AND class = "SILVER" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  dpssil,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS DENPASAR" AND class = "GOLD" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  dpsgol,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS DENPASAR" AND class = "PLATINUM" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  dpspla,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS DENPASAR" AND class = "diamond" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  dpsdia,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS MATARAM" AND class = "BRONZE" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  mtrbro,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS MATARAM" AND class = "SILVER" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  mtrsil,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS MATARAM" AND class = "GOLD" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  mtrgol,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS MATARAM" AND class = "PLATINUM" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  mtrpla,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS MATARAM" AND class = "Diamond" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  mtrdia,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS KUPANG" AND class = "BRONZE" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  kpgbro,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS KUPANG" AND class = "SILVER" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  kpgsil,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS KUPANG" AND class = "GOLD" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  kpggol,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS KUPANG" AND class = "PLATINUM" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  kpgpla,
      IFNULL(ROUND(SUM( CASE WHEN NS = "NS KUPANG" AND class = "Diamond" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  kpgdia,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bali barat" AND class = "BRONZE" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  bbbro,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bali barat" AND class = "SILVER" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  bbsil,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bali barat" AND class = "GOLD" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  bbgol,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bali barat" AND class = "PLATINUM" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  bbpla,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bali barat" AND class = "Diamond" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  bbdia,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bali timur" AND class = "BRONZE" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  btbro,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bali timur" AND class = "SILVER" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  btsil,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bali timur" AND class = "GOLD" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  btgol,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bali timur" AND class = "PLATINUM" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  btpla,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bali timur" AND class = "Diamond" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  btdia,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "mataram" AND class = "BRONZE" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  matbro,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "mataram" AND class = "SILVER" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  matsil,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "mataram" AND class = "GOLD" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  matgol,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "mataram" AND class = "PLATINUM" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  matpla,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "mataram" AND class = "Diamond" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  matdia,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "sumbawa" AND class = "BRONZE" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  sumbro,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "sumbawa" AND class = "SILVER" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  sumsil,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "sumbawa" AND class = "GOLD" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  sumgol,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "sumbawa" AND class = "PLATINUM" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  sumpla,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "sumbawa" AND class = "Diamond" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  sumdia,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bima" AND class = "BRONZE" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  bimbro,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bima" AND class = "SILVER" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  bimsil,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bima" AND class = "GOLD" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  bimgol,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bima" AND class = "PLATINUM" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  bimpla,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "bima" AND class = "Diamond" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  bimdia,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "kupang" AND class = "BRONZE" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  kupbro,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "kupang" AND class = "SILVER" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  kupsil,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "kupang" AND class = "GOLD" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  kupgol,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "kupang" AND class = "PLATINUM" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  kuppla,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "kupang" AND class = "Diamond" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  kupdia,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "ruteng" AND class = "BRONZE" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  rtgbro,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "ruteng" AND class = "SILVER" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  rtgsil,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "ruteng" AND class = "GOLD" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  rtggol,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "ruteng" AND class = "PLATINUM" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  rtgpla,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "ruteng" AND class = "Diamond" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  rtgdia,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "maumere" AND class = "BRONZE" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  maubro,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "maumere" AND class = "SILVER" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  mausil,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "maumere" AND class = "GOLD" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  maugol,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "maumere" AND class = "PLATINUM" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  maupla,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "maumere" AND class = "Diamond" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  maudia,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "waingapu" AND class = "BRONZE" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  waibro,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "waingapu" AND class = "SILVER" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  waisil,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "waingapu" AND class = "GOLD" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  waigol,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "waingapu" AND class = "PLATINUM" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  waipla,
      IFNULL(ROUND(SUM( CASE WHEN rtpo = "waingapu" AND class = "Diamond" THEN TOTAL_OUTAGE_ALARM_SECONDS END)/3600,1),0)  waidia
      FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) 
      FROM `ict_avail_davina_master_all_site`) AND MAIN_PROBLEMS != "0" GROUP BY WEEK ,main_problems 
      ORDER BY  FIELD(MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';

$c2 = 'SELECT b.class, b.main_problems, IFNULL(freq,0) freq, IFNULL(impact,0) impact, IFNULL(ROUND(outage/3600,1),0) outage, IFNULL(ROUND((outage/3600)/freq,1),0) MTTR FROM
      (SELECT class, main_problems, COUNT(siteid) freq, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, COUNT(DISTINCT(siteid)) impact FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 
      (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`) AND TOTAL_OUTAGE_ALARM_SECONDS != 0 AND ns = "ns kupang"
      GROUP BY WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)), class, main_problems)a
      RIGHT JOIN(
      SELECT MAIN_PROBLEMS, class FROM `ict_avail_davina_master_all_site` WHERE TOTAL_OUTAGE_ALARM_SECONDS != 0 AND MAIN_PROBLEMS != "exclude" GROUP BY class, MAIN_PROBLEMS) b
      ON a.main_problems = b.main_problems AND a.class = b.class
      ORDER BY class, FIELD(b.MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';

$d2 = 'SELECT b.class, b.main_problems, IFNULL(freq,0) freq, IFNULL(impact,0) impact, IFNULL(ROUND(outage/3600,1),0) outage, IFNULL(ROUND((outage/3600)/freq,1),0) MTTR FROM
      (SELECT class, main_problems, COUNT(siteid) freq, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, COUNT(DISTINCT(siteid)) impact FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 
      (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`) AND TOTAL_OUTAGE_ALARM_SECONDS != 0 AND ns = "ns denpasar"
      GROUP BY WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)), class, main_problems)a
      RIGHT JOIN(
      SELECT MAIN_PROBLEMS, class FROM `ict_avail_davina_master_all_site` WHERE TOTAL_OUTAGE_ALARM_SECONDS != 0 AND MAIN_PROBLEMS != "exclude" GROUP BY class, MAIN_PROBLEMS) b
      ON a.main_problems = b.main_problems AND a.class = b.class
      ORDER BY class, FIELD(b.MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';

$e2 = 'SELECT b.class, b.main_problems, IFNULL(freq,0) freq, IFNULL(impact,0) impact, IFNULL(ROUND(outage/3600,1),0) outage, IFNULL(ROUND((outage/3600)/freq,1),0) MTTR FROM
      (SELECT class, main_problems, COUNT(siteid) freq, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, COUNT(DISTINCT(siteid)) impact FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 
      (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`) AND TOTAL_OUTAGE_ALARM_SECONDS != 0 AND ns = "ns mataram"
      GROUP BY WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)), class, main_problems)a
      RIGHT JOIN(
      SELECT MAIN_PROBLEMS, class FROM `ict_avail_davina_master_all_site` WHERE TOTAL_OUTAGE_ALARM_SECONDS != 0 AND MAIN_PROBLEMS != "exclude" GROUP BY class, MAIN_PROBLEMS) b
      ON a.main_problems = b.main_problems AND a.class = b.class
      ORDER BY class, FIELD(b.MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';

$f2 = 'SELECT b.class, b.main_problems, IFNULL(freq,0) freq, IFNULL(impact,0) impact, IFNULL(ROUND(outage/3600,1),0) outage, IFNULL(ROUND((outage/3600)/freq,1),0) MTTR FROM
      (SELECT class, main_problems, COUNT(siteid) freq, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, COUNT(DISTINCT(siteid)) impact FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 
      (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`) AND TOTAL_OUTAGE_ALARM_SECONDS != 0 
      GROUP BY WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)), class, main_problems)a
      RIGHT JOIN(
      SELECT MAIN_PROBLEMS, class FROM `ict_avail_davina_master_all_site` WHERE TOTAL_OUTAGE_ALARM_SECONDS != 0 AND MAIN_PROBLEMS != "exclude" GROUP BY class, MAIN_PROBLEMS) b
      ON a.main_problems = b.main_problems AND a.class = b.class
      ORDER BY class, FIELD(b.MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';
$g2 = 'SELECT b.class, b.main_problems, IFNULL(freq,0) freq, IFNULL(impact,0) impact, IFNULL(ROUND(outage/3600,1),0) outage, IFNULL(ROUND((outage/3600)/freq,1),0) MTTR FROM
      (SELECT class, main_problems, COUNT(siteid) freq, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, COUNT(DISTINCT(siteid)) impact FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 
      (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`) AND TOTAL_OUTAGE_ALARM_SECONDS != 0 AND rtpo = "bali barat"
      GROUP BY WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)), class, main_problems)a
      RIGHT JOIN(
      SELECT MAIN_PROBLEMS, class FROM `ict_avail_davina_master_all_site` WHERE TOTAL_OUTAGE_ALARM_SECONDS != 0 AND MAIN_PROBLEMS != "exclude" GROUP BY class, MAIN_PROBLEMS) b
      ON a.main_problems = b.main_problems AND a.class = b.class
      ORDER BY class, FIELD(b.MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';
$h2 = 'SELECT b.class, b.main_problems, IFNULL(freq,0) freq, IFNULL(impact,0) impact, IFNULL(ROUND(outage/3600,1),0) outage, IFNULL(ROUND((outage/3600)/freq,1),0) MTTR FROM
      (SELECT class, main_problems, COUNT(siteid) freq, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, COUNT(DISTINCT(siteid)) impact FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 
      (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`) AND TOTAL_OUTAGE_ALARM_SECONDS != 0 AND rtpo = "bali timur"
      GROUP BY WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)), class, main_problems)a
      RIGHT JOIN(
      SELECT MAIN_PROBLEMS, class FROM `ict_avail_davina_master_all_site` WHERE TOTAL_OUTAGE_ALARM_SECONDS != 0 AND MAIN_PROBLEMS != "exclude" GROUP BY class, MAIN_PROBLEMS) b
      ON a.main_problems = b.main_problems AND a.class = b.class
      ORDER BY class, FIELD(b.MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';

$z2 = 'SELECT b.class, b.main_problems, IFNULL(freq,0) freq, IFNULL(impact,0) impact, IFNULL(ROUND(outage/3600,1),0) outage, IFNULL(ROUND((outage/3600)/freq,1),0) MTTR FROM
      (SELECT class, main_problems, COUNT(siteid) freq, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, COUNT(DISTINCT(siteid)) impact FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 
      (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`) AND TOTAL_OUTAGE_ALARM_SECONDS != 0 AND rtpo = "mataram"
      GROUP BY WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)), class, main_problems)a
      RIGHT JOIN(
      SELECT MAIN_PROBLEMS, class FROM `ict_avail_davina_master_all_site` WHERE TOTAL_OUTAGE_ALARM_SECONDS != 0 AND MAIN_PROBLEMS != "exclude" GROUP BY class, MAIN_PROBLEMS) b
      ON a.main_problems = b.main_problems AND a.class = b.class
      ORDER BY class, FIELD(b.MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';
$j2 = 'SELECT b.class, b.main_problems, IFNULL(freq,0) freq, IFNULL(impact,0) impact, IFNULL(ROUND(outage/3600,1),0) outage, IFNULL(ROUND((outage/3600)/freq,1),0) MTTR FROM
      (SELECT class, main_problems, COUNT(siteid) freq, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, COUNT(DISTINCT(siteid)) impact FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 
      (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`) AND TOTAL_OUTAGE_ALARM_SECONDS != 0 AND rtpo = "sumbawa"
      GROUP BY WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)), class, main_problems)a
      RIGHT JOIN(
      SELECT MAIN_PROBLEMS, class FROM `ict_avail_davina_master_all_site` WHERE TOTAL_OUTAGE_ALARM_SECONDS != 0 AND MAIN_PROBLEMS != "exclude" GROUP BY class, MAIN_PROBLEMS) b
      ON a.main_problems = b.main_problems AND a.class = b.class
      ORDER BY class, FIELD(b.MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';


$k2 = 'SELECT b.class, b.main_problems, IFNULL(freq,0) freq, IFNULL(impact,0) impact, IFNULL(ROUND(outage/3600,1),0) outage, IFNULL(ROUND((outage/3600)/freq,1),0) MTTR FROM
      (SELECT class, main_problems, COUNT(siteid) freq, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, COUNT(DISTINCT(siteid)) impact FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 
      (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`) AND TOTAL_OUTAGE_ALARM_SECONDS != 0 AND rtpo = "bima"
      GROUP BY WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)), class, main_problems)a
      RIGHT JOIN(
      SELECT MAIN_PROBLEMS, class FROM `ict_avail_davina_master_all_site` WHERE TOTAL_OUTAGE_ALARM_SECONDS != 0 AND MAIN_PROBLEMS != "exclude" GROUP BY class, MAIN_PROBLEMS) b
      ON a.main_problems = b.main_problems AND a.class = b.class
      ORDER BY class, FIELD(b.MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';
$l2 = 'SELECT b.class, b.main_problems, IFNULL(freq,0) freq, IFNULL(impact,0) impact, IFNULL(ROUND(outage/3600,1),0) outage, IFNULL(ROUND((outage/3600)/freq,1),0) MTTR FROM
      (SELECT class, main_problems, COUNT(siteid) freq, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, COUNT(DISTINCT(siteid)) impact FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 
      (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`) AND TOTAL_OUTAGE_ALARM_SECONDS != 0 AND rtpo = "kupang"
      GROUP BY WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)), class, main_problems)a
      RIGHT JOIN(
      SELECT MAIN_PROBLEMS, class FROM `ict_avail_davina_master_all_site` WHERE TOTAL_OUTAGE_ALARM_SECONDS != 0 AND MAIN_PROBLEMS != "exclude" GROUP BY class, MAIN_PROBLEMS) b
      ON a.main_problems = b.main_problems AND a.class = b.class
      ORDER BY class, FIELD(b.MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';

$m2 = 'SELECT b.class, b.main_problems, IFNULL(freq,0) freq, IFNULL(impact,0) impact, IFNULL(ROUND(outage/3600,1),0) outage, IFNULL(ROUND((outage/3600)/freq,1),0) MTTR FROM
      (SELECT class, main_problems, COUNT(siteid) freq, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, COUNT(DISTINCT(siteid)) impact FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 
      (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`) AND TOTAL_OUTAGE_ALARM_SECONDS != 0 AND rtpo = "ruteng"
      GROUP BY WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)), class, main_problems)a
      RIGHT JOIN(
      SELECT MAIN_PROBLEMS, class FROM `ict_avail_davina_master_all_site` WHERE TOTAL_OUTAGE_ALARM_SECONDS != 0 AND MAIN_PROBLEMS != "exclude" GROUP BY class, MAIN_PROBLEMS) b
      ON a.main_problems = b.main_problems AND a.class = b.class
      ORDER BY class, FIELD(b.MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';
$n2 = 'SELECT b.class, b.main_problems, IFNULL(freq,0) freq, IFNULL(impact,0) impact, IFNULL(ROUND(outage/3600,1),0) outage, IFNULL(ROUND((outage/3600)/freq,1),0) MTTR FROM
      (SELECT class, main_problems, COUNT(siteid) freq, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, COUNT(DISTINCT(siteid)) impact FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 
      (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`) AND TOTAL_OUTAGE_ALARM_SECONDS != 0 AND rtpo = "maumere"
      GROUP BY WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)), class, main_problems)a
      RIGHT JOIN(
      SELECT MAIN_PROBLEMS, class FROM `ict_avail_davina_master_all_site` WHERE TOTAL_OUTAGE_ALARM_SECONDS != 0 AND MAIN_PROBLEMS != "exclude" GROUP BY class, MAIN_PROBLEMS) b
      ON a.main_problems = b.main_problems AND a.class = b.class
      ORDER BY class, FIELD(b.MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';
$o2 = 'SELECT b.class, b.main_problems, IFNULL(freq,0) freq, IFNULL(impact,0) impact, IFNULL(ROUND(outage/3600,1),0) outage, IFNULL(ROUND((outage/3600)/freq,1),0) MTTR FROM
      (SELECT class, main_problems, COUNT(siteid) freq, SUM(TOTAL_OUTAGE_ALARM_SECONDS) outage, COUNT(DISTINCT(siteid)) impact FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = 
      (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`) AND TOTAL_OUTAGE_ALARM_SECONDS != 0 AND rtpo = "waingapu"
      GROUP BY WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)), class, main_problems)a
      RIGHT JOIN(
      SELECT MAIN_PROBLEMS, class FROM `ict_avail_davina_master_all_site` WHERE TOTAL_OUTAGE_ALARM_SECONDS != 0 AND MAIN_PROBLEMS != "exclude" GROUP BY class, MAIN_PROBLEMS) b
      ON a.main_problems = b.main_problems AND a.class = b.class
      ORDER BY class, FIELD(b.MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';




$que3 = mysqli_query($con, $c2);
while ($i = mysqli_fetch_array($que3)) {
  if ($i['class'] == "Bronze") {
    $kpgmttr["Bronze"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Silver") {
    $kpgmttr["Silver"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Gold") {
    $kpgmttr["Gold"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Platinum") {
    $kpgmttr["Platinum"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Diamond") {
    $kpgmttr["Diamond"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
};


$que4 = mysqli_query($con, $d2);
while ($i = mysqli_fetch_array($que4)) {
  if ($i['class'] == "Bronze") {
    $dpsmttr["Bronze"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Silver") {
    $dpsmttr["Silver"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Gold") {
    $dpsmttr["Gold"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Platinum") {
    $dpsmttr["Platinum"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Diamond") {
    $dpsmttr["Diamond"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
};


$que5 = mysqli_query($con, $e2);
while ($i = mysqli_fetch_array($que5)) {
  if ($i['class'] == "Bronze") {
    $mtrmttr["Bronze"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Silver") {
    $mtrmttr["Silver"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Gold") {
    $mtrmttr["Gold"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Platinum") {
    $mtrmttr["Platinum"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Diamond") {
    $mtrmttr["Diamond"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
};


$que6 = mysqli_query($con, $f2);
while ($i = mysqli_fetch_array($que6)) {
  if ($i['class'] == "Bronze") {
    $r7mttr["Bronze"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Silver") {
    $r7mttr["Silver"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Gold") {
    $r7mttr["Gold"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Platinum") {
    $r7mttr["Platinum"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Diamond") {
    $r7mttr["Diamond"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
};


$que7 = mysqli_query($con, $g2);
while ($i = mysqli_fetch_array($que7)) {
  if ($i['class'] == "Bronze") {
    $bbmttr["Bronze"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Silver") {
    $bbmttr["Silver"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Gold") {
    $bbmttr["Gold"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Platinum") {
    $bbmttr["Platinum"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Diamond") {
    $bbmttr["Diamond"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
};

$que8 = mysqli_query($con, $h2);
while ($i = mysqli_fetch_array($que8)) {
  if ($i['class'] == "Bronze") {
    $btmttr["Bronze"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Silver") {
    $btmttr["Silver"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Gold") {
    $btmttr["Gold"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Platinum") {
    $btmttr["Platinum"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Diamond") {
    $btmttr["Diamond"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
};


$que9 = mysqli_query($con, $z2);
while ($i = mysqli_fetch_array($que9)) {
  if ($i['class'] == "Bronze") {
    $matmttr["Bronze"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Silver") {
    $matmttr["Silver"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Gold") {
    $matmttr["Gold"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Platinum") {
    $matmttr["Platinum"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Diamond") {
    $matmttr["Diamond"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
};


$que10 = mysqli_query($con, $j2);
while ($i = mysqli_fetch_array($que10)) {
  if ($i['class'] == "Bronze") {
    $summttr["Bronze"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Silver") {
    $summttr["Silver"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Gold") {
    $summttr["Gold"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Platinum") {
    $summttr["Platinum"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Diamond") {
    $summttr["Diamond"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
};


$que11 = mysqli_query($con, $k2);
while ($i = mysqli_fetch_array($que11)) {
  if ($i['class'] == "Bronze") {
    $bimmttr["Bronze"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Silver") {
    $bimmttr["Silver"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Gold") {
    $bimmttr["Gold"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Platinum") {
    $bimmttr["Platinum"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Diamond") {
    $bimmttr["Diamond"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
};


$que12 = mysqli_query($con, $l2);
while ($i = mysqli_fetch_array($que12)) {
  if ($i['class'] == "Bronze") {
    $kupmttr["Bronze"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Silver") {
    $kupmttr["Silver"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Gold") {
    $kupmttr["Gold"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Platinum") {
    $kupmttr["Platinum"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Diamond") {
    $kupmttr["Diamond"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
};


$que13 = mysqli_query($con, $m2);
while ($i = mysqli_fetch_array($que13)) {
  if ($i['class'] == "Bronze") {
    $rtgmttr["Bronze"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Silver") {
    $rtgmttr["Silver"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Gold") {
    $rtgmttr["Gold"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Platinum") {
    $rtgmttr["Platinum"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Diamond") {
    $rtgmttr["Diamond"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
};

$que14 = mysqli_query($con, $n2);
while ($i = mysqli_fetch_array($que14)) {
  if ($i['class'] == "Bronze") {
    $maumttr["Bronze"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Silver") {
    $maumttr["Silver"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Gold") {
    $maumttr["Gold"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Platinum") {
    $maumttr["Platinum"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Diamond") {
    $maumttr["Diamond"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
};


$que15 = mysqli_query($con, $o2);
while ($i = mysqli_fetch_array($que15)) {
  if ($i['class'] == "Bronze") {
    $waimttr["Bronze"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Silver") {
    $waimttr["Silver"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Gold") {
    $waimttr["Gold"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Platinum") {
    $waimttr["Platinum"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
  if ($i['class'] == "Diamond") {
    $waimttr["Diamond"][] = array(
      'freq' => $i['freq'],
      'impact' => $i['impact'],
      'mttr' => $i['MTTR']
    );
  }
};


$que2 = mysqli_query($con, $b2);
while ($k = mysqli_fetch_object($que2)) {
  $mpr7['Bronze'][] = $k->r7bro;
  $mpr7['Silver'][] = $k->r7sil;
  $mpr7['Gold'][] = $k->r7gold;
  $mpr7['Platinum'][] = $k->r7pla;
  $mpr7['Diamond'][] = $k->r7dia;
  $mpdps['Bronze'][] = $k->dpsbro;
  $mpdps['Silver'][] = $k->dpssil;
  $mpdps['Gold'][] = $k->dpsgol;
  $mpdps['Platinum'][] = $k->dpspla;
  $mpdps['Diamond'][] = $k->dpsdia;
  $mpmtr['Bronze'][] = $k->mtrbro;
  $mpmtr['Silver'][] = $k->mtrsil;
  $mpmtr['Gold'][] = $k->mtrgol;
  $mpmtr['Platinum'][] = $k->mtrpla;
  $mpmtr['Diamond'][] = $k->mtrdia;
  $mpkpg['Bronze'][] = $k->kpgbro;
  $mpkpg['Silver'][] = $k->kpgsil;
  $mpkpg['Gold'][] = $k->kpggol;
  $mpkpg['Platinum'][] = $k->kpgpla;
  $mpkpg['Diamond'][] = $k->kpgdia;
  $mpkup['Bronze'][] = $k->kupbro;
  $mpkup['Silver'][] = $k->kupsil;
  $mpkup['Gold'][] = $k->kupgol;
  $mpkup['Platinum'][] = $k->kuppla;
  $mpkup['Diamond'][] = $k->kupdia;
  $mprtg['Bronze'][] = $k->rtgbro;
  $mprtg['Silver'][] = $k->rtgsil;
  $mprtg['Gold'][] = $k->rtggol;
  $mprtg['Platinum'][] = $k->rtgpla;
  $mprtg['Diamond'][] = $k->rtgdia;
  $mpmau['Bronze'][] = $k->maubro;
  $mpmau['Silver'][] = $k->mausil;
  $mpmau['Gold'][] = $k->maugol;
  $mpmau['Platinum'][] = $k->maupla;
  $mpmau['Diamond'][] = $k->maudia;
  $mpwai['Bronze'][] = $k->waibro;
  $mpwai['Silver'][] = $k->waisil;
  $mpwai['Gold'][] = $k->waigol;
  $mpwai['Platinum'][] = $k->waipla;
  $mpwai['Diamond'][] = $k->waidia;
  $mpmat['Bronze'][] = $k->matbro;
  $mpmat['Silver'][] = $k->matsil;
  $mpmat['Gold'][] = $k->matgol;
  $mpmat['Platinum'][] = $k->matpla;
  $mpmat['Diamond'][] = $k->matdia;
  $mpbim['Bronze'][] = $k->bimbro;
  $mpbim['Silver'][] = $k->bimsil;
  $mpbim['Gold'][] = $k->bimgol;
  $mpbim['Platinum'][] = $k->bimpla;
  $mpbim['Diamond'][] = $k->bimdia;
  $mpsum['Bronze'][] = $k->sumbro;
  $mpsum['Silver'][] = $k->sumsil;
  $mpsum['Gold'][] = $k->sumgol;
  $mpsum['Platinum'][] = $k->sumpla;
  $mpsum['Diamond'][] = $k->sumdia;
  $mpbb['Bronze'][] = $k->bbbro;
  $mpbb['Silver'][] = $k->bbsil;
  $mpbb['Gold'][] = $k->bbgol;
  $mpbb['Platinum'][] = $k->bbpla;
  $mpbb['Diamond'][] = $k->bbdia;
  $mpbt['Bronze'][] = $k->btbro;
  $mpbt['Silver'][] = $k->btsil;
  $mpbt['Gold'][] = $k->btgol;
  $mpbt['Platinum'][] = $k->btpla;
  $mpbt['Diamond'][] = $k->btdia;
};

$que = mysqli_query($con, $a2);
while ($t = mysqli_fetch_object($que)) {
  $wee[] = $t->week;
  $wr7['Diamond'][] = $t->diareg7;
  $wr7['Platinum'][] = $t->plareg7;
  $wr7['Gold'][] = $t->golreg7;
  $wr7['Silver'][] = $t->silreg7;
  $wr7['Bronze'][] = $t->broreg7;
  $dps['Diamond'][] = $t->diadps;
  $dps['Platinum'][] = $t->pladps;
  $dps['Gold'][] = $t->goldps;
  $dps['Silver'][] = $t->sildps;
  $dps['Bronze'][] = $t->brodps;
  $mtr['Diamond'][] = $t->diamtr;
  $mtr['Platinum'][] = $t->plamtr;
  $mtr['Gold'][] = $t->golmtr;
  $mtr['Silver'][] = $t->silmtr;
  $mtr['Bronze'][] = $t->bromtr;
  $kup['Diamond'][] = $t->diakup;
  $kup['Platinum'][] = $t->plakup;
  $kup['Gold'][] = $t->golkup;
  $kup['Silver'][] = $t->silkup;
  $kup['Bronze'][] = $t->brokup;
  $kpg['Diamond'][] = $t->diakpg;
  $kpg['Platinum'][] = $t->plakpg;
  $kpg['Gold'][] = $t->golkpg;
  $kpg['Silver'][] = $t->silkpg;
  $kpg['Bronze'][] = $t->brokpg;
  $mau['Diamond'][] = $t->diamau;
  $mau['Platinum'][] = $t->plamau;
  $mau['Gold'][] = $t->golmau;
  $mau['Silver'][] = $t->silmau;
  $mau['Bronze'][] = $t->bromau;
  $rtg['Diamond'][] = $t->diartg;
  $rtg['Platinum'][] = $t->plartg;
  $rtg['Gold'][] = $t->golrtg;
  $rtg['Silver'][] = $t->silrtg;
  $rtg['Bronze'][] = $t->brortg;
  $wai['Diamond'][] = $t->diawai;
  $wai['Platinum'][] = $t->plawai;
  $wai['Gold'][] = $t->golwai;
  $wai['Silver'][] = $t->silwai;
  $wai['Bronze'][] = $t->browai;
  $mat['Diamond'][] = $t->diamat;
  $mat['Platinum'][] = $t->plamat;
  $mat['Gold'][] = $t->golmat;
  $mat['Silver'][] = $t->silmat;
  $mat['Bronze'][] = $t->bromat;
  $bim['Diamond'][] = $t->diabim;
  $bim['Platinum'][] = $t->plabim;
  $bim['Gold'][] = $t->golbim;
  $bim['Silver'][] = $t->silbim;
  $bim['Bronze'][] = $t->brobim;
  $sum['Diamond'][] = $t->diasum;
  $sum['Platinum'][] = $t->plasum;
  $sum['Gold'][] = $t->golsum;
  $sum['Silver'][] = $t->silsum;
  $sum['Bronze'][] = $t->brosum;
  $bb['Diamond'][] = $t->diabb;
  $bb['Platinum'][] = $t->plabb;
  $bb['Gold'][] = $t->golbb;
  $bb['Silver'][] = $t->silbb;
  $bb['Bronze'][] = $t->brobb;
  $bt['Diamond'][] = $t->diabt;
  $bt['Platinum'][] = $t->plabt;
  $bt['Gold'][] = $t->golbt;
  $bt['Silver'][] = $t->silbt;
  $bt['Bronze'][] = $t->brobt;
};


$data2['week'] = $wee;
$data2['Reg7'] = $wr7;
$data2['Reg7']['mttr'] = $r7mttr;
$data2['pie']['Reg7'] = $mpr7;
$data2['Kpg'] = $kup;
$data2['Kpg']['mttr'] = $kpgmttr;
$data2['pie']['Kpg'] = $mpkpg;
$data2['Mtr'] = $mtr;
$data2['Mtr']['mttr'] = $mtrmttr;
$data2['pie']['Mtr'] = $mpmtr;
$data2['Dps'] = $dps;
$data2['Dps']['mttr'] = $dpsmttr;
$data2['pie']['Dps'] = $mpdps;
$data2['Kupang'] = $kpg;
$data2['pie']['Kupang'] = $mpkup;
$data2['Kupang']['mttr'] = $kupmttr;
$data2['Maumere'] = $mau;
$data2['pie']['Maumere'] = $mpmau;
$data2['Maumere']['mttr'] = $maumttr;
$data2['Ruteng'] = $rtg;
$data2['pie']['Ruteng'] = $mprtg;
$data2['Ruteng']['mttr'] = $rtgmttr;
$data2['Waingapu'] = $wai;
$data2['pie']['Waingapu'] = $mpwai;
$data2['Waingapu']['mttr'] = $waimttr;
$data2['Mataram'] = $mat;
$data2['pie']['Mataram'] = $mpmat;
$data2['Mataram']['mttr'] = $matmttr;
$data2['Sumbawa'] = $sum;
$data2['pie']['Sumbawa'] = $mpsum;
$data2['Sumbawa']['mttr'] = $summttr;
$data2['Bima'] = $bim;
$data2['pie']['Bima'] = $mpbim;
$data2['Bima']['mttr'] = $bimmttr;
$data2['Bali Barat'] = $bb;
$data2['Bali Barat']['mttr'] = $bbmttr;
$data2['pie']['Bali Barat'] = $mpbb;
$data2['Bali Timur'] = $bt;
$data2['Bali Timur']['mttr'] = $btmttr;
$data2['pie']['Bali Timur'] = $mpbt;
$mp['mp'] = ['PWR', 'TRM', 'HW', 'OT'];
$data2['mp'] = $mp;


// $pie['pie'] = $mp;
// $pie['pie']['Reg7'] = $mpr7;
// $pie['pie']['Dps'] = $mpdps;
// $pie['pie']['Mtr'] = $mpmtr;
// $pie['pie']['Kpg'] = $mpkpg;




print_r(json_encode($data2, JSON_NUMERIC_CHECK));
