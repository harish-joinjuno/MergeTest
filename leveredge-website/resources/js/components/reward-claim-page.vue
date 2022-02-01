<template>
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="off-black text-center">
                    LeverEdge Reward Requests
                </h1>
                <h3 v-if="rewardClaims.length" class="text-center">
                    Note: Rewards are paid after we confirm the funds have been sent.
                </h3>
            </div>
        </div>

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
                                        <td>${{ rewardClaim.reward_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td>Loan Amount</td>
                                        <td>${{ rewardClaim.loan_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Method</td>
                                        <td v-text="rewardClaim.payment_method.name" />
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td v-if="rewardClaim.status" v-text="rewardClaim.status" />
                                        <td v-else>
                                            Processing
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Is Paid</td>
                                        <td>
                                            <i v-if="rewardClaim.is_paid" class="fal fa-check-circle" />
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
                        <label for="deal">Lender / Partner</label>
                        <select id="deal"
                                v-model="form.deal"
                                class="form-control"
                                :class="{'is-invalid': hasError('deal')}">
                            <option :value="null" selected>
                                Select Lender / Partner
                            </option>
                            <option v-for="deal in deals"
                                    :key="deal.id"
                                    :value="deal"
                                    v-text="deal.name" />
                        </select>
                        <div v-if="hasError('deal')" class="invalid-feedback" role="alert" v-text="getError('deal')" />
                        <p>
                            {{ lenderPartnerDisclaimer }}
                        </p>
                    </div>
                    <div class="form-group">
                        <label for="loan_amount">Loan Amount</label>
                        <input id="loan_amount"
                               v-model="form.loan_amount"
                               type="number"
                               class="form-control"
                               :class="{'is-invalid': hasError('loan_amount')}"
                               @keypress="loanAmountChanged">
                        <p class="small text-muted">
                            Please round to the nearest dollar.
                        </p>
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
                        <label>
                            Final Disclosure or Loan Agreement Confirmation
                            (<a href="javascript:void(0)" data-toggle="tooltip" title="We don't receive PII from our partners. We use the information in this document to match the reports we do receive to confirm your eligibility for the rewards.">why do we need this?</a>)
                        </label>
                        <file-dropzone id="dropzone"
                                       ref="myVueDropzone"
                                       :options="dropzoneOptions"
                                       @vdropzone-success="fileUploadedSuccessfully"
                                       @vdropzone-error="fileUploadError" />
                    </div>
                    <p v-if="hasError('fileId')" class="danger mb-3" v-text="getError('fileId')" />


                    <div class="form-group">
                        <h4>Additional Information</h4>
                        <p>
                            This information allows us to confirm that lenders are providing you with quotes that are
                            inline with expectations they have set with us. Additionally, it allows us to respond to
                            members who have a similar credit profile with information about what rates they can expect.
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="credit_score">Credit Score</label>
                        <select id="credit_score"
                                v-model="form.credit_score"
                                :required="true"
                                class="form-control"
                                :class="{'is-invalid': hasError('credit_score')}">
                            <option :value="null">
                                Select your Credit Score
                            </option>
                            <option v-for="creditScore in creditScores"
                                    :key="creditScore"
                                    :value="creditScore"
                                    v-text="creditScore" />
                        </select>
                        <div v-if="hasError('credit_score')" class="invalid-feedback" role="alert" v-text="getError('credit_score')" />
                    </div>

                    <div class="form-group">
                        <label for="annual_income">Annual Pre-Tax Income</label>
                        <input id="annual_income"
                               v-model.number="form.annual_income"
                               type="number"
                               :required="true"
                               class="form-control"
                               placeholder="e.g. 105,000"
                               :class="{'is-invalid': hasError('annual_income')}">
                        <div v-if="hasError('annual_income')" class="invalid-feedback" role="alert" v-text="getError('annual_income')" />
                    </div>

                    <div class="form-group">
                        <label for="cosigner_credit_score">Cosigner's Credit Score</label>
                        <select id="cosigner_credit_score"
                                v-model="form.cosigner_credit_score"
                                :required="true"
                                class="form-control"
                                :class="{'is-invalid': hasError('cosigner_credit_score')}">
                            <option :value="null">
                                Select your Cosigner's Credit Score
                            </option>
                            <option v-for="cosignerCreditScore in cosignerCreditScores"
                                    :key="cosignerCreditScore"
                                    :value="cosignerCreditScore"
                                    v-text="cosignerCreditScore" />
                        </select>
                        <div v-if="hasError('cosigner_credit_score')" class="invalid-feedback" role="alert" v-text="getError('cosigner_credit_score')" />
                    </div>

                    <div class="form-group">
                        <label for="annual_income">Cosigner's Annual Income</label>
                        <input id="cosigner_annual_income"
                               v-model.number="form.cosigner_annual_income"
                               type="number"
                               class="form-control"
                               placeholder="e.g. 105,000"
                               :class="{'is-invalid': hasError('cosigner_annual_income')}">
                        <div v-if="hasError('cosigner_annual_income')" class="invalid-feedback" role="alert" v-text="getError('cosigner_annual_income')" />
                    </div>


                    <div class="sign-up-next form-group mb-0">
                        <button class="btn btn-block btn-primary" @click.prevent="claimReward">
                            Request Reward
                        </button>
                    </div>
                </template>
            </div>
        </div>

        <div v-if="showForm" class="row mt-5">
            <div class="col-12">
                <h4>
                    <a href="#" type="button" data-toggle="collapse" data-target="#rewardsTimingInformation" aria-expanded="false" aria-controls="rewardsTimingInformation">
                        <span class="fw-600">When do I get this reward?</span>
                    </a>
                </h4>
                <div id="rewardsTimingInformation" class="collapse">
                    <p>
                        You’ll receive your LeverEdge Reward once the partner confirms that LeverEdge will be paid
                        for referring you to them. Typically, this happens a few days after when the loan amount
                        gets sent by the lender to the school. The exact date should be in your final loan documents.
                    </p>
                    <p class="mt-2">
                        It is common for a loan to be split into multiple disbursements (aligned with the semesters
                        or quarters of the school year). In this case, your reward may also be proportionally split.
                    </p>
                    <p class="mt-2">
                        <em>
                            Note: Since we’re passing along a portion of our revenue to you, your reward is contingent
                            on us getting paid.
                        </em>
                    </p>
                </div>
            </div>

            <div class="col-12">
                <h4 class="mt-3">
                    <a href="#" type="button" data-toggle="collapse" data-target="#finalDisclosureInformation" aria-expanded="false" aria-controls="finalDisclosureInformation">
                        <span class="fw-600">How to find your final disclosure document?</span>
                    </a>
                </h4>

                <div id="finalDisclosureInformation" class="collapse">
                    <h5>
                        <a href="#" type="button" data-toggle="collapse" data-target="#commonbondInstructions" aria-expanded="false" aria-controls="commonbondInstructions">
                            CommonBond
                        </a>
                    </h5>
                    <ol id="commonbondInstructions" class="collapse">
                        <li>Login to your CommonBond Account</li>
                        <li>Navigate to <strong>Member Home</strong> by clicking on the link in the dropdown under your name in the Navigational Menu</li>
                        <li>Click on <strong>Your documents and additional details</strong></li>
                        <li>The document is titled <strong>Final Disclosure</strong></li>
                        <li>Click on <strong>View Document</strong> and proceed to Download the Document on your Computer</li>
                        <li>Upload the document above</li>
                    </ol>

                    <h5 class="mt-3">
                        <a href="#" type="button" data-toggle="collapse" data-target="#citizensInstructions" aria-expanded="false" aria-controls="citizensInstructions">
                            Citizens Bank
                        </a>
                    </h5>
                    <ol id="citizensInstructions" class="collapse">
                        <li>Login to your Credible Account</li>
                        <li>Click View Dashboard for your Student Loan</li>
                        <li>Click Go to Lender's Site</li>
                        <li>Log into your Citizen's Bank account</li>
                        <li>Expand section 5, View Your Loan Documents</li>
                        <li>The document is titled Final Disclosure.</li>
                        <li>Click the document name or icon to the right to download the document to your computer.</li>
                        <li>Upload the documents above.</li>
                    </ol>


                    <h5 class="mt-3">
                        <a href="#" type="button" data-toggle="collapse" data-target="#edvestinuInstructions" aria-expanded="false" aria-controls="edvestinuInstructions">
                            EDvestinU
                        </a>
                    </h5>
                    <p id="edvestinuInstructions" class="collapse">
                        The document can be found when you login to the EDvestinU website, scroll down to "Borrower ESigned Documents" and click "view".
                    </p>

                    <h5>
                        <a href="#" type="button" data-toggle="collapse" data-target="#credibleInstructions" aria-expanded="false" aria-controls="commonbondInstructions">
                            Credible - College Ave
                        </a>
                    </h5>
                    <ol id="credibleInstructions" class="collapse">
                        <li>Go to <a href="www.collegeavestudentloans.com/application" target="_blank" rel="noopener noreferrer">www.collegeavestudentloans.com/application.</a></li>
                        <li>Enter your reference number and the last 4 digits of your Social Security Number.</li>
                        <li>Review the Final Disclosure document.</li>
                        <li>Print and/or save for your records.</li>
                    </ol>

                    <h5>
                        <a href="#" type="button" data-toggle="collapse" data-target="#earnestInstructions" aria-expanded="false" aria-controls="commonbondInstructions">
                            Earnest
                        </a>
                    </h5>
                    <ol id="earnestInstructions" class="collapse">
                        <li>
                            After accepting your Earnest loan offer and providing all your information,
                            you will receive an email with the subject <strong>"Your Earnest Loan Documents"</strong>
                        </li>
                        <li>
                            Open this email and find the attachment titled
                            <strong>"final-disclosure-statement.pdf"</strong>
                        </li>
                    </ol>

                    <h5>
                        <a href="#" type="button" data-toggle="collapse" data-target="#firstRepublicInstructions" aria-expanded="false" aria-controls="firstRepublicInstructions">
                            First Republic
                        </a>
                    </h5>
                    <ol id="firstRepublicInstructions" class="collapse">
                        <li>
                            Search your email inbox for “finish your First Republic Personal Line of Credit
                            loan agreement today”
                        </li>
                        <li>
                            Open the link to the agreement, and click Download.
                        </li>
                    </ol>


                    <h5 class="mt-3">
                        Other Lenders/Partners
                    </h5>
                    <p>
                        We're looking for a document that can help verify your loan; some lenders may call it
                        something besides a final disclosure so we'll accept most documentation that includes the
                        following: Your name & address, the confirmed final loan amount, and the APR.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import fileDropzone from 'vue2-dropzone';

    const errorsDefault = {
        deal:           [],
        loan_amount:    [],
        payment_method: [],
    };

    export default {
        components: {
            fileDropzone,
        },

        props: {
            deals: {
                required: true,
                type:     Array,
            },
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
                    deal:                  null,
                    loan_amount:           null,
                    payment_method_id:     null,
                    credit_score:          null,
                    cosigner_credit_score: null,
                    annual_income:         null,
                    cosigner_annual_income: null,
                },
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
                saved:             false,
                rewardClaims:      [],
                showForm:          true,
                userEmail:         null,
                userId:            null,
                rewardAmountValue: 0,
                creditScores:      [
                    '600 - 620',
                    '620 - 640',
                    '640 - 660',
                    '660 - 680',
                    '680 - 700',
                    '700 - 720',
                    '720 - 740',
                    '740 - 760',
                    '760 - 780',
                    '780 - 800',
                    '800 +',
                ],
                cosignerCreditScores: [
                    'I applied without a co-signer',
                    'I don\'t know my co-signers credit score',
                    '600 - 620',
                    '620 - 640',
                    '640 - 660',
                    '660 - 680',
                    '680 - 700',
                    '700 - 720',
                    '720 - 740',
                    '740 - 760',
                    '760 - 780',
                    '780 - 800',
                    '800 +',
                ],
            };
        },
        computed: {
            lenderPartnerDisclaimer() {
                if (this.form.deal && this.form.deal.name) {
                    return {
                    'Earnest Refinance Deal with Rewards':    'This form only shows rewards that come from us. Separately, if you\'re eligible, you should receive another $500 from Earnest directly deposited into your bank account automatically.',
                    'Splash Refinance Deal':                  'This form only shows rewards that come from us. Separately, if you\'re eligible, you should receive another $300 from Splash directly via mail.',
                    'First Republic Personal Line of Credit': 'This form only shows rewards that come from us. If you\'re eligible, you should receive another $400 from First Republic.',
                    }[this.form.deal.name];
                }

                return '';
            },
        },
        watch: {
            'form.deal': {
                handler() {
                    this.calculateRewardAmount();
                },
                deep: true,
            },
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
                    deal_id: this.form.deal.id,
                };

                axios.post('/member/reward-claim', data)
                    .then(({data}) => {
                        window.location.href = '/member/reward-claim/success';

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
                        deal_id:     this.form.deal.id,
                    };
                    axios.post('/member/get-reward-amount', data)
                        .then(({data}) => {
                            this.rewardAmountValue = Math.round(data.rewardAmount);
                        });
                } else {
                    this.rewardAmountValue = 0;
                }
            },

            loanAmountChanged(event) {
                const reg = new RegExp('^[0-9]+$');
                if (!reg.test(event.key)) {
                    event.preventDefault();
                }
            },
        },
    };
</script>
