#!/usr/bin/env bash

## init
THE_BASE_DIR_PATH=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
source "$THE_BASE_DIR_PATH/_init.sh"


main_help () {
	cat <<EOF

Usage:

$ make [command]

Ex:

$ make
$ make help

$ make serve

EOF
}

main_help
