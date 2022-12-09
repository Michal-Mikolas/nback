<template>

    <div v-if="step=='home'">
        <Home/>

        <div class="bottom-container">
            <button class="btn btn-primary w-full" @click="moveto('form')">Pokračovat</button>
        </div>
    </div>


    <div v-if="step=='form'">
        <PersonalInfoForm ref="personalInfoForm" v-on:change="personalInfoFormChanged()"/>

        <div class="bottom-container">
            <div class="left-container">
                <button class="btn btn-primary w-full" @click="moveto('home')">Zpět</button>
            </div>
            <div class="right-container">
                <button @click="moveto('info')" v-bind:disabled="movetoInfoDisabled" class="btn btn-primary w-full">Pokračovat</button>
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
        <Test ref="test" v-on:finish="testFinished()"/>
    </div>


    <div class="w-full" v-if="step=='finish'">

    </div>

</template>


<script>
import Home from './Home.vue'
import PersonalInfoForm from './PersonalInfoForm.vue'
import TestInfo from './TestInfo.vue'
import Test from './Test.vue'
import Finish from './Finish.vue'

export default {
    data() {
        return {
            step: 'info',
            movetoInfoDisabled: true,
        }
    },
    components: {
        Home,
        PersonalInfoForm,
        TestInfo,
        Test,
        Finish,
    },
    methods: {
        moveto(step){
            this.step = step
        },
        personalInfoFormChanged(){
            this.movetoInfoDisabled = !this.$refs.personalInfoForm || !this.$refs.personalInfoForm.isValid;
        },
        testFinished(){
            var user = this.$refs.personalInfoForm.user;
            var cards = this.$refs.personalInfoForm.cards;
        },
    },
    computed: {
    },
}
</script>
