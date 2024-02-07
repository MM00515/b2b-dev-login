<?php
$pageTitle = 'Login';
require_once('../includes/header.php');
require_once('../includes/language-switch.php')
?>

<?php 
    $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    print_r($ref);
    
    if (strpos($ref, 'https://udina-columbustp') == false) {
        header("Location: https://udina-columbustp-test.authentication.eu10.hana.ondemand.com");
        exit;
    }
?>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-12 w-auto opacity-50" src="/images/logo.svg" alt="Columbus TP">
            <h2 class="mt-6 text-center text-3xl text-gray-900" x-show="!redirecting" x-text="t('login', 'Sign in to your account')" x-cloak>
                Sign in to your account
            </h2>
            <p class="text-center mt-6" x-show="redirecting" x-text="t('logging-in', 'Logging you in...')" x-cloak></p>
        </div>

        <div x-show="!redirecting" class="mt-8 sm:mx-auto sm:w-full sm:max-w-md" x-cloak>
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <?php require_once('../includes/error.php') ?>
                <form class="space-y-6" method="POST" @submit.prevent="login()">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700" x-text="t('email', 'Email address')">
                            Email address
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" x-model="email" autocomplete="email" required autofocus
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700" x-text="t('password', 'Password')">
                            Password
                        </label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" x-model="password" autocomplete="current-password" required
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="text-sm">
                            <a @click.prevent="loadContent" href="<?php echo url('forgot-password.php') ?>" class="font-medium text-indigo-600 hover:text-indigo-500 select-none"
                               x-text="t('forgot-password', 'Forgot your password?')">
                                Forgot your password?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button :disabled="loading" type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                x-text="t('sign-in', 'Sign in')">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="redirecting" id="spinner" class="mx-auto mt-10 w-14 h-14" x-cloak>
            <img src="images/spinner.svg"/>
        </div>
    </div>
<?php require_once('../includes/footer.php'); ?>