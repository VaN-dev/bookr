Bookr test project
========================

# Installation
```
git clone git@github.com:VaN-dev/bookr.git
cd bookr
composer install
bin/console doctrine:database:create
bin/console doctrine:schema:create
bin/console doctrine:fixtures:load
```

# Usage
```
bin/console server:run
```
visit http://127.0.0.1:8000