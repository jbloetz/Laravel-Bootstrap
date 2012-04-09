## Laravel Bootstrap

I used to have a CodeIgniter bootstrap framework that dealt with basic CRUD stuff, news articles, image galleries, users, permissions etc. All based on the amazing Laravel framework.

### Feature Overview

- News Articles (with image uploads)
- User Management
- Role Management
- Help and Support (sends an email from a form in the backend)
- Gallery and Images (not implemented yet, database structure built)
- Setup Of Database and User Automatic

### Setting Up The Database

- Edit application/config/database.php
- Find the values saying "fw2" and change to your own configuration
- Then goto your application URL and append: /admin/setup
- You will need to remove the routes for this in application/routes.php as this isn't automated yet.


### Contributing to Laravel

Contributions are encouraged and welcome. All commits must be signed off using the "-s" switch.

	git commit -s -m "this commit will be signed off automatically!"