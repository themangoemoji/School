#CONCURRENCY: MUTUAL EXCLUSION AND SYNCHRONIZATION

######Overview:
* Discuss basic concepts related to concurrency, such as race conditions,
OS concerns, and mutual exclusion requirements.

* Understand hardware approaches to supporting mutual exclusion.

* Define and explain semaphores.

* Define and explain monitors.

* Define and explain monitors.

* Explain the readers/writers problem. 

######Key Terms:

* **Atomic Operations** - A function or action implemented as a sequence of one or more instructions that appears
to be indivisible; that is, no other process can see an intermediate state or interrupt the
operation. The sequence of instruction is guaranteed to execute as a group, or not execute
at all, having no visible effect on system state. Atomicity guarantees isolation from
 concurrent processes.
 
 * **Critical Section** - A section of code within a process that requires access to shared resources and that must
not be executed while another process is in a corresponding section of code.
  
 * **Deadlock** - A situation in which two or more processes are unable to proceed because each is waiting
for one of the others to do something
  
 * **Livelock** - A situation in which two or more processes continuously change their states in response
to changes in the other process(es) without doing any useful work. 
    
 * **Mutual Exclusion** - The requirement that when one process is in a critical section that accesses shared resources,
no other process may be in a critical section that accesses any of those shared resources. Mutual exclusion is enforced with:
      1. semaphores
      2. monitors
      3. message passing
  
    
 * **Race Condition** - A situation in which multiple threads or processes read and write a shared data item and
the final result depends on the relative timing of their execution. 
    
 * **Starvation** - A situation in which a runnable process is overlooked indefinitely by the scheduler;
although it is able to proceed, it is never chosen

##5.1 -  PRINCIPLES OF CONCURRENCY 

