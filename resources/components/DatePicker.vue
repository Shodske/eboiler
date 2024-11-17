<script lang="ts" setup>
import {addDays} from "../helpers/date";

const {value = '2023-01-01', min = '2023-01-01', max = '2023-01-30'} = defineProps<{
    value?: string;
    min?: string;
    max?: string;
}>();
const emit = defineEmits(['update:value'])

</script>

<template>
    <div class="flex justify-between items-center p-2">
        <button class="btn" :disabled="value <= min" @click="emit('update:value', addDays(value, -1))"><</button>
        <input type="date" class="input input-bordered" :min="min" :max="max" :value="value"
               @input="emit('update:value', $event.target.value)">
        <button class="btn" :disabled="value >= max" @click="emit('update:value', addDays(value, 1))">></button>
    </div>
</template>

<style scoped>

</style>
