<?php
$location = $argv[1]; //Get first CLI argument 
$path = "/etc/apache2/sites-enabled/"; //Where vagrant_webroot is
$file_contents = '<VirtualHost *:80>
  ServerName app.local
  DocumentRoot /vagrant/{{DOC}}
  <Directory /vagrant/{{DOC}}>
    DirectoryIndex index.php index.html
    AllowOverride All
    Order allow,deny
    Allow from all
  </Directory>
</VirtualHost>
';
$file_contents = str_replace("{{DOC}}", $location, $file_contents);
file_put_contents($path."vagrant_webroot", $file_contents);//Overwrite the new virtualhost
shell_exec("service apache2 reload");//Restart the apache