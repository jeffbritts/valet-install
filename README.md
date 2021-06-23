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
- Copy all files except `composer.json` to your project root
-  `mv .env.sample .env`
- Edit the appropriate values in `.env`
- `chmod +x vp`

