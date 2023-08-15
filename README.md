# Seller-Hub: An Interface to Manage Sellers and Clients
## Introduction
The Seller-Hub, control of records of sellers and customers. Built on the Laravel framework, the project uses the Filament package for form management and Swagger for API documents.

## Prerequisites
Before you proceed, ensure that you have the following tools installed:

 * Docker
 * Docker Compose

## Getting Started
Follow the steps below to get Seller-Hub up and running:

1. - Clone the Repository
```
git clone https://github.com/Chris7T/saller-hub.git
```
2. Navigate to the Project Directory
```
cd saller-hub
```
3. Start the Docker Containers
```
docker-compose up -d
```
4. Access the App Container
```
docker exec -it app bash
```
5. Copy Environment Variables
```
cp .env.example .env
```
6. Install Composer Dependencies
```
composer install
```
7. Generate Application Key
```
php artisan key:generate
```
8. Run Migrations
```
php artisan migrate
```
9. Create user filament
```
php artisan filament:user
```

## Acess link

To access the Swagger documentation just access the link
```
http://{link}/api/documentation
```

To acess forms
```
http://{link}/admin
```
