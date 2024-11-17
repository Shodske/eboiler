<template>
    <main class="flex flex-col items-center">
        <BoilerInfo v-if="boiler" v-model:boiler="boiler"/>
        <DatePicker v-model:value="date"/>
        <!--        <PriceList :date="date"/>-->
        <ScheduleList v-if="boiler" :date="date" :boiler="boiler"/>
    </main>
</template>
<script lang="ts" setup>
import DatePicker from "../components/DatePicker.vue";
import {ref} from "vue";
// import PriceList from "../components/PriceList.vue";
import BoilerInfo from "../components/BoilerInfo.vue";
import {Boiler} from "../helpers/types";
import ScheduleList from "../components/ScheduleList.vue";

const date = ref('2023-01-01');
const boiler = ref<Boiler | null>(null);

fetch(`/api/boilers/1`)
    .then(res => res.json())
    .then(({data}) => boiler.value = data)
    .catch(console.error)
</script>
