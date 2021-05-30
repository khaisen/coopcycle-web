FROM osrm/osrm-backend:v5.23.0

RUN sudo apt-get update && sudo apt-get install -y openssl wget

COPY ./start.sh /usr/local/bin/osrm-start

RUN chmod +x /usr/local/bin/osrm-start

CMD ["osrm-start"]
