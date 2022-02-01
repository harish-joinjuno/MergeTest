window.$ = window.jQuery = require('jquery');
// noinspection ES6CheckImport
import Multiselect from 'vue-multiselect';
import Vue         from 'vue';
import ClipboardJS from 'clipboard/dist/clipboard';

import BrowseScholarships from './browse_scholarships/BrowseScholarships.vue';
import GeneralScholarships from "./browse_scholarships/GeneralScholarships";


import 'bootstrap';
import 'select2';
window._ = require('lodash');

require('./directives');
window.axios = require('axios');
window.moment = require('moment');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
Vue.component('multiselect', Multiselect);
Vue.component('browse-scholarships', BrowseScholarships);
Vue.component('general-scholarships', GeneralScholarships);
window.$ = jQuery;
window.jQuery = jQuery;
Vue.prototype._ = window._ = require('lodash');

const app = new Vue({
    el:         '#safeApp',
    components: {
        'report-aid-offers-form':   require('./components/financial-aid-tracker/report-aid-offers-form').default,
        'countdown-timer':          require('./components/common/countdown-timer').default,
        'university-filter':        require('./components/financial-aid-tracker/university-filter').default,
        'competition-status-chart': require('./components/school-vs-school-competition/competition-status-chart').default,
        'admin-message-history':    require('./components/admin/message-history').default,
        'action-notification':      require('./components/action-notification').default,
        'negotiation-group':        require('./components/negotiation-group').default,
        'negotiation-group-disabled': require('./components/negotiation-group-disabled').default,
        'referral-center':          require('./components/referral-center').default,
        'help-support':             require('./components/help-support').default,
        'left-menu':                require('./components/left-menu').default,
        'greeting':                 require('./components/greeting').default,
        'commonbond-mba-loan-calculator': require('./components/calculator/commonbond-mba-loan').default,
        'federal-student-loan-cost': require('./components/calculator/federal-student-loan-cost').default,
        'compare-my-options':         require('./components/compare-my-options').default,
        'compare-my-refinance-options':         require('./components/compare-my-refinance-options').default,
        'reward-claim-page':               require('./components/reward-claim-page').default,
        'screenshot-claim-page':    require('./components/screenshot-claim-page').default,
        'international-reward-claim-form': require('./components/international-reward-claim-form').default,
        'first-republic-calculator':               require('./components/first-republic-calculator').default,
    },

    data: {
        phone_number: '',
    },

    computed: {
        phoneNumber: {
            get() {
                let value = this.phone_number;

                value = value.replace(/^\+1/, '');
                value = value.replace(/^(\d{3})(\d)/g, '($1) $2');
                value = value.replace(/^(\(\d{3}\)\s)(\d{3})(\d)/, '$1$2-$3');
                value = value.replace(/^(\(\d{3}\)\s)(\d{3})-(\d{4})/, '$1$2-$3');

                return value;
            },

            set(value) {
                if (value.length <=14)
                    this.phone_number = value;
            },
        },
    },

    mounted() {
        this.phone_number = window.phoneNumber;
    },

    methods: {
        checkPhoneNumber(e) {
            const charCode = e.which || e.keyCode;
            if (e.target.value.length >= 14 || (charCode > 31 && (charCode < 47 || charCode > 57) && charCode !== 43)) {
                e.preventDefault();
                return false;
            }
        }
    }
});


$(() => {
    $('[data-toggle=tooltip]').tooltip();
});

$(document).ready(() => {
    $('.select2').select2({
        theme: 'bootstrap4'
    });
    $('.select-two').select2({
        theme: 'bootstrap4'
    });

    new ClipboardJS('.copy-button');

    $('.foot-note-marker').wrap(function () {
        return "<a href='#footer' style='text-decoration: none'></a>";
    })
});
