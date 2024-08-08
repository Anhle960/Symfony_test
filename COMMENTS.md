Firstly, thank you for letting me take part in this interview test. I am very excited to be part of this process. So far, this is what I was able to complete:

1. Created a new Login, Register pages & form for implementing user authentication process.
2. Created a new table "auth", which will be used to store user information after registering, whcih will be used for logging in.
3. Added a new Logout button in the User page.
4. Added a new pagination for the user list table on the User page. Currently, there will be about 10 users per page.
5. Added a new Edit button for the user to be able to update their information.
6. Added security.yaml for adding the configuration for the authentication process.
7. Added mono logger along with log level for the practice of tracking the functions called & routing their errors for maintenance purposes, in the near future.
8. Optimized the database perfformance time using cache practices for the functions.

I also refactored the code of the file UserController:

1. Added file UserService which storing the function to handle the user actions (add new, delete, edit).
2. Remove the code for creating the table "user" and updating mockup data for it, switch to using the migration files for that process.
3. Used dependency injection practice for the file.

I also refactored the code for the templates:

1. Moved all the css codes to folder public/css for better management.
2. Added some new script for the user page for handling the edit action.

I also updated file composer.json for installing additional packages needed for above changes.

To deploy this project, please follow the instructions below and make sure to read the whole document. Thank you, once again!

1. Set up the project

docker compose up symfony

The following output should be expected:
symfony 10:03:33.26
symfony 10:03:33.26 Welcome to the Bitnami symfony container
symfony 10:03:33.26 Subscribe to project updates by watching https://github.com/bitnami/containers
symfony 10:03:33.26 Submit issues and feature requests at https://github.com/bitnami/containers/issues
symfony 10:03:33.27
symfony 10:03:33.27 INFO ==> ** Running Symfony setup **
symfony 10:03:33.28 INFO ==> Configuring PHP options
symfony 10:03:33.28 INFO ==> Setting PHP opcache.enable option
symfony 10:03:33.29 INFO ==> Setting PHP expose*php option
symfony 10:03:33.29 INFO ==> Setting PHP output_buffering option
symfony 10:03:33.30 INFO ==> Validating settings in MYSQL_CLIENT*\_ env vars
symfony 10:03:33.31 INFO ==> Validating settings in SYMFONY\_\_ environment variables...
symfony 10:03:33.32 WARN ==> You set the environment variable ALLOW_EMPTY_PASSWORD=yes. For safety reasons, do not use this flag in a production environment.
symfony 10:03:33.32 INFO ==> Copying symfony/skeleton project files to /app
symfony 10:03:33.63 INFO ==> Trying to connect to the database server
symfony 10:03:33.64 INFO ==> Trying to install required Symfony packs
symfony 10:03:41.16 INFO ==> ** Symfony setup finished! **

    symfony 10:03:41.17 INFO  ==> ** Starting Symfony project **
    [Sat Oct  7 10:03:41 2023] PHP 8.2.11 Development Server (http://0.0.0.0:8000) started

# Verifying installation

Open http://localhost:8000, you should be greeted with "Welcome to Symfony 6.3.4".

3. Running the migration

To run the migration for creating the necessary tables for this project, please run the following command:

docker-compose exec symfony php bin/console doctrine:migrations:version --delete --all --no-interaction

This is to ensure the migration files will be executed from the first file to the last. 

docker-compose exec symfony php bin/console doctrine:migrations:migrate --no-interaction

This will proceed with migrate the tables into the database.

# Test the application

1. First, the page will now be redirected to http://localhost:8000/login.

In this page, you will see a form with the fields "Email" and "Password". There will also have 2 buttons: "Login" and "Register".

2. Click the "Register" button. You will be redirected to http://localhost:8000/register.

3. Fill in the "Email" & "Password" fields, then click the "Register" button. The user data will be created and you will be redirected back to http://localhost:8000/login.

4. Fill in the "Email" & "Password" fields, then after clicking the "Login" button, if the user data is right, you will be redirected to http://localhost:8000/user.

Now you should see an HTML form with the fields "First name", "Last name" and "Address".

5. I updated the migration file for the table "user" to have around 25 records, for testing the pagination.

6. There will also be a new "Edit" button. Clicking it will fill the current user data into the form input fields. After the changes have been done, press the "Save" button & the user data will be updated.

7. Click the "Logout" button on the top right to log out, at any time. The login process will be started again.

I also made changes to the file composer.json to install additional packages for the project:

"php": ">=8.2",
"ext-ctype": "_",
"ext-iconv": "_",
"doctrine/dbal": "^3",
"doctrine/doctrine-bundle": "^2.12",
"doctrine/doctrine-migrations-bundle": "^3.3",
"doctrine/orm": "^3.2",
"symfony/console": "6.3._",
"symfony/dotenv": "6.3._",
"symfony/flex": "^2",
"symfony/framework-bundle": "6.3._",
"symfony/maker-bundle": "^1.53",
"symfony/runtime": "6.3._",
"symfony/security-bundle": "6.3._",
"symfony/twig-bundle": "6.3._",
"symfony/asset": "6.3._",
"monolog/monolog": "^3.0",
"symfony/monolog-bundle": "^3.0",
"symfony/yaml": "6.3._"

In case the projects will not be able to run in your site due to missing libraries. Please do the following: 

1. Delete the current file composer.lock
2. Run: docker-composer exec composer install.

Then the project will start installing all the missing libraries. After that, we're good to go.

Missed:

I'm still missing with:

- Creating a forgot password page & form for the idea of letting the users change their password.
- Requiring the password complexity for the password field.

That's all from me for this test project. Thank you once again for the opportunity.
