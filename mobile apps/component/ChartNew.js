import React from 'react'
import { View, Text, Dimensions } from 'react-native'
import { LineChart, PieChart } from 'react-native-chart-kit'
import Button from './button'
import { useNavigation } from '@react-navigation/native'

const ChartNew = ({ data }) => {
   const navigation = useNavigation()
   let colors = ['darkslategrey', '#616161', '#909090', 'lightgrey']
   const { height, width } = Dimensions.get('screen')

   Object.keys(data.line.datasets).map((x) => {
      data.line.datasets[x].color = () => colors[x]
   })
   return (
      <View
         style={{
            flexDirection: 'column',
            alignItems: 'center',
            justifyContent: 'flex-start',
            height: height * 0.43,
            width: width * 0.9,
            backgroundColor: `rgba(255,255,255,0.07)`,
            borderBottomLeftRadius: 30,
            borderTopLeftRadius: 30,
            borderTopRightRadius: 30,
            borderBottomRightRadius: 100,
            marginRight: width * 0.04,
            marginLeft: width * 0.06,
         }}
      >
         <Text style={{ color: 'white', fontWeight: 'bold', top: '2%' }}>AVAILABILITY {data.id}</Text>
         <LineChart
            data={data.line}
            width={width * 0.95}
            height={height * 0.2}
            chartConfig={config}
            withDots={true}
            style={{ left: '-1%', top: '4%' }}
         />
         <View style={{ flexDirection: 'row', width: '100%', alignItems: 'flex-start', left: '-8%', top: '4%' }}>
            <PieChart
               data={data.pie}
               width={width * 0.67}
               height={130}
               chartConfig={config}
               accessor="outage"
               backgroundColor="transparent"
               paddingLeft={width * 0.045}
               hasLegend={true}
               center={[18, 5]}
            />
            <Button minWidth={120} handlepress={() => navigation.navigate('Avail', data)} />
         </View>
      </View>
   )
}

export default ChartNew
const config = {
   decimalPlaces: 1,
   backgroundGradientFromOpacity: 0,
   backgroundGradientToOpacity: 0,
   color: () => `rgba(255, 255, 255, 0.1)`,
   labelColor: () => `rgba(255, 255, 255,0.3 )`,
   strokeWidth: 1.5,
   useShadowColorFromDataset: false,
}
