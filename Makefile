.PHONY: up down build console mysql unit-tests setup-upgrade cache-clean cache-flush clear-generated cron-adyen

up:
	docker-compose up -d;

down:
	docker-compose down;

console:
	docker exec -it php_ql bash;

reload: down up

mysql:
	docker exec -it mysql_ql bash;

unit-tests:
	docker exec php_ql sh -c "vendor/bin/phpunit";

setup-upgrade:
	docker exec php_ql sh -c "bin/magento setup:upgrade";

cache-clean:
	docker exec php_ql sh -c "bin/magento cache:clean";

cache-flush:
	docker exec php_ql sh -c "bin/magento cache:flush";

clear-generated:
	docker exec php_ql sh -c "rm -rf generated/*";

cron-adyen:
	docker exec php_ql sh -c "bin/n98-magerun2 sys:cron:run adyen_payment_process_notification";

consumer-once:
	docker exec php_ql sh -c "php -d xdebug.remote_autostart=1 bin/magento queue:consumers:start state-machine.events --max-messages=1"

consumer:
	docker exec php_ql sh -c "php -d xdebug.remote_autostart=1 bin/magento queue:consumers:start state-machine.events"

flush-redis:
	docker exec redis_name sh -c "redis-cli flushall";