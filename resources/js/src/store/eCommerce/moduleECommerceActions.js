import axios from 'axios';

export default {
    setItemsCart({
        commit
    }, item) {
        commit('SET_ITEMS_CART', item)
    },
    toggleItemInWishList({
        commit
    }, item) {
        commit('TOGGLE_ITEM_IN_WISH_LIST', item)
    },
    toggleItemInCart({
        getters,
        commit,
        dispatch
    }, item) {

        //getters.isInCart(item.uuid) ? commit('REMOVE_ITEM_FROM_CART', item) : dispatch('additemInCart', item)

        getters.isInCart(item.uuid) ? dispatch('removeitemInCart', item) : dispatch('additemInCart', item)

    },
    removeitemInCart({
        commit
    }, item) {

        axios.post('/api/auth/cart/deletecartitem/' + localStorage.getItem('uuid'), {
            "item_id": item.id,
            "cart_uuid": item.uuid
        }).then(response => {
            if (response.data.status > 0) {
                commit('REMOVE_ITEM_FROM_CART', item);
            }
        }).catch(e => {});

    },
    additemInCart({
        commit
    }, item) {

        axios.post('/api/auth/cart/addcartitem/' + localStorage.getItem('uuid'), {
            "item_id": item.id
        }).then(response => {
            if (response.data.status > 0) {
                commit('ADD_ITEM_IN_CART', item);
            }
        }).catch(e => {});


    },
    updateItemQuantity({
        commit
    }, payload) {

        axios.post('/api/auth/cart/increment/' + localStorage.getItem('uuid'), {
            "item_id": payload.id,
            "cart_uuid": payload.cart_uuid
        }).then(response => {
            if (response.data.status > 0) {
                commit('INCREMENT_ITEM_QUANTITY', payload)
            }
        }).catch(e => {});


    },

    generarOrder({
        commit
    }, payload) {

        axios.post('/api/auth/order/' + localStorage.getItem('uuid'), {
            "address_id": payload.address_id,
            "address": payload.address
        }, {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('accessToken')}`
            }
        }).then(response => {
            if (response.data.status) {

                payload.notify({
                    title: 'success',
                    text: 'Se genero su Orden. Por favor vaya a tablero',
                    color: 'success',
                    iconPack: 'feather',
                    icon: 'icon-alert-circle'
                    })

                commit('RESET_CART_ITEMS', item);

            }
        }).catch(e => {});

    }
}
