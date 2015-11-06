#Converting TIC To TubeCode

###Converting one line at a time
https://goo.gl/photos/N9WFxjUt6C9zeLyeA 

###Programming Notes
https://goo.gl/photos/X7MfizQTGbtjPH1G6

###Arrays in tubecode
Size and contents can look like this:

`10 | 0 | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9`

But, this is if we know values at compile time so we have to build this dynamically, because we do not know this, we we can keep indirect references to arrays.

###Simple Memory Management
run-time memory management:
A simple way to do it, dedicate a fixed memory position to point to the next unused memory slot. When we need new memory start from that recorded position and thhen update the free-memory pointer.

###Converting Array Instructions
>How do we convert `ar_get_size a12 s35`?

For each variable, we assume we keep its info at the associated memory position
```
load 12 regA
mem_copy regA 35
```

######NOTE:
val_copy	reg->reg
mem_copy	mem->mem
load		mem->reg
store		reg->mem

>How do we convert `ar_get_idx a12 s24 s35`?

```
load 12 regA			// Load array pointer into regA
load 24 regB			// Load index into regB
add regA 1 regA			// Increment regA past size
add regA regB regA		// Find position of index
mem_copy regA 35		// Copy val at index to destination
```

###Starting Heap
First line of TubeCode Assembly output should be `store 10000 0`



