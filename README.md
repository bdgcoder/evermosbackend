# Backend Assesment

## 1. Online Store
After read stated facts :
### A. Problem
The main problem that is very crucial during event 12.12 in this online shop is the inventory system in the quantity system that is often reported incorrectly. This assumption is based on the facts in this assessment, it does not rule out other, more complicated obstacles in the field. Based on experience so far in the world of inventory, this can occur, among others:
   1. The first possibility, this often happens because the goods data system and physical data data are not recorded correctly, causing the quantity of inventory to be negative. Why this happened? because the system only stores incoming and outgoing inventory data in one inventory table. And this causes the supply amount to be negative.
   2. The second possibility, the system is less fast with traffic in checking inventory data at one time. So that at the same time the data for the same quantity of goods is accessed by more than one customer. And the system serves many of these customers by providing the same quantity of goods.
### B. Solution
Based on my analysis, so that this incident does not happen again. The solutions I propose include: 
For the two possibilities mentioned above, it is necessary to have an inventory history for each quantity in or out, not in one inventory table. This is done by creating several inventory tables before reducing the inventory in the main inventory table. The table includes:
   * **inventory table** 
     In this case represented by the _items_ table.
   * **inventory_transaction table**
     In this case represented by the _histories_ table.

The explanation is as follows:
* _Inventory table_ as a storage area for main quantity data, accompanied by an _inventory_transaction_ table as a history that records goods, quantities, locations or status of these items. And lock the recorded quantity without reducing the item data in the inventory table first. The locking here is of course to prevent the goods from coming out again or causing a minus.

When a customer enters **the cart, checkout** (as well as the **system** creates an **invoice**) and makes a payment and has been verified. The system records to the inventory_transaction table as items that have been ordered for processing by the Order Processing Department. In this case, every process from the order processing department is tracked according to the processes that occur both digital data and physical data. Such as the Process flag, Packing to Delivery. 
Inventory table as the main data will actually reduce the quantity physically when the goods have been received or moved from one location to another.

To simplify the simulation I created a backend application using:
- PHP with Laravel 8.0 framework
- Bootstrap design template
- mysql database (dumb file can be downloaded in _database/evermosbackend.sql_)

To make it easier, if needed, I can prepare a demo hosting to make it easier to see simulations of online shop problems by request. However, for the first time, it can be seen from the screen shoot below ![](https://raw.githubusercontent.com/bdgcoder/evermosbackend/master/public/assets/images/simulation.png)

Note:


## 2. Treasure Hunt

File hunt.php

This application build by a simple-line program in *php cli*. Open your favorite Terminal and run these commands.
You can find *hunt.php* at the root. ![](https://raw.githubusercontent.com/bdgcoder/evermosbackend/master/public/assets/images/hunt.png)


```sh
php hunt.php
```
And program will be run like this

```sh
Board Grid
########
#......#
#.###..#
#....#.#
#X#....#
########

Random Treasure Location 3, 2
########
#......#
#.###..#
#.$..#.#
#X#....#
########

Input Your Move
Up/North (0-3) step:_
```
Then You must input your move to found the treasure
```sh
Input Your Move
Up/North (0-3) step:1   
Right/East (0-5) step:1
Down/South (0-5) step:0
Wohooo!!! Congratulations, You found the treasure...
```

## Thank you
**I would love to invite with you and discuss the position in detail.**
