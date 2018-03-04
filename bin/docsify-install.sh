#!/usr/bin/env bash


## init
THE_BASE_DIR_PATH=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
source "$THE_BASE_DIR_PATH/_init.sh"


## main
main_docsify_install () {

	## https://docsify.js.org/#/quickstart?id=quick-start
	npm i docsify-cli -g

}

main_docsify_install "$@"
