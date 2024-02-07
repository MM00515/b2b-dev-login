<?php
$pageTitle = 'Forgot Password';
require_once('../includes/header.php');
?>
<?php require_once('../includes/language-switch.php') ?>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-12 w-auto opacity-50" src="/images/logo.svg" alt="Columbus TP">
            <h2 class="mt-6 text-center text-3xl text-gray-900" x-text="t('forgot-password', 'Forgot your password?')">
                Forgot your password?
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md text-sm">
            <p x-text="t('forgot-password-instructions', $el.innerText)">Enter the eMail address you originally registered with below and click send. You will then receive an eMail
                with a link to a page where you can reset your password.</p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <?php require_once('../includes/error.php') ?>

                <form class="space-y-6" method="POST" @submit.prevent="resetPassword()">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700" x-text="t('email', 'Email address')">
                            Email address
                        </label>
                        <div class="mt-1">
                            <input x-model="email" id="email" name="email" type="email" autocomplete="email" required autofocus
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div class="text-center">
                        <div class="text-sm">
                            <a @click.prevent="loadContent" href="<?php echo url('index.php') ?>" class="font-medium text-indigo-600 hover:text-indigo-500 select-none"
                               x-text="t('back-to-login', $el.innerText)">
                                Back to the login page
                            </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                x-text="t('send', 'Send')">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require_once('../includes/footer.php'); ?>