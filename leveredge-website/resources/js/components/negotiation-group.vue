<template>
    <div class="negotiation-group">
        <div class="dashboard-row pb-4 pb-md-0 mb-md-4">
            <div class="head p-3 p-md-4">
                <h2 class="h4 off-black mb-0 mx-md-2">
                    {{ negotiationGroup.display_name }}
                </h2>
                <p class="mx-md-2">
                    You’re <span class="secondary-green fw-600">one of {{ negotiationGroup.users_count }}</span> people who have helped us get a better deal for everyone.
                </p>
                <hr class="mt-2 mt-md-3 mb-0 mb-md-2 mx-md-2">
            </div>
            <div class="content text-center p-4 p-md-3 pb-md-0">
                <div class="d-flex justify-content-center pt-2 mb-2">
                    <h2 class="h1 off-black title">
                        Where are we in your deal negotiations?
                    </h2>
                </div>
                <div v-if="activeStep && negotiationGroup.progress_titles" class="row negotiation-steps pt-5">
                    <div
                        v-for="index of [0,1,2]"
                        :key="index"
                        class="col-12 col-md-4 pb-5 mb-3 pb-md-0 mb-md-0 d-flex d-md-block negotiation-step text-center">
                        <div
                            :class="{active: index < activeStep}"
                            class="negotiation-image d-flex justify-content-center mb-2">
                            <div
                                :class="iconBackground(index)"
                                class="negotiation-icon position-relative">
                                <img
                                    v-if="index < activeStep"
                                    src="/img/checked.png"
                                    class="checked-icon position-absolute"
                                    alt="checked">
                                <img
                                    v-else
                                    class="position-absolute"
                                    :src="`/img/negotiation-icon-${index}.png`"
                                    alt="icon">
                            </div>
                        </div>
                        <div class="text-left text-md-center pl-4 pl-md-0">
                            <h3 class="font-weight-bold mb-2" v-html="negotiationGroup.progress_titles[index] || '<br />'"></h3>
                            <div class="d-flex justify-content-center">
                                <p class="mb-0 mb-md-3" v-html="negotiationGroup.progress_descriptions[index]"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="card-body bg-translucent-green"
                v-html="negotiationGroup.dashboard_update" />
            <div class="p-4 d-flex justify-content-center" v-if="! negotiationGroup.hide_dashboard_button">
                <a
                    class="btn btn-primary pill-radius border-0 px-4 py-2 view-more"
                    :href="`/member/negotiation-group/${negotiationGroup.id}`">
                    <p class="my-1 mx-3" v-text="dashboardButtonCta"></p>
                </a>
<!--                    <form method="post" action="/member/leave-negotiation-group" class="d-inline-block">-->
<!--                        <input type="hidden" name="_token" :value="csrfToken" />-->
<!--                        <input-->
<!--                            type="hidden"-->
<!--                            name="negotiation_group_user_id"-->
<!--                            :value="negotiationGroupUserId">-->
<!--                        <div class="form-group mb-0">-->
<!--                            <button-->
<!--                                type="submit"-->
<!--                                class="btn btn-outline-danger off-black pill-radius px-4 py-2">-->
<!--                                <p class="my-1 mx-2">-->
<!--                                    Leave Negotiation Group-->
<!--                                </p>-->
<!--                            </button>-->
<!--                        </div>-->
<!--                    </form>-->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:  'NegotiationGroup',
        props: {
            negotiationGroup: {
                type:     Object,
                required: true,
            },
            negotiationGroupUserId: {
                type:     Number,
                required: true
            }
        },

        data() {
            return {
                activeStep: 0,
                csrfToken: document.getElementsByName('csrf-token')[0].getAttribute('content')
            };
        },

        computed: {
            dashboardButtonCta() {
                return this.negotiationGroup.dashboard_button_cta || 'View More';
            }
        },

        mounted() {
            this.activeStep = this.negotiationGroup.progress_stage - 1;
        },
        methods: {
            iconBackground(index) {
                return index < this.activeStep ? 'bg-secondary-green' : 'bg-primary-off-white';
            },
        },
    };
</script>
