# avageverification

Starting environment:
```
docker-compose up -d
```

Back-office:
```
http://localhost/administration/

email: user@example.com
password: bitnami1
```

After prestashop initialization:
```
docker-compose down
uncomment prestashop volume in docker-compose.yml 
docker-compose up -d
recomment prestashop volumen
```
