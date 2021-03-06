<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <title>Hi Valeeqa</title>

    <link rel="apple-touch-icon"
          href="{{ asset('img/apple-icon.png') }}">
    <link rel="shortcut icon"
          type="image/x-icon"
          href="{{ asset('img/favicon.ico') }}">
    <link rel="stylesheet"
          href="{{ asset('css/app.css') }}">
    <style>
        @media screen and (min-width: 992px) {
            #fPass {
                width: 50%
            }
        }

        @media screen and (min-width: 768px) and (max-width: 991px) {
            #fPass {
                width: 75%
            }
        }

        @media screen and (max-width: 767px) {
            #fPass {
                width: 100%
            }
        }

    </style>
</head>

<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center"
         style="height: 100vh;">
        <div class="card bg-white border border-white px-5 py-5"
             style="border-radius: 2rem"
             id="fPass">
            <div class="card-body">
                <h6 class="text-uppercase d-flex align-items-center">
                    <img src="{{ asset('img/hi-valeeqa.png') }}"
                         class="float-left me-2"
                         alt="Hi Valeeqa"
                         style="height: 1rem">
                    Hi Valeeqa
                </h6>
                <h2 class="my-4 text-pink">Lupa Password</h2>
                <form action="{{ url('forgot-password') }}"
                      method="post">
                    @if (session()->has('status'))
                        <div
                             class="alert {{ session()->get('status') == 'success' ? 'alert-success' : 'alert-danger' }}">
                            {{ session()->get('msg') }}
                        </div>
                        {{ session()->forget(['status', 'msg']) }}
                    @endif
                    <div class="mb-3">
                        <label for="email"
                               class="form-label">Email</label>
                        <input type="email"
                               class="form-control"
                               placeholder="example@email.com"
                               id="email"
                               name="email"
                               required>
                    </div>
                    <div class="d-grid mb-5">
                        <button class="btn btn-pink btn-lg">Kirim</button>
                    </div>
                </form>
                <div class="d-flex justify-content-center align-items-center">
                    <a href="{{ url('login') }}"
                       class="text-pink me-1">Masuk</a> atau <a href="{{ url('register') }}"
                       class="text-pink ms-1">Daftar</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
