<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>کوتاه کننده لینک</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="font-family: Vazirmatn;"
    class="bg-gray-200 pt-16">
  	<form class="my-4 mx-auto flex max-w-lg" action="/links" method="POST">
        @csrf

    	<input class="rounded-l-lg p-4 border-t mr-0 border-b border-l text-gray-800
            border-gray-400 bg-white w-full" 
            type="text"
            name="link"
            placeholder="https://link.rezero.ir/link-shortener"/>

		<input type="submit"
            class="px-8 rounded-r-lg bg-yellow-400  text-gray-800 font-bold p-4
            uppercase border-yellow-500 border cursor-pointer"
            value="کوتاه کن">
	</form>

    @error('link')
        <div class="text-center text-red-600">{{ $message }}</div>
    @enderror
</div>

</body>

</html>