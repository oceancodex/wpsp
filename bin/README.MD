## Entities:
### Add a column after an exist column:
`#[ORM\Column(columnDefinition: 'LONGTEXT NULL AFTER media_path')]`
___

## Migration:
### Migrate:
`bin/migrations migrate -n`

### Diff:
`bin/migrations diff --filter-expression="/^wp_wpsp_((?!cm_))/iu" -n`
___

## ORM:
### Clear cache:
`bin/orm orm:clear-cache:metadata`

`bin/orm orm:clear-cache:query`

`bin/orm orm:clear-cache:result`
___

## WPSP:
`bin/wpsp`