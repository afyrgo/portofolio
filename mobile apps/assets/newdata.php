<?php
$con = mysqli_connect('localhost', 'root', '', 'ICT');
$maxweek = "select max(week(date_add(date, interval 2 day))) from `ict_avail_davina_master_all_site`";

$a = 'SELECT LEFT(MONTHNAME(DATE),3) MONTH, ROUND(AVG(availability),2) AS reg7,
      ROUND(AVG(CASE WHEN NS = "NS Denpasar" THEN availability END),2) dps,
      ROUND(AVG(CASE WHEN NS = "NS kupang" THEN availability END),2) kpg,
      ROUND(AVG(CASE WHEN NS = "NS MATARAM" THEN availability END),2) mtr,
      ROUND(AVG(CASE WHEN RTPO = "BALI BARAT" THEN availability END),2) dpsB,
      ROUND(AVG(CASE WHEN RTPO = "BALI TIMUR" THEN availability END),2) dpsA,
      ROUND(AVG(CASE WHEN RTPO = "MATARAM" THEN availability END),2) mtrA,
      ROUND(AVG(CASE WHEN RTPO = "BIMA" THEN availability END),2) mtrB,
      ROUND(AVG(CASE WHEN RTPO = "SUMBAWA" THEN availability END),2) mtrC,
      ROUND(AVG(CASE WHEN RTPO = "Kupang" THEN availability END),2) kpgA,
      ROUND(AVG(CASE WHEN RTPO = "Ruteng" THEN availability END),2) kpgB,
      ROUND(AVG(CASE WHEN RTPO = "Maumere" THEN availability END),2) kpgC,
      ROUND(AVG(CASE WHEN RTPO = "Waingapu" THEN availability END),2) kpgD
      FROM `ict_avail_davina_master_all_site` 
      WHERE YEAR(DATE) = "2022"
      GROUP BY MONTH ORDER BY MONTH(DATE)';

$b = 'SELECT MAIN_PROBLEMS, SUM(total_outage_alarm_seconds) reg7,
      SUM( CASE WHEN NS = "NS DENPASAR" THEN TOTAL_OUTAGE_ALARM_SECONDS END)  dps,
      SUM( CASE WHEN NS = "NS MATARAM" THEN TOTAL_OUTAGE_ALARM_SECONDS END)  mtr,
      SUM( CASE WHEN NS = "NS KUPANG" THEN TOTAL_OUTAGE_ALARM_SECONDS END)  kpg
      FROM `ict_avail_davina_master_all_site` WHERE YEAR(DATE) = (SELECT MAX(YEAR(DATE)) 
      FROM `ict_avail_davina_master_all_site`) AND MAIN_PROBLEMS != "0" GROUP BY main_problems ORDER BY FIELD(main_problems,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)")';

$c = 'SELECT WEEK, COUNT(ach) ttl,
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

$d = 'SELECT WEEK, COUNT(ach) ttl, 
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

$e = 'SELECT WEEK, siteid, sitename,ns, rtpo, class, avail FROM(
      SELECT WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) AS WEEK, siteid, class, rtpo, ns, MID(enodeb_name,10,25) sitename, ROUND(AVG(availability),1) avail,
      CASE 
      WHEN class = "DIAMOND" AND AVG(availability) >= 99.4 THEN "Ach"
      WHEN class = "PLATINUM" AND AVG(availability) >= 99 THEN "Ach"
      WHEN class = "GOLD" AND AVG(availability) >= 98.4 THEN "Ach"
      WHEN class = "SILVER" AND AVG(availability) >= 97 THEN "Ach"
      WHEN class = "BRONZE" AND AVG(availability) >= 95 THEN "Ach"
      ELSE "nAch" END AS ach
      FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) 
      FROM `ict_avail_davina_master_all_site`)GROUP BY WEEK, siteid, class)a
      WHERE ach = "Nach" ORDER BY FIELD(class, "Diamond","platinum","Gold","Silver","bronze"),avail';


