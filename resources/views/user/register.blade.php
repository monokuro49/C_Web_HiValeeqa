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
</head>

<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center"
         style="height: 100vh;">
        <div class="card bg-white border border-white px-lg-5 px-3 px-md-5 py-5"
             style="border-radius: 2rem">
            <div class="card-body">
                <div class="row">
                    <div class="d-none d-lg-inline col-lg-7">
                        <img src="{{ asset('img/window-shop.svg') }}"
                             alt="Daftar Akun"
                             class="img-fluid w-75">
                    </div>
                    <div class="col-12 col-lg-5">
                        <h6 class="text-uppercase d-flex align-items-center">
                            <img src="{{ asset('img/hi-valeeqa.png') }}"
                                 class="float-left me-2"
                                 alt="Hi Valeeqa"
                                 style="height: 1rem">
                            Hi Valeeqa
                        </h6>
                        <h2 class="my-4 text-pink">Welcome to Family</h2>
                        <form action="{{ url('/register') }}"
                              method="POST"
                              onsubmit="return (passwordValidation() && emailValidation())">
                            <div id="alert">
                                @if (session()->has('status'))
                                    <div
                                         class="alert {{ session()->get('status') == 'success' ? 'alert-success' : 'alert-danger' }}">
                                        {{ session()->get('msg') }}</div>
                                    {{ session()->forget(['msg', 'status']) }}
                                @endif
                            </div>
                            <div class="mb-3">
                                <input type="text"
                                       class="form-control"
                                       id="fullname"
                                       name="fullname"
                                       placeholder="Nama Lengkap"
                                       onfocus="removeAlert()"
                                       required>
                            </div>
                            <div class="mb-3">
                                <input type="email"
                                       class="form-control"
                                       id="email"
                                       name="email"
                                       aria-describedby="emailHelp"
                                       placeholder="Email"
                                       onfocus="removeAlert()"
                                       required>
                            </div>
                            <div class="mb-3">
                                <input type="text"
                                       class="form-control"
                                       id="username"
                                       name="username"
                                       placeholder="Username"
                                       onfocus="removeAlert()"
                                       required>
                            </div>
                            <div class="mb-3">
                                <input type="password"
                                       class="form-control"
                                       id="password"
                                       name="password"
                                       placeholder="Password"
                                       onfocus="removeAlert()"
                                       required>
                            </div>
                            <div class="mb-3">
                                <input type="password"
                                       class="form-control"
                                       id="confirmPassword"
                                       name="confirmPassword"
                                       placeholder="Konfirmasi Password"
                                       onfocus="removeAlert()"
                                       required>
                            </div>
                            <div class="d-grid mb-3">
                                <button type="submit"
                                        class="btn btn-pink btn-lg">Daftar</button>
                            </div>
                        </form>
                        <div class="d-grid">
                            <a href="{{ url('/') }}"
                               class="btn btn-light btn-lg">Back to Home</a>
                        </div>
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            Sudah Punya Akun? <a href="{{ url('login') }}"
                               class="text-pink ms-1">Masuk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        alert = document.getElementById('alert')

        const passwordValidation = () => {
            pwd = document.getElementById('password').value
            pwdC = document.getElementById('confirmPassword').value

            if (pwd !== pwdC) {
                alert.innerHTML = "<div class='alert alert-danger'>Password tidak sesuai</div>"
                return false
            } else {
                return true
            }
        }

        const emailValidation = () => {
            emailInput = document.getElementById('email').value

            function validateEmail(email) {
                const re =
                    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            }

            if (validateEmail(emailInput)) {
                return true
            } else {
                alert.innerHTML = "<div class='alert alert-danger'>Email tidak valid</div>"
                return false
            }
        }

        const removeAlert = () => {
            alert.innerHTML = ""
        }
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
