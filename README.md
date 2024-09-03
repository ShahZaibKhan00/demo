
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


        Setup Project

first  command for project setup
    composer update

2nd command for project setup
<br>
   &nbsp; cp .env.example .env <br>
above command will create the env file you have to make changes in this file for configuration of database like database username and password in my case it was root root you will find it in that env file 
<br>
3rd command 
to create the database and tables <br>
    &nbsp; php artisan migrate
<br>
4th command
Command for seeder <br>
   &nbsp; php artisan db:Seed
<br>
before creating blog you have to run below command and there are some other changes to which I have done for you if you run these commands
   &nbsp; php artisan storage:link
    
<br>
after all this command you can post, update or delete the blog + you can add comment too
<br>
next page url just change the number the page I have set the 1 data to be shown at the time of retreiving blogs<br>
  &nbsp;  "http://demo.test/api/blog/show?page=2"<br>
you just have to change the URL according to your machine this is my virtual host.<br>
<br>

I haven't created Queues because we need mail creditinals for that. I Know how to create and have created in my projects too. <br>
I hope there will be no error when you will test it if occurs let me know ...
