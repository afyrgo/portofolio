import { View, Text, StyleSheet, TouchableOpacity, Pressable, Dimensions } from 'react-native'
import React from 'react'
import { LineChart } from 'react-native-chart-kit'
import { useNavigation } from '@react-navigation/native'
import { TouchableHighlight } from 'react-native-gesture-handler'
import EStyleSheet from 'react-native-extended-stylesheet'

const Topworst = ({ dataz }) => {
   const { height, width } = Dimensions.get('screen')
   const navagation = useNavigation()
   return (
      <View style={{ height: width * 0.4, width: width * 0.4, borderWidth: 0, borderColor: 'white', borderRadius: 27 }}>
         <Pressable style={styles.wraper} onPress={() => navagation.navigate('TWDetails', { dataz })}>
            <Text style={styles.number}>{dataz.id}</Text>
            <Text style={styles.header}>Top10 Worst</Text>
            <Text style={styles.week}>in W{dataz.week}</Text>
            <Text style={styles.siteid}>{dataz.siteid}</Text>
            <Text style={styles.ns}>
               {dataz.ns} | {dataz.to}
            </Text>
            <Text style={styles.class}>{dataz.class}</Text>
            <View style={styles.divider}></View>
            <Text style={styles.avail}>{dataz.avail}%</Text>
         </Pressable>
      </View>
   )
}
const styles = EStyleSheet.create({
   '@media ios': {
      container: {
         flex: 1,
         flexDirection: 'column',
         paddingVertical: '0.8%',
         borderWidth: 1,
      },
      wraper: { justifyContent: 'center', top: '-5%' },
      number: {
         position: 'absolute',
         zIndex: -1,
         color: 'rgba(255,255,255,0.15)',
         alignSelf: 'flex-end',
         right: '1%',
         top: '4%',
         fontSize: '8.3rem',
         fontWeight: 'bold',
      },
      siteid: {
         alignSelf: 'flex-start',
         marginLeft: '10%',
         color: 'white',
         fontSize: '1.72rem',
         fontWeight: '800',
      },
      header: {
         alignSelf: 'flex-start',
         marginTop: '13%',
         marginLeft: '10%',
         color: 'white',
         fontSize: '1 rem',
         fontWeight: '600',
      },
      ns: {
         alignSelf: 'flex-start',
         top: '-2%',
         marginLeft: '10%',
         color: 'white',
         fontSize: '0.57rem',
         fontWeight: '400',
      },
      avail: {
         alignSelf: 'flex-start',
         top: '1%',
         marginLeft: '10%',
         color: 'white',
         fontSize: '1.9rem',
         fontWeight: '800',
      },
      class: {
         alignSelf: 'flex-start',
         top: '-3%',
         marginLeft: '10%',
         color: 'white',
         fontSize: '1.1rem',
         fontWeight: '600',
      },
      week: { marginLeft: '10%', color: 'white', top: '1%', fontSize: '0.58rem' },
      divider: {
         borderRadius: 10,
         marginHorizontal: '10%',
         height: '4%',
         backgroundColor: 'white',
      },
   },
   '@media android': {
      wraper: {
         justifyContent: 'center',
         paddingTop: '9%',
         borderColor: 'white',
         borderWidth: 0,
      },
      number: {
         position: 'absolute',
         zIndex: -1,
         color: 'rgba(255,255,255,0.15)',
         alignSelf: 'flex-end',
         right: '1%',
         top: '-10%',
         fontSize: '7rem',
         fontWeight: 'bold',
         borderColor: 'white',
         borderWidth: 0,
      },
      siteid: {
         alignSelf: 'flex-start',
         marginLeft: '8%',
         color: 'white',
         fontSize: '1.55 rem',
         fontWeight: '800',
         top: '-6%',
      },
      header: {
         alignSelf: 'flex-start',
         marginLeft: '8%',
         color: 'white',
         fontSize: '0.9 rem',
         fontWeight: '600',
      },
      ns: {
         alignSelf: 'flex-start',
         top: '-10%',
         marginLeft: '10%',
         color: 'white',
         fontSize: '0.57rem',
         fontWeight: '400',
      },
      avail: {
         alignSelf: 'flex-start',
         top: '-15%',
         marginLeft: '10%',
         color: 'white',
         fontSize: '1.9rem',
         fontWeight: '800',
         borderColor: 'white',
         borderWidth: 0,
      },
      class: {
         alignSelf: 'flex-start',
         top: '-14%',
         marginLeft: '10%',
         color: 'white',
         fontSize: '1.1rem',
         fontWeight: '600',
      },
      week: { marginLeft: '10%', color: 'white', top: '-1%', fontSize: '0.58rem' },
      divider: {
         borderRadius: 10,
         marginHorizontal: '10%',
         height: '4%',
         backgroundColor: 'white',
         top: '-13%',
      },
   },
})

export default Topworst
