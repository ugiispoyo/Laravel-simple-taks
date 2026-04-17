<script setup>
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'

const email = ref('')
const password = ref('')

const login = () => {
  router.post('/login', {
    email: email.value,
    password: password.value
  })
}
</script>

<template>
  <div>
    <h1>Login</h1>
    <input v-model="email" placeholder="email" />
    <input v-model="password" type="password" />
    <button @click="login">Login</button>
  </div>
</template>