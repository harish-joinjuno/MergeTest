# Juno
![Build Status](https://app.chipperci.com/projects/b5e6a28f-d7c6-442a-848c-732a5f11a61f/status/master)
## Production environments.
    https://joinjuno.com

## QA environment
We have multiple QA environments.

    https://stage1.leveredge.org
    https://stage2.leveredge.org
    https://stage3.leveredge.org
    https://stage4.leveredge.org
    https://stage5.leveredge.org
    https://stage6.leveredge.org

## Installation
If you're using MacOs or Linux it's highly recommended to use Laravel Valet , documentation could be founded here - [MacOS] (https://laravel.com/docs/7.x/valet) , [LinuxValet] (https://github.com/cpriego/valet-linux)

1. Clone the project
2. Copy `.env.example` file to `.env`
3. Run `composer install` in the root of the project
4. Add your database credentials
5. Run `php artisan migrate --seed`
 
# Third Party Services Available
 
## Forge
We use Laravel Forge to manage our servers. You can ask Nikhil if you need access.
 
## Envoyer
We use Envoyer.io to manage our deployments. You can ask Nikhil if you need access.
 
## Mail Trap
We use Mail Trap to send emails.
 
## AWS
We use AWS EC2 instances, workspaces, Route 53, SES and other services. You can ask Nikhil if you need access.
 
## Sentry
Sentry keeps track of all our bugs, 500 errors etc.

## PaperTrail
Papertrail provides easy access to server logs.

## GitHub
We use GitHub for project management and as a code repository.

## Ottomatik
We use Ottomatik for database backups and quick restoration.
The backups are stored in AWS S3. 
	
## Integrations
 
### Checkbook.io	
To enable this integration in development mode, first create a free account using the Checkbook.io [sign up page][checkbookio-signup].	
 
Once your account is created, go to the `Developer` tab under the [settings][checkbookio-settings] menu and copy the `Client ID`, `API Key` and `API Secret` values to your `.env` file.	
 
```bash	
CHECKBOOK_IO_URI=https://sandbox.checkbook.io	
CHECKBOOK_IO_CLIENT_ID=061d923e871a4419b9acffc547ddac38	
CHECKBOOK_IO_API_KEY=2a8a1879ef3091228063631b2410d629	
CHECKBOOK_IO_API_SECRET=AfQ5IZIbH421pOSMA3EIXINL8OtNWv	
```

Dont forget to change your environment to `Sandbox`.	
If you need to add new capabilities to our `CheckbookIoClient`, check the [API Reference][checkbookio-api-reference] documentation.	
 
### MailChimp
To enable this integration in development mode, first create a free account using the Mailchimp.com [sign up page][mailchimp-signup].	
 
Once your account is created, go to the `Developer` tab under ACCOUNT > EXTRAS > API KEY [api keys][mailchimp-api-keys] menu and copy your `API Key` value to your `.env` file.	
 
```bash	
MAILCHIMP_API_KEY=xxxxxxx	
```
After that you will need a couple of List ids, so go to [Audience][mailchimp-audience] > VIEW CONTACTS > SETTINGS > AUDIENCE NAMES AND DEFAULTS and copy your `Audience ID` where necessary.

```bash	
MAILCHIMP_DEFAULT_LIST_ID=8f100b324e
MAILCHIMP_KICK_OFF_LABS_LIST_ID=8f100b324e
MAILCHIMP_SCHOLARSHIP_APP_LIST_ID=8f100b324e	
```

 
[checkbookio-signup]: hhttps://checkbook.io/register	
[checkbookio-settings]: https://www.checkbook.io/account/settings	
[checkbookio-api-reference]: https://docs.checkbook.io/reference 
[mailchimp-signup]: https://login.mailchimp.com/signup 
[mailchimp-api-keys]: https://us2.admin.mailchimp.com/account/api
[mailchimp-audience]: https://us2.admin.mailchimp.com/audience
