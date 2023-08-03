include make-vars.mk
export SHELL:=/bin/bash

.PHONY: clean
clean:
	werf stages purge --stages-storage $(WERF_STAGE_STORAGES) --force

# .PHONY: pull-base
# pull-base:
# 	@docker pull eu.gcr.io/gt-project-384708/base/bullseye-php8.1-fpm-base
# 	@docker pull eu.gcr.io/gt-project-384708/base/bullseye-nginx-base

# .PHONY: pull
# pull:
# 	@docker pull $(REGISTRY)/$(IMAGE_BACK):$(RELEASE)
# 	@docker pull $(REGISTRY)/$(IMAGE_FRONT):$(RELEASE)

.PHONY: build-dev
build-dev:
	export namespace=${DEV_KUBE_NS}
	werf build --stages-storage $(WERF_STAGE_STORAGES) ${IMAGE}

.PHONY: build-stage
build-stage:
	export namespace=${STAGE_KUBE_NS}
	werf build --stages-storage $(WERF_STAGE_STORAGES) ${IMAGE}

.PHONY: build-prod
build-prod:
	export namespace=${PROD_KUBE_NS}
	werf build --stages-storage $(WERF_STAGE_STORAGES) ${IMAGE}

.PHONY: publish-dev
publish-dev: build-dev
	werf publish --tag-custom=${RELEASE_FOR_DEV} --stages-storage $(WERF_STAGE_STORAGES) --images-repo=${REGISTRY}

.PHONY: publish-stage
publish-stage: build-stage
	werf publish --tag-custom=${RELEASE_FOR_STAGE} --stages-storage $(WERF_STAGE_STORAGES) --images-repo=${REGISTRY}

.PHONY: publish-prod
publish-prod: build-prod
	werf publish --tag-custom=${RELEASE_FOR_PROD} --stages-storage $(WERF_STAGE_STORAGES) --images-repo=${REGISTRY}

# .PHONY: compose-up
# compose-up: compose-down pull
# 	REGISTRY=$(REGISTRY) IMAGE_BACK=$(IMAGE_BACK) IMAGE_FRONT=$(IMAGE_FRONT) RELEASE=$(RELEASE) docker-compose $(COMPOSER_ARGS) create
# 	REGISTRY=$(REGISTRY) IMAGE_BACK=$(IMAGE_BACK) IMAGE_FRONT=$(IMAGE_FRONT) RELEASE=$(RELEASE) docker-compose $(COMPOSER_ARGS) up -d

# .PHONY: compose-down
# compose-down:
# 	REGISTRY=$(REGISTRY) IMAGE_BACK=$(IMAGE_BACK) IMAGE_FRONT=$(IMAGE_FRONT) RELEASE=$(RELEASE) docker-compose $(COMPOSER_ARGS) down -t0 || true
# 	REGISTRY=$(REGISTRY) IMAGE_BACK=$(IMAGE_BACK) IMAGE_FRONT=$(IMAGE_FRONT) RELEASE=$(RELEASE) docker-compose $(COMPOSER_ARGS) rm -sf || true

.PHONY: sops-decrypt-dev
sops-decrypt-dev:
	sops -d .helm/secret-values-dev.yaml > .helm/dec-secrets-dev.yaml

.PHONY: sops-encrypt-dev
sops-encrypt-dev:
	(cd .helm; sops -e dec-secrets-dev.yaml > secret-values-dev.yaml)

.PHONY: sops-decrypt-stage
sops-decrypt-stage:
	sops -d .helm/secret-values-stage.yaml > .helm/dec-secrets-stage.yaml

.PHONY: sops-encrypt-stage
sops-encrypt-stage:
	(cd .helm; sops -e dec-secrets-stage.yaml > secret-values-stage.yaml)

.PHONY: sops-decrypt-prod
sops-decrypt-prod:
	sops -d .helm/secret-values-prod.yaml > .helm/dec-secrets-prod.yaml

.PHONY: sops-encrypt-prod
sops-encrypt-prod:
	(cd .helm; sops -e dec-secrets-prod.yaml > secret-values-prod.yaml)

