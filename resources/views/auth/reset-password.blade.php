<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Reset Password KRATEOS</title>
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .background-wallpaper {
            background-image: url('{{ asset('images/walpaper.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 1000px;
            max-width: 500px;
        }

        .card-header {
            background: linear-gradient(45deg, #4e54c8, #8f94fb);
            border-bottom: none;
            text-align: center;
        }

        .card-header h3 {
            margin: 0;
            font-size: 1.5rem;
            color: #fff;
            font-weight: 700;
        }

        .card-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 18px;
            box-shadow: none;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #4e54c8;
            box-shadow: 0 0 10px rgba(78, 84, 200, 0.2);
        }

        .btn-primary {
            background: linear-gradient(45deg, #4e54c8, #8f94fb);
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #3a40a2, #7a7fe6);
        }

        .text-white {
            color: #fff;
        }
    </style>
</head>

<body class="background-wallpaper">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center text-white my-4">Reset Password KRATEOS</h3>
                                </div>
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    @endif

                                    <form action="{{ route('password.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('email') is-invalid @enderror"
                                                id="inputEmail" type="email" name="email"
                                                placeholder="name@example.com" value="{{ old('email') }}" required />
                                            <label for="inputEmail">Alamat Email</label>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                id="inputPassword" type="password" name="password"
                                                placeholder="Password Baru" required />
                                            <label for="inputPassword">Password Baru</label>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPasswordConfirmation" type="password"
                                                name="password_confirmation" placeholder="Konfirmasi Password Baru"
                                                required />
                                            <label for="inputPasswordConfirmation">Konfirmasi Password Baru</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100 mt-4 mb-3">Reset
                                            Password</button>
                                        @if (session()->has('status'))
                                            <div class="alert alert-success">
                                                {{ session()->get('status') }}
                                            </div>
                                        @endif
                                        <div class="text-center">
                                            <a class="small" href="{{ route('auth.index') }}">Kembali ke Login</a>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>

</html>
