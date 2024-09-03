
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


        Setup Project

first  command for project setup
    composer update

2nd command for project setup
    cp .env.example .env
above command will create the env file you have to make changes in this file for configuration of database like database username and password in my case it was root root you will find it in that env file 

3rd command 
to create the database and tables
    php artisan migrate

4th command
Command for seeder
    php artisan db:Seed

before createing blog you have to run below command and there are some other changes to which I have done for youu if you run these commands
    php artisan storage:link

after all this command you can post, update or delete the blog + you can add comment too

next page url just change the number the page I have set the 1 data to be shown at the time of retreiving blogs
    "http://demo.test/api/blog/show?page=2"
you just have to change the URL according to your machine this is my virtual host.

I hope there will be no error when you will test it if occurs let me know ...