$f = 'SELECT week, kabupaten, class, avail, ttlsite
      FROM(
      SELECT WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) AS WEEK,kabupaten, class, round(AVG(availability),1) avail, COUNT(DISTINCT(siteid)) ttlsite,
      CASE 
      WHEN class = "DIAMOND" AND AVG(availability) >= 99.4 THEN "Ach"
      WHEN class = "PLATINUM" AND AVG(availability) >= 99 THEN "Ach"
      WHEN class = "GOLD" AND AVG(availability) >= 98.4 THEN "Ach"
      WHEN class = "SILVER" AND AVG(availability) >= 97 THEN "Ach"
      WHEN class = "BRONZE" AND AVG(availability) >= 95 THEN "Ach"
      ELSE "nAch" END AS ach
      FROM `ict_avail_davina_master_all_site` WHERE WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) = (SELECT MAX(WEEK(DATE_ADD(DATE, INTERVAL 2 DAY))) FROM `ict_avail_davina_master_all_site`)  GROUP BY WEEK, kabupaten, class) a
      WHERE ach = "Nach" ORDER BY FIELD(class, "Diamond","platinum","Gold","Silver","bronze")';

$g = 'SELECT month,rtpo,class, round(100*(1-outage/quota),1) quo_usage FROM(
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

$h = 'SELECT WEEK(DATE_ADD(DATE, INTERVAL 2 DAY)) WEEK, siteid, ns, rtpo, class, mid(enodeb_name,10,25) as name,
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
      ORDER BY  FIELD(MAIN_PROBLEMS,"POWER PROBLEM*(PW)","TRANSMISSION PROBLEM*(TR)","HARDWARE PROBLEM*(HW)","OTHERS*(OT)","EXCLUDE")';

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
  $dps2['Diamond'][] = $t->diadps;
  $dps2['Platinum'][] = $t->pladps;
  $dps2['Gold'][] = $t->goldps;
  $dps2['Silver'][] = $t->sildps;
  $dps2['Bronze'][] = $t->brodps;
  $mtr2['Diamond'][] = $t->diamtr;
  $mtr2['Platinum'][] = $t->plamtr;
  $mtr2['Gold'][] = $t->golmtr;
  $mtr2['Silver'][] = $t->silmtr;
  $mtr2['Bronze'][] = $t->bromtr;
  $kup['Diamond'][] = $t->diakup;
  $kup['Platinum'][] = $t->plakup;
  $kup['Gold'][] = $t->golkup;
  $kup['Silver'][] = $t->silkup;
  $kup['Bronze'][] = $t->brokup;
  $kpg2['Diamond'][] = $t->diakpg;
  $kpg2['Platinum'][] = $t->plakpg;
  $kpg2['Gold'][] = $t->golkpg;
  $kpg2['Silver'][] = $t->silkpg;
  $kpg2['Bronze'][] = $t->brokpg;
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

$mp['mp'] = ['PWR', 'TRM', 'HW', 'OT'];


$data2['mp'] = $mp;
$data2['week'] = $wee;
$data2['Reg7'] = $wr7;
$data2['Reg7']['mttr'] = $r7mttr;
$data2['pie']['Reg7'] = $mpr7;


$data2['Kpg'] = $kup;
$data2['Kpg']['mttr'] = $kpgmttr;
$data2['pie']['Kpg'] = $mpkpg;

$data2['Mtr'] = $mtr2;
$data2['Mtr']['mttr'] = $mtrmttr;
$data2['pie']['Mtr'] = $mpmtr;

$data2['Dps'] = $dps2;
$data2['Dps']['mttr'] = $dpsmttr;
$data2['pie']['Dps'] = $mpdps;

$data2['Kupang'] = $kpg2;
$data2['pie']['Kupang'] = $mpkup;
$data2['Kupang']['mttr'] = $kupmttr;


$data2['Maumere'] = $mau;
$data2['pie']['Maumere'] = $mpmau;
$data2['Maumere']['mttr'] = $maumttr;

$data2['mp'] = $mp;
$data2['week'] = $wee;
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


$query = mysqli_query($con, $a);
while ($i = mysqli_fetch_object($query)) {
  $labels[] = $i->MONTH;
  $datar7['data'][] = $i->reg7;
  $datadps['data'][] = $i->dps;
  $datamtr['data'][] = $i->mtr;
  $datakpg['data'][] = $i->kpg;
  $datadpsA['data'][] = $i->dpsA;
  $datadpsB['data'][] = $i->dpsB;
  $datamtrA['data'][] = $i->mtrA;
  $datamtrB['data'][] = $i->mtrB;
  $datamtrC['data'][] = $i->mtrC;
  $datakpgA['data'][] = $i->kpgA;
  $datakpgB['data'][] = $i->kpgB;
  $datakpgC['data'][] = $i->kpgC;
  $datakpgD['data'][] = $i->kpgD;
}


