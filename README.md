Signal Handling Test
====================

Build with `make build`

Run with `make build start logs`

Then in another terminal do `docker stop -t 99999 signaltest`

The intended result is that the stop command blocks until the script (`test` in this case) is happy to exit.

Whats actually happening is S6 simply sends KILL to all its processes after 5 seconds
