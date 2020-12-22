<template>
    <div
        class="the-navbar__user-meta flex items-center"
        v-if="activeUserInfo != null"
    >
        <div class="text-right leading-tight hidden sm:block">
            <p class="font-semibold">{{ activeUserInfo.displayName }}</p>
            <small>Disponible</small>
        </div>

        <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer">
            <div class="con-img ml-3">
                <img
                    v-if="activeUserInfo.photoURL"
                    key="onlineImg"
                    :src="activeUserInfo.photoURL"
                    alt="user-img"
                    width="40"
                    height="40"
                    class="rounded-full shadow-md cursor-pointer block"
                />
            </div>

            <vs-dropdown-menu class="vx-navbar-dropdown">
                <ul style="min-width: 9rem">
                    <li
                        class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
                         @click="dashboard">
                        <feather-icon icon="UserIcon" svgClasses="w-4 h-4" />
                        <span class="ml-2">Ir a Tablero</span>
                    </li>

                    <vs-divider class="m-1" />

                    <li
                        class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
                        @click="logout"
                    >
                        <feather-icon icon="LogOutIcon" svgClasses="w-4 h-4" />
                        <span class="ml-2">Cerrar Sesión</span>
                    </li>
                </ul>
            </vs-dropdown-menu>
        </vs-dropdown>
    </div>
    <div v-else class="the-navbar__user-meta flex items-center">
        <div class="text-right leading-tight ">
            <div class="" id="account-manage-buttons">
                <vs-button
                    icon-pack="feather"
                    icon="icon-edit"
                    class="w-full mr-4"
                    :to="{ name: 'page-register' }"
                    >Registrarse</vs-button
                >
                <vs-button
                    type="border"
                    color="danger"
                    icon-pack="feather"
                    icon="icon-user"
                    class="w-full"
                    :to="{ name: 'page-login' }"
                    >Iniciar Sesión</vs-button
                >
            </div>
        </div>
    </div>
</template>
<style>
#account-manage-buttons {
    display: inline-flex;
}
</style>
<script>
import router from '@/router'

export default {
    mounted(){
    },
    computed: {
        activeUserInfo() {
            if(this.$store.state.AppActiveUser != null ) {
                return this.$store.state.AppActiveUser;
            } else {
                if(localStorage.getItem('userInfo') != null) {
                    return JSON.parse(localStorage.getItem('userInfo'));
                } else {
                    return null;
                }
            }
        }
    },
    methods: {
        logout() {
            //console.log("cerrando session");
            localStorage.removeItem("userInfo");
            localStorage.removeItem('uuid');
            localStorage.removeItem('accessToken')

            location.href="/";

        },
        dashboard(){
            location.href = '/dashboard/user/'+  localStorage.getItem('uuid');
        }
    }
};
</script>
