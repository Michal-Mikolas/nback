<template>

    <div v-if="step=='reset'">
    </div>


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
                <button @click="personalInfoFormFinish()" v-bind:disabled="movetoInfoDisabled" class="btn btn-primary w-full">Pokračovat</button>
            </div>
        </div>
    </div>


    <!-- <div v-if="step=='info'">
        <TestInfo/>

        <div class="bottom-container">
            <div class="left-container">
                <button class="btn btn-primary w-full" @click="moveto('form')">Zpět</button>
            </div>
            <div class="right-container">
                <button class="btn btn-primary w-full" @click="moveto('test')">Pokračovat</button>
            </div>
        </div>
    </div> -->


    <div class="w-full" v-if="step=='test'">
        <Test ref="test" v-bind:email="user['email']" v-on:finish="testFinish()"/>
        <!-- <Test ref="test" email="nanuqcz@gmail.com" v-on:finish="testFinished()"/> -->
    </div>


    <div class="w-full text-center pt-24" v-if="step=='loading'">
        <h1 class="h1 text-white" style="margin-bottom: 0.5rem;">
            <!-- <i class="fa-solid fa-robot"></i> -->
            <i class="fa-solid fa-network-wired"></i>
        </h1>
        <div class="loader"></div>
        <h2 class="h2 mt-8">Odesílám vaše výsledky na server...</h2>
    </div>


    <div class="w-full text-center text-error pt-40" v-if="step=='error'">
        <h1 class="h1">
            <i class="fa-regular fa-face-sad-tear"></i>
        </h1>
        <p class="p">Je mi líto, něco se porouchalo. Zkuste prosím stránku za chvíli obnovit.</p>
    </div>


    <div class="w-full" v-if="step=='test-finish'">
        <TestFinish ref="testFinish" v-on:change="testFinishChanged()"/>

        <div class="bottom-container">
            <button v-bind:disabled="appFinishDisabled" class="btn btn-primary w-full" @click="appFinish()">Pokračovat</button>
        </div>
    </div>


    <div class="w-full" v-if="step=='app-finish'">
        <AppFinish v-bind:email="user['email']"/>
        <!-- <AppFinish email="nanuqcz@gmail.com"/> -->
    </div>

</template>


<script>
import Home from './Home.vue'
import PersonalInfoForm from './PersonalInfoForm.vue'
import TestInfo from './TestInfo.vue'
import Test from './Test.vue'
import TestFinish from './TestFinish.vue'
import AppFinish from './AppFinish.vue'
import axios from 'axios'

export default {
    data() {
        return {
            step: 'home',
            movetoInfoDisabled: true,
            appFinishDisabled: true,

            user: null,
            test: null,
            cards: null,
        }
    },
    components: {
        Home,
        PersonalInfoForm,
        TestInfo,
        Test,
        TestFinish,
        AppFinish,
    },
    methods: {
        moveto(step){
            this.step = step;
            this.scrollTop();
        },
        personalInfoFormChanged(){
            this.movetoInfoDisabled = !this.$refs.personalInfoForm || !this.$refs.personalInfoForm.isValid;
        },
        testFinishChanged(){
            this.appFinishDisabled = !this.$refs.testFinish || this.$refs.testFinish.interruption === null;
        },
        personalInfoFormFinish(){
            this.user = JSON.parse(JSON.stringify(this.$refs.personalInfoForm.user));
            this.moveto('test');
        },
        testFinish(){
            this.cards = JSON.parse(JSON.stringify(this.$refs.test.cards));
            this.moveto('test-finish');
        },
        appFinish(){
            this.test = {
                'interruption': this.$refs.testFinish.interruption,
                'interruption_reason': this.$refs.testFinish.interruption_reason || '',
                'browser_info': JSON.stringify(this.getBrowserInfo()),
            };

            this.step = 'loading';

            var data = {
                'user': this.user,
                'test': this.test,
                'cards': this.cards,
            };
            data = JSON.parse(JSON.stringify(data));

            axios.post('/api/save-test', data)
                .then(response => {
                    setTimeout(() => {  // enjoy the loader animation a bit :-P
                        this.step = 'app-finish';
                    }, 2000);
                })
                .catch(error => {
                    this.step = 'error';
                });
        },
        scrollTop(){
            document.getElementById('app').scroll(0, 0);
        },
        getBrowserInfo(){
            var bi = {};

            bi['navigator'] = {};
            for (var k in navigator) {
                bi['navigator'][k] = navigator[k];
            }

            bi['screen'] = {};
            for (var k in screen) {
                bi['screen'][k] = screen[k];
            }

            bi['location'] = {};
            for (var k in location) {
                bi['location'][k] = location[k];
            }

            bi['innerWidth'] = window.innerWidth;
            bi['innerHeight'] = window.innerHeight;
            bi['referer'] = document.referer;

            return bi;
        },
    },
    computed: {
    },
}
</script>
