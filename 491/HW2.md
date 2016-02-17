# CSE 891 - Homework 2




### Q1


Suppose you are interested to store the profile of users who registered at a social networking website in a relational database such as MySQL. For each user, you will record information about the firstName, lastName, emailAddress, password, and country. In addition, you plan to record information about the contacts of each user, which has the following fields (columns): userEmailAddress, contactEmailAddress, and dateAdded. Write the corresponding SQL statements for creating the two tables in a MySQL database. Assume the names of the two tables are User and Contact, respectively. Make sure you specify the foreign keys that link the two tables together.



ANSWER:

```
create table Contacts(
userEmail varchar(40) primary key,
contactEmail varchar(40),
date datetime,
);

create table User(
firstName varchar(40),
lastName varchar(40),
email varchar(40) primary key,
password varchar(40),
country varchar(40),
);

```




### Q2


Consider the database for an online message board website that allows users to post messages and tag them. The schema of the database tables are shown below (primary keys of the tables are underlined):


* User (**Username**, EmailAddress, Gender, MemberSince)
* Post (**PostID**, Username, DatePosted, Message)
* Tag (**PostID**, TagString)
* Liked (**PostID**, Username, Rating)

*Note: rating is either ‘Liked’ or ‘Disliked’*


Suppose the number of rows in each table are as follows: 



| User   | Post    | Tag       | Liked   |
|--------|---------|-----------|---------|
| 50,000 | 500,000 | 1,000,000 | 750,000 |



If we apply the following SQL queries on the tables, state the number of rows (maximum and minimum) and columns returned in the query result?


a. `SELECT * FROM User WHERE Username = ‘CSE491891’;`
* Number of rows: max = 1
* Number of rows: min = 0
* Number of Columns   = 4


b. `SELECT * FROM Liked WHERE Username = ‘CSE491891’ AND Rating = ’Disliked’;`
* Number of rows: max = 750,000
* Number of rows: min = 0
* Number of Columns   = 3


c. `SELECT * FROM Post, Tag WHERE Post.PostID = Tag.PostID`
* Number of rows: max = 1,000,000
* Number of rows: min = 0
* Number of Columns   = 6

d. `SELECT COUNT(*) FROM Post, Tag;`
* Number of rows: max = 1
* Number of rows: min = 1
* Number of Columns   = 1



### Q3
Consider the database schema given in question 2. Express each of the following queries as SQL statements.


###### Solutions
c. For each postID, count the number of likes it receives.

`SELECT Rating, count(rating) from liked`

d. Find the username of user with the most number of posts.

`SELECT Username from POST GROUP BY Username ORDER BY COUNT (USERNAME) desc LIMIT 1`



### Q4
Consider the following set of twelve data points:

` 1, 2, 8, 8.5, 9, 10, 11, 12, 19, 21, 23, 25 `

###### Solutions

a. What are the 3 bins created if we apply the following discretization methods to the data: 

i. **Equal Width**

Bin 1: `1, 2, 8, 8.5`

Bin 2: `9, 10, 11, 12`

Bin 3: `19, 21, 23, 25`

ii. **Equal Frequency**

Bin 1: `1, 2, 8, 8.5`

Bin 2: `9, 10, 11, 12`

Bin 3: `19, 21, 23, 25`

iii. **Clustering**

Bin 1: `1, 2`

Bin 2: `8, 8.5, 9, 10, 11, 12`

Bin 3: `19, 21, 23, 25`

iv. The Best option is clustering because organizes the data into bins with items most similar to eachother

### Q5
If each data point can be classified as either good or bad,
what are the 3 bins created if we apply entropy-based discretization
assuming the classes of the data points are as follows:

|good|bad|good|bad|
|:-:|:-:|:-:|:-:|
|1-8.5|9-11|12-23|25


With the following equation for entropy:

![equation image][equation_image]

Bins    |  +  |   -
--------|-----|------
1 - 8.5 |  4  |  0
9 - 11  |  0  |  3
12 - 25 |  4  |  1

### Q5
Download the historical daily closing prices for the following stocks
from the Yahoo finance web site (http://finance.yahoo.com).

Limit the data to the period between Jan 1, 2008 and Dec 31, 2015.

AAPL, MSFT, F, GM, GE, C

Calculate the correlation between the historical daily closing prices for
every pair of stocks above. 

Check whether there are any missing values in the time series. If there is, replace the missing value with the average closing price for its previous and next day. 

Write your correlation values in the matrix shown below:

| | AAPL | MSFT          | F             | BAC           | GE            | C            |
|:------:|:---------------:|:---------------:|:---------------:|:---------------:|:--------------:|:---------------:| 
| **AAPL** | 1             | 0.8530995807  | 0.6960566211  | -0.2322783661 | 0.4369580196 | -0.2992551951 | 
| **MSFT** | 0.8530995807  | 1             | 0.6552827556  | 0.0915934546  | 0.611349688  | -0.0570737898 | 
| **F**    | 0.6960566211  | 0.6552827556  | 1             | -0.2174712501 | 0.308659151  | -0.3515057397 | 
| **BAC**  | -0.2322783661 | 0.0915934546  | -0.2174712501 | 1             | 0.6806426732 | 0.9071849803  | 
| **GE**   | 0.4369580196  | 0.611349688   | 0.308659151   | 0.6806426732  | 1            | 0.6477692232  | 
| **C**    | -0.2992551951 | -0.0570737898 | -0.3515057397 | 0.9071849803  | 0.6477692232 | 1             | 

### Q6

Download the Optical Recognition of Handwritten Digits Data Set
from the UCI machine learning repository located at https://archive.
ics.uci.edu/ml/datasets/Optical+Recognition+of+Handwritten+Digits.
For this experiment, you need to use the training set file named optdigits.
tra only. Rename the file as optdigits.csv and open it using Excel or
any text editor. You will find each line has 65 columns, in which the first
64 columns correspond to pixel values and the last column corresponds to
the class label (from 0 to 9). Insert a line to the beginning of the file. The
line should contain the following:

      p1, p2, p3, p4, · · · , p64, class

Make sure you explicitly list the attribute names from p1 to p64 (instead
of using ·). By adding the above to the first line of your CSV file, it allows
Weka to recognize the attribute names and class.


###### Solutions
a. Import the data file into Weka. List the number of training examples
as well as their class proportions (i.e., number of examples that belong
to class 0, 1, 2, until 9):

3824 training examples

Class Proportions:

class | proportion
-|-
0 | 376
1 | 389
2 | 380
3 | 389
4 | 387
5 | 376
6 | 377
7 | 387
8 | 380
9 | 382

c. 

The variance covered threshhold to reduce this was 0.2.

[equation_image]: http://www.saedsayad.com/images/Entropy_univar.png "Entropy Equation"
