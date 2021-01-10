# Mailman
Email service in PHP

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