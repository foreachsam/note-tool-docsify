#!/usr/bin/env bash


THE_PAGE_TITLE="Document"
THE_PAGE_DESCRIPTION="Description"


to_docs () {
	mkdir -p docs
	cd docs
}


create_index () {
cat > index.html << EOF
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> $THE_PAGE_TITLE </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="description" content="$THE_PAGE_DESCRIPTION">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link rel="stylesheet" href="//unpkg.com/docsify/themes/dark.css">
</head>
<body>
<div id="app"></div>
<script>
window.\$docsify = {
	name: '',
	repo: ''
}
</script>
<script src="//unpkg.com/docsify/lib/docsify.min.js"></script>
</body>
</html>

EOF
}


create_readme () {
cat > README.md << EOF

# $THE_PAGE_TITLE

> $THE_PAGE_DESCRIPTION

EOF
}


create_nojekyll () {
	echo -n > .nojekyll
}


main () {
	to_docs
	create_index
	create_readme
	create_nojekyll
}

main