$query2 = mysqli_query($con, $b);
while ($i = mysqli_fetch_array($query2)) {
  if ($i['MAIN_PROBLEMS'] == "POWER PROBLEM*(PW)") {

    $dps[] = array(
      'name' => 'Power',
      'outage' => $i['dps'],
      'color' => 'darkslategrey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );

    $mtr[] = array(
      'name' => 'Power',
      'outage' => $i['mtr'],
      'color' => 'darkslategrey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );

    $kpg[] = array(
      'name' => 'Power',
      'outage' => $i['kpg'],
      'color' => 'darkslategrey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );
    $reg7[] = array(
      'name' => 'Power',
      'outage' => $i['reg7'],
      'color' => 'darkslategrey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );
  }
  if ($i['MAIN_PROBLEMS'] == "TRANSMISSION PROBLEM*(TR)") {

    $dps[] = array(
      'name' => 'Transmisi',
      'outage' => $i['dps'],
      'color' => 'grey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );

    $mtr[] = array(
      'name' => 'Transmisi',
      'outage' => $i['mtr'],
      'color' => 'grey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );

    $kpg[] = array(
      'name' => 'Transmisi',
      'outage' => $i['kpg'],
      'color' => 'grey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );
    $reg7[] = array(
      'name' => 'Transmisi',
      'outage' => $i['reg7'],
      'color' => 'grey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );
  }
  if ($i['MAIN_PROBLEMS'] == "HARDWARE PROBLEM*(HW)") {

    $dps[] = array(
      'name' => 'Hardware',
      'outage' => $i['dps'],
      'color' => 'lightgrey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );

    $mtr[] = array(
      'name' => 'Hardware',
      'outage' => $i['mtr'],
      'color' => 'lightgrey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );

    $kpg[] = array(
      'name' => 'Hardware',
      'outage' => $i['kpg'],
      'color' => 'lightgrey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );
    $reg7[] = array(
      'name' => 'Hardware',
      'outage' => $i['reg7'],
      'color' => 'lightgrey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );
  }
  if ($i['MAIN_PROBLEMS'] == "OTHERS*(OT)") {
    $dps[] = array(
      'name' => 'Others',
      'outage' => $i['dps'],
      'color' => 'darkgrey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );
    $mtr[] = array(
      'name' => 'Others',
      'outage' => $i['mtr'],
      'color' => 'darkgrey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );
    $kpg[] = array(
      'name' => 'Others',
      'outage' => $i['kpg'],
      'color' => 'darkgrey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );
    $reg7[] = array(
      'name' => 'Others',
      'outage' => $i['reg7'],
      'color' => 'darkgrey',
      'legendFontColor' => '#7F7F7F',
      'legendFontSize' => 8
    );
  }
}


$query3 = mysqli_query($con, $c);
while ($i = mysqli_fetch_array($query3)) {
  $sitac = array(
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


$dtdps['labels'] = $labels;
$dtdps['datasets'] = [$datadpsA, $datadpsB];
$dtdps['legend'] = ['Bali Timur', 'Bali Barat'];
$dtmtr['labels'] = $labels;
$dtmtr['datasets'] = [$datamtrA, $datamtrB, $datamtrC];
$dtmtr['legend'] = ['Mataram', 'Bima', 'Sumbawa'];
$dtkpg['labels'] = $labels;
$dtkpg['datasets'] = [$datakpgA, $datakpgB, $datakpgC, $datakpgD];
$dtkpg['legend'] = ['Kupang', 'Ruteng', 'Maumere', 'Waingapu'];
$dtr7['labels'] = $labels;
$dtr7['datasets'] = [$datar7, $datadps, $datamtr, $datakpg];
$dtr7['legend'] = ['Reg7', 'Dps', 'Mtr', 'Kpg'];

$query5 = mysqli_query($con, $e);
$as = 1;
while ($i = mysqli_fetch_array($query5)) {
  $details[] = array(
    'id' => $as,
    'siteid' => $i['siteid'],
    'name' => $i['sitename'],
    'ns' => $i['ns'],
    'to' => $i['rtpo'],
    'class' => $i['class'],
    'avail' => $i['avail']
  );
  $as += 1;
};

$details2 = [];
$query6 = mysqli_query($con, $f);
$l = 1;
while ($i = mysqli_fetch_array($query6)) {
  $details2[] = array(
    'id' => $l,
    'kab' => $i['kabupaten'],
    'populasi' => $i['ttlsite'],
    'class' => $i['class'],
    'avail' => $i['avail']
  );
  $l += 1;
};

$query4 = mysqli_query($con, $d);
while ($i = mysqli_fetch_array($query4)) {
  if ($i['WEEK'] === null) {
    $kabac = array(
      'week' => $sitac['week'],
      'total' => $i['ttl'],
      'lvl' => 'Kabupaten',
      'dia' => $i['dia'],
      'pla' => $i['pla'],
      'gol' => $i['gol'],
      'sil' => $i['sil'],
      'bron' => $i['bron'],
    );
  } else {
    $kabac = array(
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
}

$query7 = mysqli_query($con, $h);
$v = 1;
while ($i = mysqli_fetch_array($query7)) {
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

$query8 = mysqli_query($con, $g);
while ($i = mysqli_fetch_array($query8)) {
  $bulan = $i['month'];
  if ($i['class'] == 'Bronze') {
    $bb['data'][] = $i['quo_usage'];
  }
  if ($i['class'] == 'Silver') {
    $ss['data'][] = $i['quo_usage'];
  }
  if ($i['class'] == 'Gold') {
    $gg['data'][] = $i['quo_usage'];
  }
  if ($i['class'] == 'Platinum') {
    $pp['data'][] = $i['quo_usage'];
  }
  if ($i['class'] == 'Diamond') {
    $ff['data'][] = $i['quo_usage'];
  }
};

$bronze = array(
  'id' => 'Bronze',
  'bulan' => $bulan
);
$bronze['bar'] = array(
  'labels' => ['BT', 'BB', 'MT', 'BM', 'SW', 'KP', 'MM', 'RT', 'WP'],
  'datasets' => [$bb],
);

$silver = array(
  'id' => 'Silver',
  'bulan' => $bulan
);

$silver['bar'] = array(
  'labels' => ['BT', 'BB', 'MT', 'BM', 'SW', 'KP', 'MM', 'RT', 'WP'],
  'datasets' => [$ss],
);

$gold = array(
  'id' => 'Gold',
  'bulan' => $bulan
);

$gold['bar'] = array(
  'labels' => ['BT', 'BB', 'MT', 'BM', 'SW', 'KP', 'MM', 'RT', 'WP'],
  'datasets' => [$gg],
);

$platinum = array(
  'id' => 'Platinum',
  'bulan' => $bulan
);

$platinum['bar'] = array(
  'labels' => ['BT', 'BB', 'MT', 'BM', 'SW', 'KP', 'MM', 'RT', 'WP'],
  'datasets' => [$pp],
);

$diamond = array(
  'id' => 'Diamond',
  'bulan' => $bulan
);

$z['data'] = [0, 0, 0, 0, 0, $ff['data'][0], $ff['data'][1], $ff['data'][2], 0];
$diamond['bar'] = array(
  'labels' => ['BT', 'BB', 'MT', 'BM', 'SW', 'KP', 'MM', 'RT', 'WP'],
  'datasets' => [$z]
);




$data['avail'] =  [array(
  'id' => 'REG7',
  'line' => $dtr7,
  'pie' => $reg7,
  'details' => $data2

), array(
  'id' => 'DPS',
  'line' => $dtdps,
  'pie' => $dps,
  'details' => $data2

), array(
  'id' => 'MTR',
  'line' => $dtmtr,
  'pie' => $mtr,
  'details' => $data2
), array(
  'id' => 'KPG',
  'line' => $dtkpg,
  'pie' => $kpg,
  'details' => $data2
)];

$data['ach']['kab'] = $kabac;
$data['ach']['site'] = $sitac;
$data['ach']['kab']['detail'] = $details2;
$data['ach']['site']['detail'] = $details;
$data['quota'] = [$diamond, $platinum, $gold, $silver, $bronze];
$data['top10'] = $datah;


print_r(json_encode($data, JSON_NUMERIC_CHECK));

file_put_contents("data.json", json_encode($data, JSON_NUMERIC_CHECK));
