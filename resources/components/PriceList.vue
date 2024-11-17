<script lang="ts" setup>
import {ref, watch} from "vue";
import {addDays} from "../helpers/date";

const {date = '2023-01-01'} = defineProps<{ date: string }>()

const loading = ref(false);
const prices = ref([]);

watch(() => date, (newDate) => {
    loading.value = true;
    fetch(`/api/prices?valid_from=${newDate}&valid_to=${addDays(newDate, 1)}`)
        .then(res => res.json())
        .then(({data}) => prices.value = data)
        .catch(console.error)
        .finally(() => loading.value = false)
}, {immediate: true})
</script>

<template>
    <span></span>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>time</th>
            <th>price</th>
        </tr>
        </thead>
        <tbody>
        <tr v-if="loading">
            <td><span class="loading loading-ring loading-md"></span></td>
            <td><span class="loading loading-ring loading-md"></span></td>
        </tr>
        <tr v-else v-for="price in prices">
            <td>{{price.valid_at}}</td><td>{{ price.price}}</td>
        </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
