.PHONY: help
help:  ## this help message
	@grep -E '^[a-zA-Z_/-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'


.PHONY: setup
setup:  ## Setups the project
	@mkdir -p var/cache && \
		chmod 0777 var/cache && \
		composer install

.PHONY: start
start:  ## Starts the backend in dev mode
	@docker compose up -d

.PHONY: stop
stop:  ## Starts the backend in dev mode
	@docker compose stop

.PHONY: clean
clean:  ## Starts the backend in dev mode
	@docker compose down

.PHONY: logs
logs:  ## Tails the backend logs (php and mysql)
	@docker compose logs -f
