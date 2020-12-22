
<template>
    <div id="ecommerce-checkout-demo">
    <a href="/" class="ml-2">Ir a Tienda</a>
        <form-wizard
            ref="checkoutWizard"
            color="rgba(var(--vs-primary), 1)"
            :title="null"
            :subtitle="null"
            :hide-buttons="true">

            <!-- tab 1 content -->
            <tab-content title="Carro de Compra" icon="feather icon-shopping-cart" class="mb-5">

                <!-- IF CART HAVE ITEMS -->
                     <div class="vx-row" v-if="cartItems.length">

                    <!-- LEFT COL -->
                    <div class="vx-col lg:w-2/3 w-full relative">
                        <div class="items-list-view" v-for="(item, index) in cartItems" :key="item.uuid">
                             <item-list-view :item="item" class="mb-base">

                                <!-- SLOT: ITEM META -->
                                <template slot="item-meta">
                                    <h5
                                      class="item-name font-semibold mb-1 cursor-pointer hover:text-primary"
                                      >{{ item.name }}</h5>
                                      <h6
                                      class="item-name font-semibold mb-1 cursor-pointer hover:text-primary"
                                      >{{ item.description }}</h6>
                                        <span class="text-sm font-medium">{{ item.quantity }} <small>x</small> ${{ item.price }}</span>


                                </template>

                                <!-- SLOT: ACTION BUTTONS -->
                                <template slot="action-buttons">
                                    <!-- PRIMARY BUTTON: REMOVE -->
                                    <div class="item-view-primary-action-btn p-3 rounded-lg flex flex-grow items-center justify-center cursor-pointer mb-3" @click="removeItemFromCart(item)">
                                        <feather-icon icon="XIcon" svgClasses="h-4 w-4" />
                                        <span class="text-sm font-semibold ml-2">Eliminar</span>
                                    </div>
                                </template>
                            </item-list-view>
                        </div>
                    </div>

                    <!-- RIGHT COL -->
                    <div class="vx-col lg:w-1/3 w-full">
                        <vx-card>
                            <vs-divider />

                            <p class="font-semibold mb-3">Detalle de Compra</p>
                            <div class="flex justify-between mb-2">
                                <span class="text-grey">SubTotal</span>
                                <span>{{ cartTotal}}</span>
                            </div>
                            <div class="flex justify-between mb-2">
                                <span class="text-grey">Envío a Domicilio</span>
                                <span class="text-success">Gratis</span>
                            </div>

                            <vs-divider />

                            <div class="flex justify-between font-semibold mb-3">
                                <span>Total</span>
                                <span>{{ cartTotal}}</span>
                            </div>

                            <vs-button class="w-full" @click="$refs.checkoutWizard.nextTab()">GENERAR COMPRA</vs-button>
                        </vx-card>
                    </div>
                </div>

                <!-- IF NO ITEMS IN CART -->
                <vx-card title="No tienes Productos en tu Carrito." v-else>
                    <vs-button @click="back()">Ir a Tienda</vs-button>
                </vx-card>

            </tab-content>

            <!-- tab 2 content -->
            <tab-content title="Dirección" icon="feather icon-home" class="mb-5">
                <div class="vx-row">

                    <!-- LEFT COL: NEW ADDRESS -->
                    <div class="vx-col lg:w-2/3 w-full">
                        <vx-card title="Dirección"
                                subtitle="Seleccione una y/o Registre una Nueva" class="mb-base">

                            <form data-vv-scope="add-new-address">
                                <div class="vx-row">
                                    <div class="vx-col sm:w-1/2 w-full">

                                        <vs-input
                                            data-vv-as="field"
                                            name="Address"
                                            label="Direccion:"
                                            v-model="Address"
                                            class="w-full mt-5" />

                                    </div>
                                </div>



                                <div class="vx-row">

                                    <div class="vx-col sm:w-1/2 w-full">
                                        <label for="" clas="vs-input--label" >Direccion</label>
                                        <select name ="address_id" id="address_id"  style="margin-top: 15px; border: 1px solid rgba(0, 0, 0, 0.2); padding: 0.7rem !important; border-radius: 5px !important;">
                                            <option :value="item.id" v-for="(item,index) in addressTypeOptions" v-bind:key ="index">{{item.address}}</option>
                                        </select>
                                    </div>
                                </div>
                                      <vs-button class="mt-6 ml-auto flex" @click.prevent="submitNewAddressForm">REALIZAR COMPRA</vs-button>
                            </form>
                        </vx-card>
                    </div>



                </div>
            </tab-content>



        </form-wizard>
    </div>
