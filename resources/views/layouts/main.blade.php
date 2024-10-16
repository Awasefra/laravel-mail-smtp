<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
        }

        footer {
            padding: 0.25rem 0;
            font-size: 0.8rem;
        }

        footer p {
            margin: 0.2rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .social-links a {
            margin: 0 10px;
            color: #333;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #007bff;
        }

        .social-links i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <header class="bg-dark text-light text-center py-2">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('mails') ? 'active' : '' }}"
                                href="{{ route('mails.') }}">Send Email</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('mails/attachs') ? 'active' : '' }}"
                                href="{{ route('mails.attachs.') }}">Send Email with Attachment</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('mails/payrolls') ? 'active' : '' }}"
                                href="{{ route('mails.payrolls.') }}">Payroll</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container main-content mt-5">
        @yield('content')
    </div>

    <footer class="bg-dark text-white text-center">
        <p>Created by <a href="https://github.com/Awasefra" class="text-white" target="_blank">Awasefra</a></p>
        <p>&copy; 2024 All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>