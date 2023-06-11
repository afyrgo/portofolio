import React from 'react'
import { View, StyleSheet, Text } from 'react-native'

const KabNACards = ({ data }) => {
   return (
      <View
         style={{ flexDirection: 'row', borderWidth: 1, borderBottomColor: 'white', justifyContent: 'space-between' }}
      >
         <Text style={styles.number}>{data.id}</Text>
         <View style={{ padding: 20 }}>
            {/* <Text style={styles.siteid}>KAB.</Text> */}
            <Text style={styles.siteid}>{data.kab}</Text>
            <Text style={styles.siteid}>{data.class.toUpperCase()}</Text>
            <Text style={styles.detail}>Populasi : {data.populasi} Sites</Text>
         </View>
         <Text style={styles.avail}>{data.avail}</Text>
      </View>
   )
}

const styles = StyleSheet.create({
   container: {
      flex: 1,
      flexDirection: 'column',
      position: 'relative',
   },
   item: {
      position: 'absolute',
      zIndex: -1,
      height: 800,
   },
   siteid: {
      fontSize: 20,
      fontWeight: '900',
      color: 'white',
   },
   number: {
      alignSelf: 'center',
      fontSize: 110,
      color: 'rgba(200,200,200,0.3)',
      marginRight: -50,
      position: 'absolute',
   },
   detail: {
      fontSize: 16,
      color: 'white',
      fontWeight: '700',
   },
   detail2: {
      fontSize: 16,
      color: 'white',
   },
   avail: {
      fontSize: 60,
      color: 'white',
      fontWeight: 'bold',
      alignSelf: 'center',
   },
})

export default KabNACards
