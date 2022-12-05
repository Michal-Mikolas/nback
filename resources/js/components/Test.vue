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

    <!-- SYMBOL -->
    <div class="test-symbol" v-if="card['type'] == 'symbol'">
        {{ card['content'] }}

        <div class="bottom-container">
            <button @click="sameBtnClicked()" class="btn btn-secondary w-full">
                Shodné s <span v-if="('badge' in card)" class="badge badge-slim">{{ card['badge'] }}</span> předchozím
            </button>
        </div>
    </div>

    <!-- BREAK -->
    <div class="test-break" v-if="card['type'] == 'break'">
        <div v-html="card['content']"></div>

        <div class="bottom-container">
            <button class="btn btn-secondary w-full" @click="nextCard()">Pokračovat</button>
        </div>
    </div>

</template>


<script>
export default {
    data() {
        return {
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
    methods: {
        sameBtnClicked(){
            this.card.clicked = true
        },
        nextCard(){
            this.i += 1
            if (this.i in this.cards) {
                this.card = this.cards[this.i]
                this.card.clicked = false

                if (this.card.type == 'symbol') {
                    setTimeout(this.nextCard, 2000)
                }

            } else {
                console.log(this.cards)
            }
        }
    },
    mounted(){
        this.nextCard()
    },
}
</script>
