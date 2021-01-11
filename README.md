# Mailman
Email service in PHP

## Send eMail
As Heroku doesn't allow the mail function of PHP, the rest Api deployed act as an mirror to the script hosted on an other server (allowing the mail functionality). The link to this service is saved under `mailerURL`in the environement variable config file. 


## Deploy on Heroku
`heroku git:remote -a mailman-cvs`: Connect heroku CLI to git branch. 
`git push heroku main`: Push git master to heroku.

## Install php libraries
`composer install` is the equivalent of `npm install`.

### install conposer
https://getcomposer.org/download/ - To make composer globally executable : 
```
sudo mv composer.phar /usr/local/bin/composer
```

## Ressources
https://shareurcodes.com/blog/creating%20a%20simple%20rest%20api%20in%20php