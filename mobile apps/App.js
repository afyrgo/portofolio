import React from 'react'
import { createStackNavigator } from '@react-navigation/stack'
import { NavigationContainer, DefaultTheme } from '@react-navigation/native'
import { Dimensions } from 'react-native'
import EStyleSheet from 'react-native-extended-stylesheet'
import Home from './screens/Home'
import Avail from './screens/avail'
import TWDetails from './screens/TWDetails'
import AchDetails from './screens/AchDetails'

const Stack = createStackNavigator()

const theme = {
   ...DefaultTheme,
   colors: {
      ...DefaultTheme.colors,
      background: 'white',
   },
}
let { height, width } = Dimensions.get('window')
EStyleSheet.build({
   $rem: width > 340 ? 18 : 16,
})

export default function App() {
   return (
      <NavigationContainer>
         <Stack.Navigator
            screenOptions={{
               headerShown: false,
               gestureEnabled: false,
            }}
            initialRouteName="Home"
         >
            <Stack.Screen name="Home" component={Home} />
            <Stack.Screen name="TWDetails" component={TWDetails} />
            <Stack.Screen name="Avail" component={Avail} />
            <Stack.Screen name="AchDetails" component={AchDetails} />
         </Stack.Navigator>
      </NavigationContainer>
   )
}