</template>

<script>
import { FormWizard, TabContent } from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
const ItemListView = () => import('./components/ItemListView.vue')

export default {
  data () {
    return {

      // TAB 2
      Address: '',
      Reference: '',
      addressType: 0,
      addressTypeOptions: [],
    }
  },
  computed: {
    cartItems () {
      return this.$store.state.eCommerce.cartItems.slice().reverse()
    },
    cartTotal() {
          let items = this.$store.state.eCommerce.cartItems;
          let suma = 0;
          items.forEach(function(item){
            suma += item.price;
        });
        return suma;
    },
    isInWishList () {
      return (itemId) => this.$store.getters['eCommerce/isInWishList'](itemId)
    }
  },
  mounted(){
      this.getAdress();
  },
  methods: {
      back() {
          location.href='/';
      },
    getAdress(){
        this.$http.get("/api/address/" + localStorage.getItem('uuid')).then(response => {
                this.addressTypeOptions = response.data.addresses;
            });

    },
    // TAB 1
    removeItemFromCart (item) {
      this.$store.dispatch('eCommerce/toggleItemInCart', item)
      this.$vs.notify({
            title: 'Exito',
            text: 'Articulo Eliminado Correctamente',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-alert-circle'
            })
    },

    updateItemQuantity (event, index , id, cart_uuid) {
      const itemIndex = Math.abs(index + 1 - this.cartItems.length)
      this.$store.dispatch('eCommerce/updateItemQuantity', { quantity: event, index: itemIndex , id: id , cart_uuid : cart_uuid })
    },

    // TAB 2
    submitNewAddressForm () {

        if(document.getElementById('address_id').value == null || document.getElementById('address_id').value == ''  ) {
            console.log(this.Address);
            if((this.Address == null || this.Address === 0 || this.Address === '' || this.Address == undefined ))  {
                this.$vs.notify({
                title: 'Error',
                text: 'Por favor debe Ingresar una Direccion',
                color: 'warning',
                iconPack: 'feather',
                icon: 'icon-alert-circle'
                })
                return ;
            }



        }

        this.$store.dispatch('eCommerce/generarOrder', { address_id: document.getElementById('address_id').value, address: this.Address , notify: this.$vs})

        this.$vs.notify({
                title: 'Exito',
                text: 'Orden Generada Correctamente',
                color: 'success',
                iconPack: 'feather',
                icon: 'icon-alert-circle'
                })

        location.href="/dashboard/user/"+localStorage.getItem('uuid');


    },

  },
  components: {
    ItemListView,
    FormWizard,
    TabContent
  }
}
</script>

<style lang="scss" scoped>
#ecommerce-checkout-demo {
    .item-view-primary-action-btn {
        color: #2c2c2c !important;
        background-color: #f6f6f6;
    }

    .item-name {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        -webkit-line-clamp: 2;
    }

    .vue-form-wizard {
        padding-bottom: 0;

        ::v-deep .wizard-header {
            padding: 0;
        }

        ::v-deep .wizard-tab-content {
            padding-right: 0;
            padding-left: 0;
            padding-bottom: 0;

            .wizard-tab-container{
              margin-bottom: 0 !important;
            }
        }
    }
}
</style>
