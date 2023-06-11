import pandas as pd
from sqlalchemy import create_engine
import pymysql as mysql
from PyQt5.QtWidgets import *
import tkinter as tk
from tkinter.filedialog import askopenfilename
tk.Tk().withdraw()

app = QApplication([])
window = QWidget()
window.setGeometry(0, 0, 400, 300)

layout = QVBoxLayout()
layout2 = QVBoxLayout()
layout3 = QVBoxLayout()
layout4 = QHBoxLayout()
button4 = QPushButton('Update ict_avail_davina')
button = QPushButton('Update master_all_site')
button2 = QPushButton('Update ict_avail_enom')
button3 = QPushButton('Exit')
button5 = QPushButton('Update dapot_temp')
text = QTextBrowser()
button.setMinimumHeight(30)
button2.setMinimumHeight(30)
button3.setMinimumHeight(30)
button5.setMinimumHeight(30)
button4.setMinimumHeight(100)
layout4.addWidget(button4)
layout2.addWidget(button)
layout2.addWidget(button2)
layout2.addWidget(button5)
layout4.addLayout(layout2)
layout.addLayout(layout4)
layout.addWidget(text)
layout.addWidget(button3)

window.setWindowTitle('Availability Database App (BETA 1.0)')


def close():
    if conn == "True":
        db1.close()
        cursor.close()
        window.close()
    else:
        window.close()


