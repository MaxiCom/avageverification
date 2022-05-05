# avageverification

WARNING: don't forget to recomment AvAgeVerication volume before pushing docker-compose.yml

Starting environment:
```
docker-compose up -d && docker-compose logs -f
```

After prestashop initialization:
```
docker-compose down

Remove AvAgeVerification volume comment in docker-compose.yml
docker-compose up -d

Back-Office -> Modules -> Module Catalog -> Search "AvAgeVerification" -> Install
Back-Office -> Advanced Parameters -> Performance -> Smarty Template compilation -> Force Compilation
Back-Office -> Advanced Parameters -> Performance -> Debug mode -> Yes
```

Prestashop Container CLI (container name may vary):
```
docker exec -it avageverification-prestashop-1 /bin/bash
cd /bitnami/prestashop/
```

Back-office:
```
http://localhost/administration/

email: user@example.com
password: bitnami1
```

Export to zip:
```
zip -r AvAgeVerification.zip avageverification
```

