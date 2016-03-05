# Homework 1


### 1

a) hadoop fs -moveToLocal /user/cse491 /user/hduser/data/

b) hadoop fs -cp /user/hduser/data/ /user/data/

c) hadoop fs -mv /user/hduser/data/mydata.txt data.txt

d) hadoop fs -cat /user/hduser/data/data.txt

e) hadoop fs -tail /user/hduser/data/data.txt

f) hadoop fs -copyToLocal /user/cse491/output/part-r-00000 /user/cse491/output.txt

g) hadoop fs -rmr /user/cse491/output

h) hadoop fs -lsr /user/cse491

i) hadoop fs -getmerge /user/cse491 output.txt

j) hadoop fs -chmown ptan /user/ptan


### 2a

> Problem: Compute the average price of single family homes larger than 3000 square feet for each city

Mapper Function: Tokenize each line into set of followers & followees

Mapper Output 1: Key is (follower, followee) tuple, value is 1

Mapper Output 2: Key is (followee, follower) tuple, value is 1

Reducer Input: Key is (followee, follower) tuple, value is list of '1's

Reduce Function: Sum up the '1's for each key

Reducer Output: Key is (followee, follower) tuple, value is sum of '1's (filtered out any < 2)


### 2b

> Problem: Find all pairs of users who have reciprocal relation. 

Mapper Function: Tokenize each line into set of followers & followees

Mapper Output 1: Key is (follower, followee) tuple, value is 1

Mapper Output 2: Key is (followee, follower) tuple, value is 1

Reducer Input: Key is (followee, follower) tuple, value is list of '1's

Reduce Function: Sum up the '1's for each key

Reducer Output: Key is (followee, follower) tuple, value is sum of '1's (filtered out any < 2)


### 2c

> Problem: For each user, list his/her favorite movie genre, i.e., the genre with highest average rating.

Mapper Function: Tokenize each line into set of user_id, genre, and rating

Mapper Output: Key is user_id, genre tuple, value is rating

Reducer Input: Key is (user_id, genre) tuple, value is list of ratings

Reduce Function: Average the ratings for each key

Reducer Output: Key is (user_id, genre) tuple, value is average rating of genre (filter out by max for user)

### 2d

> Problem: Find the station id and date of anomalous temperature readings. A temperature reading is anomalous if its min temperature exceeds max temperature for the given day.

Mapper Function: Tokenize each line into tuple of (station_id, date) and tuple of max, min

*example*: `(station_id, date): (max, min)`

Mapper Output: Key is (station_id, date) tuple, value is max, min

Reducer Input: Key is (station_id, date) tuple, value is list of max, min

Reduce Function: Take the difference of max and min

Reducer Output: Key is (station_id, date) tuple, value is difference of max, min (with positives filtered out)

### 2e

> Problem: For each user, find 3 other users of opposite sex who share
the most number of similar hobbies. For example, if X = {swimming,
dancing, outdoor sports} and Y = {horse riding, dancing}, then the
similarity of X and Y is 1 since they share only 1 hobby in common.

Mapper Function 1: Tokenize users and sex and interests, map each user to list of their interests

***example***
```
'jane', 'F', 'swimming', 'fishing', 'marriage', 'bears'
```


Mapper Output 1: Key is user, value is interest

***example***
```
('jane', 'F'): 'swimming'
```

Reducer Input 1: Key is user, value is list of interests

***example***
```
('jane', 'F'): 'swimming', 'fishing', 'marriage', 'bears'
```

Reduce Function 1: Iterate through key values, make key interst, and value list of users, filter same sex matches because it's not legal anymore

Reducer Output 1: Key is interest, value is list of users

***example***
```
swimming: {(Mark, M), (Steve, F)}
```

Mapper Function 2: Iterate through values (users) and map each pair to the key (interest)

```
Mark, Steve: swimming
Mark, Steve: fishing
Mark, Steve: mountains
```

Mapper Output 2: Key is pair of users, value is interest

Reducer Input 2: Key is pair of users, value is list of similar interests

Reduce Function 2: Count matches and (filter in top 3 counts of similar interest in other users)

Reducer Output 2: Key is pair of users, value is list of similar interests

***example***
```
'Valerie, Shawn': {swimming, hiking, long walks on the beach}
'Shawna, Shawn': {swimming, hiking, Spartan Football}
...
```


### 3

* sameEdits.java

* wiki.jar

* README.md

* countEditors.java


### 4

* countWiki.java
