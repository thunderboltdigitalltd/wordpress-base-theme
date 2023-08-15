import Alpine from 'alpinejs'
import collapse from '@alpinejs/collapse'
import morph from '@alpinejs/morph'
import persist from '@alpinejs/persist'
import focus from '@alpinejs/focus'
import 'focus-visible'
import {toTop} from '@/back-to-top'

window.Alpine = Alpine

Alpine.plugin([
    collapse,
    focus,
    morph,
    persist,
])

// Alpine.data('navigationMenu', navigationMenu)
Alpine.start()

toTop()
