cd Apache/app
echo "<?php \$repoversion='"$appver"';?>" > version.php
zip  -r Cameleon2 .
cd ..