### Run

- Clone this repository
- Run command "composer install" to download the dependencies (vendor folder)
- Run command "composer dump-autoload" to update the autoload files
- Run command "docker-compose up -d" to create a test PHP server
- Access http://localhost:3000 to check the answers. I created a very simple frontend to show the two answers in a json format.
- OR
- You can access here (https://leandroparra.com.br/tracktik-exercise) to see the answers

### Tests

- To run the unit tests, just type this command "./vendor/bin/phpunit tests"

### Changes

These are the changes I made to the code of this exercise:

- I moved the wired property from the EletronicItem to the constructor of the Controller (where it makes sense)
- I added a ENUM package to control the electric type and moved its "set" to the constructor
- I moved the maxExtras also to the constructor of the eletronic to prevent changes after its initialization
- I added the property canBeAddedAsExtra to control which eletronic can be added as extra
- I removed the constructor of the EletronicItems and added a method to add a EletronicItem
- I changed the method getItemsByType on EletronicItems to filter using the ENUM class
- I changed the method getSortedItems using the PHP function usort
