#!/usr/bin/env bash


## init
THE_BASE_DIR_PATH=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
source "$THE_BASE_DIR_PATH/_init.sh"


## main
main_sitemap_gen () {
	cd "$THE_TOOL_DIR_PATH/sitemap/bin"

	./list_save.php
	./xml_save.php
	
}

main_sitemap_gen "$@"
