<script setup>
import { debounce } from 'lodash'
import SingleProduct from './SingleProduct.vue'
import ProductSearch from './ProductSearch.vue'
import { useProductStore } from '../stores/products'

const store = useProductStore()

store.listProducts()

const search = debounce((key) => {
  store.listProducts(key)
}, 300)
</script>

<template>
  <div id="product_list">
    <div class="m-3 grid place-items-center">
      <ProductSearch @search="search" />
    </div>

    <div class="products flex flex-wrap justify-center mt-3">
      <SingleProduct
        v-for="product in store.products"
        :product="product"
        :key="product.id"
        text="add to cart"
      ></SingleProduct>
    </div>
  </div>
</template>

<style scoped>
.products {
  margin-top: 20pxx;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
}
</style>
