<template>
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="off-black text-center">
                    Screenshot Reward Requests
                </h1>
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
                                        Reward for Sharing LeverEdge with Friends & Classmates
                                    </a>
                                </p>
                            </div>
                            <div :id="'reward-claim-details-' + rewardClaim.id" class="card-body p-0 collapse">
                                <table class="table table-borders">
                                    <tr>
                                        <td>Reward Amount</td>
                                        <td>{{ rewardClaim.amount ? '$' + rewardClaim.amount : 'TBD' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td v-text="rewardClaim.status" />
                                    </tr>
                                    <tr>
                                        <td>Is Paid</td>
                                        <td>
                                            <i v-if="rewardClaim.is_paid" class="fal fa-check-circle" />
                                            <i v-else class="fal fa-times-circle" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Requested On</td>
                                        <td v-text="rewardClaim.created_at" />
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="saved" class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>We've received your request and will get back to you in a few days</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <template v-if="!rewardClaims.length">
                    <template v-if="showForm">
                        <div class="form-group">
                            <label for="payment_method_id">Payment Method</label>
                            <input id="payment_method_id"
                                   type="text"
                                   class="form-control"
                                   placeholder="Amazon Gift Card"
                                   disabled>
                            <p class="text-muted mb-0">
                                Your reward will be sent to <span v-text="userEmail" />
                            </p>
                            <div v-if="hasError('payment_method_id')" class="invalid-feedback" role="alert" v-text="getError('payment_method_id')" />
                        </div>
                        <div class="form-group">
                            <label>Screenshot</label>
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
                        We review screenshot reward requests once a week.
                        If you don't get the reward within 7 days, shoot a quick note to <a href="mailto:support@leveredge.org">support@leveredge.org</a>.
                    </p>
                </div>


                <h4>
                    <a href="#" type="button" data-toggle="collapse" data-target="#rewardsEligibilityInformation" aria-expanded="false" aria-controls="rewardsEligibilityInformation">
                        <span class="fw-600">Who is eligible for this reward?</span>
                    </a>
                </h4>
                <div id="rewardsEligibilityInformation" class="collapse">
                    <p>
                        We don't have a complex eligibility criteria. If you received an email from us, you are
                        eligible as long as you've submitted an honest post about LeverEdge in an appropriate group.
                    </p>
                    <p>
                        Appropriate groups include Facebook groups, WhatsApp groups, Slack channels where a
                        significant percentage of the group would find LeverEdge useful.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import fileDropzone from 'vue2-dropzone';

    const errorsDefault = {
    };

    export default {
        components: {
            fileDropzone,
        },

        props: {
            previousRewards: {
                required: true,
                type:     Array,
            },
        },
        data() {
            return {
                form: {

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
            };
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

                axios.post(`/member/screenshot-reward`, data)
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
        },
    };
</script>
