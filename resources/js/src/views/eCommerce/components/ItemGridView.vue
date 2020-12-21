

<template>
    <!-- <div class="item-grid-view vx-row match-height">
        <div class="vx-col" :class="gridColumnWidth" v-for="item in items" :key="item.objectID"> -->
            <vx-card class="grid-view-item mb-base overflow-hidden" v-on="$listeners">
                <template slot="no-body">

                    <!-- ITEM IMAGE -->
                    <div class="item-img-container bg-white h-64 flex items-center justify-center mb-4 cursor-pointer" @click="navigate_to_detail_view">
                        <img :src="item.image" :alt="item.name" class="grid-view-img px-4">
                    </div>
                    <div class="item-details px-4">

                        <!--  PRICE -->
                        <div class="flex justify-between items-center">
                            <h6 class="font-bold"><span>$ </span>{{ item.price.toFixed(2) }}</h6>
                        </div>

                        <!-- TITLE & DESCRIPTION -->
                        <div class="my-4">
                            <h6 class="truncate font-semibold mb-1 hover:text-primary cursor-pointer" @click="navigate_to_detail_view">{{ item.name }}</h6>
                            <p class="item-description truncate text-sm">{{ item.description }}</p>
                        </div>
                    </div>

                    <!-- SLOT: ACTION BUTTONS -->
                    <slot name="action-buttons" />
                </template>
            </vx-card>
       <!--  </div>
    </div> -->
</template>

<script>
export default{
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  methods: {
    navigate_to_detail_view () {
      this.$router.push({name: 'ecommerce-item-detail-view', params: {item_id: this.item.objectID }})
        .catch(() => {})
    }
  }
}
</script>

<style lang="scss" scoped>
.grid-view-item {
    .grid-view-img {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        transition: .35s;
    }

    &:hover {
        transform: translateY(-5px);
        box-shadow: 0px 4px 25px 0px rgba(0,0,0,.25);

        .grid-view-img{
            opacity: 0.9;
        }
    }
}
</style>
