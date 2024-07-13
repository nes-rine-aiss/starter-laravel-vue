<script setup>
import { computed } from 'vue'
import { useDarkModeStore } from '@/Stores/darkMode.js'
import { gradientBgPurplePink, gradientBgDark, gradientBgPinkRed } from '@/colors'

const props = defineProps({
  bg: {
    type: String,
    required: true,
    validator: value => ['purplePink', 'pinkRed'].includes(value)
  }
})

const colorClass = computed(() => {
  if (useDarkModeStore().isEnabled) {
    return gradientBgDark
  }

  switch (props.bg) {
    case 'purplePink':
      return gradientBgPurplePink
    case 'pinkRed':
      return  gradientBgPinkRed
  }
  
  return ''
})
</script>

<template>
  <div
    class="flex min-h-full items-center justify-center"
    :class="colorClass"
  >
    <slot card-class="w-12/12 md:w-8/12 lg:w-8/12 xl:w-6/12  " />
  </div>
</template>
