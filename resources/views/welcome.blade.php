<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

<body class="flex p-4">

    <form action="" class="flex-col">
        <div class="form-control row w-full max-w-xs">
            <label class="label">
                <span class="label-text">What is your name?</span>
            </label>
            <input type="text" placeholder="John Doe" class="input input-bordered w-full max-w-xs" />
        </div>

        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">What is your birthdate?</span>
            </label>
            <input type="date" placeholder="31.12.1990" class="input input-bordered w-full max-w-xs" />
        </div>

        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">How many languages do you understand?</span>
            </label>
            <input type="number" placeholder="1" step="1.0" min="1" class="input input-bordered w-full max-w-xs" />
        </div>

        <div class="form-control w-full max-w-xs">
            <label class="label">
                <span class="label-text">How many languages do you speak?</span>
            </label>
            <input type="number" placeholder="1" step="1.0" min="1" class="input input-bordered w-full max-w-xs" />
        </div>

        <button class="btn">Pokračovat</button>
    </form>

</body>

</html>
