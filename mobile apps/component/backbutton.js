import React from 'react'
import { View, Image, TouchableOpacity, Text } from 'react-native'

const Backbutton = ({ handlepress }) => {
   return (
      <TouchableOpacity
         style={{
            position: 'absolute',
            top: 0,
            height: 40,
            width: 40,
            borderRadius: 100,
            backgroundColor: 'gray',
            alignItems: 'center',
            justifyContent: 'center',
            margin: 20,
            shadowColor: 'black',
            shadowOffset: {
               width: 0,
               height: 0,
            },
            shadowOpacity: 0.4,
            shadowRadius: 5,
         }}
         onPress={handlepress}
      >
         <Text style={{ color: 'white', fontSize: 25, fontWeight: '700', top: -1, left: -1 }}>{'<'}</Text>
      </TouchableOpacity>
   )
}

export default Backbutton
