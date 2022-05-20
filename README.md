## Getting started

```bash
docker-compose build --pull --no-cache
docker-compose up -d
```

```
# URL
http://127.0.0.1

# Env DB (à mettre dans .env, si pas déjà présent)
DATABASE_URL="postgresql://postgres:password@db:5432/db?serverVersion=13&charset=utf8"
```

## Commandes utiles
```
# Lister l'ensemble des commandes existances 
docker-compose exec php bin/console

# Supprimer le cache du navigateur
docker-compose exec php bin/console cache:clear

# Création de fichier vierge
docker-compose exec php bin/console make:controller
```

## Gestion de base de données

#### Commandes de création d'entité
```
docker-compose exec php bin/console make:entity
```

#### Mise à jour de la base de données
```
# Voir les requètes qui seront jouer avec force
docker-compose exec php bin/console doctrine:schema:update --dump-sql

# Executer les requètes en DB
docker-compose exec php bin/console doctrine:schema:update --force
```

#### Fixtures 
Documentation : https://symfony.com/bundles/DoctrineFixturesBundle/current/index.html
```
# Installation 
docker compose exec php composer require --dev orm-fixtures

# Installtion Faker 
docker compose exec php composer require --dev fzaninotto/faker
```

#### Sécurité 
Assert : https://symfony.com/doc/current/validation.html

#### Auth
Commande pour installer le système d'authentification
```
    bin/console make:user
    bin/console make:auth
```

