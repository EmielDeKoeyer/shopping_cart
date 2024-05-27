<script setup>
import { useCartStore } from '@/stores/cart'
import SingleProduct from './SingleProduct.vue'

const store = useCartStore()

store.listCartItems()
</script>

<template>
  <div class="page">
    <div class="items">
      Currently in your cart:
      <div id="product_list">
        <div v-if="store.cart.length == 0">Nothing :(</div>
        <SingleProduct
          v-for="product in store.cart"
          :product="product"
          :key="product.id"
          text="update amount"
        ></SingleProduct>
      </div>
    </div>
    <div class="overview">Total expenses: €{{ store.cartTotal }}</div>
  </div>
</template>

<style scoped>
.page {
  display: flex;
  justify-content: space-between;
}

.products {
  margin-top: 20pxx;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
}

.items {
  width: 80%;
}
</style>
