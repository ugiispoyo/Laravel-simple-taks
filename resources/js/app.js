import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
  resolve: (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })

    console.log('REQUESTED:', name)
    console.log('PAGES:', pages)

    const page = Object.entries(pages).find(([key]) =>
      key.endsWith(`${name}.vue`)
    )

    if (!page) {
      console.error('PAGE NOT FOUND!')
      throw new Error(`Page not found: ${name}`)
    }

    return page[1]
  },

  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})