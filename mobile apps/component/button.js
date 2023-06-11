import React from 'react'
import { View, Text, TouchableOpacity } from 'react-native'

const Button = ({ handlepress }) => {
   return (
      <TouchableOpacity
         style={{
            top: 45,
            left: 10,
            backgroundColor: 'maroon',
            opacity: 0.7,
            height: 45,
            width: 85,
            borderRadius: 100,
            justifyContent: 'center',
            alignItems: 'center',
         }}
         onPress={handlepress}
      >
         <Text style={{ fontWeight: 'bold', color: 'white' }}>Detail</Text>
      </TouchableOpacity>
   )
}

export default Button
