import React, { useState } from 'react'
import { View, SafeAreaView, Image, Text, FlatList, Dimensions, VirtualizedList, Pressable } from 'react-native'
import { StatusBar } from 'expo-status-bar'
import Backbutton from '../component/backbutton'
import { useNavigation } from '@react-navigation/native'
import NotAchieveCards from '../component/notAchieveCards'
import KabNACards from '../component/KabNACards'
import EStyleSheet from 'react-native-extended-stylesheet'
import { index } from 'd3'

const AchDetails = ({ route }) => {
   const navigation = useNavigation()
   var datac = route.params.data
   var datax = datac.detail
   const [select, setselect] = useState('')
   const [dataz, setdataz] = useState(datax)

   const handlepress = (s, ns) => {
      if (s != select) {
         setselect(s)
         var res = datax.filter((nsa) => nsa.ns == ns)
         setdataz(res)
      } else {
         setselect('')
         setdataz(datax)
      }
   }

   const Count = (cl, n) => {
      let a = 0
      datax.map((x, index) => {
         if (x.class == cl && x.ns == n) {
            a += 1
         }
      })
      return a
   }

   if (datac.lvl == 'Site') {
      return (
         <SafeAreaView style={{ backgroundColor: 'black' }}>
            <StatusBar style="light" />

            <View style={styles.container}>
               <View style={styles.buttoncontainer}>
                  <Backbutton handlepress={() => navigation.goBack()} />
               </View>
               <View style={styles.item}>
                  <Image
                     source={require('../assets/bg.png')}
                     resizeMode="stretch"
                     style={{ height: height, width: width, zIndex: -1 }}
                  ></Image>
               </View>
               <View style={styles.header}>
                  <Text style={styles.tittle1}>{datac.total}</Text>
                  <Text style={styles.tittle2}>{datac.lvl.toUpperCase()}</Text>
                  <Text style={styles.tittle3}>not achieve</Text>
               </View>
               <View style={styles.underline}></View>
               <View style={styles.flatwrap}>
                  <VirtualizedList
                     data={dataz}
                     initialNumToRender={4}
                     renderItem={(item) => <NotAchieveCards data={item} />}
                     keyExtractor={(item) => item.id}
                     getItemCount={(item) => item.length}
                     getItem={(item, index) => item[index]}
                     style={{ borderRadius: 30 }}
                  />
               </View>
               <View style={styles.detailwrap}>
                  <Pressable
                     style={select == 'dps' ? styles.selected : styles.detailbox}
                     onPress={() => handlepress('dps', 'NS DENPASAR')}
                  >
                     <Text style={styles.detailtitle}>DPS</Text>
                     <Text style={styles.detailtot}>
                        {Count('Bronze', 'NS DENPASAR') +
                           Count('Silver', 'NS DENPASAR') +
                           Count('Gold', 'NS DENPASAR') +
                           Count('Platinum', 'NS DENPASAR') +
                           Count('Diamond', 'NS DENPASAR')}
                     </Text>
                     <View style={styles.footwrap}>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>D</Text>
                           <Text style={styles.detailcount}>{Count('Diamond', 'NS DENPASAR')}</Text>
                        </View>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>P</Text>
                           <Text style={styles.detailcount}>{Count('Platinum', 'NS DENPASAR')}</Text>
                        </View>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>G</Text>
                           <Text style={styles.detailcount}>{Count('Gold', 'NS DENPASAR')}</Text>
                        </View>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>S</Text>
                           <Text style={styles.detailcount}>{Count('Silver', 'NS DENPASAR')}</Text>
                        </View>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>B</Text>
                           <Text style={styles.detailcount}>{Count('Bronze', 'NS DENPASAR')}</Text>
                        </View>
                     </View>
                  </Pressable>
                  <Pressable
                     style={select == 'mtr' ? styles.selected : styles.detailbox}
                     onPress={() => handlepress('mtr', 'NS MATARAM')}
                  >
                     <Text style={styles.detailtitle}>MTR</Text>
                     <Text style={styles.detailtot}>
                        {Count('Bronze', 'NS MATARAM') +
                           Count('Silver', 'NS MATARAM') +
                           Count('Gold', 'NS MATARAM') +
                           Count('Platinum', 'NS MATARAM') +
                           Count('Diamond', 'NS MATARAM')}
                     </Text>
                     <View style={styles.footwrap}>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>D</Text>
                           <Text style={styles.detailcount}>{Count('Diamond', 'NS MATARAM')}</Text>
                        </View>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>P</Text>
                           <Text style={styles.detailcount}>{Count('Platinum', 'NS MATARAM')}</Text>
                        </View>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>G</Text>
                           <Text style={styles.detailcount}>{Count('Gold', 'NS MATARAM')}</Text>
                        </View>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>S</Text>
                           <Text style={styles.detailcount}>{Count('Silver', 'NS MATARAM')}</Text>
                        </View>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>B</Text>
                           <Text style={styles.detailcount}>{Count('Bronze', 'NS MATARAM')}</Text>
                        </View>
                     </View>
                  </Pressable>
                  <Pressable
                     style={select == 'kpg' ? styles.selected : styles.detailbox}
                     onPress={() => handlepress('kpg', 'NS KUPANG')}
                  >
                     <Text style={styles.detailtitle}>KPG</Text>
                     <Text style={styles.detailtot}>
                        {Count('Bronze', 'NS KUPANG') +
                           Count('Silver', 'NS KUPANG') +
                           Count('Gold', 'NS KUPANG') +
                           Count('Platinum', 'NS KUPANG') +
                           Count('Diamond', 'NS KUPANG')}
                     </Text>
                     <View style={styles.footwrap}>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>D</Text>
                           <Text style={styles.detailcount}>{Count('Diamond', 'NS KUPANG')}</Text>
                        </View>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>P</Text>
                           <Text style={styles.detailcount}>{Count('Platinum', 'NS KUPANG')}</Text>
                        </View>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>G</Text>
                           <Text style={styles.detailcount}>{Count('Gold', 'NS KUPANG')}</Text>
                        </View>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>S</Text>
                           <Text style={styles.detailcount}>{Count('Silver', 'NS KUPANG')}</Text>
                        </View>
                        <View style={styles.countwrap}>
                           <Text style={styles.detailclass}>B</Text>
                           <Text style={styles.detailcount}>{Count('Bronze', 'NS KUPANG')}</Text>
                        </View>
                     </View>
                  </Pressable>
               </View>
            </View>
         </SafeAreaView>
      )
   }

   if (datac.total == 0) {
      return (
         <SafeAreaView style={{ backgroundColor: 'black' }}>
            <StatusBar style="light" />

            <View style={styles.container}>
               <View style={styles.buttoncontainer}>
                  <Backbutton handlepress={() => navigation.goBack()} />
               </View>
               <View style={styles.item}>
                  <Image
                     source={require('../assets/bg.png')}
                     resizeMode="stretch"
                     style={{ height: height, width: width, zIndex: -1 }}
                  ></Image>
               </View>
               <View style={styles.kabheader}>
                  <Text style={styles.kabtitle1}>{datac.total}</Text>
                  <Text style={styles.kabtitle2}>{datac.lvl.toUpperCase()}</Text>
                  <Text style={styles.kabtitle3}>not achieve</Text>
               </View>
               <View style={styles.kabunderline}></View>
            </View>
         </SafeAreaView>
      )
   }
   return (
      <SafeAreaView style={{ backgroundColor: 'black' }}>
         <StatusBar style="light" />

         <View style={styles.container}>
            <View style={styles.buttoncontainer}>
               <Backbutton handlepress={() => navigation.goBack()} />
            </View>
            <View style={styles.item}>
               <Image source={require('../assets/bg.png')}></Image>
            </View>
            <View style={styles.kabheader}>
               <Text style={styles.kabtitle1}>{datac.total}</Text>
               <Text style={styles.kabtitle2}>{datac.lvl.toUpperCase()}</Text>
               <Text style={styles.kabtitle3}>not achieve</Text>
            </View>
            <View style={styles.kabunderline}></View>
            <View style={styles.kabflatcontainer}>
               <FlatList
                  data={datax}
                  renderItem={({ item }) => <KabNACards key={item.id} data={item} />}
                  style={{
                     borderRadius: 30,
                  }}
               />
            </View>
         </View>
      </SafeAreaView>
   )
}
const { height, width } = Dimensions.get('screen')
const styles = EStyleSheet.create({
   '@media ios': {
      container: {
         flex: 1,
         flexDirection: 'column',
         position: 'relative',
      },
      item: {
         position: 'absolute',
         zIndex: -1,
         height: '100%',
      },
      buttoncontainer: { height: width * 0.1, zIndex: 1, width: '100%' },
      header: {
         height: width * 0.1,
         borderColor: 'white',
         borderWidth: 0,
         paddingHorizontal: '3%',
         alignItems: 'flex-end',
         flexDirection: 'row',
         justifyContent: 'flex-end',
      },
      tittle1: {
         fontSize: '2.6rem',
         fontWeight: '800',
         color: 'rgba(255,255,255,0.5)',
         right: '-20%',
         alignSelf: 'flex-end',
      },
      tittle2: { fontSize: '2.6rem', fontWeight: '800', color: 'rgba(255,255,255,1)', alignSelf: 'flex-end' },
      tittle3: { fontSize: '1.3 rem', color: 'white', alignSelf: 'flex-end', bottom: '-1.2%' },

      underline: {
         height: width * 0.01,
         width: width * 0.75,
         backgroundColor: 'rgba(255,255,255,0.5)',
         alignSelf: 'flex-end',
         borderRadius: 30,
         marginHorizontal: '3%',
      },
      flatwrap: {
         borderColor: 'white',
         borderWidth: 0,
         alignSelf: 'center',
         alignItems: 'center',
         justifyContent: 'center',
         marginTop: '7%',
         borderRadius: 30,
         height: width * 1.31,
         width: width * 0.92,
         marginBottom: '4%',
      },
      footwrap: {
         height: '13%',
         width: '100%',
         backgroundColor: 'rgba(255,255,255,0.3)',
         flexDirection: 'row',
         justifyContent: 'space-evenly',
         top: '-12%',
      },
      detailwrap: { flexDirection: 'row', justifyContent: 'space-evenly', marginTop: '2%' },
      detailbox: {
         height: width * 0.31,
         width: width * 0.29,
         backgroundColor: 'rgba(0,0,0,0.2)',
         borderRadius: 20,
         flexDirection: 'column',
         justifyContent: 'center',
         alignItems: 'center',
      },
      detailtitle: { color: 'white', fontWeight: '800', alignSelf: 'center', fontSize: '1.3rem', top: '-5%' },
      detailtot: {
         color: 'rgba(255,255,255,0.3)',
         fontWeight: '800',
         fontSize: '3rem',
         alignSelf: 'center',
         top: '-10%',
      },
      countwrap: { flexDirection: 'column', alignItems: 'center' },
      detailclass: { color: 'white', fontWeight: '800' },
      detailcount: { color: 'white', fontWeight: '400', top: '20%', fontSize: '0.7rem' },
      kabheader: {
         height: width * 0.1,
         width: '100%',
         borderColor: 'white',
         borderWidth: 0,
         paddingHorizontal: '3%',
         alignItems: 'flex-end',
         flexDirection: 'row',
         justifyContent: 'flex-end',
         top: '8%',
      },
      kabtitle1: {
         fontSize: '2rem',
         fontWeight: '800',
         color: 'rgba(255,255,255,0.5)',
         right: '-15%',
         alignSelf: 'flex-end',
      },
      kabtitle2: { fontSize: '2rem', fontWeight: '800', color: 'rgba(255,255,255,1)', alignSelf: 'flex-end' },
      kabtitle3: { fontSize: '1rem', color: 'white', alignSelf: 'flex-end', bottom: '1%' },
      kabunderline: {
         margin: '2.6%',
         height: width * 0.01,
         width: width * 0.85,
         backgroundColor: 'white',
         alignSelf: 'flex-end',
         top: width * 0.05,
         borderRadius: 30,
      },
      kabflatcontainer: {
         height: height * 0.7,
         width: width * 0.9,
         alignSelf: 'center',
         paddingTop: 30,
         borderColor: 'white',
         borderWidth: 0,
      },
      selected: {
         height: width * 0.3,
         width: width * 0.29,
         backgroundColor: 'rgba(255,255,255,0.2)',
         borderRadius: 20,
         flexDirection: 'column',
         justifyContent: 'center',
         alignItems: 'center',
      },
   },
   '@media android': {
      container: {
         flex: 1,
         flexDirection: 'column',
         position: 'relative',
      },
      item: {
         position: 'absolute',
         zIndex: -1,
         height: '100%',
      },
      buttoncontainer: { height: width * 0.1, zIndex: 1, width: '100%', top: width * 0.05 },
      header: {
         height: width * 0.15,
         borderColor: 'white',
         borderWidth: 0,
         paddingHorizontal: '3%',
         alignItems: 'flex-end',
         flexDirection: 'row',
         justifyContent: 'flex-end',
      },
      tittle1: {
         fontSize: '2.4rem',
         fontWeight: '800',
         color: 'rgba(255,255,255,0.5)',
         right: '-20%',
         alignSelf: 'flex-end',
      },
      tittle2: { fontSize: '2.4rem', fontWeight: '800', color: 'rgba(255,255,255,1)', alignSelf: 'flex-end' },
      tittle3: { fontSize: '1.3 rem', color: 'white', alignSelf: 'flex-end', bottom: '1.6%' },

      underline: {
         height: width * 0.01,
         width: width * 0.75,
         backgroundColor: 'rgba(255,255,255,0.5)',
         alignSelf: 'flex-end',
         borderRadius: 30,
         marginHorizontal: '3%',
      },
      flatwrap: {
         borderColor: 'white',
         borderWidth: 0,
         alignSelf: 'center',
         alignItems: 'center',
         justifyContent: 'center',
         marginTop: '5%',
         borderRadius: 30,
         height: width * 1.25,
         width: width * 0.92,
      },
      footwrap: {
         height: '13%',
         width: '100%',
         backgroundColor: 'rgba(255,255,255,0.3)',
         flexDirection: 'row',
         justifyContent: 'space-evenly',
         top: '-20%',
      },
      detailwrap: { flexDirection: 'row', justifyContent: 'space-evenly', marginTop: '5%' },
      detailbox: {
         height: width * 0.3,
         width: width * 0.29,
         backgroundColor: 'rgba(0,0,0,0.2)',
         borderRadius: 20,
         flexDirection: 'column',
         justifyContent: 'center',
         alignItems: 'center',
      },
      detailtitle: { color: 'white', fontWeight: '800', alignSelf: 'center', fontSize: '1rem', top: '-8%' },
      detailtot: {
         color: 'rgba(255,255,255,0.3)',
         fontWeight: '800',
         fontSize: '2.5rem',
         alignSelf: 'center',
         top: '-15%',
      },
      countwrap: { flexDirection: 'column', alignItems: 'center' },
      detailclass: { color: 'white', fontWeight: '800', top: '-17%' },
      detailcount: { color: 'white', fontWeight: '400', top: '20%', fontSize: '0.7rem' },
      kabheader: {
         height: width * 0.1,
         width: '100%',
         borderColor: 'white',
         borderWidth: 0,
         paddingHorizontal: '3%',
         alignItems: 'flex-end',
         flexDirection: 'row',
         justifyContent: 'flex-end',
         top: '8%',
      },
      kabtitle1: {
         fontSize: '2rem',
         fontWeight: '800',
         color: 'rgba(255,255,255,0.5)',
         right: '-15%',
         alignSelf: 'flex-end',
      },
      kabtitle2: { fontSize: '2rem', fontWeight: '800', color: 'rgba(255,255,255,1)', alignSelf: 'flex-end' },
      kabtitle3: { fontSize: '1rem', color: 'white', alignSelf: 'flex-end', bottom: '-1%' },
      kabunderline: {
         margin: '2.6%',
         height: width * 0.01,
         width: width * 0.85,
         backgroundColor: 'white',
         alignSelf: 'flex-end',
         top: width * 0.05,
         borderRadius: 30,
      },
      kabflatcontainer: {
         height: height * 0.7,
         width: width * 0.9,
         alignSelf: 'center',
         paddingTop: 30,
         borderColor: 'white',
         borderWidth: 0,
      },
      selected: {
         height: width * 0.3,
         width: width * 0.29,
         backgroundColor: 'rgba(255,255,255,0.2)',
         borderRadius: 20,
         flexDirection: 'column',
         justifyContent: 'center',
         alignItems: 'center',
      },
   },
})
export default AchDetails
