# avageverification

Starting environment:
```
docker-compose up -d && docker-compose logs -f
```

After prestashop initialization:
```
docker-compose down
uncomment prestashop plugin volume in docker-compose.yml 
docker-compose up -d
recomment prestashop plugin volume
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

