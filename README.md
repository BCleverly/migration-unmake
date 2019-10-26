# Laravel Migration Unmake

A laravel console command to remove the last file in your migrations folder. This is handy in case you create a migration by accident or release you don't need it anymore.

## How to install 
``composer require bcleverly/migration-unmake``

## How to run 
To remove the latest file run the following: ``php artisan migration:unmake`` to dry run add `--dry-run` to the end of the command.

MIT license
