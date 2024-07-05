    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>@yield('title')Laravel</title>
            
            <link rel="stylesheet" href="/css/index.css">
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    background-color: black;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
                .rectangle1 {
                    background: linear-gradient(180deg, rgba(4, 6, 22, 0.45) 0%, rgba(4, 6, 22, 0.845312) 50.48%, #040616 68.03%);
                    box-sizing: inherit;
                    width: 450px;
                    height: 100%;
                    gap: 0px;
                    opacity: 1; 
                    border: 0px;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                }
            </style>    
        </head>
        <body>
            <main class="rectangle1">
                @yield('content')
            </main>
        </body>
    </html>
