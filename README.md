# Export List Of Users From User Group In Jira

**Installation**
* run composer install
* cp /vendor/lesstif/php-jira-rest-client/.env.example to /.env
* Update .env with your JIRA credentials
* Run PHP CLI (see below)

**Run PHP CLI**
```
php index.php group-name [bool]includeInactiveUsers [bool]startFrom [bool]maxResults
```

```
php index.php group-name 1 0 200
```

A new file will be created named [grou-name].csv and will be placed in the /csv folder.