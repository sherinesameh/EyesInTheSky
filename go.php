<?php
 echo "Training....";
 $Train_crminals = var_dump(shell_exec("python /opt/lampp/htdocs/gp/TF/tensorflow/examples/image_retraining/retrain.py 2>&1"));
?>
