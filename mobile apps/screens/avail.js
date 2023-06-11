import 'react-native-gesture-handler'
import React, { useEffect, useState } from 'react'
import { View, Image, StyleSheet, SafeAreaView, Text, Touchable, Pressable } from 'react-native'
import Backbutton from '../component/backbutton'
import { useNavigation } from '@react-navigation/native'
import { StatusBar } from 'expo-status-bar'
import SelectList from 'react-native-dropdown-select-list'
import {
   VictoryTheme,
   VictoryLine,
   VictoryAxis,
   VictoryVoronoiContainer,
   VictoryArea,
   VictoryScatter,
   VictoryChart,
   VictoryTooltip,
   VictoryPie,
} from 'victory-native'

const Avail = ({ route }) => {
   const param = route.params.line.legend[0]
   const daya = route.params.details

   const dtclas = [
      { key: 'Diamond', value: 'Diamond' },
      { key: 'Platinum', value: 'Platinum' },
      { key: 'Gold', value: 'Gold' },
      { key: 'Silver', value: 'Silver' },
      { key: 'Bronze', value: 'Bronze' },
   ]

   const navigation = useNavigation()
   const [isselect, setisselect] = useState(0)
   const [level, setlevel] = useState(param)
   const [selected, setSelected] = useState('Bronze')
   const list = route.params.line.legend

   const convert2 = (lvl, cls) => {
      const p = daya.mp.mp
      const h = daya.pie[lvl][cls]
      const go = p.map((x, index) => ({ x, ['y']: h[index] }))
      return go
   }

   const convert = (lvl, cls) => {
      const i = daya['week']
      const j = daya[lvl][cls]
      const go = i.map((x, index) => ({ x, ['y']: j[index] }))
      return go
   }

   const target = (cls) => {
      let i = daya['week']
      if (cls === 'Diamond') {
         var go = i.map((x, index) => ({
            x,
            ['y']: 99.4,
         }))
      }
      if (cls === 'Platinum') {
         var go = i.map((x, index) => ({
            x,
            ['y']: 99,
         }))
      }
      if (cls === 'Gold') {
         var go = i.map((x, index) => ({
            x,
            ['y']: 98.4,
         }))
      }
      if (cls == 'Silver') {
         var go = i.map((x, index) => ({
            x,
            ['y']: 97,
         }))
      }
      if (cls === 'Bronze') {
         var go = i.map((x, index) => ({
            x,
            ['y']: 95,
         }))
      }
      return go
   }

   return (
      <SafeAreaView style={{ backgroundColor: 'black', flex: 1 }}>
         <StatusBar style="light" />
         <View style={styles.container}>
            <View style={{ flex: 1, position: 'absolute', zIndex: -1 }}>
               <Image source={require('../assets/bg.png')}></Image>
            </View>
            <View style={{ height: 330, borderWidth: 0, borderColor: 'white' }}>
               <View style={{ zIndex: 2 }}>
                  <Backbutton handlepress={() => navigation.goBack()} />
               </View>
               <View>
                  <SelectList
                     setSelected={setSelected}
                     data={dtclas}
                     search={false}
                     boxStyles={{
                        top: 20,
                        borderRadius: 15,
                        width: 93,
                        height: 40,
                        alignSelf: 'flex-end',
                        alignItems: 'center',
                        marginHorizontal: 20,
                        backgroundColor: 'rgba(255,255,255,0.4)',
                        borderWidth: 0,
                     }} //override default styles
                     dropdownStyles={{
                        top: 20,
                        maxWidth: 100,
                        alignSelf: 'flex-end',
                        marginHorizontal: 20,
                        borderWidth: 0,
                        backgroundColor: 'rgba(255,255,255,0.4)',
                     }}
                     inputStyles={{
                        color: 'white',
                        alignSelf: 'center',
                        alignItems: 'center',
                        justifyContent: 'center',
                     }}
                     defaultOption={{ key: 'Bronze', value: 'Bronze' }} //default selected option
                     dropdownTextStyles={{ color: 'white', alignSelf: 'center' }}
                  />
               </View>
               <View
                  style={{
                     top: 80,
                     position: 'absolute',
                     alignSelf: 'center',
                     backgroundColor: 'rgba(200,200,200,0)',
                     height: 350,
                     width: 380,
                     zIndex: -1,
                     borderRadius: 40,
                     left: -28,
                     marginBottom: 0,
                  }}
               >
                  <Text style={{ fontSize: 20, fontWeight: '800', color: 'white', left: 50, top: -5 }}>
                     {level.toUpperCase()}
                  </Text>
                  <Text style={{ color: 'white', left: 50, top: -10, marginBottom: -45 }}>{selected}</Text>
                  <VictoryChart
                     theme={VictoryTheme.grayscale}
                     minDomain={{
                        y: target(selected)[0]['y'] - 0.2,
                        x: convert(level, selected).length - 15,
                     }}
                     maxDomain={{ y: 100.1 }}
                     width={430}
                     containerComponent={
                        <VictoryVoronoiContainer
                           voronoiBlacklist={['target', 'dot']}
                           labels={({ datum }) => `${datum.y}`}
                           labelComponent={<VictoryTooltip dy={-7} />}
                        />
                     }
                  >
                     <VictoryLine
                        name="target"
                        data={target(selected)}
                        style={{ data: { stroke: 'red', strokeDasharray: 6, strokeWidth: 1 } }}
                     />
                     <VictoryScatter
                        animate
                        name="dot"
                        data={convert(level, selected)}
                        style={{ data: { fill: 'white' } }}
                     />
                     <VictoryArea
                        animate
                        interpolation={'natural'}
                        data={convert(level, selected)}
                        style={{ data: { fill: 'grey', fillOpacity: 0.1, stroke: 'white' } }}
                     />
                     <VictoryAxis
                        style={{
                           axis: { stroke: 'transparent' },
                           ticks: { stroke: 'transparent' },
                           tickLabels: { fill: 'white', fontSize: 9 },
                        }}
                     />
                  </VictoryChart>
               </View>
            </View>
            <View
               style={{
                  flexDirection: 'row',
                  justifyContent: 'space-evenly',
                  marginVertical: 15,
                  height: 50,
                  backgroundColor: 'rgba(0,0,0,0.6)',
                  alignItems: 'center',
                  top: 10,
               }}
            >
               {list.map((x, index) => {
                  return (
                     <Pressable
                        key={x}
                        style={isselect == index ? styles.selected : styles.unselected}
                        onPress={() => {
                           setlevel(x)
                           setisselect(index)
                        }}
                     >
                        <Text style={{ color: 'white', textTransform: 'uppercase' }}>{x}</Text>
                     </Pressable>
                  )
               })}
            </View>
            <View
               style={{
                  flexDirection: 'column',
                  alignItems: 'flex-start',
                  top: -10,
               }}
            >
               <Text style={{ color: 'white', top: 20, fontWeight: '800', alignSelf: 'center' }}>
                  RC Distribution W{daya.week.length}
               </Text>
               <View
                  style={{
                     flexDirection: 'row',
                     alignContent: 'flex-start',
                     alignItems: 'flex-start',
                     alignSelf: 'flex-start',
                     justifyContent: 'flex-start',
                     borderWidth: 0,
                     borderColor: 'white',
                     width: '100%',
                     height: 250,
                     top: -5,
                     left: -10,
                  }}
               >
                  <VictoryChart height={270} width={240}>
                     <VictoryPie
                        animate
                        colorScale={['maroon', '#616161', '#909090', 'lightgrey']}
                        data={convert2(level, selected)}
                        innerRadius={50}
                        labelRadius={({ innerRadius }) => innerRadius + 25}
                        labels={({ datum }) => (datum.y !== 0 ? datum.x : '')}
                        labelPlacement={'perpendicular'}
                        labelPosition={'centroid'}
                        padAngle={3}
                        style={{
                           labels: {
                              fill: 'white',
                              fontSize: 9,
                           },
                        }}
                        padding={0}
                     />
                     <VictoryAxis
                        style={{
                           axis: { stroke: 'transparent' },
                           ticks: { stroke: 'transparent' },
                           tickLabels: { fill: 'transparent' },
                        }}
                     />
                  </VictoryChart>
                  <View
                     style={{
                        height: 270,
                        justifyContent: 'center',
                        alignItems: 'flex-start',
                        left: 5,
                        borderWidth: 0,

                        borderColor: 'white',
                     }}
                  >
                     <Text style={{ color: 'white', fontSize: 24, fontWeight: '800' }}>OUTAGE</Text>
                     <Text style={{ color: 'white', fontSize: 16, fontWeight: '800' }}>
                        TOTAL :
                        {Math.round(
                           (daya.pie[level][selected][0] +
                              daya.pie[level][selected][1] +
                              daya.pie[level][selected][2] +
                              daya.pie[level][selected][3]) *
                              10
                        ) / 10}{' '}
                        h
                     </Text>
                     <Text style={{ color: 'white', fontSize: 16 }}>PW : {daya.pie[level][selected][0]} h</Text>
                     <Text style={{ color: 'white', fontSize: 16 }}>TR : {daya.pie[level][selected][1]} h</Text>
                     <Text style={{ color: 'white', fontSize: 16 }}>HW : {daya.pie[level][selected][2]} h</Text>
                     <Text style={{ color: 'white', fontSize: 16 }}>OT : {daya.pie[level][selected][3]} h</Text>
                  </View>
               </View>
               <View
                  style={{
                     flexDirection: 'row',
                     alignSelf: 'center',
                     top: -20,
                     backgroundColor: 'rgba(255,255,255,0.2)',
                     padding: 15,
                     borderRadius: 15,
                  }}
               >
                  <View style={{ flexDirection: 'column', marginRight: 15 }}>
                     <Text style={{ color: 'white', fontWeight: '700' }}>ROOTCAUSE</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>POWER</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>TRANSMISI</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>HARDWARE</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>OTHER</Text>
                  </View>
                  <View style={{ flexDirection: 'column', marginRight: 15 }}>
                     <Text style={{ color: 'white', fontWeight: '700' }}>{}</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>:</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>:</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>:</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>:</Text>
                  </View>
                  <View
                     style={{
                        flexDirection: 'column',
                        alignItems: 'center',
                        marginRight: 15,
                     }}
                  >
                     <Text style={{ color: 'white', fontWeight: '700' }}>EVENT</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>{daya[level]['mttr'][selected][0]['freq']}</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>{daya[level]['mttr'][selected][1]['freq']}</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>{daya[level]['mttr'][selected][2]['freq']}</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>{daya[level]['mttr'][selected][3]['freq']}</Text>
                  </View>
                  <View
                     style={{
                        flexDirection: 'column',
                        alignItems: 'center',
                        marginRight: 10,
                     }}
                  >
                     <Text style={{ color: 'white', fontWeight: '700' }}>IMPACT</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>{daya[level]['mttr'][selected][0]['impact']}</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>{daya[level]['mttr'][selected][1]['impact']}</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>{daya[level]['mttr'][selected][2]['impact']}</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>{daya[level]['mttr'][selected][3]['impact']}</Text>
                  </View>
                  <View
                     style={{
                        flexDirection: 'column',
                        alignItems: 'center',
                     }}
                  >
                     <Text style={{ color: 'white', fontWeight: '700' }}>MTTR</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>{daya[level]['mttr'][selected][0]['mttr']}</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>{daya[level]['mttr'][selected][1]['mttr']}</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>{daya[level]['mttr'][selected][2]['mttr']}</Text>
                     <Text style={{ color: 'white', fontSize: 12 }}>{daya[level]['mttr'][selected][3]['mttr']}</Text>
                  </View>
               </View>
            </View>
         </View>
      </SafeAreaView>
   )
}

export default Avail

const datatable = {
   head: ['Problem', 'Freq', 'Impacted'],
   data: [
      ['PW', 149, 63],
      ['TR', 28, 10],
      ['HW', 0, 0],
      ['OT', 3, 2],
   ],
}

const styles = StyleSheet.create({
   container: {
      flex: 1,
      flexDirection: 'column',
   },
   item: {
      position: 'absolute',
      zIndex: -1,
      height: 800,
   },
   chart: {
      marginBottom: 30,
      padding: 10,
      paddingTop: 20,
      borderRadius: 20,
      width: 375,
      left: '-5%',
   },
   unselected: {
      height: 30,
      borderWidth: 0,
      borderColor: 'white',
      width: 75,
      alignItems: 'center',
      justifyContent: 'center',
      borderRadius: 5,
   },
   selected: {
      height: 30,
      borderWidth: 0,
      borderColor: 'white',
      width: 75,
      alignItems: 'center',
      justifyContent: 'center',
      borderRadius: 30,
      backgroundColor: 'rgba(255,255,255,0.4)',
   },
})
