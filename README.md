<!-- -*- mode: markdown; coding: utf-8 -*- -->

# Redmine IRC bot

Redmine to IRC gateway. Doesn't support any real IRC networks but can
connect to
[irssi-proxy](https://irssi.org/documentation/startup/#proxies-and-irc-bouncers).

## Installation

Install requirements on Debian/Ubuntu. Please match similar packages
on other distributions.

	sudo apt install php-cli php-xml php-curl

Make configuration file

	cp config.json.example config.json

And edit it to match your setup
