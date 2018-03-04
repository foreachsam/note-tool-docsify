#!/usr/bin/env bash


## init
THE_BASE_DIR_PATH=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
source "$THE_BASE_DIR_PATH/_init.sh"


## main
main_docsify_serve () {

	## https://docsify.js.org/#/quickstart?id=preview-your-site
	docsify serve docs

}

main_docsify_serve "$@"
