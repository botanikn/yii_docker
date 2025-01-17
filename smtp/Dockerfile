FROM ubuntu:latest

RUN apt update && apt install -y postfix dovecot-core dovecot-imapd dovecot-pop3d

RUN groupadd -g 2000 mailuser \
    && useradd -u 2000 -g mailuser --shell /bin/bash --create-home mailuser1 \
    && useradd -u 2001 -g mailuser --shell /bin/bash --create-home mailuser2

COPY postfix.cf /etc/postfix/main.cf
COPY dovecot.conf /etc/dovecot/dovecot.conf
COPY users /etc/dovecot/users

CMD ["postfix", "start-fg"]