<template>

    <div v-if="step=='form'">
        <PersonalInfoForm/>

        <div class="pt-20"></div>
        <div class="bottom-container">
            <button class="btn btn-primary w-full" @click="moveto('info')">Pokračovat</button>
        </div>
    </div>


    <div v-if="step=='info'">
        <StartInfo/>

        <div class="pt-20"></div>
        <div class="bottom-left-container">
            <button class="btn btn-primary w-full" @click="moveto('form')">Zpět</button>
        </div>
        <div class="bottom-right-container">
            <button class="btn btn-primary w-full" @click="moveto('test')">Pokračovat</button>
        </div>
    </div>


    <div class="w-full" v-if="step=='test'">
        <Test/>
    </div>

</template>


<script>
import PersonalInfoForm from './PersonalInfoForm.vue';
import StartInfo from './StartInfo.vue'
import Test from './Test.vue'

export default {
    data() {
        return {
            step: 'form',
            '': ''
        }
    },
    components: {
        PersonalInfoForm,
        StartInfo,
        Test
    },
    methods: {
        moveto(step){
            console.log('moveto', step);
            this.step = step;
        }
    }
}
</script>
