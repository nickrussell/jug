# Export List Of Users From User Group In Jira
A simple PHP script that leverages https://github.com/lesstif/php-jira-rest-client 
to create a CSV export of users from a user group in JIRA.

**Installation**
* run composer install
* cp /vendor/lesstif/php-jira-rest-client/.env.example .env
* Update .env with your JIRA credentials
* Run PHP CLI (see below)

**Run PHP CLI**
example:
```
php index.php group-name [bool]includeInactiveUsers [bool]startFrom [bool]maxResults
```

real-example:
```
php index.php group-name 1 0 200
```

A new file will be created named [group-name].csv and will be placed in the /csv folder.