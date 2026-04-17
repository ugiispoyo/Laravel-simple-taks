<script setup>
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'

const props = defineProps({
  tasks: Array
})

const title = ref('')

const add = () => {
  router.post('/tasks', { title: title.value })
  title.value = ''
}

const toggle = (id) => {
  router.put(`/tasks/${id}`)
}

const remove = (id) => {
  router.delete(`/tasks/${id}`)
}
</script>

<template>
  <div>
    <h1>Tasks</h1>

    <input v-model="title" />
    <button @click="add">Add</button>

    <ul>
      <li v-for="t in tasks" :key="t.id">
        {{ t.title }} - {{ t.status }}
        <button @click="toggle(t.id)">Toggle</button>
        <button @click="remove(t.id)">Delete</button>
      </li>
    </ul>
  </div>
</template>