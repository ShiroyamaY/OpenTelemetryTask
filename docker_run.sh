#/bin/bash

docker compose -f ./deploy/docker-compose.yaml up --build -d
docker compose -f ./admin/docker-compose.yaml up --build -d
docker compose -f ./store/docker-compose.yaml up --build -d
