<?php
$pageTitle = 'Password Reset Success';
require_once('../includes/header.php');
require_once('../includes/language-switch.php')
?>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-12 w-auto opacity-50" src="/images/logo.svg" alt="Columbus TP">
            <h2 class="mt-6 text-center text-3xl text-gray-900" x-text="t('reset-mail-success', $el.innerText)">
                The password reset email has been sent.
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md text-sm">
            <p x-text="t('reset-success-copy', $el.innerText)">An eMail was sent to your address. Click the link contained in the eMail <strong>within the next hour</strong> to be
                forwarded to a page where you can reset your password.</p>
            <p class="mt-4" x-text="t('reset-success-notice', $el.innerText)">The eMail should reach your inbox within a few minutes. Make sure to check your spam folder in case it
                does not.</p>
        </div>

        <div class="text-center mt-10">
            <div class="text-sm">
                <?php if (defined('PORTAL_URL')): ?>
                    <a href="<?php echo PORTAL_URL ?>" class="font-medium text-indigo-600 hover:text-indigo-500" x-text="t('back-to-portal-login', $el.innerText)">
                        Back to the login page
                    </a>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php require_once('../includes/footer.php'); ?>