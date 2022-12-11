<template>

    <div v-if="step=='home'">
        <Home/>

        <div class="bottom-container">
            <button class="btn btn-primary w-full" @click="moveto('form')">Pokračovat</button>
        </div>
    </div>


    <div v-show="step=='form'">
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
        <Test ref="test" v-bind:email="$refs.personalInfoForm.user['email']" v-on:finish="testFinished()"/>
    </div>


    <div class="w-full text-center pt-24" v-if="step=='loading'">
        <h1 class="h1 text-white" style="margin-bottom: 0.5rem;">
            <!-- <i class="fa-solid fa-robot"></i> -->
            <i class="fa-solid fa-network-wired"></i>
        </h1>
        <div class="loader"></div>
        <h2 class="h2 mt-8">Odesílám tvé výsledky na server...</h2>
    </div>


    <div class="w-full text-center text-error pt-40" v-if="step=='error'">
        <h1 class="h1">
            <i class="fa-regular fa-face-sad-tear"></i>
        </h1>
        <p class="p">Je mi líto, něco se porouchalo. Zkus prosím stránku za chvíli obnovit.</p>
    </div>


    <div class="w-full" v-if="step=='finish'">
        <Finish v-bind:email="$refs.personalInfoForm.user['email']"/>
    </div>

</template>


<script>
import Home from './Home.vue'
import PersonalInfoForm from './PersonalInfoForm.vue'
import TestInfo from './TestInfo.vue'
import Test from './Test.vue'
import Finish from './Finish.vue'
import axios from 'axios'

export default {
    data() {
        return {
            step: 'home',
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
            this.step = 'loading';

            var data = {
                'user': this.$refs.personalInfoForm.user,
                'cards': this.$refs.test.cards,
            };
            console.log('data to send: ', data);  /**/
            data = JSON.parse(JSON.stringify(data));
            console.log('data to send after cloning: ', data);  /**/

            axios.post('/api/save-test', data)
                .then(response => {
                    setTimeout(() => {  // enjoy the loader animation a bit :-P
                        this.step = 'finish';
                    }, 1000);
                })
                .catch(error => {
                    this.step = 'error';
                });
        },
    },
    computed: {
    },
}
</script>
