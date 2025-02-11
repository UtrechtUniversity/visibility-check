<?php
header('Content-Type: application/javascript');
?>

var _env = {
  'API_URL' : '<?php print trim(getenv('PROXY_URL')); ?>',
  'FEEDBACK_FORM_URL' : '<?php print trim(getenv('FEEDBACK_FORM_URL')); ?>'
};


