# Project 7 Notes


## Debugging 

You can use `debug_status` with `-v` to display comments

## Functions Definition

> Example

```
 define val max(val value1, val value2) {
      if (value1 > value2) return value1;
      return value2;
    }
```

Add...

1. Return type
2. Name
3. Param List
4. Statement

...to symbol table

In symbol table class, we want to add new map of function names to all characteristics of a function.

## Function call

> Example

```
val high_score = max(score1, score2);
    print("And the high score is: ", high_score);
```

1. Then we need to check Symbol Table
2. Do syntax checking (return type matching, etc.)
3. This is a special node we have to add to AST tree
