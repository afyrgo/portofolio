import React from 'react'
import { View, Text, Dimensions } from 'react-native'
import EStyleSheet from 'react-native-extended-stylesheet'

const NotAchieveCards = ({ data }, { index }) => {
   const datam = data.item
   return (
      <View style={styles.container}>
         <Text style={styles.number}>{data.index + 1}</Text>
         <View>
            <Text style={styles.siteid}>{datam.siteid}</Text>
            <Text style={styles.detail2}>{datam.name.toUpperCase()}</Text>
            <View style={{ flexDirection: 'row' }}>
               <Text style={styles.detail}>{datam.ns}</Text>
               <Text style={styles.detail2}>{datam.to}</Text>
            </View>
            <Text style={styles.detail}>{datam.class}</Text>
         </View>
         <Text style={styles.avail}>{datam.avail}</Text>
      </View>
   )
}
const { height, width } = Dimensions.get('screen')
const styles = EStyleSheet.create({
   '@media ios': {
      container: {
         height: width * 0.295,
         width: width * 0.92,
         backgroundColor: 'rgba(255,255,255,0.13)',
         borderRadius: 30,
         flexDirection: 'row',
         alignItems: 'center',
         paddingLeft: '11%',
         paddingRight: '6%',
         marginBottom: '4.2%',
         justifyContent: 'space-between',
      },
      item: {
         position: 'absolute',
         zIndex: -1,
         height: height,
      },
      siteid: {
         fontSize: '1.4rem',
         fontWeight: '900',
         color: 'white',
      },
      number: {
         position: 'absolute',
         left: '2.5%',
         fontSize: '5rem',
         fontWeight: '800',
         color: 'rgba(0,0,0,0.4)',
      },
      detail: {
         fontSize: '0.9rem',
         color: 'white',
         fontWeight: '700',
      },
      detail2: {
         fontSize: '0.9rem',
         color: 'white',
      },
      avail: {
         fontSize: '3.2rem',
         color: 'white',
         fontWeight: 'bold',
         alignSelf: 'auto',
      },
   },
   '@media android': {
      container: {
         height: width * 0.285,
         width: width * 0.9,
         backgroundColor: 'rgba(255,255,255,0.13)',
         borderRadius: 30,
         flexDirection: 'row',
         alignItems: 'center',
         paddingLeft: '11%',
         paddingRight: '6%',
         marginBottom: '4.2%',
         justifyContent: 'space-between',
      },
      item: {
         position: 'absolute',
         zIndex: -1,
         height: height,
      },
      siteid: {
         fontSize: '1.2rem',
         fontWeight: '900',
         color: 'white',
      },
      number: {
         position: 'absolute',
         left: '2.5%',
         fontSize: '5rem',
         fontWeight: '800',
         color: 'rgba(0,0,0,0.4)',
      },
      detail: {
         fontSize: '0.75rem',
         color: 'white',
         fontWeight: '700',
      },
      detail2: {
         fontSize: '0.75rem',
         color: 'white',
      },
      avail: {
         fontSize: '3rem',
         color: 'white',
         fontWeight: 'bold',
         alignSelf: 'auto',
         left: '15%',
      },
   },
})
export default NotAchieveCards
