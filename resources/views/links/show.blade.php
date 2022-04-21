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
    class="bg-gray-200 pt-16 px-1">
  	<div class="my-4 mx-auto flex max-w-lg">
        @csrf

    	<input 
            id="short-link"
            class="rounded-l-lg p-4 border-t mr-0 border-b border-l text-gray-800
            border-gray-400 bg-white w-full transition-colors" 
            type="text"
            name="link"
            value="{{ $url }}"
            placeholder="https://link.rezero.ir/link-shortener"/>

		<button type="submit"
            class="px-8 rounded-r-lg bg-blue-400  text-gray-800 font-bold p-4
             border-blue-500 border cursor-pointer whitespace-nowrap"
             onclick="copyShortLink()">کپی کن</button>
	</div>
    
    <div class="text-center underline">
        <a href="{{ route('links.create') }}">کوتاه کردن لینک جدید</a>
    </div>

    <script>
        function copyShortLink() {
            const input = document.getElementById('short-link')
            navigator.clipboard.writeText(input.value)
            input.style.backgroundColor = '#bbf7d0'

            setTimeout(
                () => input.style.backgroundColor = 'white',
                1000
            )
        }
    </script>

</div>

</body>

</html>