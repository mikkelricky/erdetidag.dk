# Er det … i dag?

```shell
git clone https://github.com/mikkelricky/erdetidag.dk
cd erdetidag.dk
```

Edit `.env.local` and set these required parameters:

```shell
DATABASE_URL=''
SITE_URL=''
SITE_TITLE=''

# Run `bin/console security:hash-password` to hash a password
ADMIN_PASSWORD=''
```

```shell
composer install --no-dev --classmap-authoritative
bin/console doctrine:migrations:migrate --no-interaction
```

Finalize install by setting a real admin password (`ADMIN_PASSWORD` in `.env.local`) and running:

```shell
composer dump-env prod
```

## Development

``` dotenv
# .env.local
APP_ENV=dev
```

``` shell
task dev:start
```

### Coding standards

```shell
task dev:coding-standards:check
```
