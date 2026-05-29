# Docker Lab

A local lab with 3 containers: Nginx (reverse proxy), Apache+PHP (web server), MySQL (database).

## Structure

```
docker-lab/
├── docker-compose.yml
├── nginx/
│   └── default.conf        # Nginx reverse proxy config
├── apache/
│   ├── Dockerfile           # PHP 8.2 + Apache
│   └── src/
│       └── index.php        # Demo app (reads from MySQL)
└── mysql/
    └── init.sql             # Creates DB, table, and seed data
```

## Quick Start

```bash
# Start all containers
docker compose up --build -d

# Open in browser
open http://localhost
```

## Useful Commands

| Command | Description |
|---|---|
| `docker compose ps` | Check container statuses |
| `docker compose logs -f nginx` | Stream Nginx logs |
| `docker compose logs -f apache` | Stream Apache/PHP logs |
| `docker exec -it lab-mysql mysql -u labuser -plabpass labdb` | MySQL shell |
| `docker compose down` | Stop containers |
| `docker compose down -v` | Stop + remove volumes |

## Architecture

```
Browser → localhost:80
    → Nginx (reverse proxy)
        → Apache:80 (PHP app)
            → MySQL:3306 (database)
```
