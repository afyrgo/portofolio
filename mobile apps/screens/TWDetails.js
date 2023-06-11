import React from 'react'
import { SafeAreaView, Text, View, Image, StyleSheet, Dimensions } from 'react-native'
import { BarChart, PieChart } from 'react-native-chart-kit'
import { StatusBar } from 'expo-status-bar'
import Backbutton from '../component/backbutton'
import { useNavigation } from '@react-navigation/native'
import EStyleSheet from 'react-native-extended-stylesheet'

const TWDetails = ({ route }) => {
   const { height, width } = Dimensions.get('screen')
   var datac = route.params.dataz
   const navigation = useNavigation()
   const target = (x) => {
      if (x == 'Diamond') return '99.4'
      if (x == 'Platinum') return '99.0'
      if (x == 'Gold') return '98.4'
      if (x == 'Silver') return '97.0'
      if (x == 'Bronze') return '95.0'
   }
   return (
      <SafeAreaView style={{ backgroundColor: 'black' }}>
         <StatusBar style="light" />
         <View style={{ flex: 1, flexDirection: 'column' }}>
            <View style={{ flex: 1 }}>
               <Image
                  source={require('../assets/bg.png')}
                  resizeMode="stretch"
                  style={{ height: height, width: width }}
               ></Image>
               <Backbutton handlepress={() => navigation.goBack()} />
            </View>
            <View
               style={{
                  flexDirection: 'column',
                  borderColor: 'white',
                  borderWidth: 0,
                  height: height * 0.85,
                  justifyContent: 'flex-start',
                  top: width * 0.15,
                  margin: '5%',
               }}
            >
               <BarChart
                  data={datac.graph}
                  fromZero={true}
                  width={width}
                  height={width * 0.45}
                  chartConfig={chartConfig}
                  verticalLabelRotation={0}
                  withHorizontalLabels={false}
                  withInnerLines={false}
                  showBarTops={false}
                  showValuesOnTopOfBars={true}
                  paddingTop={0}
                  style={{
                     left: '-15%',
                  }}
               />
               <View style={{ top: '2.5%' }}>
                  <Text style={styles.siteid}>{datac.siteid}</Text>
                  <Text style={styles.name}>{datac.name.toUpperCase()}</Text>
                  <View
                     style={{ height: '4%', width: '70%', backgroundColor: 'white', top: 12, borderRadius: 30 }}
                  ></View>
                  <View style={{ flexDirection: 'row', justifyContent: 'flex-start', alignItems: 'center' }}>
                     <Text style={styles.ns}>{datac.ns}</Text>
                     <Text style={styles.to}>{datac.to.toUpperCase()}</Text>
                  </View>
                  <Text style={styles.class}>{datac.class.toUpperCase()}</Text>
               </View>
               <View style={styles.container}>
                  <Text style={styles.ava}>AVAILABILITY{'      '}</Text>
                  <Text style={styles.avail}>{datac.avail}</Text>
                  <Text style={styles.percent}>%</Text>
               </View>

               <View style={styles.container2}>
                  <Text style={styles.out}>OUTAGE</Text>
                  <Text style={styles.outot}>{datac.outage} hr</Text>
                  <Text style={styles.text}>Power : {datac.pie[0].outage} hr</Text>
                  <Text style={styles.text}>Transmisi : {datac.pie[1].outage} hr</Text>
                  <Text style={styles.text}>Hardware : {datac.pie[2].outage} hr</Text>
                  <Text style={styles.text}>Other : {datac.pie[3].outage} hr</Text>
               </View>
               <View style={styles.pie}>
                  <PieChart
                     data={datac.pie}
                     width={width * 0.8}
                     height={width * 0.4}
                     chartConfig={config}
                     accessor="outage"
                     backgroundColor="transparent"
                     paddingLeft="60"
                     hasLegend={true}
                     center={[30, 4]}
                  />
               </View>
            </View>
         </View>
      </SafeAreaView>
   )
}
const styles = EStyleSheet.create({
   '@media ios': {
      siteid: { top: '7%', fontSize: '2rem', color: 'white', fontWeight: '900' },
      name: { top: '5%', fontSize: '2rem', color: 'white', fontWeight: '400' },
      ns: { top: '5.5%', fontSize: '1.38 rem', color: 'white', fontWeight: '900' },
      to: { top: '5.5%', fontSize: '1.38 rem', color: 'white', fontWeight: '400' },
      class: { top: '13%', fontSize: '1.38 rem', color: 'white', fontWeight: '600' },
      container: {
         flexDirection: 'row',
         justifyContent: 'flex-end',
         top: '13%',
         alignSelf: 'flex-end',
         paddingVertical: '5%',
      },
      ava: { color: 'white', alignSelf: 'center', justifyContent: 'flex-start' },
      avail: { fontSize: '5 rem', color: 'white', fontWeight: '700', alignSelf: 'flex-end' },
      container2: {
         height: '20%',
         width: '41%',
         backgroundColor: 'rgba(255,255,255,0.2)',
         top: '10%',
         left: '0.5%',
         alignSelf: 'flex-start',
         borderRadius: 20,
         alignItems: 'flex-start',
         justifyContent: 'center',
         padding: '4%',
      },
      pie: { top: '-11%', left: '15%' },
      percent: { fontSize: '2rem', color: 'white', fontWeight: '700', alignSelf: 'flex-end', bottom: '5%' },
      text: { fontSize: '0.85rem', color: 'white' },
      out: { fontSize: '1rem', color: 'white', fontWeight: 'bold', top: '1%' },
      outot: { fontSize: '1.5rem', color: 'white', fontWeight: '700' },
   },
   '@media android': {
      siteid: { top: '7%', fontSize: '1.8rem', color: 'white', fontWeight: '900' },
      name: { top: '5%', fontSize: '1.8rem', color: 'white', fontWeight: '400' },
      ns: { top: '5.5%', fontSize: '1.28 rem', color: 'white', fontWeight: '900' },
      to: { top: '5.5%', fontSize: '1.28 rem', color: 'white', fontWeight: '400' },
      class: { top: '13%', fontSize: '1.28 rem', color: 'white', fontWeight: '600' },
      container: {
         flexDirection: 'row',
         justifyContent: 'flex-end',
         top: '6%',
         alignSelf: 'flex-end',
         paddingVertical: '5%',
      },
      ava: { color: 'white', alignSelf: 'center', justifyContent: 'flex-start' },
      avail: { fontSize: '5 rem', color: 'white', fontWeight: '700', alignSelf: 'flex-end' },
   },
   container2: {
      height: '20%',
      width: '43%',
      backgroundColor: 'rgba(255,255,255,0.2)',
      top: '3%',
      left: '-1%',
      alignSelf: 'flex-start',
      borderRadius: 20,
      alignItems: 'flex-start',
      justifyContent: 'center',
      padding: '3%',
   },
   text: { fontSize: '0.75rem', color: 'white', top: '-2%' },
   pie: { top: '-18%', left: '17%' },
   percent: { fontSize: '2rem', color: 'white', fontWeight: '700', alignSelf: 'flex-end', bottom: '5%' },
   out: { fontSize: '1rem', color: 'white', fontWeight: 'bold', top: '5%' },
   outot: { fontSize: '1.5rem', color: 'white', fontWeight: '700' },
})

const chartConfig = {
   backgroundGradientFrom: '#1E2923',
   backgroundGradientFromOpacity: 0,
   backgroundGradientTo: '#08130D',
   backgroundGradientToOpacity: 0,
   color: () => `rgba(255, 255, 255, 1)`,
   strokeWidth: 2, // optional, default 3
   barPercentage: 0.7,
   barRadius: 6,
   propsForVerticalLabels: { fontSize: 7 },
}

const config = {
   decimalPlaces: 1,
   backgroundGradientFromOpacity: 0,
   backgroundGradientToOpacity: 0,
   color: () => `rgba(255, 255, 255, 0.1)`,
   labelColor: () => `rgba(255, 255, 255,1 )`,
   strokeWidth: 2,
   useShadowColorFromDataset: false,
}
export default TWDetails
