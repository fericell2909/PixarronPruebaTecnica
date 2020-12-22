
import jwt from '../../http/requests/auth/jwt/index.js'

import router from '@/router'

export default {
  loginAttempt ({ dispatch }, payload) {

    // New payload for login action
    const newPayload = {
      userDetails: payload.userDetails,
      notify: payload.notify,
      closeAnimation: payload.closeAnimation
    }

    // If remember_me is enabled change firebase Persistence
    if (!payload.checkbox_remember_me) {

      // Change firebase Persistence
      firebase.auth().setPersistence(firebase.auth.Auth.Persistence.SESSION)

      // If success try to login
        .then(function () {
          dispatch('login', newPayload)
        })

      // If error notify
        .catch(function (err) {

          // Close animation if passed as payload
          if (payload.closeAnimation) payload.closeAnimation()

          payload.notify({
            time: 2500,
            title: 'Error',
            text: err.message,
            iconPack: 'feather',
            icon: 'icon-alert-circle',
            color: 'danger'
          })
        })
    } else {
      // Try to login
      dispatch('login', newPayload)
    }
  },
  login ({ commit, state, dispatch }, payload) {

    // If user is already logged in notify and exit
    if (state.isUserLoggedIn()) {
      // Close animation if passed as payload
      if (payload.closeAnimation) payload.closeAnimation()

      payload.notify({
        title: 'Login Attempt',
        text: 'You are already logged in!',
        iconPack: 'feather',
        icon: 'icon-alert-circle',
        color: 'warning'
      })

      return false
    }

    // Try to sigin
    firebase.auth().signInWithEmailAndPassword(payload.userDetails.email, payload.userDetails.password)

      .then((result) => {

        // Set FLAG username update required for updating username
        let isUsernameUpdateRequired = false

        // if username is provided and updateUsername FLAG is true
        // set local username update FLAG to true
        // try to update username
        if (payload.updateUsername && payload.userDetails.displayName) {

          isUsernameUpdateRequired = true

          dispatch('updateUsername', {
            user: result.user,
            username: payload.userDetails.displayName,
            notify: payload.notify,
            isReloadRequired: true
          })
        }

        // Close animation if passed as payload
        if (payload.closeAnimation) payload.closeAnimation()

        // if username update is not required
        // just reload the page to get fresh data
        // set new user data in localstorage
        if (!isUsernameUpdateRequired) {
          router.push(router.currentRoute.query.to || '/')
          commit('UPDATE_USER_INFO', result.user.providerData[0], {root: true})
        }
      }, (err) => {

        // Close animation if passed as payload
        if (payload.closeAnimation) payload.closeAnimation()

        payload.notify({
          time: 2500,
          title: 'Error',
          text: err.message,
          iconPack: 'feather',
          icon: 'icon-alert-circle',
          color: 'danger'
        })
      })
  },

  registerUser ({dispatch}, payload) {

    // create user using firebase
    firebase.auth().createUserWithEmailAndPassword(payload.userDetails.email, payload.userDetails.password)
      .then(() => {
        payload.notify({
          title: 'Account Created',
          text: 'You are successfully registered!',
          iconPack: 'feather',
          icon: 'icon-check',
          color: 'success'
        })

        const newPayload = {
          userDetails: payload.userDetails,
          notify: payload.notify,
          updateUsername: true
        }
        dispatch('login', newPayload)
      }, (error) => {
        payload.notify({
          title: 'Error',
          text: error.message,
          iconPack: 'feather',
          icon: 'icon-alert-circle',
          color: 'danger'
        })
      })
  },
  updateUsername ({ commit }, payload) {
    payload.user.updateProfile({
      displayName: payload.displayName
    }).then(() => {

      // If username update is success
      // update in localstorage
      const newUserData = Object.assign({}, payload.user.providerData[0])
      newUserData.displayName = payload.displayName
      commit('UPDATE_USER_INFO', newUserData, {root: true})

      // If reload is required to get fresh data after update
      // Reload current page
      if (payload.isReloadRequired) {
        router.push(router.currentRoute.query.to || '/')
      }
    }).catch((err) => {
      payload.notify({
        time: 8800,
        title: 'Error',
        text: err.message,
        iconPack: 'feather',
        icon: 'icon-alert-circle',
        color: 'danger'
      })
    })
  },


  // JWT
  loginJWT ({ commit }, payload) {

    return new Promise((resolve, reject) => {
      jwt.login(payload.userDetails.email, payload.userDetails.password)
        .then(response => {

          // If there's user data in response
          //console.log(response);
          if (response.data.access_token) {


            // Set accessToken
            localStorage.setItem('accessToken', response.data.access_token)

            // Set bearer token in axios
            commit('SET_BEARER', response.data.accessToken)


            jwt.getUser(response.data.access_token).then(response => {

                if(response.data.id){

                    const userDefaults = {
                        uid         : response.data.id,
                        displayName : response.data.name, // From Auth
                        email       : response.data.email,
                        about       : "Hello",
                        photoURL    : require("@assets/images/portrait/small/avatar-default.jpg"), // From Auth
                        status      : "online",
                        userRole    : "user",
                        uuid :  response.data.uuid
                      }

                      localStorage.setItem("userInfo",JSON.stringify(userDefaults));
                      localStorage.setItem('uuid', response.data.uuid);
                    //this.$store.state.AppActiveUser = userDefaults;

                    // Update user details

                    commit('UPDATE_USER_INFO', userDefaults, {root: true})
                    //state.AppActiveUser = userDefaults;
                    //this.$store.state.AppActiveUser = userDefaults;
                     // Navigate User to homepage
                    //router.push(router.currentRoute.query.to || '/')
                    location.href="/";
                }
            })
            resolve(response)
          } else {
            reject({message: 'Credenciales Incorrectas.'})
          }

        })
        .catch(error => {  reject({message: 'No Autorizado'}) })
    })
  },
  registerUserJWT ({ commit }, payload) {

    const { displayName, email, password } = payload.userDetails

    return new Promise((resolve, reject) => {

      jwt.registerUser(displayName, email, password)
        .then(response => {
            if (response.data.access_token) {


                // Set accessToken
                localStorage.setItem('accessToken', response.data.access_token)

                // Set bearer token in axios
                commit('SET_BEARER', response.data.accessToken)


                jwt.getUser(response.data.access_token).then(response => {

                    if(response.data.id){

                        const userDefaults = {
                            uid         : response.data.id,
                            displayName : response.data.name, // From Auth
                            email       : response.data.email,
                            about       : "Hello",
                            photoURL    : require("@assets/images/portrait/small/avatar-default.jpg"), // From Auth
                            status      : "online",
                            userRole    : "user",
                            uuid :  response.data.uuid
                          }

                          localStorage.setItem("userInfo",JSON.stringify(userDefaults));
                          localStorage.setItem('uuid', response.data.uuid);

                        commit('UPDATE_USER_INFO', userDefaults, {root: true})

                        payload.notify({
                            title: 'success',
                            text: 'Registro Correcto',
                            iconPack: 'feather',
                            icon: 'icon-alert-circle',
                            color: 'warning'
                          });

                        location.href="/";
                    }
                });
            } else {
                payload.notify({
                    title: 'Error',
                    text: 'Registro Incorrecto',
                    iconPack: 'feather',
                    icon: 'icon-alert-circle',
                    color: 'warning'
                  });

            }
        })
        .catch(error => { reject(error) })
    })
  },
  fetchAccessToken () {
    return new Promise((resolve) => {
      jwt.refreshToken().then(response => { resolve(response) })
    })
  }
}
