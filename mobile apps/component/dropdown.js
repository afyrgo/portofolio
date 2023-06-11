import React from 'react'
import SelectList from 'react-native-dropdown-select-list'

const Dropdown = () => {
   const [selected, setSelected] = React.useState('')

   const dtclas = [
      { key: 'diamond', value: 'Diamond' },
      { key: 'platinum', value: 'Platinum' },
      { key: 'gold', value: 'Gold' },
      { key: 'silver', value: 'Silver' },
      { key: 'bronze', value: 'Bronze' },
   ]

   return (
      <SelectList
         data={data}
         search={false}
         boxStyles={{
            top: 20,
            borderRadius: 20,
            width: 93,
            alignSelf: 'flex-end',
            marginHorizontal: 20,
         }} //override default styles
         dropdownStyles={{ top: 20, maxWidth: 100, alignSelf: 'flex-end', marginHorizontal: 20 }}
         inputStyles={{ color: 'white', alignSelf: 'center' }}
         defaultOption={{ key: '1', value: 'Diamond' }} //default selected option
         dropdownTextStyles={{ color: 'white' }}
      />
   )
}

export default Dropdown
