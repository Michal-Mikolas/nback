<!DOCTYPE html>
<html class="h-full" data-theme="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NBack</title>

    <!-- Styles -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v=2" media="all" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css'/>
</head>

<body
    class="h-full relative flex p-4
        sm:bg-base-200 sm:bg-cover sm:bg-top"
>

    <div id="app"
        class="w-full h-full overflow-y-auto pb-20
            sm:card sm:w-[72rem] sm:bg-base-100 sm:shadow-xl sm:relative sm:mx-auto sm:p-4 sm:pb-20"
    >
        <h1 class="h1">{{ $user->email }} - Porovnání s ostatními</h1>
        <table class="table">
            <thead>
                <tr>
                    <th rowspan=2>Test</th>
                    <th colspan=4>Celkové skóre ty vs. ostatní</th>
                    <th colspan=3>Chyby typu "zapomenuté označení"</th>
                    <th colspan=3>Chyby typu "označeno nesprávně"</th>
                </tr>
                <tr>
                    {{-- Test --}}

                    {{-- Úspěšnost --}}
                    <th>Ty</th>
                    <th>Percentil</th>
                    <th>Průměr</th>
                    <th>Medián</th>

                    {{-- Chyby typu "zapomenuté označení" --}}
                    <th>Ty</th>
                    <th>Průměr</th>
                    <th>Medián</th>

                    {{-- Chyby typu "označeno nesprávně" --}}
                    <th>Ty</th>
                    <th>Průměr</th>
                    <th>Medián</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $mainTests = $user->tests()->where('is_main_test', 1)->get();
                    $minorTests = $user->tests()->where('is_main_test', 0)->get();
                @endphp

                <tr>
                    <td colspan="11">
                        <p class="p mt-4 whitespace-normal" style="margin-bottom: 0;">
                            <small class="small">První, hlavní test. Tento se počítá do výsledků bakalářské práce. Všichni testovaní mají tento první test stejný, se stejnými symboly. Proto se tento první test srovnává samostatně, s prvními testy ostatních účastníků.</small>
                        </p>
                    </td>
                </tr>
                @foreach($mainTests as $test)
                    @include('results-row', ['test' => $test, 'allTests' => $allMainTests])
                @endforeach

                <tr>
                    <td colspan="11">
                        <p class="p mt-4 whitespace-normal" style="margin-bottom: 0;">
                            <small class="small">Ostatní testy. Ty jsou generovány náhodně a tedy každý test je jiný. Přesto se pomocí souhrnných statistik můžeš porovnat s výkonností ostatních.</small>
                        </p>
                        @unless($minorTests->count())
                            <p class="p whitespace-normal mt-0">
                                <small class="small"><i class="fa-regular fa-folder-open mr-1"></i>
                                <i>Zatím žádné další testy nemáš. Neváhej si ale test zkusit kdykoli znovu - tyto testy se ti pak zobrazí zde.</i></small>
                            </p>
                        @endunless
                    </td>
                </tr>
                @foreach($minorTests as $test)
                    @include('results-row', ['test' => $test, 'allTests' => $allMinorTests])
                @endforeach
            </tbody>
        </table>

        <div class="bottom-container-wide">
            <small>
                <i class="fa-solid fa-copyright"></i>
                Aplikaci vytvořil
                <a href="https://www.linkedin.com/in/michal-mikolas" target="_blank" class="link">Michal Mikoláš</a>
                jako
                <a href="https://github.com/Michal-Mikolas/nback" target="_blank" class="link">open-source</a>
                pod svobodnou licencí
                <a href="https://cs.wikipedia.org/wiki/Licence_MIT" target="_blank" class="link">MIT</a>.
            </small>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.7/dayjs.min.js'></script>
    <script src="{{ mix('js/app.js') }}?v=2"></script>
</body>
</html>