try:
    db1 = mysql.connect(host="10.67.98.98", user="datcen",
                        password="r4t5y6", database="ict", autocommit=True)
    cursor = db1.cursor()
    engine = create_engine("mysql+pymysql://{user}:{pw}@10.67.98.98/{db}".format(user="datcen",
                                                                                 pw="r4t5y6",
                                                                                 db="ict"))
    conn = "True"
    que = "Select max(date) from ict_avail_davina_master_all_site"
    que2 = "Select max(date) from ict_avail_davina"
    que3 = "select max(date) from ict_dapot_temp"
    cursor.execute(que)
    mxdt1 = cursor.fetchone()
    maxdt1 = mxdt1[0]
    cursor.execute(que2)
    mxdt2 = cursor.fetchone()
    maxdt2 = mxdt2[0]
    cursor.execute(que3)
    mxdt3 = cursor.fetchone()
    maxdt3 = mxdt3[0]
    text.setText('last ict_avail_davina update '+str(maxdt2))
    if mxdt1 == mxdt2:
        text.append('master_all_site updated')
    else:
        diffdate = maxdt2 - maxdt1
        diff = str(diffdate).split(",")[0]
        text.append(diff + " need update in master_all_site")
    if maxdt2.month > maxdt3.month:
        mdif = maxdt2.month - maxdt3.month
        text.append('need update ict_dapot_temp')
    else:
        text.append('ict_dapot_temp updated')

    def on_click():
        link = askopenfilename(defaultextension='csv')
        if link != "":
            fname = str(link).split('/')[-1]
            text.setText('inserting '+fname+' to tb ict_avail_davina')
            dt = pd.read_csv(link)
            df = pd.DataFrame(dt)
            maxdate = df['DATE'].max()
            mindate = df['DATE'].min()
            rows2 = len(df)
            try:
                df.to_sql('ict_avail_davina', engine,
                          if_exists="append", index=None)
            except mysql.Error as e:
                text.append(str(e))
            cursor.execute(
                'select * from ict_avail_davina where date between "'+mindate+'" and "'+maxdate+'"')
            rows = cursor.rowcount
            text.append(str(rows) + ' of ' +
                        str(rows2) + ' row(s) updated')
            text.append('Please xcheck the result in mysql')
        else:
            text.setText('no file selected')

    def update_dapot():
        q = "select max(date) from ict_dapot_temp"
        cursor.execute(q)
        mxdt = cursor.fetchone()
        maxdt = mxdt[0]
        link = askopenfilename(defaultextension='csv')
        if link != "":
            fname = str(link).split('/')[-1]
            text.setText('inserting '+fname+' to tb dapot_temp')
            dt = pd.read_csv(link)
            df = pd.DataFrame(dt)
            maxdate = df['DATE'].max()
            rows2 = len(df)
            if maxdate.month == maxdt.month:
                text.setText('dapot sudah update')
            else:
                try:
                    df.to_sql('ict_dapot_temp', engine,
                              if_exists="append", index=None)
                except mysql.Error as e:
                    text.append(str(e))
                cursor.execute(
                    'select * from ict_dapot_temp where month(date)= ' + str(maxdate.month))
                rows = cursor.rowcount
                text.append(str(rows) + ' of ' +
                            str(rows2) + ' row(s) updated')
                text.append('Please xcheck the result in mysql')
        else:
            text.setText('no file selected')

    def update_mas():
        q1 = 'select max(date) from ict_avail_davina'
        q2 = 'select max(date) from ict_avail_davina_master_all_site'
        cursor.execute(q1)
        mdate1 = cursor.fetchone()
        md = mdate1[0]
        cursor.execute(q2)
        mdate2 = cursor.fetchone()
        md2 = mdate2[0]
        if md2 == md:
            text.setText('Data sudah sama / update')
        else:
            if md2.month < md.month:
                q3 = 'select max(date) from ict_avail_davina where month(date) ="' + \
                    str(md2.month)+'"'
                cursor.execute(q3)
                mdate3 = cursor.fetchone()
                md3 = mdate3[0]
                a = md.day
                b = md2.day + 1
                c = md.month
                d = md2.month
                e = md3.day
                f = 1
                while d <= c:
                    while b <= e:
                        if d < 10:
                            g = '0'+str(d)
                        else:
                            g = str(d)
                        if b < 10:
                            h = '0'+str(b)
                        else:
                            h = str(b)
                        q = "INSERT INTO ict_avail_davina_master_all_site (DATE, SITEID, AREA, REGIONAL, NS, RTPO, KABUPATEN, TAC_ENBID_CI, ENODEB_NAME, TOTAL_OUTAGE_ALARM_SECONDS, TOTAL_EVENT_ALARM, AVAILABILITY, CLASS_DAVINA, CLASS, TARGET, ACHIEVE, FLAG, TOWER_PROVIDER, VENDOR_FMC, KPI, ROOT_CAUSE, MAIN_PROBLEMS, DETAIL_PROBLEMS, REMARK_DETAIL_PROBLEM) SELECT '"+str(
                            md.year)+"-"+g+"-"+h+"' AS DATE,a.siteid, IFNULL(b.area, 'AREA3'), IFNULL(b.regional,'REGIONAL7'), a.NS, a.RTPO, a.KABUPATEN, IFNULL(TAC_ENBID_CI,'None'), a.site_name, IFNULL(total_outage_alarm_seconds,0), IFNULL(TOTAL_EVENT_ALARM,0), IFNULL(AVAILABILITY,100), IFNULL(b.class_davina,a.class), IFNULL(b.class, a.class), a.target, IFNULL(achieve,1), IFNULL(flag,''), IFNULL(tower_provider,a.tp), IFNULL(vendor_fmc,''), IFNULL(kpi,'TRUE'), IFNULL(ROOT_CAUSE,''), IFNULL(main_problems,''), IFNULL(detail_problems,''), ''FROM(SELECT * FROM ict_dapot_temp where month(date) = "+str(d)+")a LEFT JOIN(SELECT * FROM ict_avail_davina WHERE DATE = '"+str(
                            md.year)+"-"+g+"-"+h+"')b ON a.siteid = b.siteid"
                        cursor.exccute(q)
                        b += 1
                    d += 1
                    while f <= a:
                        if d < 10:
                            g = '0'+str(d)
                        else:
                            g = str(d)
                        if f < 10:
                            h = '0'+str(f)
                        else:
                            h = str(f)
                        q = "INSERT INTO ict_avail_davina_master_all_site (DATE, SITEID, AREA, REGIONAL, NS, RTPO, KABUPATEN, TAC_ENBID_CI, ENODEB_NAME, TOTAL_OUTAGE_ALARM_SECONDS, TOTAL_EVENT_ALARM, AVAILABILITY, CLASS_DAVINA, CLASS, TARGET, ACHIEVE, FLAG, TOWER_PROVIDER, VENDOR_FMC, KPI, ROOT_CAUSE, MAIN_PROBLEMS, DETAIL_PROBLEMS, REMARK_DETAIL_PROBLEM) SELECT '"+str(
                            md.year)+"-"+g+"-"+h+"' AS DATE,a.siteid, IFNULL(b.area, 'AREA3'), IFNULL(b.regional,'REGIONAL7'), a.NS, a.RTPO, a.KABUPATEN, IFNULL(TAC_ENBID_CI,'None'), a.site_name, IFNULL(total_outage_alarm_seconds,0), IFNULL(TOTAL_EVENT_ALARM,0), IFNULL(AVAILABILITY,100), IFNULL(b.class_davina,a.class), IFNULL(b.class, a.class), a.target, IFNULL(achieve,1), IFNULL(flag,''), IFNULL(tower_provider,a.tp), IFNULL(vendor_fmc,''), IFNULL(kpi,'TRUE'), IFNULL(ROOT_CAUSE,''), IFNULL(main_problems,''), IFNULL(detail_problems,''), ''FROM(SELECT * FROM ict_dapot_temp where month(date) = "+str(d)+")a LEFT JOIN(SELECT * FROM ict_avail_davina WHERE DATE = '"+str(
                            md.year)+"-"+g+"-"+h+"')b ON a.siteid = b.siteid"
                        cursor.execute(q)
                        f += 1
                text.setText('Done Update ict_avail_davina_master_all_site')
                text.append('mohon di xcheck di mysql')
            else:
                a = md.day
                b = md2.day + 1
                c = md.month
                d = md2.month
                while b <= a:
                    if d < 10:
                        g = '0'+str(d)
                    else:
                        g = str(d)
                    if b < 10:
                        h = '0'+str(b)
                    else:
                        h = str(b)
                    q = "INSERT INTO ict_avail_davina_master_all_site (DATE, SITEID, AREA, REGIONAL, NS, RTPO, KABUPATEN, TAC_ENBID_CI, ENODEB_NAME, TOTAL_OUTAGE_ALARM_SECONDS, TOTAL_EVENT_ALARM, AVAILABILITY, CLASS_DAVINA, CLASS, TARGET, ACHIEVE, FLAG, TOWER_PROVIDER, VENDOR_FMC, KPI, ROOT_CAUSE, MAIN_PROBLEMS, DETAIL_PROBLEMS, REMARK_DETAIL_PROBLEM) SELECT '"+str(
                        md.year)+"-"+g+"-"+h+"' AS DATE,a.siteid, IFNULL(b.area, 'AREA3'), IFNULL(b.regional,'REGIONAL7'), a.NS, a.RTPO, a.KABUPATEN, IFNULL(TAC_ENBID_CI,'None'), a.site_name, IFNULL(total_outage_alarm_seconds,0), IFNULL(TOTAL_EVENT_ALARM,0), IFNULL(AVAILABILITY,100), IFNULL(b.class_davina,a.class), IFNULL(b.class, a.class), a.target, IFNULL(achieve,1), IFNULL(flag,''), IFNULL(tower_provider,a.tp), IFNULL(vendor_fmc,''), IFNULL(kpi,'TRUE'), IFNULL(ROOT_CAUSE,''), IFNULL(main_problems,''), IFNULL(detail_problems,''), ''FROM(SELECT * FROM ict_dapot_temp where month(date) = "+str(d)+")a LEFT JOIN(SELECT * FROM ict_avail_davina WHERE DATE = '"+str(
                        md.year)+"-"+g+"-"+h+"')b ON a.siteid = b.siteid"
                    cursor.execute(q)
                    b += 1
                text.setText('Done Update ict_avail_davina_master_all_site')
                text.append('mohon di xcheck di mysql')

    def update_ae():
        q = "select max(date) from ict_avail_davina_master_all_site"
        cursor.execute(q)
        maxste = cursor.fetchone()
        maxsite = maxste[0]
        q2 = "select max(yearweek(date_add(date, interval 2 day))) from ict_avail_davina_master_all_site"
        cursor.execute(q2)
        max_curyweek = cursor.fetchone()
        max_curryweek = max_curyweek[0]
        q3 = "select date from ict_avail_davina_master_all_site where yearweek(date_add(date, interval 2 day)) ='" + str(
            max_curryweek) + "' group by date"
        cursor.execute(q3)
        if cursor.rowcount < 7:
            a = max_curryweek-1
        else:
            a = max_curryweek
        cursor.execute('truncate ict_avail_enom')

        cursor.execute('insert into ict_avail_enom select "'+str(a) +
                       '",  `SITEID`,`AREA`,`REGIONAL`,`NS`,`RTPO`,`ENODEB_NAME`, "","","","","","","",""  FROM `ict_avail_davina_master_all_site` WHERE DATE = "' + str(maxsite) + '"')
        cursor.execute('Update ict_avail_enom A join (select siteid, 100*(1-(SUM(`TOTAL_OUTAGE_ALARM_SECONDS`)/(60*60*24*7))) AVAIL FROM (SELECT *, DATE_ADD(DATE, INTERVAL 2 DAY) TGL_PALSU FROM ict.`ict_avail_davina`) AVAIL_PALSU WHERE YEARWEEK(TGL_PALSU) = "' +
                       str(a - 3)+'" GROUP BY SITEID) B ON A.`SITEID` = B.SITEID SET A.AVAIL_W1 = B.AVAIL')
        cursor.execute(
            'UPDATE `ict_avail_enom` SET AVAIL_W1 = 100 WHERE AVAIL_W1 = ""')
        cursor.execute('Update ict_avail_enom A join (select siteid, 100*(1-(SUM(`TOTAL_OUTAGE_ALARM_SECONDS`)/(60*60*24*7))) AVAIL FROM (SELECT *, DATE_ADD(DATE, INTERVAL 2 DAY) TGL_PALSU FROM ict.`ict_avail_davina`) AVAIL_PALSU WHERE YEARWEEK(TGL_PALSU) = "' +
                       str(a - 2)+'" GROUP BY SITEID) B ON A.`SITEID` = B.SITEID SET A.AVAIL_W2 = B.AVAIL')
        cursor.execute(
            'UPDATE `ict_avail_enom` SET AVAIL_W2 = 100 WHERE AVAIL_W2 = ""')
        cursor.execute('Update ict_avail_enom A join (select siteid, 100*(1-(SUM(`TOTAL_OUTAGE_ALARM_SECONDS`)/(60*60*24*7))) AVAIL FROM (SELECT *, DATE_ADD(DATE, INTERVAL 2 DAY) TGL_PALSU FROM ict.`ict_avail_davina`) AVAIL_PALSU WHERE YEARWEEK(TGL_PALSU) = "' +
                       str(a - 1)+'" GROUP BY SITEID) B ON A.`SITEID` = B.SITEID SET A.AVAIL_W3 = B.AVAIL')
        cursor.execute(
            'UPDATE `ict_avail_enom` SET AVAIL_W3 = 100 WHERE AVAIL_W3 = ""')
        cursor.execute('Update ict_avail_enom A join (select siteid, 100*(1-(SUM(`TOTAL_OUTAGE_ALARM_SECONDS`)/(60*60*24*7))) AVAIL FROM (SELECT *, DATE_ADD(DATE, INTERVAL 2 DAY) TGL_PALSU FROM ict.`ict_avail_davina`) AVAIL_PALSU WHERE YEARWEEK(TGL_PALSU) = "' +
                       str(a)+'" GROUP BY SITEID) B ON A.`SITEID` = B.SITEID SET A.AVAIL_W4 = B.AVAIL')
        cursor.execute(
            'UPDATE `ict_avail_enom` SET AVAIL_W4 = 100 WHERE AVAIL_W4 = ""')
        cursor.execute('UPDATE ict_avail_enom A JOIN ( SELECT SITEID, 100*(1-(SUM(`TOTAL_OUTAGE_ALARM_SECONDS`)/(60*60*24*7))) AVAIL FROM (SELECT *, DATE_ADD(DATE, INTERVAL 2 DAY) TGL_PALSU FROM ict_avail_davina) AVAIL_PALSU WHERE YEARWEEK(TGL_PALSU) ="' +
                       str(a-3)+'" AND MAIN_PROBLEMS = "POWER PROBLEM*(PW)" GROUP BY SITEID) B ON A.`SITEID` = B.SITEID SET A.AV_POWER_W1 = B.AVAIL')
        cursor.execute(
            ' UPDATE `ict_avail_enom` SET AV_POWER_W1 = 100 WHERE AV_POWER_W1 = ""')
        cursor.execute('UPDATE ict_avail_enom A JOIN ( SELECT SITEID, 100*(1-(SUM(`TOTAL_OUTAGE_ALARM_SECONDS`)/(60*60*24*7))) AVAIL FROM (SELECT *, DATE_ADD(DATE, INTERVAL 2 DAY) TGL_PALSU FROM ict_avail_davina) AVAIL_PALSU WHERE YEARWEEK(TGL_PALSU) ="' +
                       str(a-2)+'" AND MAIN_PROBLEMS = "POWER PROBLEM*(PW)" GROUP BY SITEID) B ON A.`SITEID` = B.SITEID SET A.AV_POWER_W2 = B.AVAIL')
        cursor.execute(
            ' UPDATE `ict_avail_enom` SET AV_POWER_W2 = 100 WHERE AV_POWER_W2 = ""')
        cursor.execute('UPDATE ict_avail_enom A JOIN ( SELECT SITEID, 100*(1-(SUM(`TOTAL_OUTAGE_ALARM_SECONDS`)/(60*60*24*7))) AVAIL FROM (SELECT *, DATE_ADD(DATE, INTERVAL 2 DAY) TGL_PALSU FROM ict_avail_davina) AVAIL_PALSU WHERE YEARWEEK(TGL_PALSU) ="' +
                       str(a-1)+'" AND MAIN_PROBLEMS = "POWER PROBLEM*(PW)" GROUP BY SITEID) B ON A.`SITEID` = B.SITEID SET A.AV_POWER_W3 = B.AVAIL')
        cursor.execute(
            ' UPDATE `ict_avail_enom` SET AV_POWER_W3 = 100 WHERE AV_POWER_W3 = ""')
        cursor.execute('UPDATE ict_avail_enom A JOIN ( SELECT SITEID, 100*(1-(SUM(`TOTAL_OUTAGE_ALARM_SECONDS`)/(60*60*24*7))) AVAIL FROM (SELECT *, DATE_ADD(DATE, INTERVAL 2 DAY) TGL_PALSU FROM ict_avail_davina) AVAIL_PALSU WHERE YEARWEEK(TGL_PALSU) ="' +
                       str(a)+'" AND MAIN_PROBLEMS = "POWER PROBLEM*(PW)" GROUP BY SITEID) B ON A.`SITEID` = B.SITEID SET A.AV_POWER_W4 = B.AVAIL')
        cursor.execute(
            ' UPDATE `ict_avail_enom` SET AV_POWER_W4 = 100 WHERE AV_POWER_W4 = ""')
        cursor.execute(
            'UPDATE ict_avail_enom SET ns = "NOP KUPANG" WHERE ns = "NOP FLORES"')
        text.setText('Update done mohon di xcheck ke web/mysql')

    button.clicked.connect(update_mas)
    button2.clicked.connect(update_ae)
    button5.clicked.connect(update_dapot)
    button4.clicked.connect(on_click)

except:
    conn = "False"
    text.setText('koneksi ke db gagal')

button3.clicked.connect(close)

window.setLayout(layout)
window.show()
app.exec()
