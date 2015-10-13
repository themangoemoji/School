#include <iostream>
#include <signal.h>
#include <sys/types.h>
#include <unistd.h>
#include <fstream>
#include <cstdlib>

#include "reporter.h"

using namespace std;

int main(int argc, char** argv) {
    interval = 1; // in seconds
    // Give PID and basic information
    cout << "The reporter program's PID is " << getpid() << endl;
    cout << "The default report interval is " << interval << endl;
    print_report();

    while(true){
        sleep(3);
    }

    return 0;
}
