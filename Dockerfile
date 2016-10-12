FROM debian

RUN apt-get update && apt-get install -yqq curl cron php5-cli

# Install S6
RUN curl -sL "https://github.com/just-containers/s6-overlay/releases/download/v1.16.0.0/s6-overlay-amd64.tar.gz" | tar xz -C /

ADD services.d /etc/services.d
ADD init-stage3 /etc/s6/init/init-stage3

WORKDIR /signal
ADD crontab ./
ADD signal.php ./
RUN crontab -i crontab
#ENV S6_KILL_GRACETIME=99999999

CMD ["/init"]
