<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CafeMovil</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background:linear-gradient(135deg, #172a74, #21a9af);
	            background-color:#184e8e;
                color:#fff;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .p {
                color:rgba(255,255,255,0.8);
                font-size:20px;
                font-weight:200;
            }

            .links > a {
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;

                text-transform: uppercase;
                
                color:#d9d9d9;
                text-decoration:none;
                opacity:0.8;
            }

            .links > a:hover {
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;

                opacity:1;
                color:#fff;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title">
                    CafeMovil [MAIN PAGE].
                </div>
                <!-- <div class="links">
                    <a href="/iniciar">Iniciar sesión</a>
                    <a href="/registrarme">Registrarme</a>
                </div> -->
            </div>
        </div>
    </body>
</html>