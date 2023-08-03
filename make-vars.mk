SERVICE:=decider-media-project-cybersportscore-api
# RELEASE:=$(shell git rev-parse --verify origin/master)
RELEASE_FOR_DEV:=$(shell git rev-parse --verify origin/dev)
RELEASE_FOR_STAGE:=$(shell git rev-parse --verify origin/stage)
RELEASE_FOR_PROD:=$(shell git rev-parse --verify origin/prod)

REGISTRY=eu.gcr.io/gt-project-384708
# WERF_STAGE_STORAGES:=:local
WERF_STAGE_STORAGES:=${REGISTRY}/werf-stage-storage/${SERVICE}

WERF_ARGS:=--log-quiet=false --log-pretty=false

DEV_KUBE_NS:=gt-dev
DEV_KUBE_CONTEXT:=gke_gt-project-384708_europe-west4_gt-project

NAMESPACE_DEV:=gt-dev
NAMESPACE_STAGE:=gt-stage
NAMESPACE_PROD:=gt

STAGE_KUBE_NS:=gt-stage
STAGE_KUBE_NS:=gt-stage
STAGE_KUBE_CONTEXT:=gke_gt-project-384708_europe-west4_gt-project

PROD_KUBE_NS:=gt
PPROD_KUBE_CONTEXT:=gke_gt-project-384708_europe-west4_gt-project

IMAGE_BACK:=${SERVICE}-back
IMAGE_FRONT:=${SERVICE}-front

GIT_RELEASE:=$(shell helm get values -n master ${SERVICE}-master|grep "git_rev:"|cut -d ' ' -f4)

GIT_LOG_DEV:= $(shell git log --pretty=oneline ${GIT_RELEASE}..${RELEASE_FOR_DEV})
GIT_LOG_STAGE:= $(shell git log --pretty=oneline ${GIT_RELEASE}..${RELEASE_FOR_STAGE})
GIT_LOG_PROD:= $(shell git log --pretty=oneline ${GIT_RELEASE}..${RELEASE_FOR_PROD})

GIT_COMMITS_DEV:= $(subst ~,m, $(GIT_LOG_DEV))
GIT_COMMITS_STAGE:= $(subst ~,m, $(GIT_LOG_STAGE))
GIT_COMMITS_PROD:= $(subst ~,m, $(GIT_LOG_PROD))
