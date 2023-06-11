import { StatusBar } from 'expo-status-bar'
import { SafeAreaView, Dimensions, Text, View, ActivityIndicator, FlatList, ScrollView, Image } from 'react-native'
import React, { useState, useEffect } from 'react'
import { useNavigation } from '@react-navigation/native'
import Cards2 from '../component/Cards2'
import EStyleSheet from 'react-native-extended-stylesheet'
import Topworst from '../component/topworst'
import Quota from '../component/Quota'
import Headers from '../component/Headers'
import ChartNew from '../component/ChartNew'

export const Home = () => {
   const navigation = useNavigation()
   let [isloading, setloading] = useState(true)
   let [iserror, setisError] = useState()
   let [datap, setdatap] = useState({})
   let [datam, setdatam] = useState([])
   let [datas, setdatas] = useState([])
   let [datag, setdatag] = useState([])
   const { height, width } = Dimensions.get('screen')
   useEffect(() => {
      fetch('https://afyrgo.github.io/api/data.json')
         .then((response) => response.json())
         .then((res) => {
            setdatap(res.avail)
            setdatam(res.ach)
            setdatag(res.top10)
            setdatas(res.quota)
            setloading(false)
         })
         .catch((eror) => {
            setisError(eror)
            setloading(false)
         })
   }, [])

   const getdata = () => {
      if (isloading) {
         return (
            <SafeAreaView style={{ backgroundColor: 'black' }}>
               <StatusBar style="dark" />
               <View style={styles.container}>
                  <View style={{ flex: 1, position: 'absolute', zIndex: -1 }}>
                     <Image
                        source={require('../assets/bg.png')}
                        resizeMode="stretch"
                        style={{ height: height, width: width }}
                     ></Image>
                  </View>
                  <ActivityIndicator size={'large'} style={{ top: 340 }} />
                  <Text
                     style={{
                        fontSize: 25,
                        fontWeight: '400',
                        fontStyle: 'italic',
                        color: 'white',
                        top: 360,
                        position: 'absolute',
                        alignSelf: 'center',
                     }}
                  >
                     Fetching Data, Please wait!
                  </Text>
               </View>
            </SafeAreaView>
         )
      }
      if (iserror) {
         return <Text style={{ color: 'white', top: 370, fontSize: 34 }}>{iserror}</Text>
      }
      return (
         <SafeAreaView style={{ backgroundColor: 'black', flex: 1 }}>
            <StatusBar style="light" />
            <View style={styles.container}>
               <View style={{ flex: 1, position: 'absolute', zIndex: -1 }}>
                  <Image
                     source={require('../assets/bg.png')}
                     resizeMode="stretch"
                     style={{ height: height, width: width }}
                  ></Image>
               </View>
               <Headers />
               <View
                  style={{
                     height: height * 0.44,
                     borderColor: 'white',
                     borderWidth: 0,
                     alignSelf: 'center',
                     alignItems: 'center',
                     marginTop: '3%',
                  }}
               >
                  <FlatList
                     data={datap}
                     renderItem={({ item }) => <ChartNew key={item.id} data={item} />}
                     horizontal
                     showsHorizontalScrollIndicator={false}
                  />
               </View>
               <View
                  style={{
                     flexDirection: 'row',
                     height: width * 0.4,
                     borderColor: 'white',
                     borderWidth: 0,
                     justifyContent: 'space-evenly',
                     borderRadius: 20,
                     marginTop: '2%',
                  }}
               >
                  <View
                     style={{
                        width: width * 0.4,
                        borderColor: 'white',
                        borderWidth: 0,
                     }}
                  >
                     <ScrollView pagingEnabled style={{ borderRadius: 27, backgroundColor: 'rgba(0,0,0,0.3)' }}>
                        {Object.keys(datam).map((x) => {
                           return <Cards2 key={x} data={datam[x]} />
                        })}
                     </ScrollView>
                  </View>
                  <View>
                     <ScrollView
                        pagingEnabled
                        style={{
                           width: width * 0.4,
                           height: width * 0.4,
                           backgroundColor: 'rgba(255,255,255,0.1)',
                           borderRadius: 27,
                        }}
                     >
                        {datag.map((x, index) => {
                           return <Topworst key={index} dataz={x} />
                        })}
                     </ScrollView>
                  </View>
               </View>
               <View style={{ height: width * 0.4, marginTop: '5%' }}>
                  <ScrollView
                     pagingEnabled
                     style={{
                        borderRadius: 30,
                        backgroundColor: 'rgba(200,200,200, 0.2)',
                        alignSelf: 'center',
                        width: '88%',
                        height: width * 0.4,
                        borderColor: 'white',
                     }}
                  >
                     {datas.map((x, index) => {
                        return <Quota key={index} datax={x} />
                     })}
                  </ScrollView>
               </View>
            </View>
         </SafeAreaView>
      )
   }

   return <>{getdata()}</>
}
const styles = EStyleSheet.create({
   container: {
      '@media android': {
         flex: 1,
         width: '100%',
         height: '100%',
         top: '3.5%',
         flexDirection: 'column',
      },
   },
   '@media ios': {
      flex: 1,
      width: '100%',
      height: '100%',
      flexDirection: 'column',
   },
})

export default Home
