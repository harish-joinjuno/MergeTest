<template>
    <div>
        <section class="bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <h1 class="title">
                                Browse General Scholarships<span v-if="title"> for {{ title }} students</span>
                            </h1>
                            <h2 class="subtitle">
                                Apply for scholarships to help finance your education
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section list-of-scholarships-section">
            <div class="container mb-3">
                <div class="row">
                    <div class="col-12 col-md-4 d-flex align-items-end">
                        <div>
                            <p class="scholarship-count">
                                {{ totalResults }} Scholarships found
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 offset-md-2">
                        <div class="form-row">
                            <div class="form-group col-12 col-md-6 d-flex align-items-end" />
                            <div class="form-group col-12 col-md-6 d-flex align-items-end mb-2 mb-md-0">
                                <select
                                    v-model="sortKey"
                                    class="form-control"
                                    @input="page = 1"
                                    data-style="sort-selector">
                                    <option
                                        v-for="[value, text] in sortableKeys"
                                        :key="value[0]"
                                        :value="value">
                                        {{ text }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div v-for="(scholarship, i) in filtered" :key="scholarship.id" class="col-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div v-if="scholarship.recommended">
                                            <h5>
                                                <div class="badge badge-secondary">
                                                    Recommended for you
                                                </div>
                                            </h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="row name-row">
                                    <div class="col">
                                        <p class="title">
                                            {{ scholarship.name }}
                                        </p>
                                    </div>
                                </div>

                                <div class="row description-row">
                                    <div class="col">
                                        <expandable-description
                                            class="d-none d-md-block"
                                            :description="scholarship.qualifications"
                                            :length="180" />

                                        <expandable-description
                                            class="d-md-none"
                                            :description="scholarship.qualifications"
                                            :length="90" />
                                    </div>
                                </div>

                                <div class="row details-row">
                                    <div class="col-12 col-md-4 d-flex align-items-end">
                                        <div>
                                            <p class="subtitle mb-0">
                                                Amount
                                            </p>
                                            <p class="deadline-or-amount">
                                                <template v-if="scholarship.funds_value > 0">
                                                    Up to {{
                                                        scholarship.funds_value.toLocaleString('default', {
                                                            currency: 'USD',
                                                            minimumFractionDigits: 0,
                                                            style: 'currency',
                                                        })
                                                    }}
                                                </template>
                                                <template v-else>
                                                    Unknown
                                                </template>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex align-items-end">
                                        <div>
                                            <p class="subtitle mb-0">
                                                Deadline
                                            </p>
                                            <p class="deadline-or-amount">
                                                <template v-if="!_.isNil(scholarship.formatted_deadline)">
                                                    {{ scholarship.formatted_deadline }}
                                                </template>
                                                <template v-else>
                                                    Unknown
                                                </template>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex align-items-end justify-content-end">
                                        <a
                                            class="btn btn-secondary btn-block-below-md mt-4 mt-md-0"
                                            target="_blank"
                                            :href="scholarship.for_more_information">
                                            Apply
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            v-if="i === 9 || (filtersCount < 10 && i === filtersCount - 1)"
                            class="card my-3 border-primary"
                            style="background-color:#EAF1F0;">
                            <div class="card-body text-center">
                                <h2>What is Juno?</h2>
                                <p class="mb-4">
                                    We use collective bargaining to get students and families the best rates on
                                    student loans. When you join today, you’ll be able to access our exclusive
                                    deals for free, without any committment.
                                </p>
                                <a href="/" class="btn btn-primary">
                                    Join us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a aria-hidden="true" class="infinite-scroll-observer" />

                <div class="row justify-content-center align-items-center">
                    <button
                        class="btn btn-primary btn-square"
                        :disabled="page === 1"
                        @click="page = 1">
                        1
                    </button>

                    <button
                        class="btn btn-primary btn-square"
                        @click="page = Math.max(0, page - 1)">
                        <i class="far fa-chevron-left"></i>
                    </button>

                    <p class="mb-0 mx-3">
                        Page {{ page }} / {{ totalPages }}
                    </p>

                    <button
                        class="btn btn-primary btn-square"
                        @click="page = Math.min(page + 1, totalPages)">
                        <i class="far fa-chevron-right"></i>
                    </button>

                    <button
                        class="btn btn-primary btn-square"
                        :disabled="page === totalPages"
                        @click="page = totalPages">
                        {{ totalPages }}
                    </button>
                </div>
            </div>
        </section>

        <section v-show="filtered.length == 0" class="empty-state-section">
            <div class="row justify-content-center">
                <div class="col-12 col-md-4">
                    <UndrawEmpty style="color: #439795;" />
                </div>
            </div>
            <div class="my-5">
                <p class="text-center">
                    No scholarships found
                </p>
            </div>
        </section>

        <div id="exampleModal" :active.sync="isFiltersModalActive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">
                            Scholarship Filters
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-lg-4 mb-2 form-group">
                                <select v-model="filters.citizenship" class="form-control">
                                    <option
                                        v-for="status in citizenshipStatuses"
                                        :key="status.text"
                                        :value="status.value"
                                        v-text="status.text" />
                                </select>
                            </div>

                            <div class="col-12 col-lg-4 mb-2 form-group">
                                <select v-model="filters.ethnicity" class="form-control">
                                    <option :value="null">
                                        Any protected class
                                    </option>
                                    <option
                                        v-for="ethnicity in (_.uniq(vScholarships.map((v) => v.eligible_protected_classes).flat()).filter((v) => ! _.isEmpty(v)).sort())"
                                        :key="ethnicity"
                                        :value="ethnicity">
                                        {{ ethnicity }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-12 col-lg-4 mb-2 form-group">
                                <select v-model="filters.state" class="form-control">
                                    <option :value="null">
                                        Any state
                                    </option>
                                    <option
                                        v-for="state in (_.uniq(vScholarships.map((v) => v.eligible_states).flat()).filter((v) => ! _.isEmpty(v)).sort())"
                                        :key="state"
                                        :value="state">
                                        {{ state }}
                                    </option>
                                </select>
                            </div>

                            <div class="col-12 col-lg-4 mb-2 form-group">
                                <select v-model="filters.gpa" class="form-control">
                                    <option :value="null">
                                        Any GPA
                                    </option>
                                    <!-- v-for="gpa in (_.uniq(scholarships.map((v) : v.minimum_eligible_gpa_value)).filter(v : !!v).sort())" -->
                                    <option
                                        v-for="gpa in gpas"
                                        :key="gpa.key"
                                        :value="gpa.key"
                                        v-text="gpa.value" />
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            :disabled="filtersCount == 0"
                            type="button"
                            class="btn btn-outline-primary"
                            data-dismiss="modal"
                            @click="filtersReset">
                            {{ filtersCount ? `(${filtersCount})` : '' }} Reset filters
                        </button>

                        <button
                            data-dismiss="modal"
                            type="button"
                            class="btn btn-secondary">
                            See Recommendations
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import UndrawEmpty           from 'vue2-undraw/src/components/UndrawEmpty.vue';
    import axios from 'axios';
    import ExpandableDescription from './ExpandableDescription.vue';

    export default {
        components: {
            UndrawEmpty,
            ExpandableDescription,
        },

        props: {
            vScholarships: {
                type: Array,
                default() {
                    return [];
                },
            },
            title: {
                type: String,
                default() {
                    return '';
                },
            },
            totalResults: {
                type: [String, Number],
                default: () => '',
            },
        },

        data() {
            return {
                sortableKeys: [
                    [
                        ['formatted_deadline_timestamp', 'asc'],
                        'Sort by Deadline',
                    ],
                    [
                        ['funds_value', 'desc'],
                        'Sort by Amount',
                    ],
                ],
                citizenshipStatuses: [
                    {
                        value: null,
                        text:  'Any Citizenship Status',
                    },
                    {
                        value: 0,
                        text:  'Non-U.S. Citizen',
                    },
                    {
                        value: 1,
                        text:  'U.S. Citizen',
                    },
                ],
                filters: {
                    citizenship: null,
                    ethnicity:   null,
                    gender:      null,
                    state:       null,
                    gpa:         null,
                },
                sortKey:              null,
                isFiltersModalActive: false,
                gpas:                 [
                    {
                        key:   3.3,
                        value: 'Above 3.3',
                    },
                    {
                        key:   3,
                        value: 'Above 3.0',
                    },
                    {
                        key:   2.5,
                        value: 'Above 2.5',
                    },
                    {
                        key:   2,
                        value: 'Above 2.0',
                    },
                ],
                intersectionObserver: null,
                loading:              false,
                page:                 1,
                scholarships:         this.vScholarships,
            };
        },

        computed: {
            totalPages() {
                return Math.ceil(this.totalResults / 20);
            },

            filtered() {
                const start = 20 * (this.page - 1);
                const end = start + 20;
                return _.orderBy(this.scholarships, ['recommended', this.sortKey[0]], ['desc', this.sortKey[1]])
                    .slice(start, end);
            },

            filtersCount() {
                return this.filtered.length;
            },
        },

        beforeMount() {
            this.sortKey = this.sortableKeys[0][0];
        },
        methods: {
            filtersReset() {
                this.filters = {
                    citizenship: null,
                    ethnicity:   null,
                    state:       null,
                    gpa:         null,
                };
            },
        },
    };
</script>


<style lang="scss" scoped>

.form-group{
    margin-bottom: 0;
}

.sort-selector{
    border: #777777 1px solid;
}

h1.title{
    font-size: 32px;
    font-weight: 500;
    margin-bottom: 16px;
}

h2.subtitle{
    font-family: "GTWalsheimPro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    font-size: 24px;
    font-weight: 500;
    color: black;
}

.list-of-scholarships-section{
    background: linear-gradient(0deg, #F7F7F5, #F7F7F5), linear-gradient(180deg, #F3F4ED 0%, #FFFFFF 50%);
    padding-top: 30px;
}

.empty-state-section{
    background: linear-gradient(0deg, #F7F7F5, #F7F7F5), linear-gradient(180deg, #F3F4ED 0%, #FFFFFF 50%);
}

.empty-state-section p{
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 16px;
}

.scholarship-count{
    font-size: 20px;
    font-weight: 500;
    margin-bottom: 16px;
}
.btn-square {
    height:40px;
    width:40px;
    margin:0 5px;
    padding:0;
}

@media (min-width: 992px) {
    .scholarship-count {
        font-size: 16px;
        margin-bottom: 0;
    }
}

.card .title{
    font-size: 24px;
    font-weight: 500;
    margin-bottom: 0;
}

.card .name-row{
    margin-bottom: 16px;
}

.card .description-row{
    margin-bottom: 16px;
    font-size: 18px;
}

.card .deadline-or-amount{
    font-size: 16px;
    font-weight: 500;
}

.card .subtitle{
    font-size: 14px;
    text-transform: uppercase;
    font-weight: 500;
    color: #777777;
}

.card .btn{
    padding-left: 64px;
    padding-right: 64px;
    text-transform: uppercase;
}

.card-body{
    padding-top: 32px;
    padding-bottom: 32px;
}

@media (min-width: 992px) {

    h1.title{
        font-size: 36px;
    }

    .scholarship-count{
        font-size: 20px;
    }

    .card .title{
        font-size: 32px;
    }

    .card .deadline-or-amount{
        font-size: 16px;
        margin-bottom: 0;
    }

    .card .deadline-or-amount{
        font-size: 18px;
    }

    .card .subtitle{
        font-size: 14px;
    }
}

@media all and (max-width:768px) {
    .btn-block-below-md {
        width: 100%;
        display:block;
    }
}


</style>
