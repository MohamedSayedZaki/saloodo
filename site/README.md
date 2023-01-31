# saloodo
### Salood task challenge 

## Installation

```bash
git clone git@github.com:MohamedSayedZaki/saloodo.git
```

### checkout master branch
```bash
git checkout master 
```

### build environment

```bash
docker compose up -d
```

### build database schema and load fixtures

```bash
php bin/console doctrine:migrations:migrate
```

```bash
php bin/console doctrine:fixtures:load
```

### You can get user as a biker or sender through database 
##### choose one email for each user and use password: [1234] for each user.


###
###


### You can login through the url 
[localhost:8001/api/login](http://localhost:8001/api/login)