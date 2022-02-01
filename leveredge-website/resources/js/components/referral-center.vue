<template>
    <div class="dashboard-row mb-md-4 mb-3">
        <div class="head p-3 p-md-4">
            <h2 class="h4 off-black mb-0 mx-md-2">
                Referral center
            </h2>
            <hr class="mt-2 mt-md-3 mb-0 mb-md-2 mx-md-2">
        </div>
        <div class="content text-center p-5">
            <div class="d-flex justify-content-center mb-2">
                <h2 class="off-black title">
                    Friends don’t let friends overpay for their student loans
                </h2>
            </div>
            <div class="d-flex justify-content-center mb-4">
                <img src="/img/referral-center.png" alt="">
            </div>
            <div class="d-flex justify-content-center">
                <div class="copy-link w-100">
                    <div class="copy-body d-flex flex-row justify-content-between mb-2">
                        <input
                            id="unique-url"
                            type="text"
                            class="form-control bg-white py-3 pl-4 my-1"
                            :value="link"
                            readonly
                            @click="$event.target.select()">
                        <button
                            class="btn bg-secondary-green position-relative white rounded-pill py-2 px-4 copy-button"
                            aria-describedby="tooltipcopy"
                            data-clipboard-target="#unique-url"
                            @click="copyText">
                            <span class="d-block my-2">Copy link</span>
                            <div
                                v-if="showTooltip"
                                id="tooltipcopy"
                                class="tooltip fade bs-tooltip-top show"
                                role="tooltip"
                                style="position: absolute; top: -47px; left: 22px; will-change: transform;" x-placement="top">
                                <div class="arrow" style="left: 31px;" />
                                <div class="tooltip-inner">
                                    Copied!
                                </div>
                            </div>
                        </button>
                    </div>
                    <a href="/member/referral-program" class="learn-more mt-4">Learn more about rewards in referral center</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ReferralCenter',
        data() {
            return {
                showTooltip: false,
            };
        },
        props: {
            link: {
                type: String,
                default: null
            }
        },
        methods: {
            copyText() {
                this.showTooltip = true;
                setTimeout(() => {
                    this.showTooltip = false;
                }, 1000);
            },
        },
    };
</script>
