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
        <p class="p">Je mi líto, něco se porouchalo. Zkuste prosím stránku za chvíli obnovit.</p>
    </div>
    <div class="test-loading" v-else-if="loading">
        <div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        <h2 class="h2">Načítám test...</h2>
    </div>

    <!-- SYMBOL -->
    <div class="test-symbol" v-else-if="card['type'] == 'symbol' || card['type'] == 'trial'">
        {{ card['content'] }}

        <div class="bottom-container">
            <button @click="sameBtnClicked()" class="btn btn-secondary w-full">
                Shodné
            </button>
            <!-- <button @click="sameBtnClicked()" class="btn btn-secondary w-full">
                Shodné s <span v-if="card['badge'] && card['badge'].length" class="badge badge-slim">{{ card['badge'] }}</span> předchozím
            </button> -->
            <button v-if="(i > 0) && (email == 'nanuqcz@gmail.com' || email == 'leaslizova311@seznam.cz')"
                @click="skipSection()"
                class="btn btn-default absolute bottom-20 right-4"
            >
                Přeskočit<br/>
                sekci
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
    emits: ['test-finished'],
    props: ['email'],
    data() {
        return {
            loading: true,
            error: false,
            cards: [

                // #     #
                // #  #  #   ##   #####  #    #       #    # #####
                // #  #  #  #  #  #    # ##  ##       #    # #    #
                // #  #  # #    # #    # # ## # ##### #    # #    #
                // #  #  # ###### #####  #    #       #    # #####
                // #  #  # #    # #   #  #    #       #    # #
                //  ## ##  #    # #    # #    #        ####  #

                // { type: 'break', content: `
                //     <h1 class="h1">Zkušební kolo - Lehká úroveň</h1>
                //     <p class="p">Nyní Vás čeká test pracovní paměti. Test spočívá v&nbsp;tom, že se Vám na obrazovce zobrazí sled písmen. Vaším úkolem bude stisknout tlačítko v&nbsp;dolní části obrazovky vždy, když se aktuální podnět bude shodovat s&nbsp;podnětem ob několik podnětů zpět. </p>

                //     <p class="p">Chápu, že instrukce zatím zní složitě. Princip ale jistě pochopíte díky naší zkušební verzi.</p>

                //     <p class="p">Nejdříve budete mít za úkol tlačítko zmáčknout vždy, když se aktuální podnět bude shodovat s&nbsp;bezprostředně předchozím. </p>

                //     <p class="p">Tzn. <span class="badge">A</span>&rarr;<span class="badge">A</span>&nbsp;=&nbsp;stisk tlačítka.</p>

                //     <p class="p">Pokud jste připraveni, stiskněte na tlačítko <i>Pokračovat</i>.</p>
                // ` },
                // { type: 'trial', content: 'E', level: 1 },
                // { type: 'trial', content: 'C', level: 1 },
                // { type: 'trial', content: 'P', level: 1 },
                // { type: 'trial', content: 'C', level: 1 },
                // { type: 'trial', content: 'L', level: 1 },
                // { type: 'trial', content: 'L', level: 1 },
                // { type: 'trial', content: 'D', level: 1 },
                // { type: 'trial', content: 'W', level: 1 },
                // { type: 'trial', content: 'F', level: 1 },
                // { type: 'trial', content: 'F', level: 1 },

                // { type: 'break', if: "imperfect", next: 0, content: `
                //     <h1 class="h1">Zkušební kolo - Lehká úroveň</h1>
                //     <p class="p">Je mi líto, zdá se, že Vám první kolo nevyšlo. To nevadí, byl to Váš první pokus, který se nepočítá do finálního výsledku.</p>

                //     <p class="p">Nyní si zkušební kolo projděte pro jistotu znovu.</p>

                //     <p class="p">Nezapomeňte, že je nutné tlačítko stisknout vždy, když se podněty v řadě za sebou budou shodovat. Tzn. když na obrazovce uvidíte <span class="badge">B</span>, a&nbsp;za ním se opět objeví další <span class="badge">B</span>, stisknete tlačítko v dolní části obrazovky. </p>

                //     <p class="p"><span class="badge">B</span>&rarr;<span class="badge">B</span>&nbsp;=&nbsp;stisk tlačítka.</p>

                //     <p class="p">Pokud jste připraveni, stiskněte tlačítko <i>Pokračovat</i>. </p>
                // ` },

                // { type: 'break', content: `
                //     <h1 class="h1">Zkušební kolo - Těžší úroveň</h1>
                //     <p class="p">Výborně, první kolo zkušební verze jste úspěšně absolvovali. Nyní jste připraveni vyzkoušet si těžší úroveň. V této úrovni máte za úkol stisknout tlačítko vždy, když se aktuální podnět bude shodovat s podnětem ob jeden zpět. </p>

                //     <p class="p">Tzn. <span class="badge">A</span>&rarr;<span class="badge">B</span>&rarr;<span class="badge">A</span>&nbsp;=&nbsp;stiskněte tlačítko.</p>

                //     <p class="p">Pokud jste připraveni, stiskněte tlačítko <i>Pokračovat</i>. </p>
                // ` },

                // { type: 'trial', content: 'V', level: 2 },
                // { type: 'trial', content: 'S', level: 2 },
                // { type: 'trial', content: 'V', level: 2 },
                // { type: 'trial', content: 'Q', level: 2 },
                // { type: 'trial', content: 'A', level: 2 },
                // { type: 'trial', content: 'D', level: 2 },
                // { type: 'trial', content: 'C', level: 2 },
                // { type: 'trial', content: 'V', level: 2 },
                // { type: 'trial', content: 'C', level: 2 },
                // { type: 'trial', content: 'R', level: 2 },

                // { type: 'break', if: "imperfect", next: 0, content: `
                //     <h1 class="h1">Zkušební kolo - Těžší úroveň</h1>
                //     <p class="p">Je mi líto, zdá se, že Vám zkušební kolo nevyšlo. To nevadí, byl to Váš první pokus, který se nepočítá do finálního výsledku.</p>

                //     <p class="p">Nyní si zkušební kolo projděte celé pro jistotu znovu.</p>

                //     <p class="p">Nezapomeňte, že v&nbsp;těžší úrovni je nutné tlačítko stisknout vždy, když se podněty v&nbsp;řadě budou shodovat ob-jedno. Tzn. když na obrazovce uvidíte <span class="badge">B</span>&rarr;<span class="badge">A</span>, a&nbsp;za ním se opět objeví další <span class="badge">B</span>, stisknete tlačítko v&nbsp;dolní části obrazovky. <span class="badge">B</span>&rarr;<span class="badge">A</span>&rarr;<span class="badge">B</span>&nbsp;=&nbsp;stisk tlačítka.</p>

                //     <p class="p">Pokud jste připraveni, stiskněte tlačítko <i>Pokračovat</i>. </p>
                // ` },

                // ######
                // #     # ######   ##   #         ##### ######  ####  #####
                // #     # #       #  #  #           #   #      #        #
                // ######  #####  #    # #           #   #####   ####    #
                // #   #   #      ###### #           #   #           #   #
                // #    #  #      #    # #           #   #      #    #   #
                // #     # ###### #    # ######      #   ######  ####    #

                { type: 'break', content: `
                    <h1 class="h1">Ostrý test</h1>
                    <p class="p">Výborně, zkušební verzi jste úspěšně absolvovali. Nyní jste jistě připraveni na první kolo ostrého testu. V&nbsp;tomto kole máte za úkol stisknout tlačítko vždy, když se aktuální podnět bude shodovat s&nbsp;podnětem ob jeden zpět. </p>

                    <p class="p">Tzn. <span class="badge">A</span>&rarr;<span class="badge">B</span>&rarr;<span class="badge">A</span>&nbsp;=&nbsp;stiskněte tlačítko.</p>

                    <p class="p">Pokud jste připraveni, stiskněte tlačítko <i>Pokračovat</i>. </p>
                ` },
                { type: 'symbol', content: 'W', level: 2 },
                { type: 'symbol', content: 'H', level: 2 },
                { type: 'symbol', content: 'U', level: 2 },
                { type: 'symbol', content: 'H', level: 2 },
                { type: 'symbol', content: 'J', level: 2 },
                { type: 'symbol', content: 'K', level: 2 },
                { type: 'symbol', content: 'L', level: 2 },
                { type: 'symbol', content: 'M', level: 2 },
                { type: 'symbol', content: 'L', level: 2 },
                { type: 'symbol', content: 'H', level: 2 },
                { type: 'symbol', content: 'Z', level: 2 },
                { type: 'symbol', content: 'U', level: 2 },
                { type: 'symbol', content: 'Z', level: 2 },
                { type: 'symbol', content: 'F', level: 2 },
                { type: 'symbol', content: 'R', level: 2 },
                { type: 'symbol', content: 'T', level: 2 },
                { type: 'symbol', content: 'Z', level: 2 },
                { type: 'symbol', content: 'T', level: 2 },
                { type: 'symbol', content: 'K', level: 2 },
                { type: 'symbol', content: 'L', level: 2 },
                { type: 'symbol', content: 'L', level: 2 },
                { type: 'symbol', content: 'O', level: 2 },
                { type: 'symbol', content: 'P', level: 2 },
                { type: 'symbol', content: 'O', level: 2 },
                { type: 'symbol', content: 'G', level: 2 },
                { type: 'symbol', content: 'D', level: 2 },
                { type: 'symbol', content: 'F', level: 2 },
                { type: 'symbol', content: 'R', level: 2 },
                { type: 'symbol', content: 'D', level: 2 },
                { type: 'symbol', content: 'R', level: 2 },
                { type: 'symbol', content: 'K', level: 2 },
                { type: 'symbol', content: 'L', level: 2 },
                { type: 'symbol', content: 'G', level: 2 },
                { type: 'symbol', content: 'J', level: 2 },
                { type: 'symbol', content: 'G', level: 2 },
                { type: 'symbol', content: 'K', level: 2 },
                { type: 'symbol', content: 'R', level: 2 },
                { type: 'symbol', content: 'T', level: 2 },
                { type: 'symbol', content: 'E', level: 2 },
                { type: 'symbol', content: 'W', level: 2 },
                { type: 'symbol', content: 'Q', level: 2 },
                { type: 'symbol', content: 'S', level: 2 },
                { type: 'symbol', content: 'Q', level: 2 },
                { type: 'symbol', content: 'M', level: 2 },
                { type: 'symbol', content: 'N', level: 2 },
                { type: 'symbol', content: 'P', level: 2 },
                { type: 'symbol', content: 'L', level: 2 },
                { type: 'symbol', content: 'P', level: 2 },
                { type: 'symbol', content: 'F', level: 2 },
                { type: 'symbol', content: 'V', level: 2 },

                // { type: 'break', content: `
                //     <h1 class="h1">Ostrý test - Úroveň 3</h1>
                //     <p class="p">Výborně, můžeme přejít na další level. Stiskněte tlačítko vždy, když se podnět bude shodovat s podnětem o 3 zpět. </p>

                //     <p class="p">Tzn. <span class="badge">R</span>&rarr;<span class="badge">J</span>&rarr;<span class="badge">K</span>&rarr;<span class="badge">R</span>&nbsp;=&nbsp;stiskněte tlačítko.</p>

                //     <p class="p">Pokud jste připraveni, stiskněte tlačítko <i>Pokračovat</i>. </p>
                // ` },
                // { type: 'symbol', content: 'J', level: 3 },
                // { type: 'symbol', content: 'U', level: 3 },
                // { type: 'symbol', content: 'W', level: 3 },
                // { type: 'symbol', content: 'J', level: 3 },
                // { type: 'symbol', content: 'Q', level: 3 },
                // { type: 'symbol', content: 'K', level: 3 },
                // { type: 'symbol', content: 'L', level: 3 },
                // { type: 'symbol', content: 'O', level: 3 },
                // { type: 'symbol', content: 'L', level: 3 },
                // { type: 'symbol', content: 'J', level: 3 },
                // { type: 'symbol', content: 'O', level: 3 },
                // { type: 'symbol', content: 'H', level: 3 },
                // { type: 'symbol', content: 'T', level: 3 },
                // { type: 'symbol', content: 'B', level: 3 },
                // { type: 'symbol', content: 'F', level: 3 },
                // { type: 'symbol', content: 'T', level: 3 },
                // { type: 'symbol', content: 'P', level: 3 },
                // { type: 'symbol', content: 'H', level: 3 },
                // { type: 'symbol', content: 'P', level: 3 },
                // { type: 'symbol', content: 'P', level: 3 },
                // { type: 'symbol', content: 'F', level: 3 },
                // { type: 'symbol', content: 'T', level: 3 },
                // { type: 'symbol', content: 'Z', level: 3 },
                // { type: 'symbol', content: 'F', level: 3 },
                // { type: 'symbol', content: 'G', level: 3 },
                // { type: 'symbol', content: 'B', level: 3 },
                // { type: 'symbol', content: 'V', level: 3 },
                // { type: 'symbol', content: 'F', level: 3 },
                // { type: 'symbol', content: 'U', level: 3 },
                // { type: 'symbol', content: 'V', level: 3 },
                // { type: 'symbol', content: 'Z', level: 3 },
                // { type: 'symbol', content: 'H', level: 3 },
                // { type: 'symbol', content: 'J', level: 3 },
                // { type: 'symbol', content: 'Z', level: 3 },
                // { type: 'symbol', content: 'G', level: 3 },
                // { type: 'symbol', content: 'B', level: 3 },
                // { type: 'symbol', content: 'H', level: 3 },
                // { type: 'symbol', content: 'J', level: 3 },
                // { type: 'symbol', content: 'K', level: 3 },
                // { type: 'symbol', content: 'N', level: 3 },
                // { type: 'symbol', content: 'J', level: 3 },
                // { type: 'symbol', content: 'U', level: 3 },
                // { type: 'symbol', content: 'T', level: 3 },
                // { type: 'symbol', content: 'N', level: 3 },
                // { type: 'symbol', content: 'J', level: 3 },
                // { type: 'symbol', content: 'T', level: 3 },
                // { type: 'symbol', content: 'H', level: 3 },
                // { type: 'symbol', content: 'U', level: 3 },
                // { type: 'symbol', content: 'K', level: 3 },
                // { type: 'symbol', content: 'H', level: 3 },

                // { type: 'break', content: `
                //     <h1 class="h1">Ostrý test - Úroveň 4</h1>
                //     <p class="p">Výborně, můžeme přejít na další level. Stiskněte tlačítko vždy, když se podnět bude shodovat s podnětem o 4 zpět. </p>

                //     <p class="p">Tzn. <span class="badge">R</span>&rarr;<span class="badge">J</span>&rarr;<span class="badge">K</span>&rarr;<span class="badge">G</span>&rarr;<span class="badge">R</span>&nbsp;=&nbsp;stiskněte tlačítko.</p>

                //     <p class="p">Pokud jste připraveni, stiskněte tlačítko <i>Pokračovat</i>. </p>
                // ` },
                // { type: 'symbol', content: 'R', level: 4 },
                // { type: 'symbol', content: 'J', level: 4 },
                // { type: 'symbol', content: 'K', level: 4 },
                // { type: 'symbol', content: 'G', level: 4 },
                // { type: 'symbol', content: 'R', level: 4 },
                // { type: 'symbol', content: 'H', level: 4 },
                // { type: 'symbol', content: 'U', level: 4 },
                // { type: 'symbol', content: 'T', level: 4 },
                // { type: 'symbol', content: 'K', level: 4 },
                // { type: 'symbol', content: 'H', level: 4 },
                // { type: 'symbol', content: 'G', level: 4 },
                // { type: 'symbol', content: 'F', level: 4 },
                // { type: 'symbol', content: 'K', level: 4 },
                // { type: 'symbol', content: 'U', level: 4 },
                // { type: 'symbol', content: 'G', level: 4 },
                // { type: 'symbol', content: 'J', level: 4 },
                // { type: 'symbol', content: 'F', level: 4 },
                // { type: 'symbol', content: 'R', level: 4 },
                // { type: 'symbol', content: 'K', level: 4 },
                // { type: 'symbol', content: 'P', level: 4 },
                // { type: 'symbol', content: 'F', level: 4 },
                // { type: 'symbol', content: 'Z', level: 4 },
                // { type: 'symbol', content: 'E', level: 4 },
                // { type: 'symbol', content: 'D', level: 4 },
                // { type: 'symbol', content: 'F', level: 4 },
                // { type: 'symbol', content: 'T', level: 4 },
                // { type: 'symbol', content: 'K', level: 4 },
                // { type: 'symbol', content: 'D', level: 4 },
                // { type: 'symbol', content: 'I', level: 4 },
                // { type: 'symbol', content: 'J', level: 4 },
                // { type: 'symbol', content: 'K', level: 4 },
                // { type: 'symbol', content: 'L', level: 4 },
                // { type: 'symbol', content: 'I', level: 4 },
                // { type: 'symbol', content: 'O', level: 4 },
                // { type: 'symbol', content: 'M', level: 4 },
                // { type: 'symbol', content: 'U', level: 4 },
                // { type: 'symbol', content: 'F', level: 4 },
                // { type: 'symbol', content: 'O', level: 4 },
                // { type: 'symbol', content: 'H', level: 4 },
                // { type: 'symbol', content: 'Z', level: 4 },
                // { type: 'symbol', content: 'X', level: 4 },
                // { type: 'symbol', content: 'Y', level: 4 },
                // { type: 'symbol', content: 'J', level: 4 },
                // { type: 'symbol', content: 'X', level: 4 },
                // { type: 'symbol', content: 'N', level: 4 },
                // { type: 'symbol', content: 'U', level: 4 },
                // { type: 'symbol', content: 'O', level: 4 },
                // { type: 'symbol', content: 'P', level: 4 },
                // { type: 'symbol', content: 'N', level: 4 },
                // { type: 'symbol', content: 'A', level: 4 },

                // { type: 'break', content: `
                //     <h1 class="h1">Ostrý test - Úroveň 5</h1>
                //     <p class="p">Výborně, můžeme přejít na další level. Stiskněte tlačítko vždy, když se podnět bude shodovat s podnětem o 5 zpět. </p>

                //     <p class="p">Tzn. <span class="badge">N</span>&rarr;<span class="badge">J</span>&rarr;<span class="badge">H</span>&rarr;<span class="badge">K</span>&rarr;<span class="badge">L</span>&rarr;<span class="badge">N</span>&nbsp;=&nbsp;stiskněte tlačítko.</p>

                //     <p class="p">Pokud jste připraveni, stiskněte tlačítko <i>Pokračovat</i>. </p>
                // ` },
                // { type: 'symbol', content: 'G', level: 5 },
                // { type: 'symbol', content: 'T', level: 5 },
                // { type: 'symbol', content: 'R', level: 5 },
                // { type: 'symbol', content: 'K', level: 5 },
                // { type: 'symbol', content: 'J', level: 5 },
                // { type: 'symbol', content: 'L', level: 5 },
                // { type: 'symbol', content: 'R', level: 5 },
                // { type: 'symbol', content: 'G', level: 5 },
                // { type: 'symbol', content: 'N', level: 5 },
                // { type: 'symbol', content: 'J', level: 5 },
                // { type: 'symbol', content: 'K', level: 5 },
                // { type: 'symbol', content: 'G', level: 5 },
                // { type: 'symbol', content: 'R', level: 5 },
                // { type: 'symbol', content: 'K', level: 5 },
                // { type: 'symbol', content: 'D', level: 5 },
                // { type: 'symbol', content: 'W', level: 5 },
                // { type: 'symbol', content: 'Q', level: 5 },
                // { type: 'symbol', content: 'S', level: 5 },
                // { type: 'symbol', content: 'L', level: 5 },
                // { type: 'symbol', content: 'R', level: 5 },
                // { type: 'symbol', content: 'D', level: 5 },
                // { type: 'symbol', content: 'S', level: 5 },
                // { type: 'symbol', content: 'S', level: 5 },
                // { type: 'symbol', content: 'R', level: 5 },
                // { type: 'symbol', content: 'K', level: 5 },
                // { type: 'symbol', content: 'N', level: 5 },
                // { type: 'symbol', content: 'F', level: 5 },
                // { type: 'symbol', content: 'R', level: 5 },
                // { type: 'symbol', content: 'J', level: 5 },
                // { type: 'symbol', content: 'O', level: 5 },
                // { type: 'symbol', content: 'N', level: 5 },
                // { type: 'symbol', content: 'T', level: 5 },
                // { type: 'symbol', content: 'H', level: 5 },
                // { type: 'symbol', content: 'J', level: 5 },
                // { type: 'symbol', content: 'B', level: 5 },
                // { type: 'symbol', content: 'N', level: 5 },
                // { type: 'symbol', content: 'H', level: 5 },
                // { type: 'symbol', content: 'U', level: 5 },
                // { type: 'symbol', content: 'I', level: 5 },
                // { type: 'symbol', content: 'B', level: 5 },
                // { type: 'symbol', content: 'D', level: 5 },
                // { type: 'symbol', content: 'H', level: 5 },
                // { type: 'symbol', content: 'N', level: 5 },
                // { type: 'symbol', content: 'V', level: 5 },
                // { type: 'symbol', content: 'Z', level: 5 },
                // { type: 'symbol', content: 'D', level: 5 },
                // { type: 'symbol', content: 'H', level: 5 },
                // { type: 'symbol', content: 'N', level: 5 },
                // { type: 'symbol', content: 'M', level: 5 },
                // { type: 'symbol', content: 'U', level: 5 },

                // { type: 'break', content: `
                //     <h1 class="h1">Ostrý test - Úroveň 6</h1>
                //     <p class="p">Výborně, můžeme přejít na další level. Stiskněte tlačítko vždy, když se podnět bude shodovat s podnětem o 6 zpět. </p>

                //     <p class="p">Tzn. <span class="badge">N</span>&rarr;<span class="badge">H</span>&rarr;<span class="badge">K</span>&rarr;<span class="badge">I</span>&rarr;<span class="badge">O</span>&rarr;<span class="badge">L</span>&rarr;<span class="badge">N</span>&nbsp;=&nbsp;stiskněte tlačítko.</p>

                //     <p class="p">Pokud jste připraveni, stiskněte tlačítko <i>Pokračovat</i>. </p>
                // ` },
                // { type: 'symbol', content: 'F', level: 6 },
                // { type: 'symbol', content: 'E', level: 6 },
                // { type: 'symbol', content: 'K', level: 6 },
                // { type: 'symbol', content: 'L', level: 6 },
                // { type: 'symbol', content: 'K', level: 6 },
                // { type: 'symbol', content: 'N', level: 6 },
                // { type: 'symbol', content: 'E', level: 6 },
                // { type: 'symbol', content: 'F', level: 6 },
                // { type: 'symbol', content: 'D', level: 6 },
                // { type: 'symbol', content: 'S', level: 6 },
                // { type: 'symbol', content: 'N', level: 6 },
                // { type: 'symbol', content: 'D', level: 6 },
                // { type: 'symbol', content: 'W', level: 6 },
                // { type: 'symbol', content: 'D', level: 6 },
                // { type: 'symbol', content: 'V', level: 6 },
                // { type: 'symbol', content: 'C', level: 6 },
                // { type: 'symbol', content: 'E', level: 6 },
                // { type: 'symbol', content: 'R', level: 6 },
                // { type: 'symbol', content: 'W', level: 6 },
                // { type: 'symbol', content: 'X', level: 6 },
                // { type: 'symbol', content: 'O', level: 6 },
                // { type: 'symbol', content: 'L', level: 6 },
                // { type: 'symbol', content: 'P', level: 6 },
                // { type: 'symbol', content: 'N', level: 6 },
                // { type: 'symbol', content: 'X', level: 6 },
                // { type: 'symbol', content: 'B', level: 6 },
                // { type: 'symbol', content: 'G', level: 6 },
                // { type: 'symbol', content: 'R', level: 6 },
                // { type: 'symbol', content: 'E', level: 6 },
                // { type: 'symbol', content: 'T', level: 6 },
                // { type: 'symbol', content: 'X', level: 6 },
                // { type: 'symbol', content: 'J', level: 6 },
                // { type: 'symbol', content: 'K', level: 6 },
                // { type: 'symbol', content: 'L', level: 6 },
                // { type: 'symbol', content: 'P', level: 6 },
                // { type: 'symbol', content: 'X', level: 6 },
                // { type: 'symbol', content: 'K', level: 6 },
                // { type: 'symbol', content: 'O', level: 6 },
                // { type: 'symbol', content: 'L', level: 6 },
                // { type: 'symbol', content: 'P', level: 6 },
                // { type: 'symbol', content: 'B', level: 6 },
                // { type: 'symbol', content: 'A', level: 6 },
                // { type: 'symbol', content: 'N', level: 6 },
                // { type: 'symbol', content: 'C', level: 6 },
                // { type: 'symbol', content: 'P', level: 6 },
                // { type: 'symbol', content: 'D', level: 6 },
                // { type: 'symbol', content: 'E', level: 6 },
                // { type: 'symbol', content: 'K', level: 6 },
                // { type: 'symbol', content: 'Z', level: 6 },
                // { type: 'symbol', content: 'P', level: 6 },
            ],

            i: -1,
            card: { type: 'symbol', content: '', level: 1},
            cardTimeout: null,
        }
    },

    //  #####
    // #     #   ##   #    # ###### #####  #        ##   #   #
    // #        #  #  ##  ## #      #    # #       #  #   # #
    // #  #### #    # # ## # #####  #    # #      #    #   #
    // #     # ###### #    # #      #####  #      ######   #
    // #     # #    # #    # #      #      #      #    #   #
    //  #####  #    # #    # ###### #      ###### #    #   #

    mounted(){
        axios.get('/api/find-user/' + this.email)
            .then(response => {
                console.log('response.data', response.data);
                setTimeout(() => {  // enjoy the loader animation a bit :-P
                    this.loading = false;

                    if (response.data['user']) {
                        console.log('user found', response.data['user']);
                        this.nextCard();  /**/
                        // this.runRandomTest();
                    } else {
                        console.log('no user');
                        this.nextCard();
                    }
                }, 1000);
            }).catch(err => {
                console.log('err', err);
                this.error = true
            });
    },
    methods: {
        sameBtnClicked(){
            this.cards[this.i]['clicked'] = true;
        },
        skipSection(){
            clearTimeout(this.cardTimeout);

            this.card = this.prepareCard(this.i);
            if (this.card['same']) {
                /**/console.log('clicking', this.i, this.card);
                this.sameBtnClicked();
            }

            setTimeout(()=>{
                var i2 = this.i + 1;
                this.card = this.prepareCard(i2);

                // Another symbol? Skip it as well.
                if (this.card['type'] == 'symbol' || this.card['type'] == 'trial') {
                    this.i++;
                    this.skipSection();

                // No next card? Finish the test.
                } else if (!this.card) {
                    this.$emit('test-finished');

                    // Next card is break/info card? Manage it standard way.
                } else {
                    this.nextCard();
                }
            }, 100);
        },
        nextCard(){
            // Force move to specific card ?
            if (this.cards[this.i] && (this.cards[this.i]['next'] !== undefined)) {
                this.i = this.cards[this.i]['next'] - 1;
            }

            // Show blank and then selected card after small time
            this.card['content'] = '';
            this.cardTimeout = setTimeout(()=>{

                // Skip cards that doesn't meet their "if" conditions
                do {
                    this.i += 1
                } while (this.cards[this.i] && (this.validateCardConditions(this.i) == false));

                // Show chosen card
                if (this.cards[this.i]) {
                    this.card = this.prepareCard(this.i);

                    if (this.card['type'] == 'symbol' || this.card['type'] == 'trial') {
                        this.cardTimeout = setTimeout(this.nextCard, 800);
                    }

                    // No more cards, finish
                } else {
                    this.$emit('test-finished');
                    // console.log(this.cards)
                }
            }, 200);
        },
        prepareCard(i){
            if (!this.cards[i]) {
                return false;
            }

            this.cards[i]['clicked'] = false;

            var curCard = this.cards[i];
            if (curCard['type'] == 'symbol' || curCard['type'] == 'trial') {
                var level = curCard['level'];
                var prevCard = this.cards[i - level];

                // Is the card's ancestor same?
                if (prevCard && (prevCard['type'] == 'symbol' || prevCard['type'] == 'trial')) {
                    this.cards[i]['same'] = (this.cards[i]['content'] == this.cards[i - level]['content'])
                        && (this.cards[i]['level'] == this.cards[i - level]['level']);

                // The card doesn't have ancestor?
                } else if (curCard['type'] == 'symbol' || curCard['type'] == 'trial') {
                    this.cards[i]['same'] = false;
                }
            }

            return JSON.parse(JSON.stringify(this.cards[i]))  // clone card
        },
        validateCardConditions(i){
            // Imperfect?
            if (this.cards[i]['if'] == 'imperfect') {
                /**/console.log('Imperfect? i, cards', i, this.cards);

                for (let j = 0; j < i; j++) {
                    var card = this.cards[j];
                    if ((card['type'] == 'symbol' || card['type'] == 'trial') && (card['same'] != card['clicked'])) {
                        return true;  // found mistake => is imperfect
                    }
                }

                return false;  // no mistakes found => not imperfect
            }

            // No conditions, return true
            return true;
        },

        // ######                                     #######
        // #     #   ##   #    # #####   ####  #    #    #    ######  ####  #####
        // #     #  #  #  ##   # #    # #    # ##  ##    #    #      #        #
        // ######  #    # # #  # #    # #    # # ## #    #    #####   ####    #
        // #   #   ###### #  # # #    # #    # #    #    #    #           #   #
        // #    #  #    # #   ## #    # #    # #    #    #    #      #    #   #
        // #     # #    # #    # #####   ####  #    #    #    ######  ####    #

        runRandomTest(){
            this.cards = this.generateCards(10, 1);
            this.cards.push(
                { type: 'break', content: `
                    <h1 class="h1">Vedeš si skvěle!</h1>
                    <p class="p">Úspěšně jsi dokončil zahřívací kolo. Zde jsi měl kontrolovat, jestli je písmeno shodné s jeho <b><i>přímým předchůdcem</i></b>. </p>

                    <p class="p">Zkusíme to trochu ztížit. Nyní budeš porovnávat, jestli je symbol shodný se symbolem <b><i>před-předchozím</i></b>. <br/>
                    Tedy například v sekvenci <span class="badge">A</span>&rarr;<span class="badge">B</span>&rarr;<span class="badge">A</span> je poslední písmeno shodné - protože je stejné, jako <b><i>písmeno před předchozím</i></b> (takže klikáš na tlačítko).</p>

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
