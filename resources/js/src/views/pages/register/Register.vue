
<template>
    <div class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center">
        <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4" id="register_login">

            <vx-card>
                <div slot="no-body" class="full-page-bg-color">
                    <div class="vx-row no-gutter">
                        <div class="vx-col hidden sm:hidden md:hidden lg:block lg:w-1/2 mx-auto self-center">
                            <img src="@assets/images/login/register.png" alt="Registrese para Acceder al Sistema" class="mx-auto">
                        </div>
                        <div class="vx-col sm:w-full md:w-full lg:w-1/2 mx-auto self-center  d-theme-dark-bg">
                            <div class="px-8 pt-8 register-tabs-container">
                                <div class="vx-card__title mb-4">
                                    <h4 class="mb-4">Registrase</h4>
                                    <p>Complete los siguientes espacios en blanco.</p>
                                    <a href="/" class="ml-2">Ir a Tienda</a>
                                </div>

                                <register-jwt></register-jwt>

                            </div>
                        </div>
                    </div>
                </div>
            </vx-card>
        </div>

    </div>
</template>
<style>
    #register_login
        {
            margin-top: -100px !important;
        }
</style>
<script>
import RegisterJwt from './RegisterJWT.vue'

export default {
  components: {
    RegisterJwt
  }
}
</script>

<style lang="scss">
.register-tabs-container {
  min-height: 517px;

  .con-tab {
    padding-bottom: 23px;
  }
}
</style>
