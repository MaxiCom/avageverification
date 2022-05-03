# avageverification

WARNING: Before every push, remember to recomment AvAgeVerification volume in docker-compose.yml

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
```

Prestashop Container CLI:
```
docker exec -it avageverification_prestashop_1 /bin/bash
cd /bitnami/prestashop/
```

Back-office:
```
http://localhost/administration/

email: user@example.com
password: bitnami1
```

