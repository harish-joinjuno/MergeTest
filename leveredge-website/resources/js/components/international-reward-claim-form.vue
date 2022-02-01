<template>
    <div class="row">
        <div class="col-12">
            <div v-if="rewardClaims.length" class="row mb-5">
                <div class="col-12">
                    <h2>Rewards you've requested</h2>
                </div>

                <div v-for="rewardClaim in rewardClaims" :key="rewardClaim.id" class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header" data-toggle="collapse" :data-target="'#reward-claim-details-' + rewardClaim.id" aria-expanded="false" :aria-controls="'reward-claim-details-' + rewardClaim.id">
                            <p class="card-title mb-0 fw-600">
                                <a href="javascript:void(0)">
                                    Reward for ${{ parseInt(rewardClaim.loan_amount) }} Loan from {{ rewardClaim.deal.name }}
                                </a>
                            </p>
                        </div>
                        <div :id="'reward-claim-details-' + rewardClaim.id" class="card-body p-0 collapse">
                            <table class="table table-borders">
                                <tr>
                                    <td>Deal</td>
                                    <td v-text="rewardClaim.deal.name" />
                                </tr>
                                <tr>
                                    <td>Reward Amount</td>
                                    <td>${{ rewardClaim.amount }}</td>
                                </tr>
                                <tr>
                                    <td>Cost of Insurance</td>
                                    <td>${{ rewardClaim.loan_amount }}</td>
                                </tr>
                                <tr>
                                    <td>Payment Method</td>
                                    <td v-text="rewardClaim.payment_method.name" />
                                </tr>
                                <tr>
                                    <td>Is Paid</td>
                                    <td>
                                        <i v-if="rewardClaim.payment_completed" class="fal fa-check-circle" />
                                        <i v-else class="fal fa-times-circle" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>Submitted Date</td>
                                    <td v-text="rewardClaim.date_submitted" />
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="saved" class="alert alert-success alert-dismissible fade show" role="alert">
                <p>We've received your request and will get back to you as soon as we can confirm the loan</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <template v-if="showForm">
                <h2>Request Reward</h2>
                <div class="form-group">
                    <label for="loan_amount">Cost of Insurance</label>
                    <input id="loan_amount"
                           v-model="form.loan_amount"
                           type="number"
                           class="form-control"
                           :class="{'is-invalid': hasError('loan_amount')}">
                    <div v-if="hasError('loan_amount')" class="invalid-feedback" role="alert" v-text="getError('loan_amount')" />
                </div>
                <div class="form-group">
                    <label for="reward_amount">Reward Amount</label>
                    <input id="reward_amount"
                        type="number"
                        class="form-control"
                        :value="rewardAmountValue"
                        :readonly="true"
                        :diabled="true">
                    <div class="invalid-feedback" role="alert" />
                </div>
                <div class="form-group">
                    <label for="payment_method_id">Payment Method</label>
                    <select id="payment_method_id"
                            v-model="form.payment_method_id"
                            class="form-control"
                            :class="{'is-invalid': hasError('payment_method_id')}">
                        <option :value="null">
                            Select Payment Method
                        </option>
                        <option v-for="paymentMethod in paymentMethods"
                                :key="paymentMethod.id"
                                :value="paymentMethod.id"
                                v-text="paymentMethod.name" />
                    </select>
                    <p class="text-muted mb-0">
                        Your reward will be sent to <span v-text="userEmail" />
                    </p>
                    <div v-if="hasError('payment_method_id')" class="invalid-feedback" role="alert" v-text="getError('payment_method_id')" />
                </div>
                <div class="form-group">
                    <label>Final Disclosure Document (<a href="javascript:void(0)" data-toggle="tooltip" title="We don't receive PII from our partners. We use the information in this document to match the reports we do receive to confirm your eligibility for the rewards.">why do we need this?</a>
                        )</label>
                    <file-dropzone id="dropzone"
                                   ref="myVueDropzone"
                                   :options="dropzoneOptions"
                                   @vdropzone-success="fileUploadedSuccessfully"
                                   @vdropzone-error="fileUploadError" />
                </div>
                <p v-if="hasError('fileId')" class="danger mb-3" v-text="getError('fileId')" />

                <div class="sign-up-next form-group mb-0">
                    <button class="btn btn-block btn-primary" @click.prevent="claimReward">
                        Request Reward
                    </button>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
    import fileDropzone from 'vue2-dropzone';

    const errorsDefault = {
        loan_amount:    [],
        payment_method: [],
    };

    export default {
        components: {
            fileDropzone,
        },

        props: {
            paymentMethods: {
                required: true,
                type:     Array,
            },
            previousRewards: {
                required: true,
                type:     Array,
            },
        },

        data() {
            return {
                form: {
                    deal_id:           null,
                    loan_amount:       null,
                    payment_method_id: null,
                },
                userEmail:       null,
                dropzoneOptions: {
                    url:            '/file-upload',
                    maxFiles:       1,
                    thumbnailWidth: 150,
                    headers:        {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    },
                    params: {
                        path:                 null,
                    },
                    language: {
                        dictDefaultMessage: 'Drop a PDF or Image here, or click to select a file to upload.',
                    },
                },
                fileId:            null,
                errors:            errorsDefault,
                rewardClaims:      [],
                saved:             false,
                showForm:          true,
                rewardAmountValue: 0
            }
        },

        watch: {
            'form.loan_amount': {
                handler() {
                    this.calculateRewardAmount();
                },
                deep: true,
            },
        },

        mounted() {
            this.userId = window.userId.toString();
            this.userEmail = window.userEmail;
            this.dropzoneOptions.params.path = `users/${window.userId}/screenshots`;
            this.rewardClaims = this.previousRewards;
        },

        methods: {
            fileUploadedSuccessfully(file, response) {
                this.fileId = response.id;
            },

            fileUploadError(file, message, xhr) {
                document.getElementsByClassName('dz-error-message')[0].innerHTML = message.errors.file[0];
            },

            claimReward() {
                const data = {
                    ...this.form,
                    fileId:  this.fileId,
                };

                axios.post(`/member/international-reward-claim`, data)
                    .then(({data}) => {
                        this.saved = true;
                        setTimeout(() => {
                            this.saved = false;
                        }, 5000);
                        this.errors = errorsDefault;
                        for (const key in this.form) {
                            this.form[key] = null;
                        }
                        this.rewardClaims = data.rewardClaims;
                        this.showForm = false;
                    }).catch((error) => {
                    this.errors = error.response.data.errors;
                });
            },

            hasError(key) {
                return this.errors.hasOwnProperty(key) && this.errors[key].length;
            },

            getError(key) {
                return this.errors[key][0];
            },
            calculateRewardAmount() {
                const loanAmount = parseInt(this.form.loan_amount);
                if (Number.isInteger(loanAmount) !== true) {
                    this.rewardAmountValue = 0;
                }
                if (this.form.deal !== null) {
                    const data = {
                        loan_amount: loanAmount,
                    };
                    axios.post('/member/get-international-reward-amount', data)
                        .then(({data}) => {
                            this.rewardAmountValue = Math.round(data.rewardAmount);
                        });
                } else {
                    this.rewardAmountValue = 0;
                }
            },
        }
    }
</script>
