import Vue from 'vue'

require('./directives');

import Multiselect from 'vue-multiselect';
Vue.component('multiselect', Multiselect);

const app = new Vue({
	el: '#safeApp',
	components: {
        'report-aid-offers-form': require('./components/financial-aid-tracker/report-aid-offers-form').default,
        'countdown-timer': require('./components/common/countdown-timer').default,
        'university-filter': require('./components/financial-aid-tracker/university-filter').default,
        'competition-status-chart': require('./components/school-vs-school-competition/competition-status-chart').default,
    },
})
