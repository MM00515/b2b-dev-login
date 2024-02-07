<?php
$pageTitle = 'New Password Set';
require_once('../includes/header.php');
require_once('../includes/language-switch.php')
?>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-12 w-auto opacity-50" src="/images/logo.svg" alt="Columbus TP">
            <h2 class="mt-6 text-center text-3xl text-gray-900" x-text="t('set-password-success', $el.innerText)">
                Your new password has been set successfully.
            </h2>
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