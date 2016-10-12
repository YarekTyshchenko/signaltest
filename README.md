Signal Handling Test
====================

Build with `make build`

Run with `make build start logs`

Then in another terminal do `docker stop -t 99999 signaltest`

The intended result is that the stop command blocks until the script (`test` in this case) is happy to exit.

Whats actually happening is S6 simply sends KILL to all its processes after 5 seconds

```
docker logs -f signaltest
[s6-init] making user provided files available at /var/run/s6/etc...exited 0.
[s6-init] ensuring user provided files have correct perms...exited 0.
[fix-attrs.d] applying ownership & permissions fixes...
[fix-attrs.d] done.
[cont-init.d] executing container initialization scripts...
[cont-init.d] done.
[services.d] starting services
[services.d] done.
[cont-finish.d] executing container finish scripts...
[cont-finish.d] done.
[s6-finish] syncing disks.
[s6-finish] sending all processes the TERM signal.
[s6-finish] sending all processes the KILL signal and exiting.
```


