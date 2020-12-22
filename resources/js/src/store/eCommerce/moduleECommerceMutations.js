
export default {
  TOGGLE_ITEM_IN_WISH_LIST (state, item) {
    const index = state.wishList.findIndex(i => i.uuid === item.uuid)
    if (index < 0) {
      state.wishList.push(item)
    } else {
      state.wishList.splice(index, 1)
    }
  },
  REMOVE_ITEM_FROM_CART (state, item) {
    const index = state.cartItems.findIndex(i => i.uuid === item.uuid)
    if (index > -1) { state.cartItems.splice(index, 1) }
  },
  SET_ITEMS_CART(state,items){
    state.cartItems = items;
  },
  ADD_ITEM_IN_CART (state, item) {
    state.cartItems.push(Object.assign({}, item));

  },
  UPDATE_ITEM_QUANTITY (state, payload) {
    state.cartItems[payload.index].quantity = payload.quantity
  },

  INCREMENT_ITEM_QUANTITY (state, payload) {
    state.cartItems[payload.index].quantity = state.cartItems[payload.index].quantity + 1;
  },

  RESET_CART_ITEMS (state,payload) {

    state.cartItems = [];

  }

}

