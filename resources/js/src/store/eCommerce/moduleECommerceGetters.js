
export default {
  isInCart: state => itemId => {
      if(state.cartItems.length > 0 ) {
        return state.cartItems.some((item) => item.uuid === itemId)
      }

  },
  getTotalCart: state => {
    return state.cartItems.reduce((a, b) => a.price + b.price, 0);
  },
  isInWishList: state => itemId => {
    return state.wishList.some((item) => item.uuid === itemId)
  },
  getCartItem: state => itemId => {
    const result = state.cartItems.filter((item) => item.uuid === itemId)
    return result.length ? result.pop() : []
  }
}
