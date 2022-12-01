<!DOCTYPE html>
<html class="h-full" data-theme="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" media="all" />
</head>

<body class="h-full relative flex p-4">

    <!--
    #######
    #        ####  #####  #    #
    #       #    # #    # ##  ##
    #####   #    # #    # # ## #
    #       #    # #####  #    #
    #       #    # #   #  #    #
    #        ####  #    # #    #
    -->
    <form action="" class="flex-col w-full hidden">
        <div class="form-control row w-full">
            <label class="label">
                <span class="label-text">What is your name?</span>
            </label>
            <input type="text" placeholder="John Doe" class="input input-bordered w-full" />
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">What is your birthdate?</span>
            </label>
            <input type="date" placeholder="31.12.1990" class="input input-bordered w-full" />
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">How many languages do you understand?</span>
            </label>
            <input type="number" placeholder="1" step="1.0" min="1" class="input input-bordered w-full" />
        </div>

        <div class="form-control w-full">
            <label class="label">
                <span class="label-text">How many languages do you speak?</span>
            </label>
            <input type="number" placeholder="1" step="1.0" min="1" class="input input-bordered w-full" />
        </div>

        <div class="bottom-container">
            <button class="btn btn-primary w-full">Pokračovat</button>
        </div>
    </form>

    <!--
    ###
     #  #    # ######  ####
     #  ##   # #      #    #
     #  # #  # #####  #    #
     #  #  # # #      #    #
     #  #   ## #      #    #
    ### #    # #       ####
    -->
    <div class="_hidden">
        <h1 class="h1">Základní informace</h1>

        <p class="p">V následujících krocích budete sledovat na obrazovce měnící se písmena a čísla. Každé se zobrazí na 2s.
        Pod nimi vždy tlačítko <span class="btn btn-primary btn-xs">Shodné s 1 předchozí</span>. </p>

        <p class="p">Vaším úkolem je toto tlačítko zmáčknout, pokud předchozí znak byl stejný, jako ten aktuální.
        Až budete připraveni, klikněte na tlačítko <i>Pokračovat</i>.</p>

        <div class="bottom-container">
            <a href="" class="btn btn-primary w-full">Pokračovat</a>
        </div>
    </div>

    <!--
     #####
    #     # #   # #    # #####   ####  #
    #        # #  ##  ## #    # #    # #
     #####    #   # ## # #####  #    # #
          #   #   #    # #    # #    # #
    #     #   #   #    # #    # #    # #
     #####    #   #    # #####   ####  ######
    -->
    <div class="w-full hidden">
        <div class="symbol">
            A
        </div>

        <div class="bottom-container">
            <a href="" class="btn btn-secondary w-full">Shodné s 1 předchozí</a>
        </div>
    </div>

</body>
</html>
