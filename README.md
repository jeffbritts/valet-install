#Valet Install

####A helper script to easily install Magento 2 on a Valet + environment

#####What it does
- deletes `/app/etc/env.php`
- applies ece patches (if present)
- drops and creates database
- installs magento
- runs upgrade, cleans cache, reindexes, sets developer mode

#####To use
- Copy `.env.sample` to `.env` (this should be in the root of your project)
- Edit the appropriate values in `.env`
- the install file can be placed in the root of the project, or in bin if you prefer
- `chmod +x install` (or `chmod +x bin/install`)