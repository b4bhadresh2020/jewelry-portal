# Shivaay Jewels

## Installation

* Add below code in the `C:\Users\{username}\.ssh\config` path :
```
    #shivaay account
        Host bitbucket.org-shivaay
        HostName bitbucket.org
        User git
        IdentityFile ~/.ssh/shivaay
        IdentitiesOnly yes
```

* Execute following command for clone repository.
```
    git clone git@bitbucket.org-shivaay:sanjayvekariya/backend.git shivaay
```

* Open the terminal in your root directory(`shivaay`) & to install the composer packages run the following command:
```
    composer install
```

* In the root directory, you will find a file named .env.example, rename the given file name to .env and run the following command to generate the key (and you can also edit your database credentials here).
```
    php artisan key:generate
    php artisan vendor:publish --provider="Junges\ACL\ACLServiceProvider" --tag="acl-migrations"
    php artisan vendor:publish --provider="Junges\ACL\ACLServiceProvider" --tag="acl-config"
    php artisan migrate
    php artisan db:seed
```
* By running the following command, you will be able to get all the dependencies in your node_modules folder:
```
    npm install
```
* To run the project, you need to run following command in the project directory. It will compile the php files & all the other project files. If you are making any changes in any of the .php file then you need to run the given command again.
```
    npm run dev
```
* To serve the application you need to run the following command in the project directory. (This will give you an address with port number 8000.)
```
    php artisan serve
```

## Required Permissions
If you are facing any issues regarding the permissions, then you need to run the following command in your project directory:
```
sudo chmod -R o+rw bootstrap/cache
sudo chmod -R o+rw storage
```

## Building for Production
 If you want to run the project and make the build in the production mode then run the following command in the root directory, otherwise the project will continue to run in the development mode.
```
npm run prod
```
