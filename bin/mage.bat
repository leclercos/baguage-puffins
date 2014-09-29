@ECHO OFF
SET BIN_TARGET=%~dp0/../vendor/andres-montanez/magallanes/bin/mage
php "%BIN_TARGET%" %*
