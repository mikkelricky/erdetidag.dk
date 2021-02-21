# Er det … i dag?

```sh
git clone https://github.com/rimi-itk/erdetidag.dk
cd erdetidag.dk
```

Edit `.env.local` and set these required parameters:

```sh
SITE_URL=''
SITE_TITLE=''
# Run `bin/console security:encode-password` to encode an admin password.
ADMIN_PASSWORD=''
```

```sh
composer install --no-dev --classmap-authoritative
bin/console doctrine:migrations:migrate --no-interaction
```

Finalize install by setting a real admin password (`ADMIN_PASSWORD` in `.env.local`) and running:

```sh
composer dump-env prod
```

## Development

### Coding standards

```sh
yarn install
yarn coding-standards-check
yarn coding-standards-apply
```
