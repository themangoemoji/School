# CSE 491 - Big Data

## Contents

#### Changing Java Version

Add this to `~/.aliases`

`alias javac '/usr/lib/jvm/java-6-openjdk/bin/javac'`

Then source the `aliases` file:

`source ~/.aliases`


## Running Hadoop

To run compile a file such as `countEdits.java`:

`javac *.java`

Create a Java archive (jar) file that contains all the class files:

`jar cvf <filename>.jar *.class`

Run the hadoop program:

`hadoop jar <filename>.jar <hadoop filename (ex:countEdits) > /user/hduser/path_to_data.txt <out_file>`

*Example:*

`hadoop jar wiki.jar countEdits /user/hduser/wikipedia/wiki_edit.txt wiki_output`
