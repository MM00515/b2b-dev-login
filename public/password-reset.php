<?php
$pageTitle = 'Password Reset';
require_once('../includes/header.php');
require_once('../includes/language-switch.php')
?>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8" x-init='initResetPassword(<?php echo json_encode(['token' => $_GET['pwrt'] ?? '']) ?>)'>
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-12 w-auto opacity-50" src="/images/logo.svg" alt="Columbus TP">
            <h2 class="mt-6 text-center text-3xl text-gray-900" x-text="token ? t('reset-password', $el.innerText) : t('invalid-password-reset', 'Invalid password reset link')">
                Set a new password
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md text-sm">
            <p x-show="token" x-text="t('reset-password-instructions', $el.innerText)" x-cloak>Please set a new password for your account.</p>
            <p x-show="!token" x-text="t('invalid-password-reset-instructions', $el.innerText)" class="text-center" x-cloak>Your password reset link is invalid or incomplete. If
                you manually copied the link from the email, make sure it is complete. Some mail clients also may put a line feed in the link and break it.</p>
        </div>

        <div x-show="token" class="mt-8 sm:mx-auto sm:w-full sm:max-w-md" x-cloak>
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <?php require_once('../includes/error.php') ?>
                <form class="space-y-6" method="POST" @submit.prevent="setPassword()">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700" x-text="t('new-password', $el.innerText)">
                            New password
                        </label>
                        <div class="mt-1">
                            <input x-model="password" id="password" type="password" autocomplete="new-password" required autofocus
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700" x-text="t('confirm-password', $el.innerText)">
                            Confirm new password
                        </label>
                        <div class="mt-1">
                            <input x-model="confirmPassword" id="confirm-password" type="password" autocomplete="new-password" required autofocus
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                x-text="t('set-password', 'Set new password')">
                            Set new password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require_once('../includes/footer.php'); ?>