.PHONY: dev
dev: publish-dev
	# curl --silent -d "{'text': '🐧 CyberSportScore API DEV: *Deploying ...*\n${GIT_COMMITS_DEV}'}" -H 'Content-Type: application/json; charset=UTF-8' -X POST "https://chat.googleapis.com/v1/spaces/AAAA5dGJ5TA/messages?key=AIzaSyDdI0hCZtE6vySjMm-WEfRq3CPzqKqqsHI&token=qjJrqzyhMetHxKJ3uDQ90DLu7xgxHAoixfRj58wU8Qg%3D"
	sops -d .helm/secret-values-dev.yaml > .helm/dec-secrets-dev.yaml
	helm upgrade $(SERVICE)-dev .helm \
	  --install --timeout 600s --wait \
	  --kube-context=$(DEV_KUBE_CONTEXT) \
	  --namespace=$(DEV_KUBE_NS) \
	  --set "global.git_rev=$(RELEASE_FOR_DEV)" \
	  --set "global.timestamp=$(shell date +"%s")" \
	  --set "global.image_back=$(REGISTRY)/$(IMAGE_BACK):$(RELEASE_FOR_DEV)" \
	  --set "global.image_front=$(REGISTRY)/$(IMAGE_FRONT):$(RELEASE_FOR_DEV)" \
	  --values .helm/values-dev.yaml \
	  --values .helm/dec-secrets-dev.yaml || (rm -f .helm/dec-*.yaml && false)
	rm -f .helm/dec-*.yaml
	# curl -d "{'text': '🟢 CyberSportScore API DEV: *Ready*'}" -H 'Content-Type: application/json; charset=UTF-8' -X POST "https://chat.googleapis.com/v1/spaces/AAAA5dGJ5TA/messages?key=AIzaSyDdI0hCZtE6vySjMm-WEfRq3CPzqKqqsHI&token=qjJrqzyhMetHxKJ3uDQ90DLu7xgxHAoixfRj58wU8Qg%3D"

.PHONY: stage
stage: publish-stage
	# curl --silent -d "{'text': '🐧 CyberSportScore API Stage: *Deploying ...*\n${GIT_COMMITS_STAGE}'}" -H 'Content-Type: application/json; charset=UTF-8' -X POST "https://chat.googleapis.com/v1/spaces/AAAA5dGJ5TA/messages?key=AIzaSyDdI0hCZtE6vySjMm-WEfRq3CPzqKqqsHI&token=qjJrqzyhMetHxKJ3uDQ90DLu7xgxHAoixfRj58wU8Qg%3D"
	sops -d .helm/secret-values-stage.yaml > .helm/dec-secrets-stage.yaml
	helm upgrade $(SERVICE)-stage .helm \
	  --install --timeout 600s --wait \
	  --kube-context=$(STAGE_KUBE_CONTEXT) \
	  --namespace=$(STAGE_KUBE_NS) \
	  --set "global.git_rev=$(RELEASE_FOR_STAGE)" \
	  --set "global.timestamp=$(shell date +"%s")" \
	  --set "global.image_back=$(REGISTRY)/$(IMAGE_BACK):$(RELEASE_FOR_STAGE)" \
	  --set "global.image_front=$(REGISTRY)/$(IMAGE_FRONT):$(RELEASE_FOR_STAGE)" \
	  --values .helm/values-stage.yaml \
	  --values .helm/dec-secrets-stage.yaml || (rm -f .helm/dec-*-stage.yaml && false)
	rm -f .helm/dec-*-stage.yaml
	# curl -d "{'text': '🟢 CyberSportScore API Stage: *Ready*'}" -H 'Content-Type: application/json; charset=UTF-8' -X POST "https://chat.googleapis.com/v1/spaces/AAAA5dGJ5TA/messages?key=AIzaSyDdI0hCZtE6vySjMm-WEfRq3CPzqKqqsHI&token=qjJrqzyhMetHxKJ3uDQ90DLu7xgxHAoixfRj58wU8Qg%3D"

.PHONY: production
prod: publish-prod
	# curl --silent -d "{'text': '🐧 CyberSportScore API PROD: *Deploying ...*\n${GIT_COMMITS_PROD}'}" -H 'Content-Type: application/json; charset=UTF-8' -X POST "https://chat.googleapis.com/v1/spaces/AAAA5dGJ5TA/messages?key=AIzaSyDdI0hCZtE6vySjMm-WEfRq3CPzqKqqsHI&token=qjJrqzyhMetHxKJ3uDQ90DLu7xgxHAoixfRj58wU8Qg%3D"
	sops -d .helm/secret-values-prod.yaml > .helm/dec-secrets-prod.yaml
	helm upgrade $(SERVICE)-prod .helm \
	  --install --timeout 600s --wait \
	  --kube-context=$(PROD_KUBE_CONTEXT) \
	  --namespace=$(PROD_KUBE_NS) \
	  --set "global.git_rev=$(RELEASE_FOR_PROD)" \
	  --set "global.timestamp=$(shell date +"%s")" \
	  --set "global.image_back=$(REGISTRY)/$(IMAGE_BACK):$(RELEASE_FOR_PROD)" \
	  --set "global.image_front=$(REGISTRY)/$(IMAGE_FRONT):$(RELEASE_FOR_PROD)" \
	  --values .helm/values-prod.yaml \
	  --values .helm/dec-secrets-prod.yaml || (rm -f .helm/dec-*-prod.yaml && false)
	rm -f .helm/dec-*-prod.yaml
	# curl -d "{'text': '🟢 CyberSportScore API PROD: *Ready*'}" -H 'Content-Type: application/json; charset=UTF-8' -X POST "https://chat.googleapis.com/v1/spaces/AAAA5dGJ5TA/messages?key=AIzaSyDdI0hCZtE6vySjMm-WEfRq3CPzqKqqsHI&token=qjJrqzyhMetHxKJ3uDQ90DLu7xgxHAoixfRj58wU8Qg%3D"
