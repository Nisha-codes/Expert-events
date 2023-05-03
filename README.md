
# Event Booking App
> A Event booking  app that allows users book events and admin can manage the events

## Description
This project was built with HTML,CSS,PHP and MYSQL .


## Running the App
To run the App, you must have:
- **PHP** (https://www.php.net/downloads)
- **PostgreSQL** (https://www.mysql.com/downloads/)

Clone the repository to your local machine using the command
```console
$ git clone *remote repository url*
```




### Environment
Configure your database in `/includes/database.php` for  based on your MYSQL database configuration

```  

$con = mysqli_connect('localhost', 'root','','database_name');
```

### STARTING SERVER

```console
$ php -S localhost:5000 
```



## Assumptions/Suggestions/Decisions
While creating the app the following Assumptions/Decisions were made
- When a user tries to book an event for a date and time already taken, they are prevented from booking such event and informed of the date and time unavailability
