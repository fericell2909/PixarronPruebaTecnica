

import auth from '@/auth/authService'


export default {
  isUserLoggedIn: () => {
    let isAuthenticated = false


    if (auth.isAuthenticated() ) isAuthenticated = true
    else isAuthenticated = false

    return localStorage.getItem('userInfo') && isAuthenticated
  }
}
