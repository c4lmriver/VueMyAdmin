# <img src="https://i.postimg.cc/fRPfG7wC/log-menu.png" width="300">

A PhpMyAdmin (and no more pre-computers era) alternative written in Vue.js with Ant Design !  
2nd year Uni group project.

## Screenshots
[![vuemyadmin-demo.gif](https://i.postimg.cc/Ssm09bwJ/vuemyadmin-demo.gif)](https://postimg.cc/hJZ3F64B)

## Features 

- List all databases from a server
- List all tables from a given database
- See the structure of a table from a selected database

## Prerequesites

- Linux : 
  - A basic LAMP / XAMPP server installed (https://www.apachefriends.org/download.html)
  - Node.js (https://nodejs.org/en/download)
- Windows : 
  - Wampserver installed (https://www.wampserver.com/en/)
  - Node.js (https://nodejs.org/en/download)

and a pre-existent database on PhpMyAdmin.

## How to run it 

1) Clone the project under `/opt/lampp` on Linux or `C:\wamp64\www\` on Windows
2) `cd` into the root of the project and install all dependencies using `npm i`
4) Serve a local instance of the web application using `npm run dev`
5) VueMyAdmin will now run at `localhost:5173`

**Don't forget to put `db.php` (filled with username, password and name of one database) in one of the two paths discussed in 1) in order to connect your databases with VueMyAdmin.  
(Small ~~big~~ inconvenient as we didn't have time to play with APIs and setup proper routes)**

### Footnotes

This was a really fun project, motivated by the very (very) old-looking of PhpMyAdmin and the usage of modern programming languages.
We couldn't finish it due to lack of time, however we still wanted to add the SQL tab, as the project can always be greatly improved.
