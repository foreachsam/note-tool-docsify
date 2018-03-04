
# 輔助工具


## 安裝

執行下面指令，安裝「[docsify-cli](https://www.npmjs.com/package/docsify-cli/) ([GitHub](https://github.com/QingWei-Li/docsify-cli))」。

``` bash
npm i docsify-cli -g
```

## 觀看使用說明

執行下面指令，觀看使用說明

``` bash
docsify -h
```

或是下面指令

``` bash
docsify --help
```

顯示

```
Usage: docsify <init|serve> <path>

Commands:
  init <path>   Creates new docs
  serve [path]  Run local server to preview site.
  start <path>  Server for SSR

Global Options
  --help, -h     Show help                                             [boolean]
  --version, -v  Show version number                                   [boolean]
```

## 觀看版本

執行下面指令，觀看版本

``` bash
docsify -v
```

或是下面指令

``` bash
docsify --version
```

顯示

```
docsify-cli version:
  4.2.0
```


## 初始 docs

執行下面指令，會產生一個資料夾「docs」

``` bash
docsify init ./docs
```

顯示

```
Initialization succeeded! Please run docsify serve ./docs
```


## 觀看「docs」的檔案結構

執行

``` bash
tree -a docs
```

顯示

```
docs
├── index.html
├── .nojekyll
└── README.md

0 directories, 3 files
```


## 啟動伺服器

執行下面指令，啟動伺服器

``` bash
docsify serve docs
```


## 觀看首頁

執行下面指令，觀看首頁「[http://localhost:3000](http://localhost:3000)」。

``` bash
firefox http://localhost:3000
```


## 完整範例

* [example/start/demo-basic](https://github.com/foreachsam/note-tool-docsify/tree/gh-pages/docs/example/docsify-cli/demo-basic/) ([觀看](https://foreachsam.github.io/note-tool-docsify/docs/example/docsify-cli/demo-basic/docs/))


## 更多參考

* docsify / Quick start / [Initialize](https://docsify.now.sh/quickstart?id=initialize) ([中文](https://docsify.now.sh/zh-cn/quickstart?id=%e5%88%9d%e5%a7%8b%e5%8c%96%e9%a1%b9%e7%9b%ae))
* docsify / Quick start / [Preview your site](https://docsify.now.sh/quickstart?id=preview-your-site) ([中文](https://docsify.now.sh/zh-cn/quickstart?id=%e6%9c%ac%e5%9c%b0%e9%a2%84%e8%a7%88%e7%bd%91%e7%ab%99))
