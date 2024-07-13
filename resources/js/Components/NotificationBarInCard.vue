<script setup>
import { colorsBgLight } from '@/colors.js'

defineProps({
  color: {
    type: String,
    required: true
  },
  isPlacedWithHeader: {
    type: Boolean
  }
})
</script>

<template>
  <div class="flex flex-col mb-4 mt-4 animate-fade-in">
    <div
      :class="[ { 'rounded': !isPlacedWithHeader }]"
      class="flex  bg-red-100 text-red-600 flex-col p-1 transition-colors"
    >
      <slot />
    </div>
  </div>
</template>
