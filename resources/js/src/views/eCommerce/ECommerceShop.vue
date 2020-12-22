<template>
    <div>
        <div
            class="instant_search"
            id="algolia-instant-search-demo"
        >

            <div id="algolia-content-container" class="relative clearfix">
                <div :class="{ d: clickNotClose }" style="margin-left: 0px:">

                    <template v-if="currentItemView == 'item-grid-view'">
                        <div class="items-grid-view vx-row match-height">
                            <div
                                class="vx-col lg:w-1/3 sm:w-1/2 w-full"
                                v-for="item in items"
                                :key="item.uuid"
                            >
                                <item-grid-view :item="item">
                                    <template slot="action-buttons">
                                        <div class="flex flex-wrap">
                                            <div
                                                class="item-view-secondary-action-btn bg-primary p-3 flex flex-grow items-center justify-center text-white cursor-pointer"
                                                 @click="cartButtonClicked(item)"
                                            >
                                                <feather-icon
                                                    icon="ShoppingBagIcon"
                                                    svgClasses="h-4 w-4"
                                                />

                                                <span
                                                    class="text-sm font-semibold ml-2"
                                                    v-if="
                                                        isInCart(item.uuid)
                                                    "
                                                    >VER EN CARRITO</span
                                                >
                                                <span
                                                    class="text-sm font-semibold ml-2"
                                                    v-else

                                                    >AGREGAR A CARRITO</span
                                                >
                                            </div>
                                        </div>
                                    </template>
                                </item-grid-view>
                            </div>
                        </div>
                    </template>
                    <div class="con-vs-pagination vs-pagination-primary">
                        <nav class="vs-pagination--nav">
                            <ul class="vs-pagination--ul">
                                <button
                                    v-if="pagination.current_page > 1"
                                    class="vs-pagination--buttons btn-prev-pagination vs-pagination--button-prev"
                                    @click.prevent="
                                        changePage(pagination.current_page - 1)
                                    "
                                >
                                    <<
                                </button>
                                <li
                                    v-for="page in pagesNumber"
                                    :class="[
                                        page == isActived
                                            ? 'item-pagination vs-pagination--li is-current'
                                            : 'item-pagination vs-pagination--li'
                                    ]"
                                    v-bind:key="page"
                                >
                                    <a
                                        href="#"
                                        @click.prevent="changePage(page)"
                                        >{{ page }}</a
                                    >
                                </li>
                                <button
                                    v-if="
                                        pagination.current_page <
                                            pagination.last_page
                                    "
                                    class="vs-pagination--buttons btn-next-pagination vs-pagination--button-next"
                                    @click.prevent="
                                        changePage(pagination.current_page + 1)
                                    "
                                >
                                    >>
                                </button>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    components: {
        ItemGridView: () => import("./components/ItemGridView.vue")
    },
    data() {
        return {
            // Filter Sidebar
            isFilterSidebarActive: true,
            clickNotClose: true,
            currentItemView: "item-grid-view",
            items: [],
            pagination: {
                total: 0,
                per_page: 12,
                from: 1,
                to: 0,
                current_page: 1
            },
            offset: 4
        };
    },
    computed: {
        // GRID VIEW
        isInCart() {
            return itemId => this.$store.getters["eCommerce/isInCart"](itemId);
        },
        windowWidth() {
            return this.$store.state.windowWidth;
        },
        isActived: function() {
            return this.pagination.current_page;
        },
        itemsdata: function() {
            return this.items;

        },
        pagesNumber: function() {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + this.offset * 2;
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    mounted: function() {
        this.getProducts(this.pagination.current_page);
    },
    watch: {
        windowWidth() {
            this.setSidebarWidth();
        }
    },
    methods: {
        setSidebarWidth() {
            if (this.windowWidth < 992) {
                this.isFilterSidebarActive = this.clickNotClose = false;
            } else {
                this.isFilterSidebarActive = this.clickNotClose = true;
            }
        },

        // GRID VIEW - ACTIONS
        toggleFilterSidebar() {
            if (this.clickNotClose) return;
            this.isFilterSidebarActive = !this.isFilterSidebarActive;
        },
        additemInCart(item) {
            this.$store.dispatch("eCommerce/additemInCart", item);
            this.$vs.notify({
            title: 'Exito',
            text: 'Articulo Agregado Correctamente',
            color: 'success',
            iconPack: 'feather',
            icon: 'icon-alert-circle'
            })

        },
        cartButtonClicked(item) {
            if(localStorage.getItem("uuid")) {
                this.isInCart(item.uuid)
                ? location.href='/checkout'
                : this.additemInCart(item);
            } else {
                 this.$vs.notify({
                title: 'Atencion',
                text: 'Debe Iniciar Sesión y/o Registrarse',
                color: 'warning',
                iconPack: 'feather',
                icon: 'icon-alert-circle'
                })
            }

        },
        getProducts(page) {
            this.$http.get("/api/items?page=" + page).then(response => {
                this.items = response.data.data.data;
                this.pagination = response.data.pagination;
            });

        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getProducts(page);
        },
    },
    created() {
        this.setSidebarWidth();
    }
};
</script>

<style lang="scss">
.vs-pagination--li.is-current {
    background-color: rgb(115, 103, 240);
}
.vs-pagination--li.is-current a {
    color: white;
}

.theme-dark {
    #algolia-instant-search-demo {
        #algolia-content-container {
            .vs-sidebar {
                background-color: #10163a;
            }
        }
    }
}

@media (min-width: 992px) {
    .vs-sidebar-rounded {
        .vs-sidebar {
            border-radius: 0.5rem;
        }

        .vs-sidebar--items {
            border-radius: 0.5rem;
        }
    }
}

@media (max-width: 992px) {
    #algolia-content-container {
        .vs-sidebar {
            position: absolute !important;
            float: none !important;
        }
    }
}
</style>
