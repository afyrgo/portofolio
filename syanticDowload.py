import requests
import pandas as pd
import datetime
from datetime import date
import sys
import os

passwrd = os.environ.get('syanticPwd')
username = os.environ.get('syanticUN')
tgl = date.today()-datetime.timedelta(days=1)
a = pd.read_excel('D:/incident data/incident 2023.xlsx',
                  sheet_name='Sheet1')
aa = len(a)+1
ldate = max(a['startTime'])
lasday = pd.to_datetime(ldate)+datetime.timedelta(days=1)
lasday = lasday.date()
try:
    url2 = 'http://syantic.telkomsel.co.id/NOCD2018/apis-nocd-prod/incident/search-rca?category=&region=BALI%20NUSRA&start={}&end={}&search=&page=1&sort=&keySort='.format(
        lasday, tgl)
    r = requests.get(url2, auth=(username, passwrd))
    dt = r.json()

    data = pd.json_normalize(dt['content'])
    df = pd.DataFrame(data)
    df2 = df.loc()

    df2 = df[['escalationType', 'title', 'areaImpact', 'regional', 'department', 'technicalArea', 'startTime', 'endTime', 'duration', 'severity', 'impactNetwork', 'faultList', 'serviceImpact', 'rootCause', 'regional', 'incidentOwner', 'category', 'rt1', 'rt2', 'rt3', 'pic', 'ticket', 'ticketExt', 'ticketStatus', 'resolved', 'incidentTimeLine', 'perwiraJaga', 'otr', 'endTimePartial', 'preventive'
              ]]
    with pd.ExcelWriter('D:/incident data/incident 2023.xlsx', engine='openpyxl', mode='a', if_sheet_exists='overlay') as writer:
        df2.to_excel(writer, sheet_name='Sheet1',
                     startrow=aa, index=None, header=None)
except:
    print('connection error')
finally:
    sys.exit()
