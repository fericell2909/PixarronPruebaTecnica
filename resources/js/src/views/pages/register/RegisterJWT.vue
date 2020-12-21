
<template>
  <div class="clearfix">
    <vs-input
      v-validate="'required|alpha_dash|min:3'"
      data-vv-validate-on="blur"
      label-placeholder="Name"
      name="displayName"
      placeholder="Nombre"
      v-model="displayName"
      class="w-full" />

    <vs-input
      v-validate="'required|email'"
      data-vv-validate-on="blur"
      name="email"
      type="email"
      label-placeholder="Email"
      placeholder="Correo Electronico"
      v-model="email"
      class="w-full mt-6" />

    <vs-input
      ref="password"
      type="password"
      data-vv-validate-on="blur"
      v-validate="'required|min:6|max:10'"
      name="password"
      label-placeholder="Password"
      placeholder="Contraseña"
      v-model="password"
      class="w-full mt-6" />

    <vs-input
      type="password"
      v-validate="'min:6|max:10|confirmed:password'"
      data-vv-validate-on="blur"
      data-vv-as="password"
      name="confirmar Contraseña"
      label-placeholder="Confirm Password"
      placeholder="Confirmar Password"
      v-model="confirm_password"
      class="w-full mt-6" />

    <vs-checkbox v-model="isTermsConditionAccepted" class="mt-6">Acepto los Terminos y Condiciones.</vs-checkbox>
    <vs-button  type="border" :to="{ name: 'page-login' }" class="mt-6">Iniciar Sesion</vs-button>
    <vs-button class="float-right mt-6" @click="registerUserJWt" :disabled="!validateForm">Registrarse</vs-button>
  </div>
</template>
<style>
    header
        {
            display: none !important;
        }
</style>
<script>
export default {
  data () {
    return {
      displayName: '',
      email: '',
      password: '',
      confirm_password: '',
      isTermsConditionAccepted: true
    }
  },
  computed: {
    validateForm () {
      return  this.displayName !== '' && this.email !== '' && this.password !== '' && this.confirm_password !== '' && this.isTermsConditionAccepted === true
    }
  },
  methods: {
    checkLogin () {
      // If user is already logged in notify
      if (this.$store.state.auth.isUserLoggedIn()) {

        // Close animation if passed as payload
        // this.$vs.loading.close()

        this.$vs.notify({
          title: 'Login Attempt',
          text: 'You are already logged in!',
          iconPack: 'feather',
          icon: 'icon-alert-circle',
          color: 'warning'
        })

        return false
      }
      return true
    },
    registerUserJWt () {
      // If form is not validated or user is already login return
      if (!this.validateForm || !this.checkLogin()) return

      const payload = {
        userDetails: {
          displayName: this.displayName,
          email: this.email,
          password: this.password,
          confirmPassword: this.confirm_password
        },
        notify: this.$vs.notify
      }
      this.$store.dispatch('auth/registerUserJWT', payload)
    }
  }
}
</script>
