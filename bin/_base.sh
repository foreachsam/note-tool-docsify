## THE_BASE_DIR_PATH=$(cd -P -- "$(dirname -- "$0")" && pwd -P)

find_dir_path () {
	if [ ! -d $(dirname -- "$1") ]; then
		dirname -- "$1"
		return 1
	fi
	echo $(cd -P -- "$(dirname -- "$1")" && pwd -P)
}

##THIS_BASE_DIR_PATH=$(find_dir_path $0)

is_debug () {
	if [ "$DEBUG_DOCSIFY" = "true" ]; then
		return 0
	fi

	return 1
}

is_not_debug () {
	! is_debug
}

base_var_init () {

	THE_PLAN_DIR_PATH=$(find_dir_path "$THE_BASE_DIR_PATH/../.")

	THE_BIN_DIR_NAME="bin"
	THE_BIN_DIR_PATH="$THE_PLAN_DIR_PATH/$THE_BIN_DIR_NAME"

	THE_DOCS_DIR_NAME="docs"
	THE_DOCS_DIR_PATH="$THE_PLAN_DIR_PATH/$THE_DOCS_DIR_NAME"

	THE_TOOL_DIR_NAME="tool"
	THE_TOOL_DIR_PATH="$THE_PLAN_DIR_PATH/$THE_TOOL_DIR_NAME"


	THE_WWW_DIR_PATH="$THE_DOCS_DIR_PATH"

}

base_var_dump () {

	is_not_debug && return 0

	echo
	echo "### var_dump ###"
	echo "#"
	echo "#"


	echo "THE_PLAN_DIR_PATH=$THE_PLAN_DIR_PATH"

	echo "THE_BIN_DIR_NAME=$THE_BIN_DIR_NAME"
	echo "THE_BIN_DIR_PATH=$THE_BIN_DIR_PATH"

	echo "THE_DOCS_DIR_NAME=$THE_DOCS_DIR_NAME"
	echo "THE_DOCS_DIR_PATH=$THE_DOCS_DIR_PATH"

	echo "THE_TOOL_DIR_NAME=$THE_TOOL_DIR_NAME"
	echo "THE_TOOL_DIR_PATH=$THE_TOOL_DIR_PATH"

	echo "THE_WWW_DIR_PATH=$THE_WWW_DIR_PATH"


	echo "#"
	echo "#"
	echo "### var_dump ###"
	echo
}
