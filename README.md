#Valet Install

####A helper script for Magento 2 on a Valet + environment

#####Usage
vp [action]

Actions:

-i Install Magento  
-c Clean cache
-r Reindex  
-w Start cache-clean watcher  

Cache Clean uses https://github.com/mage2tv/magento-cache-clean


#####What it does on install
- deletes `/app/etc/env.php`
- applies ece patches (if present)
- drops and creates database
- installs magento
- runs upgrade, cleans cache, reindexes, sets developer mode

#####To use
- `composer require jbritts/valet-install`
- run `./vendor/jeffbritts/valet-install/setup`
-  If you dont have a local `.env` file : `mv .env.sample .env` and edit the appropriate values

