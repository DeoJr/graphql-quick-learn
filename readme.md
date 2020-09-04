# GRaphQL Quick Learn

## Para rodar o projeto

Subir os containers Docker

```shell script
$ docker-compose up -d
```

Editar o arquivo `/etc/hosts/` e adicionar uma linha `127.0.0.1 magento.local`;

Setup no magento

```
bin/magento setup:install \
  --base-url="http://magento.local" --backend-frontname="admin" \
  --db-host="mysql" --db-name="magento" --db-user="root" --db-password="magento" \
  --language="pt_BR" --timezone="America/Sao_Paulo" \
  --sales-order-increment-prefix="BR" \
  --admin-firstname="Magento" --admin-lastname="Admin" --admin-email="admin@magento.com.br" \
  --admin-user="admin" --admin-password="magento123" \
   --cleanup-database
```

