[![Review ssignment Due Date](https://classroom.github.com/assets/deadline-readme-button-22041afd0340ce965d47ae6ef1cefeee28c7c493a6346c4f15d667ab976d596c.svg)](https://classroom.github.com/a/NoujRXDZ)
# Warmup - set up a sample docker infrastructure

There are 3 folders in this repository:
- `deploy` - is where the "main" gateway compose file to store
- `store` and `admin` - hello world applications with Dockerfile and compose files that can connect to the gateway network to be served

### Set up caddy-proxy

In deploy modify the `caddy.compose.yaml` in such a way that it starts a caddy-proxy service listening to the docker socket on network
`caddy`. See: [Caddy documentation](https://caddyserver.com/docs/). You will have to find the proxy variant yourselves. (allows caddy to
react to containers on a specific network)

Expose the https port locally. Consider using 8443 instead of 443 as it is a dev environment.

**WARNING**: ensure that you only use self-signed certificates, as Let's encrypt will not be able to provide certificates for the dummy domains.

### Create a couple of hello-world applications

Using your respective frameworks (same from the test assignment) create a couple of "hello world" applications in admin and store.
The points to look-out for:
- Must be able to build respective images using docker files in their respective folders (must be edited)
- The docker files must utilize multistage builds
- Create `compose.yaml` files for docker compose in each app folder that will allow launching the applications like so `docker compose up -d`
- No ports must be exposed from the application compose files, only the caddy gateway is allowed to expose a localhost port
- The applicaations must connect to the caddy network.
- Database is sqlite, for now. But you must ensure persistence so that the data remains after `docker compose down`

NOTE: you may consider creating helper scripts in your respective languages to automate starting the caddy compose and the app ones. Or
to ensure that `.env` files are in place, or what have you.

In the end you should be able to access `https://admin.localdev.me:8443` and `https://store.localdev.me:8443` to get to the sample applications.
(The idea is to have 2 different applications share a single port and be TLS terminated)

NOTE: `*.localdev.me` is a DNS record maintained by a 3rd party that points to localhost - helps avoid editing `hosts` file for local testing.
