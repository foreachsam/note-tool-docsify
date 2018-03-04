
# 開始





## 產生「docs」這個資料夾

執行下面指令，產生「docs」這個資料夾，並且切換到「docs」這個資料夾。

``` bash
mkdir -p docs
cd docs
```

## 產生「index.html」

執行下面指令，產生「index.html」這個檔案。

``` bash
cat > index.html << EOF
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> Document </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="description" content="Description">
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
```


## 產生「README.md」

執行下面指令，產生「README.md」這個檔案。

``` bash
cat > README.md << EOF

# Document

> Description

EOF
```


## 產生「.nojekyll」

執行下面指令，產生「.nojekyll」這個檔案。

``` bash
echo > .nojekyll
```

## 觀看「docs」的檔案結構

執行

``` bash
tree -a
```

顯示

```
.
├── index.html
├── .nojekyll
└── README.md

0 directories, 3 files
```


## 啟動伺服器

執行下面指令，啟動伺服器

``` bash
python -m SimpleHTTPServer 3000
```

或是也可以執行下面指令，啟動伺服器

``` bash
php -S 0.0.0.0:3000
```


## 觀看首頁

執行下面指令，觀看首頁「[http://localhost:3000](http://localhost:3000)」。

``` bash
firefox http://localhost:3000
```


## 完整範例

* [example/start/demo-basic](https://github.com/foreachsam/note-tool-docsify/tree/gh-pages/docs/example/start/demo-basic/) ([觀看](https://foreachsam.github.io/note-tool-docsify/docs/example/start/demo-basic/docs/))


## 更多參考

* docsify / Quick start / [Manual initialization](https://docsify.js.org/#/quickstart?id=manual-initialization) ([中文](https://docsify.js.org/#/zh-cn/quickstart?id=%e6%89%8b%e5%8a%a8%e5%88%9d%e5%a7%8b%e5%8c%96))
* Python / [http.server — HTTP servers](https://docs.python.org/3/library/http.server.html)
* PHP / [Built-in web server](http://php.net/manual/en/features.commandline.webserver.php)
