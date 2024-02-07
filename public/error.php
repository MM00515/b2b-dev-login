<?php
$pageTitle = 'Error';
require_once('../includes/header.php');

$error              = json_decode($_GET['error'] ?? '{}', true);
$errorCode          = $error['errorCode'] ?? '';
$errorMessage       = $error['errorMessage'] ?? 'Unknown error';
$errorDetails       = $error['errorDetails'] ?? 'Please try again.';
$redirectIfLoggedIn = false;
?>
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8 mt-10">
    <img class="mx-auto h-12 w-auto opacity-50 mb-4 -mt-4" src="/images/logo.svg" alt="Columbus TP">
    <div id="container" class="text-center">
        <h1 class="text-2xl text-gray-500">Error <?php echo $errorCode ?></h1>
        <h2 class="text-3xl font-bold my-3"><?php echo $errorMessage ?></h2>
        <h3 class="text-lg mt-4"><?php echo $errorDetails ?></h3>

        <div class="text-sm mt-10">
            <a href="<?php echo url('index.php') ?>" class="font-medium text-indigo-600 hover:text-indigo-500" x-text="t('try-again', 'Try again')">
                Try again
            </a>
        </div>
    </div>
</div>
</div>
</body>

</html>