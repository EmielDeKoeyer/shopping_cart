import axios from '@/apis/axios'
import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useProductStore = defineStore('products', () => {
  let products = ref(null)
  let singleProduct = ref(null)

  function listProducts(key = '') {
    axios
      .get('products?search_key=' + key)
      .then((response) => {
        let result = response.data
        this.products = result.products
      })
      .catch((error) => {
        console.log(error)
      })
  }

  function fetchAProduct(id) {
    axios
      .get('products/' + id)
      .then((response) => {
        let result = response.data
        this.singleProduct = result.product
      })
      .catch((error) => {
        console.log(error)
      })
  }

  return { products, singleProduct, listProducts, fetchAProduct }
})
