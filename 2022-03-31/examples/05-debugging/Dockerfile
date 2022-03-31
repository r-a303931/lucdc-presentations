FROM ubuntu

ENV DEBIAN_FRONTEND=noninteractive

WORKDIR /dangerous

RUN apt update && \
    apt install -y wine gdb gcc

COPY dangerous.c dangerous.c

RUN gcc dangerous.c
