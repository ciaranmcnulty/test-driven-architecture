test: test-micro test-acceptance test-integration psalm test-ui

serve: clean dev-db symfony

symfony:
	symfony serve

test-micro:
	vendor/bin/phpunit --testsuite=microtests

test-acceptance:
	vendor/bin/phpunit --testsuite=acceptance

test-integration: test-doctrine

test-doctrine: test-db
	vendor/bin/phpunit --testsuite=doctrine

test-db: clean
	bin/console doctrine:schema:create -q --env=test

dev-db:
	bin/console doctrine:schema:create -q --env=dev

test-ui: test-db
	APP_ENV=test_e2e vendor/bin/phpunit --testsuite=ui

psalm:
	vendor/bin/psalm

clean:
	rm -rf var/test.db
	rm -rf var/dev.db
