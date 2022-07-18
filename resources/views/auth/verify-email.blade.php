{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout> --}}

<!doctype html>
<html lang="en">

<head>
    <title>Login User</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="from/css/style.css">
    <style>
        .text{
            text-align: right;
            margin-top: -38px;
            margin-right: 125px;
            color: white;
        }
        .submit{
            margin-left: 75px;
        }
    </style>
</head>

<body class="img js-fullheight" style="background-image: url(from/images/bg.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">User Verification</h2>

                    <div style="color: white">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div style="color: white">
                            'A new verification link has been sent to the email address you provided during registration.
                        </div>
                    @endif
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6">

                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div class="submit">
                                <button class="btn btn-success">
                                    Resend Verification Email
                                </button>
                            </div>
                        </form>

                        <form class="text" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-secondary" type="submit">
                                Log Out
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="from/js/jquery.min.js"></script>
    <script src="from/js/popper.js"></script>
    <script src="from/js/bootstrap.min.js"></script>
    <script src="from/js/main.js"></script>

</body>

</html>
