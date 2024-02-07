<?php
$pageTitle          = 'Logout';
$redirectIfLoggedIn = false;
require_once('../includes/header.php');
?>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8" x-init="logout()">
        <div id="container" class="text-center">
            <img class="mx-auto h-12 w-auto opacity-50 mb-4 -mt-4" src="/images/logo.svg" alt="Columbus TP">
            <div class="sm:mx-auto sm:w-full sm:max-w-md mt-6">
                <?php require_once('../includes/error.php') ?>
            </div>
            <span x-show="!loggedOut" x-text="t('logging-out', 'Logging out...')">Logging out...</span>
            <span x-show="loggedOut" x-text="t('logout-success', 'You have been logged out successfully.')">You have been logged out successfully.</span>
        </div>
    </div>
<?php require_once('../includes/footer.php'); ?>