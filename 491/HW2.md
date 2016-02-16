#CSE 891 - Homework 2




### Q1


*Suppose you are interested to store the profile of users who registered at a social networking website in a relational database such as MySQL. For each user, you will record information about the firstName, lastName, emailAddress, password, and country. In addition, you plan to record information about the contacts of each user, which has the following fields (columns): userEmailAddress, contactEmailAddress, and dateAdded. Write the corresponding SQL statements for creating the two tables in a MySQL database. Assume the names of the two tables are User and Contact, respectively. Make sure you specify the foreign keys that link the two tables together.*



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




###Q2


*Consider the database for an online message board website that allows users to post messages and tag them. The schema of the database tables are shown below (primary keys of the tables are underlined):*


* User (**Username**, EmailAddress, Gender, MemberSince) 
* Post (**PostID**, Username, DatePosted, Message) 
* Tag (**PostID**, TagString) 
* Liked (**PostID**, Username, Rating) 

*Note: rating is either ‘Liked’ or ‘Disliked’*


*Suppose the number of rows in each table are as follows: *



| User   | Post    | Tab       | Liked   |
|--------|---------|-----------|---------|
| 50,000 | 500,000 | 1,000,000 | 750,000 |



*If we apply the following SQL queries on the tables, state the number of rows (maximum and minimum) and columns returned in the query result?*


a. `SELECT * FROM User WHERE Username = ‘CSE491891’;`
* Number of rows: max = 50,000
* Number of rows: min = 0
* Number of Columns   = 4


b. `SELECT * FROM Liked WHERE Username = ‘CSE491891’ AND Rating = ’Disliked’;`
* Number of rows: max = 750,000
* Number of rows: min = 0
* Number of Columns   = 3


c. `SELECT * FROM Post, Tag WHERE Post.PostID = Tag.PostID`
* Number of rows: max = 750,000
* Number of rows: min = 0
* Number of Columns   = 3



###Q3
Consider the database schema given in question 2. Express each of the following queries as SQL statements.


######Solutions
c. For each postID, count the number of likes it receives.
`SELECT Rating, count(rating) from liked`

d. Find the username of user with the most number of posts.
`SELECT Username from POST GROUP BY Username ORDER BY COUNT (USERNAME) desc LIMIT 1`



###Q4
Consider the following set of twelve data points:

> 1, 2, 8, 8.5, 9, 10, 11, 12, 19, 21, 23, 25

######Solutions

What are the 3 bins created if we apply the following discretization methods to the data: 

1. **Equal Width**

Bin 1: `1, 2, 8, 8.5`
Bin 2: `9, 10, 11, 12`
Bin 3: `19, 21, 23, 25`

