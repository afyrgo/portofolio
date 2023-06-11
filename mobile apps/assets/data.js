const data = {
   avail: [
      {
         id: 'REG7',
         line: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            datasets: [
               { data: [99.23, 99.28, 99.38, 99.38, 99.57, 99.56, 99.72, 99.77, 99.76] },
               { data: [99.77, 99.86, 99.84, 99.83, 99.94, 99.83, 99.87, 99.83, 99.8] },
               { data: [99.42, 99.69, 99.43, 99.42, 99.67, 99.76, 99.83, 99.86, 99.88] },
               { data: [98.34, 98.16, 98.78, 98.77, 99.02, 99.07, 99.45, 99.61, 99.62] },
            ],
            legend: ['reg7', 'dps', 'mtr', 'kpg'],
         },
         pie: [
            { name: 'power', outage: 292160098, color: 'darkslategrey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
            { name: 'transmisi', outage: 67120432, color: 'grey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
            { name: 'other', outage: 43885616, color: 'darkgrey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
            { name: 'hardware', outage: 4903602, color: 'lightgrey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
         ],
      },
      {
         id: 'DPS',
         line: {
            legend: ['bali barat', 'bali timur'],
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            datasets: [
               { data: [99.73, 99.83, 99.81, 99.79, 99.95, 99.78, 99.84, 99.79, 99.75] },
               { data: [99.94, 99.97, 99.92, 99.93, 99.94, 99.99, 99.96, 99.98, 99.96] },
            ],
         },
         pie: [
            { name: 'power', outage: 11009229, color: 'darkslategrey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
            { name: 'transmisi', outage: 12278814, color: 'grey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
            { name: 'other', outage: 11487775, color: 'darkgrey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
            { name: 'hardware', outage: 3497348, color: 'lightgrey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
         ],
      },
      {
         id: 'MTR',
         line: {
            legend: ['mataram', 'bima', 'sumbawa'],
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            datasets: [
               { data: [99.43, 99.71, 99.48, 99.58, 99.75, 99.81, 99.87, 99.89, 99.87] },
               { data: [99.6, 99.6, 99.47, 99.14, 99.54, 99.73, 99.91, 99.82, 99.94] },
               { data: [99.24, 99.69, 99.19, 99.14, 99.52, 99.62, 99.61, 99.81, 99.85] },
            ],
         },
         pie: [
            { name: 'power', outage: 51929056, color: 'darkslategrey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
            { name: 'transmisi', outage: 25337411, color: 'grey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
            { name: 'other', outage: 7453787, color: 'darkgrey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
            { name: 'hardware', outage: 150824, color: 'lightgrey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
         ],
      },
      {
         id: 'KPG',
         line: {
            legend: ['kupang', 'ruteng', 'maumere', 'waingapu'],
            datasets: [
               { data: [98.79, 98.4, 99.06, 98.77, 99.06, 99.04, 99.37, 99.46, 99.81] },
               { data: [98.76, 98.22, 98.89, 99.08, 99.26, 99.24, 99.52, 99.72, 99.37] },
               { data: [96.48, 96.43, 97.66, 98.33, 98.53, 98.56, 99.3, 99.6, 99.25] },
               { data: [99.3, 99.82, 99.5, 99, 99.31, 99.65, 99.77, 99.85, 99.99] },
            ],
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
         },
         pie: [
            { name: 'power', outage: 229221813, color: 'darkslategrey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
            { name: 'transmisi', outage: 29504207, color: 'grey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
            { name: 'other', outage: 24944054, color: 'darkgrey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
            { name: 'hardware', outage: 1255430, color: 'lightgrey', legendFontColor: '#7F7F7F', legendFontSize: 8 },
         ],
      },
   ],
   ach: {
      kab: { week: 35, lvl: 'Kabupaten', total: 4, dia: 0, pla: 2, gol: 0, sil: 1, bron: 1 },
      site: { week: 35, lvl: 'Site', total: 50, dia: 0, pla: 3, gol: 19, sil: 15, bron: 13 },
   },
}
