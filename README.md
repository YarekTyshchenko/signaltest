Signal Handling Test
====================

This is a test to verify signal chain from `docker stop` command all the way
down to the process supervised by S6, to create a deployment system where a
long running script can be safely killed by `docker stop` leaving the control
with the script to exit when its done.

How to use
==========

Build with `make build`

Run with `make build start logs`. This should show you a typical S6 startup
plus some output of a running script. The script will print a dot every second.

Then in another terminal do `docker stop -t 99999 signaltest`. This sends a `SIGTERM`
signal to PID1 of the container, which is S6. It will in turn enter shutdown mode
and based on an environment variable `S6_KILL_GRACETIME` wait for all processes
to exit. After such time it will issue a `SIGKILL`.

```
# S6 Startup

[s6-init] making user provided files available at /var/run/s6/etc...exited 0.
[s6-init] ensuring user provided files have correct perms...exited 0.
[fix-attrs.d] applying ownership & permissions fixes...
[fix-attrs.d] done.
[cont-init.d] executing container initialization scripts...
[cont-init.d] done.
[services.d] starting services
[services.d] done.
Installing signal handler...
.
.
.

# Issue shutdown command

Caught SIGTERM
.
[cont-finish.d] executing container finish scripts...
[cont-finish.d] done.
[s6-finish] syncing disks.
[s6-finish] sending all processes the TERM signal.
Caught SIGHUP
Caught SIGTERM
.
Caught SIGTERM
.
.

# Script continues to run, until it exits itself
```


