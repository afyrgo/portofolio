import { Text, View, Image, Dimensions } from 'react-native'
import React, { Component } from 'react'
import SHADOWS from '../constant/Constant'

export class Headers extends Component {
   render() {
      const { height, width } = Dimensions.get('screen')
      return (
         <View style={{ height: width * 0.1, flexDirection: 'row' }}>
            <Image
               source={require('../assets/logo.png')}
               style={{
                  height: width * 0.1,
                  width: '40%',
                  left: '65%',
                  resizeMode: 'contain',
                  borderColor: 'white',
               }}
            ></Image>
         </View>
      )
   }
}

export default Headers
