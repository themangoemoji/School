#include <iostream>
#include <sys/types.h>
#include <signal.h>
#include <string>

#include "controller.h"

using namespace std;

int main(int argc, char** argv) {
    if(parse_argv(argc, argv) == false) {
        help_message(argv);
        exit(EXIT_FAILURE);
    }
    else {
        string choice;
        cout << "Controller for process (" << target_pid << ") is running" 
             << endl;

        while(true) {
            print_menu();
            choice = get_input();
            
        }
        cout << "Terminating the controller." << endl;
    }
}
