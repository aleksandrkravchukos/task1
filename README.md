# Docker / PHP 7.4 console / composer / phpunit 

##Clone the repo and run the commands

    docker-compose up -d

    docker exec -i mysql8 mysql -uroot -proot  content < dump/task1.sql
    
##Run tests

    make functional-tests

Finally you can see like this https://prnt.sc/t371g4