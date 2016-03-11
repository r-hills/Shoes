# _SHOE LISTING_

##### An app to display and edit lists of Shoe Stores and the Shoe Brands they carry. Written as an Epicodus Code Review 21-Aug-2015_

#### By _**Rick Hills**_

## Description

An app to add and edit lists of Shoe Stores and the brands they carry, either by Store or by Brand.   

## Setup

* _Clone this repository_
* _Run composer install in project folder_
* _Unzip shoes.sql and import to MySQL database_
* _Start PHP server in web folder_
* _Navigate web browser to localhost:8000_

MySQL Commands used, as per class instructions:
-------------------------------------------------------------------------------
mysql> create database shoes;
Query OK, 1 row affected (0.00 sec)

mysql> use shoes;
Database changed
mysql> create table brands(name varchar (255), id serial primary key);
Query OK, 0 rows affected (0.45 sec)

mysql> create table stores(name varchar (255), address varchar (255), phone varc
har (50), id serial primary key);
Query OK, 0 rows affected (0.44 sec)

mysql> create table partnerships(brand_id int, store_id int, id serial);
Query OK, 0 rows affected (0.46 sec)

mysql>
-------------------------------------------------------------------------------

## Technologies Used

_PHP, Twig, Silex, PHPUnit, MySQL, HTML, Bootstrap, CSS_

### Legal

Copyright (c) 2015 **_Rick Hills_**

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
