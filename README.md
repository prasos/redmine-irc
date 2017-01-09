<!-- -*- mode: markdown; coding: utf-8 -*- -->

# Redmine IRC bot

Redmine to IRC gateway. Doesn't support any real IRC networks but can
connect to
[irssi-proxy](https://irssi.org/documentation/startup/#proxies-and-irc-bouncers).

## Installation

Install requirements on Debian/Ubuntu. Please match similar packages
on other distributions.

	sudo apt install php-cli php-xml php-curl

Make configuration file:

	cp example/config.json config.json

And edit it to match your setup.

Then run manually for the first time:

	./bot

## Systemd timer

To get it running periodically, we use systemd. See example
configurations in [example/](example/) subdirectory.

Copy example files to systemd:

```sh
sudo cp example/redmine-irc.* /etc/systemd/system
sudo chown root:root /etc/systemd/system/redmine-irc.*
```

Edit `/etc/systemd/system/redmine-irc.service` to match with your
installation directory, user name, and group. Then run:

```sh
sudo systemctl daemon-reload
sudo systemctl enable redmine-irc.timer
sudo systemctl start redmine-irc.timer
```

That shoud keep it running for every 5 minutes. To change the running
interval, edit `/etc/systemd/system/redmine-irc.timer`.
