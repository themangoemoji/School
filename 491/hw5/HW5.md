# Homework 5

## Question 2

***Calculate the eucledian distances***:

| Data Point | Equation | Distance From Point |
|------------|----------|---------------------|
| 1          |![e1](https://raw.githubusercontent.com/wrightmhw/School/master/491/hw5/daum/1.png)| 0.3 |
| 2          |![e2](https://raw.githubusercontent.com/wrightmhw/School/master/491/hw5/daum/2.png)|0.223|
| 3          |![e3](https://raw.githubusercontent.com/wrightmhw/School/master/491/hw5/daum/3.png)|0.489|
| 4          |![e4](https://raw.githubusercontent.com/wrightmhw/School/master/491/hw5/daum/4.png)|0.424|
| 5          |![e5](https://raw.githubusercontent.com/wrightmhw/School/master/491/hw5/daum/5.png)|0.566|
| 6          |![e6](https://raw.githubusercontent.com/wrightmhw/School/master/491/hw5/daum/6.png)|0.656|

#### 2a

P2 is the nearest neighbor

#### 2b

Data points 1, 2, and 3 are the nearest neighbors.

## Question 3

#### 3a 

```
Milk    S=80%
Bread   S=70%
Coffee  S=40%
Butter  S=40%

Itemset pairs:
Bread, Milk    ==>  S=50%
Bread, Butter  ==>  S=40%
```

### 3b

```
Bread -> Milk    > S=50% C=5/7 (71%)
Milk -> Bread    > S=50% C=5/8 (62.5%)
Bread -> Butter  > S=40% C=4/7 (57%)
Butter -> Bread  > S=40% C=4/4 (100%)
```


## Question 4

#### 4a

Examples in the Data: 1277


Positive examples: 643

Negative examples: 634

Accuracy: 50.35%

#### 4b

JRIP rules:

```
(movie = t) => polarity=negative (202.0/75.0)
(like = t) => polarity=negative (103.0/39.0)
(bad = t) => polarity=negative (20.0/2.0)
(made = t) => polarity=negative (30.0/11.0)
(video = t) => polarity=negative (14.0/2.0)
(time = t) => polarity=negative (53.0/23.0)
(plot = t) => polarity=negative (25.0/8.0)
(fails = t) => polarity=negative (9.0/1.0)
=> polarity=positive (821.0/339.0)
  
Number of Rules : 9
  
Correctly Classified Instances         738               57.7917 %
Incorrectly Classified Instances       539               42.2083 %
```
  
The classifier’s performance is better than the baseline accuracy
in question 4a.

#### 4c

```
Best rules found:
  1. bad=t 32 ==> polarity=negative 30    conf:(0.94)
  2. video=t 19 ==> polarity=negative 17    conf:(0.89)
  3. entertaining=t 15 ==> polarity=positive 13    conf:(0.87)
  4. take=t 21 ==> polarity=positive 17    conf:(0.81)
  5. life=t 34 ==> polarity=positive 27    conf:(0.79)
  6. movie=t one=t 24 ==> polarity=negative 19    conf:(0.79)
  7. family=t 19 ==> polarity=positive 15    conf:(0.79)
  8. us=t 32 ==> polarity=positive 25    conf:(0.78)
  9. hard=t 18 ==> polarity=negative 14    conf:(0.78)
 10. still=t 37 ==> polarity=positive 28    conf:(0.76)
 11. go=t 20 ==> polarity=negative 15    conf:(0.75)
 12. point=t 19 ==> polarity=negative 14    conf:(0.74)
 13. emotional=t 19 ==> polarity=positive 14    conf:(0.74)
 14. human=t 26 ==> polarity=positive 19    conf:(0.73)
 15. quite=t 21 ==> polarity=negative 15    conf:(0.71)
 16. thing=t 27 ==> polarity=negative 19    conf:(0.7)
 17. comes=t 20 ==> polarity=negative 14    conf:(0.7)
```

Association Rule Mining uses 17 rules, while JRip uses 7 rules. There are many similar words, but the polarities of the words do not always match eachother.

The JRip rules are ordered based on class prevalence and were mostly negative in their polarities. Also in JRip, rarity is favored over quantity. The Association Rule Mining produced rules with varying polarities and they are ordered into equal frequency bins.


## Question 5

#### 5a

**Cluster assignment of data points (enter A, B, or C)**

| | Iteration  |      |       |      |       |       |      |       |       |
|-|:---:|------|-------|------|-------|-------|------|-------|-------|
|**Points**|   | 0.09 | 0.172 | 0.31 | 0.335 | 0.429 | 0.64 | 0.642 | 0.851 |
|| 0 | -    |   -   |   -  | -     | -     | -    | -     | -     |
|| 1 | A    |   A   |   B  | B     | B     | C    | C     | C     |
|| 2 | A    | A     | B    | B     | B     | C    | C     | C     |


**Centroid Locations**

| Iteration  | A     | B     | C     |
|:---:|-------|-------|-------|
| 0 | 0.15  | 0.25  | 0.9   |
| 1 | 0.131 | 0.358 | 0.711 |
| 2 | 0.131 | 0.358 | 0.711 |

The algorithm did not converge after 2 iterations

#### 5b

**Cluster assignment of data points (enter A, B, or C)**

| | Iteration  |      |       |      |       |       |      |       |       |
|-|:---:|------|-------|------|-------|-------|------|-------|-------|
|**Points**|   | 0.09 | 0.172 | 0.31 | 0.335 | 0.429 | 0.64 | 0.642 | 0.851 |
|| 0 | -    |   -   |   -  | -     | -     | -    | -     | -     |
|| 1 |  A    |   A   |   B  | B     | B     | B    | B    | C     |
|| 2 |  A    |   A   |   B  | B     | B     | B    | B    | C     |

The algorithm did not converge after 2 iterations

**Centroid Locations**

| Iteration  | A     | B     | C     |
|:---:|-------|-------|-------|
| 0 | 0.1  | 0.45  | 0.9   |
| 1 | 0.131 | 0.4712 | 0.851 |
| 2 | 0.131 | 0.4712 | 0.851 |

#### 5c

Part a SSE: 3.911392

#### 5d

Part b SSE: 3.8446852, the algorithm used in part b is better because it has a lower SSE.

## Question 6

![6a](https://raw.githubusercontent.com/wrightmhw/School/master/491/hw5/daum/6a.jpg)
![6ae](https://raw.githubusercontent.com/wrightmhw/School/master/491/hw5/daum/6ae.png)
![6b](https://raw.githubusercontent.com/wrightmhw/School/master/491/hw5/daum/6b.jpg)
![6be](https://raw.githubusercontent.com/wrightmhw/School/master/491/hw5/daum/6be.png)
