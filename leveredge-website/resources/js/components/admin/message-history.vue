<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="header">
                    <h1 class="h1">
                        Search user history by phone
                    </h1>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col">
                <input v-model="phone"
                       class="form-control"
                       name="phone"
                       placeholder="Phone number">
                <button v-if="validPhoneNumber" class="btn btn-primary mt-3" @click.prevent="searchByPhone">
                    Search
                </button>
            </div>
        </div>
        <template v-if="searched">
            <div v-if="userInfo" class="mt-5">
                <div class="row">
                    <div class="col-12">
                        <h2>
                            <span>User Information</span>
                        </h2>
                    </div>
                    <div class="col-12">
                        <h3>
                            <span>Personal Info</span>
                        </h3>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered">
                            <tr>
                                <td><strong>Role</strong></td>
                                <td v-text="userInfo.profile.role" />
                            </tr>
                            <tr>
                                <td><strong>First Name</strong></td>
                                <td v-text="userInfo.first_name" />
                            </tr>
                            <tr>
                                <td><strong>Last Name</strong></td>
                                <td v-text="userInfo.last_name" />
                            </tr>
                            <tr>
                                <td><strong>Immigration Status</strong></td>
                                <td v-text="userInfo.profile.immigration_status" />
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>
                            <span>Undergrad Info</span>
                        </h3>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered">
                            <tr>
                                <td><strong>University</strong></td>
                                <td>
                                    <span v-if="userInfo.profile.university" v-text="userInfo.profile.university.name" />
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Degree</strong></td>
                                <td>
                                    <span v-if="userInfo.profile.degree" v-text="userInfo.profile.degree.name" />
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Graduation Year</strong></td>
                                <td v-text="userInfo.profile.graduation_year" />
                            </tr>
                            <tr>
                                <td><strong>Enrollment Status</strong></td>
                                <td v-text="userInfo.profile.enrollment_status" />
                            </tr>
                            <tr>
                                <td><strong>Grad Degree Format</strong></td>
                                <td v-text="userInfo.profile.degree_format" />
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>
                            <span>Graduate Info</span>
                        </h3>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered">
                            <tr>
                                <td><strong>University</strong></td>
                                <td>
                                    <span v-if="userInfo.profile.grad_university" v-text="userInfo.profile.grad_university.name" />
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Degree</strong></td>
                                <td>
                                    <span v-if="userInfo.profile.grad_degree" v-text="userInfo.profile.grad_degree.name" />
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Graduation Year</strong></td>
                                <td v-text="userInfo.profile.grad_graduation_year" />
                            </tr>
                            <tr>
                                <td><strong>Enrollment Status</strong></td>
                                <td v-text="userInfo.profile.grad_enrollment_status" />
                            </tr>
                            <tr>
                                <td><strong>Grad Degree Format</strong></td>
                                <td v-text="userInfo.profile.grad_degree_format" />
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>
                            <span>Financial Info</span>
                        </h3>
                    </div>
                    <div class="col-12">
                        <table class="table table-bordered">
                            <tr>
                                <td><strong>Credit Score</strong></td>
                                <td v-text="userInfo.profile.credit_score" />
                            </tr>
                            <tr>
                                <td><strong>Annual Income</strong></td>
                                <td v-text="userInfo.profile.annual_income" />
                            </tr>
                            <tr v-if="userInfo.profile.cosigner_annual_income">
                                <td><strong>Cosigner Annual Income</strong></td>
                                <td v-text="userInfo.profile.cosigner_annual_income" />
                            </tr>
                            <tr v-if="userInfo.profile.cosigner_credit_score">
                                <td><strong>Cosigner Credit Score</strong></td>
                                <td v-text="userInfo.profile.cosigner_credit_score" />
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div v-else class="justify-content-center row">
                <h3>No User Information Found</h3>
            </div>
            <div v-if="messages.length" class="mt-5">
                <div class="row">
                    <div class="col-12">
                        <h2>
                            <span>Message History</span>
                        </h2>
                    </div>
                    <div class="col-12">
                        <ul class="list-group">
                            <li v-for="message in messages" class="list-group-item">
                                <span class="badge badge-primary">
                                    <span v-if="message.incoming">Incoming</span>
                                    <span v-else>Outgoing</span>
                                </span>
                                <p v-text="message.created_at" />
                                <p v-text="message.body" />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div v-else class="justify-content-center row">
                <h3>No Message History Found</h3>
            </div>
        </template>
        <div class="row mt-5" v-if="searched && (messages.length || userInfo !== null)">
            <div class="col">
                <input v-model="phone"
                       class="form-control"
                       name="phone"
                       placeholder="Phone number">
                <button v-if="validPhoneNumber" class="btn btn-primary mt-3" @click.prevent="searchByPhone">
                    Search
                </button>
            </div>
        </div>
    </div>
</template>

<script scoped>
    export default {
        data() {
            return {
                phone:    '',
                userInfo: null,
                messages: [],
                searched: false,
            };
        },

        computed: {
            validPhoneNumber() {
                if (this.phone[0] === '+') {
                    return /^\+[\d+]{11,12}$/.test(this.phone);
                }

                return /^[\d+]{10,11}$/.test(this.phone);
            },
        },

        methods: {
            searchByPhone() {
                this.searched = false;
                axios.post('/admin/view-user-by-phone-number', {phone: this.phone})
                    .then(({data}) => {
                        this.searched = true;
                        this.messages = data.messages;
                        this.userInfo = data.userInfo;
                    });
            },
        },
    };
</script>
