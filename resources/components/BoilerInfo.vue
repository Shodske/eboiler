<script lang="ts" setup>
import {ref} from "vue";
import {Boiler} from "../helpers/types";


// const {id = '1'} = defineProps<{ id?: string }>();
const {boiler} = defineProps<{ boiler: Boiler }>();
const emit = defineEmits(['update:boiler'])

const loading = ref(false);

const save = () => {
    loading.value = true;
    fetch(`/api/boilers/${boiler.id}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({data: {price_threshold: boiler.price_threshold}})
    })
        .then(res => res.json())
        .then(({data}) => emit('update:boiler', data))
        .catch(console.error)
        .finally(() => loading.value = false)
}

</script>

<template>
    <div class="card bg-base-100 w-96 shadow-xl">
        <span v-if=" loading" class="loading loading-ring loading-md"></span>
        <div v-else class="card-body">
            <h2 class="card-title">{{ boiler.name }}</h2>

            <input class="input input-bordered" type="number" step="0.000000001"
                   v-model="boiler.price_threshold"/>
            <button class="btn" @click="save">save</button>
        </div>
    </div>
</template>

<style scoped>

</style>
