<template>

    <div v-if="step=='home'">
        <Home/>

        <div class="bottom-container">
            <button class="btn btn-primary w-full" @click="moveto('form')">Pokračovat</button>
        </div>
    </div>


    <div v-if="step=='form'">
        <PersonalInfoForm/>

        <div class="bottom-container">
            <div class="left-container">
                <button class="btn btn-primary w-full" @click="moveto('home')">Zpět</button>
            </div>
            <div class="right-container">
                <button class="btn btn-primary w-full" @click="moveto('info')">Pokračovat</button>
            </div>
        </div>
    </div>


    <div v-if="step=='info'">
        <TestInfo/>

        <div class="bottom-container">
            <div class="left-container">
                <button class="btn btn-primary w-full" @click="moveto('form')">Zpět</button>
            </div>
            <div class="right-container">
                <button class="btn btn-primary w-full" @click="moveto('test')">Pokračovat</button>
            </div>
        </div>
    </div>


    <div class="w-full" v-if="step=='test'">
        <Test/>
    </div>

</template>


<script>
import Home from './Home.vue'
import PersonalInfoForm from './PersonalInfoForm.vue'
import TestInfo from './TestInfo.vue'
import Test from './Test.vue'

export default {
    data() {
        return {
            step: 'home',
        }
    },
    components: {
        Home,
        PersonalInfoForm,
        TestInfo,
        Test,
    },
    methods: {
        moveto(step){
            console.log('moveto', step)
            this.step = step
        }
    }
}
</script>
