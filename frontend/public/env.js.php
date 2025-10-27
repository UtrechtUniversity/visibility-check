<?php
header('Content-Type: application/javascript');
?>

var _env = {
  'API_URL' : '<?php print trim(getenv('API_URL')); ?>',
  'FEEDBACK_FORM_URL' : '<?php print trim(getenv('FEEDBACK_FORM_URL')); ?>'
};


