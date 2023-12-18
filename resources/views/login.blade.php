<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Signup Example</title>
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="../../css/alert.css">
</head>

<body>
    <div class="form-wrapper">

        <div class="form-side">
            <form class="my-form" action="" method="POST">
                @include('partials.alert')
                @csrf
                <div class="image-container">
                    <img src="image/pmb_online/logo.png" alt="" height="250"
                        style="width: 250px; border-radius: 20%; margin-botom: 20px">
                </div>
                <div class="divider">
                    <span class="divider-line"></span>
                    Login
                    <span class="divider-line"></span>
                </div>

                <div class="text-field">
                    <label for="email">Email:
                        <input type="email" id="email" name="email" autocomplete="on" placeholder="Your Email" required>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                            <path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28"></path>
                        </svg>
                    </label>
                </div>
                <div class="text-field">
                    <label for="password">Password:
                        <input id="password" type="password" name="password" placeholder="Your Password" required>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z">
                            </path>
                            <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                            <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                        </svg>
                    </label>
                </div>
                <button class="my-form__button" type="submit">
                    Sign in
                </button>
                <div class="my-form__actions">
                    <div class="my-form__row">
                        <span>Did you forget your password?</span>
                        <a href="#" title="Reset Password">
                            Reset Password
                        </a>
                    </div>
                    <div class="my-form__signup">
                        <a href="/register" title="Login">
                            Register
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="info-side">
            <div class="welcome-message" style="border-radius: 20px;">
                <h2>PSB Online</h2>
            </div>
        </div>
    </div>

</body>

</html>