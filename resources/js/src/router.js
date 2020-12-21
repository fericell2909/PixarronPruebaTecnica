import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    base: '/',
    scrollBehavior() {
        return {
            x: 0,
            y: 0
        }
    },
    routes: [
        {
            path: '',
            component: () => import('./layouts/main/Main.vue'),
            children: [
                {
                    path: '/iniciarsesion',
                    name: 'page-login',
                    component: () => import('@/views/pages/login/Login.vue'),
                    meta: {
                      rule: 'editor'
                    }
                  },
                  {
                    path: '/registrarse',
                    name: 'page-register',
                    component: () => import('@/views/pages/register/Register.vue'),
                    meta: {
                      rule: 'editor'
                    }
                  },
                  {
                    path: '/restablecer-password',
                    name: 'page-forgot-password',
                    component: () => import('@/views/pages/ForgotPassword.vue'),
                    meta: {
                      rule: 'editor'
                    }
                  },
                  {
                    path: '/reiniciar-password',
                    name: 'page-reset-password',
                    component: () => import('@/views/pages/ResetPassword.vue'),
                    meta: {
                      rule: 'editor'
                    }
                  },
                {
                    path: '/',
                    name: 'home',
                    component: () => import('@/views/eCommerce/ECommerceShop.vue'),
                    meta: {
                        requiresAuth: false,
                        is_admin: false
                    }
                },
                {
                    path: '/checkout',
                    name: 'ecommerce-checkout',
                    component: () => import('@/views/eCommerce/ECommerceCheckout.vue'),
                    meta: {
                        requiresAuth: true,
                        is_admin: false
                    }
                },
                {
                    path: '/apps/eCommerce/item/:item_id',
                    name: 'ecommerce-item-detail-view',
                    component: () => import('@/views/eCommerce/ECommerceItemDetailView.vue'),
                    meta: {
                        requiresAuth: true,
                        is_admin: false
                    }
                },
            ],
        },
        {
            path: '*',
            redirect: '/pages/error-404'
        }
    ],
})

router.afterEach(() => {
    // Remove initial loading
    const appLoading = document.getElementById('loading-bg')
    if (appLoading) {
        appLoading.style.display = "none";
    }
})

export default router
