# OceanCodex Base Plugin
### Entity add a column after an exist column:

`#[ORM\Column(columnDefinition: 'LONGTEXT NULL AFTER media_path')]`
### Check different and maybe generate a new migration:

`bin/doctrine-migrations diff --filter-expression="/^wp_wpsp_((?!cm_))/iu" -n`

### Run migrate:
`bin/doctrine-migrations migrate -n`

### Clear cache:
`bin/doctrine orm:clear-cache:metadata -n`

`bin/doctrine orm:clear-cache:query -n`

`bin/doctrine orm:clear-cache:result -n`

### Other commands:
`bin/console`