<script lang="ts" setup>
import {ref, watch} from "vue";
import {addDays} from "../helpers/date";
import {Boiler} from "../helpers/types";

const {date = '2023-01-01', boiler} = defineProps<{ date: string, boiler: Boiler }>()

const loading = ref(false);
const schedules = ref([]);

watch(() => ([date, boiler]), ([newDate, boiler]) => {
    loading.value = true;
    fetch(`/api/boilers/${boiler.id}/schedules?valid_from=${newDate}&valid_to=${addDays(newDate, 1)}`)
        .then(res => res.json())
        .then(({data}) => schedules.value = data)
        .catch(console.error)
        .finally(() => loading.value = false)
}, {immediate: true})

const toggleType = (index: number) => {
    let schedule = schedules.value[index];
    const type = schedule.type === 'auto' ? 'manual' : 'auto';
    // Also set the status to the current status when switching from auto to manual
    const status = schedule.type === 'auto' ? schedule.status : undefined;

    loading.value = true;
    fetch(`/api/schedules/${schedule.id}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({data: {type, status}})
    })
        .then(res => res.json())
        .then(({data}) => schedules.value[index] = data)
        .catch(console.error)
        .finally(() => loading.value = false)
}

const toggleStatus = (index: number) => {
    let schedule = schedules.value[index];
    const status = schedule.status === 'on' ? 'off' : 'on';

    loading.value = true;
    fetch(`/api/schedules/${schedule.id}`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({data: {status}})
    })
        .then(res => res.json())
        .then(({data}) => schedules.value[index] = data)
        .catch(console.error)
        .finally(() => loading.value = false)
}


</script>

<template>
    <span></span>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>time</th>
            <th>price</th>
            <th>type</th>
            <th>status</th>
        </tr>
        </thead>
        <tbody>
        <tr v-if="loading">
            <td><span class="loading loading-ring loading-md"></span></td>
            <td><span class="loading loading-ring loading-md"></span></td>
            <td><span class="loading loading-ring loading-md"></span></td>
            <td><span class="loading loading-ring loading-md"></span></td>
        </tr>
        <tr v-else v-for="(schedule, i) in schedules">
            <td>{{ schedule.valid_at.split('T')[1] }}</td>
            <td>{{ schedule.price }}</td>
            <td>
                <button
                    :class="{
                        'badge badge-outline': true,
                        'badge-default': schedule.type === 'auto',
                        'badge-accent': schedule.type === 'manual',
                    }"
                    @click="toggleType(i)"
                >{{ schedule.type }}
                </button>
            </td>
            <td>
                <button
                    :disabled="schedule.type === 'auto'"
                    :class="{
                        'badge badge-outline': true,
                        'badge-success': schedule.status === 'on',
                        'badge-error': schedule.status === 'off',
                    }"
                    @click="toggleStatus(i)"
                >{{ schedule.status }}
                </button>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<style scoped>

</style>
