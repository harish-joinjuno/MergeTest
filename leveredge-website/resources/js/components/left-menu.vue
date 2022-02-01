<template>
    <div>
<!--    <div id="left-menu">-->

<!--        <div class="sidebar-heading">Start Bootstrap </div>-->
        <div class="list-group list-group-flush">
            <div class="position-fixed">
                <a v-for="(item, index) in menuItems"
                   :href="item.link"
                   :key="index"
                   class="list-group-item list-group-item-action"
                   :class="{active: item.active}">

                    <i :class="item.icon" class="icon px-3"></i><span class="title">{{ item.name }}</span>
                </a>
            </div>
        </div>

<!--        <div class="line pb-5 mx-3" />-->
<!--        <ul class="menu p-0 m-0 pb-5">-->
<!--            <li-->
<!--                v-for="(item, index) in menuItems"-->
<!--                :key="index"-->
<!--                class="menu-item mb-3"-->
<!--                :class="{active: item.active}">-->
<!--                <a href="#" class="d-flex justify-content-start py-2">-->
<!--                    <div class="icon px-4">-->
<!--                        <img :src="`/img/icons/left-menu/${item.icon}.png`" :alt="item.name">-->
<!--                    </div>-->
<!--                    <div class="title">-->
<!--                        <span>{{ item.name }}</span>-->
<!--                    </div>-->
<!--                </a>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
    </div>
</template>

<script>
    export default {
        name: 'LeftMenu',
        data() {
            return {
                menuItems: [
                    {
                        name:   'Home',
                        link:   '/member/dashboard',
                        icon:   'fad fa-home',
                        active: true,
                    },
                    // {
                    //     name:   'Negotiation group',
                    //     icon:   'fad fa-hands-helping',
                    //     active: false,
                    // },
                    {
                        name:   'Referral center',
                        link:   '/member/referral-program',
                        icon:   'fad fa-stars',
                        active: false,
                    },
                ],
            };
        },
    };
</script>
