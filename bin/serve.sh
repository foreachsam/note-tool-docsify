#!/usr/bin/env bash


## init
THE_BASE_DIR_PATH=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
source "$THE_BASE_DIR_PATH/_init.sh"


## main
main_serve () {
	## cd document root dir
	cd $THE_WWW_DIR_PATH


	## http://php.net/manual/en/features.commandline.webserver.php
	#php -S localhost:8080
	#php -S 127.0.0.1:8080
	php -S 0.0.0.0:8080

	## https://docsify.js.org/#/quickstart?id=manual-initialization
	## https://docs.python.org/3/library/http.server.html
	#python -m SimpleHTTPServer 8080
}

main_serve "$@"
