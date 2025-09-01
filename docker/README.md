# Docker Implementation Documentation for POA

## Overview
This documentation covers the Docker implementation for the Purchase Order Application (POA). The setup includes three main services:
- PHP Application (PHP 8.1-FPM)
- MySQL Database (8.0)
- Nginx Web Server (Alpine)

## Project Structure
```
poa/
├── docker/
│   ├── nginx/
│   │   └── conf.d/
│   │       └── app.conf
│   └── README.md
├── Dockerfile
├── docker-compose.yml
└── .env
```

## Services Configuration

### 1. PHP Application (app)
- Base image: `php:8.1-fpm`
- Extensions installed:
  - pdo_mysql
  - mbstring
  - zip
  - exif
  - pcntl
  - bcmath
  - gd
  - soap
- Additional tools:
  - Composer (Latest version)
  - Git
  - Zip/Unzip
  - Image optimization tools

### 2. MySQL Database (db)
- Version: 8.0
- Exposed Port: 3306
- Environment variables:
  - MYSQL_DATABASE: poa
  - MYSQL_USER: poa
  - MYSQL_PASSWORD: root
  - MYSQL_ROOT_PASSWORD: root

### 3. Nginx Web Server (nginx)
- Version: Alpine (latest)
- Exposed Port: 80
- Configuration: Custom configuration for Laravel application

## Installation & Setup

### Prerequisites
1. Docker Engine installed
2. Docker Compose installed
3. Git (optional)

### First-Time Setup

1. Clone the repository and navigate to project directory:
```bash
git clone <repository-url>
cd poa
```

2. Create required directories:
```bash
mkdir -p docker/nginx/conf.d
```

3. Copy environment file:
```bash
cp .env.example .env
```

4. Build and start containers:
```bash
docker-compose up -d --build
```

5. Install dependencies:
```bash
docker-compose exec app composer install
```

6. Set permissions:
```bash
chmod -R 777 storage bootstrap/cache
```

7. Generate application key:
```bash
docker-compose exec app php artisan key:generate
```

8. Run migrations:
```bash
docker-compose exec app php artisan migrate
```

## Usage

### Starting the Application
```bash
docker-compose up -d
```

### Stopping the Application
```bash
docker-compose down
```

### Common Commands

1. View logs:
```bash
# All services
docker-compose logs -f

# Specific service
docker-compose logs -f app
```

2. Access containers:
```bash
# PHP container
docker-compose exec app bash

# MySQL container
docker-compose exec db bash

# Nginx container
docker-compose exec nginx sh
```

3. Database operations:
```bash
# Create database backup
docker-compose exec db mysqldump -u root -p poa > backup.sql

# Restore database
docker-compose exec db mysql -u root -p poa < backup.sql
```

## Environment Configuration

### Important .env Variables
```
APP_NAME=POA
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=poa
DB_USERNAME=poa
DB_PASSWORD=root
```

## Network Configuration
- Network Name: poa-network
- Type: bridge
- Services connected: app, db, nginx

## Volume Configuration
- Database persistence: dbdata volume
- Application files: mounted from host

## Ports
- Web Application: http://localhost:80
- MySQL Database: localhost:3306

## Troubleshooting

### Common Issues and Solutions

1. Permission Issues
```bash
# Fix storage permissions
chmod -R 777 storage bootstrap/cache
```

2. Container Won't Start
```bash
# Check logs
docker-compose logs

# Rebuild containers
docker-compose up -d --build
```

3. Database Connection Issues
```bash
# Verify database connection
docker-compose exec app php artisan tinker
\DB::connection()->getPdo();
```

### Health Checks
```bash
# Check container status
docker-compose ps

# Check nginx configuration
docker-compose exec nginx nginx -t
```

## Maintenance

### Updates
1. Pull latest changes:
```bash
git pull origin main
```

2. Rebuild containers:
```bash
docker-compose up -d --build
```

3. Update dependencies:
```bash
docker-compose exec app composer update
```

### Backups
1. Database:
```bash
# Create backup
docker-compose exec db mysqldump -u root -p poa > backup.sql
```

2. Application files:
```bash
# Backup application files
tar -czf poa-backup.tar.gz ./*
```

## Security Considerations
1. Environment variables are managed through .env file
2. Database credentials are customizable
3. Nginx configuration optimized for Laravel
4. Separate user (www) for PHP-FPM process

## Development Workflow
1. Local development files are mounted into containers
2. Changes reflect immediately without rebuild
3. Composer and Artisan commands available through container
4. Database persists between container restarts

## Production Deployment
For production deployment, consider:
1. Updating APP_DEBUG=false
2. Setting secure database credentials
3. Configuring proper SSL certificates
4. Optimizing PHP and Nginx configurations
5. Setting up proper backup strategies 