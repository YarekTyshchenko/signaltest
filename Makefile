all: build

build:
	docker build -t signaltest .

run:
	docker run --rm -it signaltest bash

start: stop
	docker run -d --name signaltest signaltest

stop:
	@docker rm -vf signaltest ||:

logs:
	docker logs -f signaltest

.PHONY: all build run start stop logs
