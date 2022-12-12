<template>
    <!--
    #######
    #       # #    # #  ####  #    #
    #       # ##   # # #      #    #
    #####   # # #  # #  ####  ######
    #       # #  # # #      # #    #
    #       # #   ## # #    # #    #
    #       # #    # #  ####  #    #
    -->
    <h1 class="h1">Gratuluji!</h1>

    <p class="p text-justify">
        <img src="/lea2.png" alt="Lea Slížová" class="float-right mt-[3px] ml-5 mb-4 w-28 rounded"/>
        Úspěšně jsi prošel celým testem. Velice jsi mi tím pomohl s bakalářskou prací a já ti jsem za to vděčná.
    </p>

    <p class="p text-justify">
        Tvé výsledky spolu se srovnáním s ostatními účastníky najdeš na odkazu níže. Výsledky jsou interaktivní, takže jak bude více lidí zkoušet tento test, tvé srovnání s ostatními se bude měnit.
    </p>

    <p class="p text-justify">
        Neváhej se zde tedy vracet. A to jak k výsledkům, tak klidně čas od času k samotnému testu. Ve výsledcích pak uvidíš historicky všechny tvé testy i jejich srovnání.
    </p>

    <p class="p">
        A zde už slíbený odkaz: <br/>
        <i class="fa-solid fa-up-right-from-square link link-primary mr-1"></i>
        <a class="link link-primary" v-bind:href="'https://lea.michalm.cz/' + email" target="_blank">lea.michalm.cz/{{ email }}</a>
    </p>

    <div class="bottom-container text-center opacity-75">
        <small>
            <i class="fa-solid fa-copyright"></i>
            Aplikaci vytvořil
            <a href="https://www.linkedin.com/in/michal-mikolas" target="_blank" class="link">Michal Mikoláš</a>
            jako
            <a href="https://github.com/Michal-Mikolas/nback" target="_blank" class="link">open-source</a>.
        </small>
    </div>

</template>


<script>
export default {
    props: ['email'],
    data() {
        return {
        }
    },
    methods: {
    },
}
</script>
