# Docker / PHP 7.4 console / composer / phpunit 

Task1.

* You must create a table in MySQL to store the book.
* The book arrives line by line, that is, the input is strings.
* Line size on average 3-5mb.
* It is necessary to avoid repetition, each line must be unique.
* You must write the database structure (TABLE DDL) and the code that will record the data.

## Prerequisites

Install Docker and optionally Make utility.

Commands from Makefile could be executed manually in case Make utility is not installed.

## Build container and install composer dependencies

    Make build

## Create original files from dist

If dist files are not copied to actual destination, then
    
    Make copy-dist-configs
    
## Run docker containers

    Make up

## Create database

    Make create-database
    
## Check docker containers

    docker ps    
    
## Create database 

    docker exec -i mysql_task_1 mysql -uroot -proot  content < dump/task1.sql        

## Run functional tests

Runs container and executes functional tests.

    Make functional-tests


## Fix code style

    Make cs-fix

## Static analysis

Static analysis check

    Make static-analysis
    
## Algorithm 

In this task, a test table is created with the structure:
* hash_text (unique field)
* one_row (field book mediumtext maximum field size 16mb)
* name (string for the name of the book)
 
All implemented methods are used in BookServiceTest tests.
1. canAddString - check to insert a large row 3-5 mb
2. canAddDuplicateText - check for insertion of a duplicate of a large row of a row, we expect that it will not be inserted
3. canAddAnotherText - insert two different text 