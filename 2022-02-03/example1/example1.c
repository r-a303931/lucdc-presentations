#include <stdio.h>

void shell() {
    printf("Suspicious function here...\n");
}

void get_name() {
    printf("What is your name?\n");

    char buffer[20];
    scanf("%s", buffer);

    printf("Hello, %s!\n", buffer);
}

int main() {
    get_name();
}
