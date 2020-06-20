# Docker / PHP 7.4 console / composer / phpunit 

Blank docker project for console php 7.4 projects with composer and phpunit.

## Prerequisites

Install Docker and optionally Make utility.

Commands from Makefile could be executed manually in case Make utility is not installed.

## Build container and install composer dependencies

    Make build

## Build container and install composer dependencies

If dist files are not copied to actual destination, then
    
    Make copy-dist-configs
    
## Run docker 

    docker-compose up -d
    
## Check docker containers

    docker ps    
    
## Create database 

    docker exec -i mysql8 mysql -uroot -proot  content < dump/task1.sql        

## Run functional tests

Runs container and executes functional tests.

    Make functional-tests

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