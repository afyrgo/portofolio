import { StyleSheet, Text, View, Dimensions } from 'react-native'
import React, { Component } from 'react'
import { BarChart } from 'react-native-chart-kit'

const Quota = ({ datax }) => {
   const { height, width } = Dimensions.get('screen')
   return (
      <View
         style={{
            height: width * 0.4,
            alignSelf: 'center',
            alignItems: 'flex-start',
            justifyContent: 'center',
            borderRadius: 30,
            borderWidth: 0,
            borderColor: 'white',
         }}
      >
         <Text
            style={{
               color: 'white',
               position: 'absolute',
               fontWeight: 'bold',
               alignSelf: 'center',
               top: '4%',
            }}
         >
            Quota {datax.id} {datax.bulan}
         </Text>
         <BarChart
            data={datax.bar}
            fromZero={true}
            width={350}
            height={width * 0.35}
            chartConfig={chartConfig}
            verticalLabelRotation={0}
            withHorizontalLabels={false}
            withInnerLines={false}
            showBarTops={false}
            showValuesOnTopOfBars={true}
            paddingTop={0}
            style={{
               left: '-10%',
               top: '10%',
            }}
         />
      </View>
   )
}
export default Quota

const chartConfig = {
   backgroundGradientFrom: '#1E2923',
   backgroundGradientFromOpacity: 0,
   backgroundGradientTo: '#08130D',
   backgroundGradientToOpacity: 0,
   color: () => `rgba(255, 255, 255, 1)`,
   strokeWidth: 2, // optional, default 3
   barPercentage: 0.6,
   barRadius: 6,
   propsForVerticalLabels: { fontSize: 8 },
}
