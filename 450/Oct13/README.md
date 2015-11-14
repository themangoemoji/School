#Project 4 Notes
###Bools
```
!20 == 0
!0  == 1
!!7 == 1
```

###Shadowing/Scope
Given:
```
val a = 123;
if (a == 123) {
  char a = 'x';
  print(a);
  }
print(a);
```
In a deeper scope, we should be able to redeclare a variable.
Close brace means:

1. Decrement scope
2. Deactivate all variables declared in this scope


You dont want to delete it, **deactivate** it:

1. either set a true false flag on it, or
2. rip it from symbol table, put it in alternative data structure


###Implementation of Scope:
Stack of symbol tables
```
Given:

val a = 123;
val b = 44;
if (a == 123) {
  char a = 'x';
  print(a);
  }
print(a);
```
This should yield:
```
SymbolTable[0]:
  val a
  val b
SymbolTable[1]:
  char a
```
