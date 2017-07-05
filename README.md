![alt text][logo]
[logo]: https://github.com/SherineSameh/EyesInTheSky/blob/Users/public/assets/img/EyesInTheSkyLogo.png "Logo"

# EyesInTheSky
> Mobile Ad-hoc Cloud [Mobile infrastructure-less Cloud].  
> Website: MVC Model - No Framework - Angular JS - Material Design.  
> Back-End: PHP and Python

## To-Do List:

* **Website**:
1. ~~Database Schema and Implementation~~
2. [Pending] Home Page
3. ~~Login Page~~
4. **~~Administrator Portal~~**
  * ~~Admin Details~~
  * ~~Actions Log~~
  * ~~Raspberry pie specs, tasks and location~~
  * ~~DB Admin Page [Display, add, edit and delete accounts(Admin and Gov)]~~
5. **User Portal**
  * Registration form
  * ~~User Details~~
  * ~~Upload New Job~~
  * ~~Jobs History~~
  * ~~Receiving results~~
  * [Cancel] ~~Notification~~
6. **Government Portal**
  * ~~User Details~~
  * ~~Add Criminal~~
  * ~~Search~~
  * ~~Delete Criminal~~
  * ~~Train~~
  * ~~Receiving Result~~
  * Billing Details
  * ~~Actions Log~~
7. ~~Host the 3 websites with different portals on the same droplet~~

* **Raspberry Pi**:
1. ~~Reverse shell Multi-clients~~
2. ~~Send broadcast message to all raspberry pies~~
3. ~~3G module driver~~
4. Autorun client script on startup
5. ~~Run docker remotely on a specific raspberry pi~~
6. ~~Manage Raspberry pies remotely~~
7. ~~Get current specs remotely from a specific raspberry pi~~
8. [Pending] Automated adding system for the raspberry pies
8. [Cancel] ~~Migration between Raspberry pi [load balancer concept]~~
9. [Cancel] ~~Distributed system between raspberry pies~~
10. [Cancel] ~~Create Internet access points from raspberry pies~~

* **Image Processing**:
1. ~~Face recognition~~
2. [Cancel] ~~Arabic plate recognition~~
3. [Cancel] ~~Action Detection~~

* **Assets**:
1. ~~Logo~~
2. ~~UI Designs~~
3. [Pending] Descriptive Video

* **Issues and Uncompleted Tasks**:
1. **Government/app/models/uploadCriminal.php:** Change path and design naming convention for the uploaded directories *(line 17)*
2. **Government/app/controllers/addCriminal.php:** Change the image path into the directory of the uploaded zip file *(line 12)*
3. **Government/app/controllers/Socket.php:** Please check if the type at *(line 17)* is correct
4. **Government/public/partials/_add.html:** Add restrictions on expire date *(line 56)*
5. ~~ **Government/public/partials/_search.html & _delete.html:** Save the full path of the images in database ~~
6. ~~ Fix Raspberry pies **3G Connection** ~~
7. **Administration/public/partials/_rasberrypies.html:** Fix Google Map Display *from (line 143)*
8. ~~ **Administration/public/partials/_rasberrypies.html:** Allow data binding from server to web ~~
9. ~~ **Administration/public/partials/_rasberrypies.html:** Add RP restart and shutdown buttons ~~
10. add new log rplog on startup
11. add searching state at Government
