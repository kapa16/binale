Vue.component('ustid', {
    data() {
        return {
            selected: '',
            ustList: [
                {id: 'BE',},
                {id: 'BG'},
                {id: 'DK'},
                {id: 'DE'},
                {id: 'EE'},
                {id: 'FI'},
                {id: 'FR'},
                {id: 'EL'},
                {id: 'IE'},
                {id: 'IT'},
                {id: 'HR'},
                {id: 'LV'},
                {id: 'LT'},
                {id: 'LU'},
                {id: 'MT'},
                {id: 'NL'},
                {id: 'AT'},
                {id: 'PL'},
                {id: 'PT'},
                {id: 'RO'},
                {id: 'SE'},
                {id: 'DE'},
                {id: 'SK'},
                {id: 'SI'},
                {id: 'ES'},
                {id: 'CZ'},
                {id: 'HU'},
                {id: 'GB'},
                {id: 'CY'}
                ],
        }
    },
    methods : {

    },
    computed: {

    },
    template: `
                <select 
                v-model="selected"
                class="input_width__no" 
                name="" id="">
                <option disabled value="">Land</option>
                    <option
                    v-for="option in ustList"
                    > {{ option.id }}</option>
                    </select>
     `
});
