# MyZenTeam code test assignment

## Description

This project is a test assignment and not meant for actual use by companies or job seekers.

This is a hiring platform where job seekers (candidates) can be found and get contacted and hired from companies' hiring managers.

The platform is free for job seekers, but not for companies.
The billing is handled by using a wallet. At the start each company has a wallet with 20 coins of credit.
These coins can be used to contact candidates and contacting a candidate will cost the company 5 coins.
Hiring a contacted candidate will deposit 5 coins back into the company's wallet.
Both contacting and hiring a candidate will automatically send them an email.

_**This app was created only for the purpose of the test assignment and code quality in this repository DOES NOT represent code quality in MyZenTeam.**_

## Get started

1. Clone the repository.

2. Set up a local environment (Docker/WAMPP/XAMPP etc.)

3. cd to the project directory and run:

```bash
# install dependencies
$ npm install
$ composer install
```

4. Copy .env.example to .env in the root folder

5. configure .env with settings for your database and mailer

6. Run the following commands

```bash
# set up the laravel app key
$ php artisan key:generate

# migrations and seeding
$ php artisan migrate --seed

# hot reload
$ npm run watch
```

7. To enable to queue worker to send out mails:

```bash
# start queue worker
$ php artisan queue:work
```
