import { View, Text, Pressable, Dimensions } from 'react-native'
import { useNavigation } from '@react-navigation/native'
import React from 'react'
import EStyleSheet from 'react-native-extended-stylesheet'

const Cards2 = ({ data }) => {
   const { height, width } = Dimensions.get('screen')
   const navigation = useNavigation()
   return (
      <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center' }}>
         <Pressable
            onPress={() => navigation.navigate('AchDetails', { data })}
            style={{
               height: width * 0.39,
               width: width * 0.39,
               borderColor: 'white',
               borderWidth: 0,
            }}
         >
            <View style={styles.upper}>
               <Text style={styles.total}>{data.total}</Text>
               <Text style={styles.lvl}>{data.lvl.toUpperCase()}</Text>
               <Text style={styles.nac}>NOT ACHIEVE</Text>
               <Text style={styles.week}>In W{data.week}</Text>
            </View>
            <View style={styles.bottom}>
               <View style={styles.hilight}></View>
               <View style={styles.wrap}>
                  <View style={{ alignItems: 'center' }}>
                     <Text style={{ color: 'white' }}>D</Text>
                     <Text style={styles.detail}>{data.dia}</Text>
                  </View>
                  <View style={{ alignItems: 'center' }}>
                     <Text style={{ color: 'white' }}>P</Text>
                     <Text style={styles.detail}>{data.pla}</Text>
                  </View>
                  <View style={{ alignItems: 'center' }}>
                     <Text style={{ color: 'white' }}>G</Text>
                     <Text style={styles.detail}>{data.gol}</Text>
                  </View>
                  <View style={{ alignItems: 'center' }}>
                     <Text style={{ color: 'white' }}>S</Text>
                     <Text style={styles.detail}>{data.sil}</Text>
                  </View>
                  <View style={{ alignItems: 'center' }}>
                     <Text style={{ color: 'white' }}>B</Text>
                     <Text style={styles.detail}>{data.bron}</Text>
                  </View>
               </View>
            </View>
         </Pressable>
      </View>
   )
}
const styles = EStyleSheet.create({
   total: {
      '@media ios': {
         fontSize: '2.8rem',
         color: 'white',
         fontWeight: '600',
      },
      '@media android': {
         fontSize: '2.3rem',
         color: 'white',
         fontWeight: '600',
      },
   },
   lvl: {
      '@media ios': {
         fontSize: '0.8rem',
         color: 'white',
         top: '-0.4rem',
      },
      '@media android': {
         fontSize: '0.7rem',
         color: 'white',
         top: '-0.4rem',
      },
   },
   nac: {
      '@media ios': {
         fontSize: '0.8rem',
         color: 'white',
         top: '-0.55rem',
         fontWeight: 'bold',
      },
      '@media android': {
         fontSize: '0.7rem',
         color: 'white',
         top: '-0.5rem',
         fontWeight: 'bold',
      },
   },
   wrap: {
      '@media ios': {
         flexDirection: 'row',
         justifyContent: 'space-evenly',
         alignItems: 'center',
         top: '-18%',
      },
      '@media android': {
         flexDirection: 'row',
         justifyContent: 'space-evenly',
         alignItems: 'center',
         top: '-22%',
      },
   },
   detail: {
      '@media ios': { color: 'white', fontSize: '0.9rem', fontWeight: 'bold', top: '0.4rem' },
      '@media android': { color: 'white', fontSize: '0.8rem', top: '0.1rem', fontWeight: 'bold' },
   },
   week: {
      '@media ios': { color: 'white', top: '-0.6rem' },
      '@media android': { color: 'white', top: '-0.7rem' },
   },
   upper: {
      '@media ios': { top: '6%', flexDirection: 'column', alignItems: 'center', justifyContent: 'center' },
      '@media android': { top: '3%', flexDirection: 'column', alignItems: 'center', justifyContent: 'center' },
   },
   bottom: {
      '@media ios': { top: '7%' },
      '@media android': { top: '7%' },
   },
   hilight: {
      '@media ios': { height: '1rem', backgroundColor: 'rgba(255,255,255,0.2)', top: '-20%' },
      '@media android': { height: '1rem', backgroundColor: 'rgba(255,255,255,0.2)', top: '-25%' },
   },
})
export default Cards2
