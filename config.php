<?php
require 'stripe-php-master/init.php';
$publishableKey="pk_test_51I6dW0CHA2TXPVd4d0kIeEtPUTaJ62l2bK5atSgswyh211EBUQpJ1MSgA7VTj14z2OsFMsfs3mJCXE6NinSWNSgf00aSSCVouC";
$secretKey="sk_test_51I6dW0CHA2TXPVd4NzyWWFlfzhfLzR32iGWZJ8LD1LAfn8X3cox4UOXNJOXYO0G4T8sOZ9dMYF0PJWhYQ7hiyQvK00B4RtMQ6D";
\Stripe\Stripe::setApiKey($secretKey);
?>
