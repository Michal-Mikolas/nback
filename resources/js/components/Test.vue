<template>
    <!--
     #######
        #    ######  ####  #####
        #    #      #        #
        #    #####   ####    #
        #    #           #   #
        #    #      #    #   #
        #    ######  ####    #
    -->

    <!-- LOADING & ERROR -->
    <div class="test-error" v-if="error">
        <h1 class="h1">
            <i class="fa-regular fa-face-sad-tear"></i>
        </h1>
        <p class="p">Je mi líto, něco se porouchalo. Zkus prosím stránku za chvíli obnovit.</p>
    </div>
    <div class="test-loading" v-else-if="loading">
        <div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        <h2 class="h2">Načítám test...</h2>
    </div>

    <!-- SYMBOL -->
    <div class="test-symbol" v-else-if="card['type'] == 'symbol'">
        {{ card['content'] }}

        <div class="bottom-container">
            <button @click="sameBtnClicked()" class="btn btn-secondary w-full">
                Shodné s <span v-if="card['badge'] && card['badge'].length" class="badge badge-slim">{{ card['badge'] }}</span> předchozím
            </button>
        </div>
    </div>

    <!-- BREAK -->
    <div class="test-break" v-else-if="card['type'] == 'break'">
        <div v-html="card['content']"></div>

        <div class="bottom-container">
            <button class="btn btn-secondary w-full" @click="nextCard()">Pokračovat</button>
        </div>
    </div>

</template>


<script>
import axios from 'axios';

export default {
    emits: ['finish'],
    props: ['email'],
    data() {
        return {
            loading: true,
            error: false,
            cards: [
                { type: 'symbol', content: 'A', same: false },
                { type: 'symbol', content: 'B', same: false },
                { type: 'symbol', content: 'C', same: false },

                { type: 'break', content: `
                    <h1 class="h1">Vedeš si skvěle!</h1>
                    <p class="p">Úspěšně jsi dokončil zahřívací kolo. Zde jsi měl kontrolovat, jestli je písmeno shodné s jeho <b><i>přímým předchůdcem</i></b>. </p>

                    <p class="p">Zkusíme to trochu ztížit. Nyní budeš porovnávat, jestli je symbol shodný se symbolem <b><i>před-předchozím</i></b>. <br/>
                    Tedy například v sekvenci <span class="badge">A</span>-<span class="badge">B</span>-<span class="badge">A</span> je poslední písmeno shodné - protože je stejné, jako <b><i>písmeno před předchozím</i></b> (takže klikáš na tlačítko).</p>

                    <p class="p">V následující sekvenci se ti tedy bude dole zobrazovat tlačítko
                        <button class="btn btn-secondary btn-xs">
                            Shodné s <span class="badge badge-slim">2.</span> předchozím
                        </button>
                    .</p>

                    <p class="p">Je vše srozumitelné? Jsi připraven pokračovat? Klikni na tlačítko níže.</p>
                ` },
                { type: 'symbol', content: 'D', same: false, badge: '2.' },
                { type: 'symbol', content: 'E', same: false, badge: '2.' },
                { type: 'symbol', content: 'F', same: false, badge: '2.' },
            ],

            i: -1,
            card: { type: 'symbol', content: '', same: false},
        }
    },
    mounted(){
        axios.get('/api/find-user/' + this.email)
            .then(response => {
                console.log('response.data', response.data);
                setTimeout(() => {  // enjoy the loader animation a bit :-P
                    this.loading = false;

                    if (response.data['user']) {
                        console.log('user found', response.data['user']);
                        this.runRandomTest();
                    } else {
                        console.log('no user');
                        this.runRandomTest();
                    }
                }, 1000);
            }).catch(err => {
                console.log('err', err);
                this.error = true
            });
    },
    methods: {
        sameBtnClicked(){
            this.cards[this.i].clicked = true
        },
        nextCard(){
            this.card['content'] = '';

            setTimeout(()=>{
                this.i += 1
                if (this.i in this.cards) {
                    this.card = JSON.parse(JSON.stringify(this.cards[this.i]))
                    this.card.clicked = false

                    if (this.card.type == 'symbol') {
                        setTimeout(this.nextCard, 2000)
                    }

                } else {
                    this.$emit('finish');
                    // console.log(this.cards)
                }
            }, 500)
        },

        runRandomTest(){
            this.cards = this.generateCards(10, 1);
            this.cards.push(
                { type: 'break', content: `
                    <h1 class="h1">Vedeš si skvěle!</h1>
                    <p class="p">Úspěšně jsi dokončil zahřívací kolo. Zde jsi měl kontrolovat, jestli je písmeno shodné s jeho <b><i>přímým předchůdcem</i></b>. </p>

                    <p class="p">Zkusíme to trochu ztížit. Nyní budeš porovnávat, jestli je symbol shodný se symbolem <b><i>před-předchozím</i></b>. <br/>
                    Tedy například v sekvenci <span class="badge">A</span>-<span class="badge">B</span>-<span class="badge">A</span> je poslední písmeno shodné - protože je stejné, jako <b><i>písmeno před předchozím</i></b> (takže klikáš na tlačítko).</p>

                    <p class="p">V následující sekvenci se ti tedy bude dole zobrazovat tlačítko
                        <button class="btn btn-secondary btn-xs">
                            Shodné s <span class="badge badge-slim">2.</span> předchozím
                        </button>
                    .</p>

                    <p class="p">Je vše srozumitelné? Jsi připraven pokračovat? Klikni na tlačítko níže.</p>
                ` }
            );
            this.cards = this.cards.concat(this.generateCards(10, 2));

            this.nextCard();
        },
        generateCards(count, level){
            String.prototype.replaceAt = function(index, replacement) {
                return this.substring(0, index) + replacement + this.substring(index + replacement.length);
            }

            /*
             * 1) Generate word
             */
            var word = this.randomWord(count);

            // at least 30 % of cards should be match
            var matches = this.countMatches(word, level)
            var j = 0;
            while (matches < (count * 0.3) && j < 99){
                i = Math.floor(Math.random() * (word.length - level)) + level;

                word = word.replaceAt(i, word[i - level])
                // console.log(i, word);

                matches = this.countMatches(word, level)
                j++;
            }

            /*
             * 2) Convert word to cards
             */
            var cards = [];
            for (var i = 0; i < word.length; i++) {
                cards.push({
                    type: 'symbol',
                    content: word[i],
                    same: (word[i] == word[i - level]),
                    badge: (level > 1)? level + '.': '',
                });
            }

            return cards;
        },
        randomWord(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        },
        countMatches(word, level){
            var counter = 0;

            for (var i = 0; i < word.length; i++) {
                if ((i >= level) && (word[i] == word[i-level])) {
                    counter++;
                }
            }

            return counter;
        },
    },
}
</script>
