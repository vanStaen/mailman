# Mailman
Email service in PHP

## Send eMail
As Heroku doesn't allow the mail function of PHP, the rest Api deployed act as an mirror to the script hosted on an other server (allowing the mail functionality). The heroku script is seen a the `mirror` and the final script as the `emailer`.

### Setup
1. Upload the file emailer.php (folder ressources) on the server allowing the php mail function.
2. Save the link to this file as `emailerURL` in the environement variable config file (on Heroku and local). 

### Checks
All verification of the data are made on the mirror side. 
- Validity of the emails
- Confirmation of the credentials (id:key)

## Deploy on Heroku
`heroku git:remote -a mailman-cvs`: Connect heroku CLI to git branch. </br>
`git push heroku main`: Push git master to heroku.

### Show logs 
Showing the logs: `heroku logs --tail`

## Install php libraries
`composer install` is the equivalent of `npm install`.

### Install composer
https://getcomposer.org/download/ - To make composer globally executable : 
```
sudo mv composer.phar /usr/local/bin/composer
```

## Ressources
https://shareurcodes.com/blog/creating%20a%20simple%20rest%20api%20in%20php