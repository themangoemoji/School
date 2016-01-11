#Project 8 Notes - Tue Dec 8

## Declare

Declare is a lot like Define except w/out function body

* Parsing - identical except doesn't end w/ statement
* Set up in symol table but leave AST pointing to null
* then when you see define, check to see if is listed and if it has an AST

#### Declare Common Errors

* If the definitions don't match you need to throw err
* You can't redefine
* Declared but not defined
  * Pointer in AST set to NULL, if when converting ASTs to IC, you have function with NULL ptr in AST, throw error

## Algebraic Simplification

> Everything that doesn't touch memory takes 1 clock cycle, anything that does takes ~100 clock cycles

##### Removal

  * `x = x + 0` ➜ remove
  * `x = x * 1` ➜ remove
  
##### Simplification
  * `x = x * 0`  ➜ `x = 0`
  * `x = x ^ 2`  ➜ `x = x * x`
  * `x = x * 8`  ➜ `x = x << 3`
  * `x = x * 15` ➜ `t = x << 4 x = t - x`
  
##### Constant Folding

If there is a statement `x = y op z` and y and z are constants then `y op z` can be computed at compile time.

Example:
  * `x = 2 + 2`      ➜ `x = 4`
  * `if 2 < 0 jump L` ➜ can be removed
  
##### Copy Propagation

Replacing occurences of a var that is being directly assigned w/ the val of the assignment

```
y = x
z = 6 * y
```

⇣

`z = 6 * x`
  
##### Common Subexpression Elimination

```
a = b + c
b = a - d
c = b + c
d = a - d
```

⇣

```
a = b + c
d = a - d
c = d + c
```

##### Dead code elim

Remove any inststructions that have no live vars attached

```
a = b + c
b = b - d
c = c + d
e = b + c
```

in this, `a` and `b` are live, `c` and `e` not

⇣

```
a = b + c
b = b - d
c = c + d
```

⇣

```
a = b + c
b = b - d
```

