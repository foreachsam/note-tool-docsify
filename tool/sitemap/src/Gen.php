<?php

namespace Tool\Sitemap;

class Gen {

	protected $_ExceptDirNameList = NULL;
	protected $_ExceptFileNameList = NULL;

	protected $_SourceFile = NULL;
	protected $_TargetUri = NULL;

	protected $_SaveFile = NULL;

	protected $_Engine = NUll;

	protected function init()
	{
		if ($this->_ExceptDirNameList === NULL) {
			$this->_ExceptDirNameList = array();
			$this->_ExceptDirNameList[] = 'example';
		}

		if ($this->_ExceptFileNameList === NULL) {
			$this->_ExceptFileNameList = array();
			$this->_ExceptFileNameList[] = 'index.html';
			$this->_ExceptFileNameList[] = '.nojekyll';
			$this->_ExceptFileNameList[] = '_sidebar.md';
		}


		if ($this->_Engine === NULL) {
			$this->_Engine = $this->findEngine();
		}

		$action_type = $this->_ActionType;
		if ($action_type === 'save_xml' || $action_type === 'save_list' ) {
			$this->_SaveFile = (new SourceFile)
				->setFilePath($this->_SaveFilePath);
			;
			//$this->_SaveFile->dump();

			$this->_Engine->setTarget($this->_SaveFile);
		}


	}

	public function run()
	{
		$this->init();
		$this->preRun();
		$this->doRun();
		$this->postRun();
	}

	protected function preRun()
	{
		$this->_Engine->preRun();
	}

	protected function doRun()
	{
		$this->walkDir($this->_SourceDirPath);
	}

	protected function postRun()
	{
		$this->_Engine->postRun();
	}

	protected function walkDir($dir_path, $dir_name=null, $sub_path=NULL)
	{
		$dir_path = $this->fixDirPath($dir_path);


		if (!is_dir($dir_path)) {
			return false;
		}


		// http://php.net/manual/en/function.opendir.php
		if (!($dir_handle = opendir($dir_path))) {
			return false;
		}

		if ($sub_path !== NULL) {
			$sub_path .= '/';
			$sub_path .= $dir_name;
		} else {
			$sub_path = $dir_name;
		}

		//http://php.net/manual/en/function.readdir.php
		while (($node_name = readdir($dir_handle)) !== false) {

			if ($node_name === '..' || $node_name === '.' ) {
				continue;
			}

			$node_path = $dir_path . '/' . $node_name;

			if (is_dir($node_path)) {
				if ($this->exceptDirName($node_name)) {
					continue;
				}
				$this->walkDir($node_path, $node_name, $sub_path);
			} else {
				if ($this->exceptFileName($node_name)) {
					continue;
				}
				$this->walkFile($node_path, $node_name, $sub_path);
			}

		}

		closedir($dir_handle);

	}

	protected function walkFile($file_path, $file_name, $sub_path=NULL)
	{
		//var_dump($file_path);
		//var_dump($file_name);
		//var_dump($sub_path);

		$this->_SourceFile = (new SourceFile)
			->setFilePath($file_path)
			->setSubPath($sub_path)
		;

		$this->_TargetUri = (new NodeUri)
			->setSourceFile($this->_SourceFile)
			->setBaseUri($this->_BaseUri)
		;

		$this->_Engine->push($this->_TargetUri);


	}

	protected function findEngine()
	{
		$method = 'engine_' . $this->_ActionType;

		if (method_exists($this, $method)) {
			// http://php.net/manual/en/function.call-user-func.php
			return call_user_func(array($this, $method));
		}
	}

	protected function engine_dump_list()
	{
		return new EngineDumpList;
	}

	protected function engine_save_list()
	{
		return new EngineSaveList;
	}

	protected function engine_dump_xml()
	{
		return new EngineDumpXml;
	}

	protected function engine_save_xml()
	{
		return new EngineSaveXml;
	}

	protected function exceptDirName($name)
	{
		if (in_array($name, $this->_ExceptDirNameList)) {
			return true;
		}

		return false;
	}

	protected function exceptFileName($name)
	{
		if (in_array($name, $this->_ExceptFileNameList)) {
			return true;
		}

		return false;
	}

	protected function fixDirPath($val)
	{
		return rtrim($val, '/');
	}

	protected $_SourceDirPath = '';
	public function setSourceDirPath($val)
	{
		$this->_SourceDirPath = $val;
		return $this;
	}

	protected $_BaseUri = '';
	public function setBaseUri($val)
	{
		$this->_BaseUri = $val;
		return $this;
	}

	protected $_ActionType = 'dump_list';
	public function setActionType($val)
	{
		$this->_ActionType = $val;
		return $this;
	}

	protected $_SaveFilePath = '';
	public function setSaveFilePath($val)
	{
		$this->_SaveFilePath = $val;
		return $this;
	}

}


class SourceFile {

	protected $_SubPath = '';
	public function setSubPath($val)
	{
		$this->_SubPath = $val;
		return $this;
	}
	public function getSubPath()
	{
		return $this->_SubPath;
	}

	protected $_FilePath = '';
	public function setFilePath($val)
	{
		$this->_FilePath = $val;

		$info = pathinfo($this->_FilePath);

		if (array_key_exists('dirname', $info)) {
			$this->_DirPath = $info['dirname'];
		}

		if (array_key_exists('basename', $info)) {
			$this->_FileName = $info['basename'];
		}

		if (array_key_exists('filename', $info)) {
			$this->_FileMainName = $info['filename'];
		}

		if (array_key_exists('extension', $info)) {
			$this->_FileExtName = $info['extension'];
		}

		return $this;
	}
	public function getFilePath()
	{
		return $this->_FilePath;
	}

	protected $_DirPath = '';
	public function getDirPath()
	{
		return $this->_DirPath;
	}

	protected $_FileName = '';
	public function getFileName()
	{
		return $this->_FileName;
	}

	protected $_FileMainName = '';
	public function getFileMainName()
	{
		return $this->_FileMainName;
	}

	protected $_FileExtName = '';
	public function getFileExtName()
	{
		return $this->_FileExtName;
	}

	public function dump()
	{
		var_dump($this->_FilePath);
	}

}

class NodeUri {
	public function __toString()
	{
		return $this->toString();
	}

	protected function toString()
	{
		$rtn = '';
		$rtn .= $this->fixBaseUri($this->_BaseUri);
		$rtn .= '/';
		$rtn .= '#';
		$rtn .= '/';

		$sub_path = trim($this->_SourceFile->getSubPath());
		if ($sub_path) {
			$rtn .= $sub_path;
			$rtn .= '/';
		}

		$name = $this->_SourceFile->getFileMainName();
		if ($name === 'README') {
			$name = '';
		}
		$rtn .= $name;

		return $rtn;
	}

	protected $_SourceFile = '';
	public function setSourceFile($val)
	{
		$this->_SourceFile = $val;
		return $this;
	}


	protected $_BaseUri = '';
	public function setBaseUri($val)
	{
		$this->_BaseUri = $val;
		return $this;
	}

	protected function fixBaseUri($val)
	{
		return rtrim($val, '/');
	}

}


class EngineBase {

	public function preRun()
	{

	}

	public function push($item)
	{

	}

	public function postRun()
	{

	}

	protected $_Target = NULL;
	public function setTarget($val)
	{
		$this->_Target = $val;
		return $this;
	}
	public function getTarget($val)
	{
		return $this->_Target;
	}

}

class EngineDumpList extends EngineBase {

	public function push($item)
	{
		$this->write($item . PHP_EOL);
	}

	protected function write($item)
	{
		echo($item);
	}

}

class EngineDumpXml extends EngineDumpList {

	protected $_Date = NULL;

	public function preRun()
	{
		$this->_Date = date('Y-m-d');
		$this->write($this->renderHead());
	}

	public function push($item)
	{
		$this->write($this->renderItem($item));
	}

	public function postRun()
	{
		$this->write($this->renderTail());
	}

	protected function renderItem($uri)
	{
		$rtn = '';
		$rtn .= '<url>';
		$rtn .= PHP_EOL;
		$rtn .= '	<loc>';
		$rtn .= $uri;
		$rtn .= '</loc>';
		$rtn .= PHP_EOL;
		$rtn .= '	<lastmod>';
		$rtn .= $this->_Date;
		$rtn .= '</lastmod>';
		$rtn .= PHP_EOL;
		$rtn .= '	<changefreq>daily</changefreq>';
		$rtn .= PHP_EOL;
		$rtn .= '</url>';
		$rtn .= PHP_EOL;

		return $rtn;
	}

	public function renderHead()
	{
		$rtn = '';
		$rtn .= '<' . '?xml version="1.0" encoding="UTF-8"?' . '>';
		$rtn .= PHP_EOL;
		$rtn .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		$rtn .= PHP_EOL;

		return $rtn;
	}

	public function renderTail()
	{
		$rtn = '';
		$rtn .= '</urlset>';
		$rtn .= PHP_EOL;

		return $rtn;
	}

}


class EngineSaveList extends EngineBase {

	protected $_Stream;

	public function preRun()
	{
		// http://php.net/manual/en/function.fopen.php
		$this->_Stream = fopen($this->_Target->getFilePath(), 'w+');
	}

	public function push($item)
	{
		// http://php.net/manual/en/function.fwrite.php
		$this->write($item . PHP_EOL);
	}

	public function postRun()
	{
		fclose($this->_Stream);
	}

	protected function write($item)
	{
		fwrite($this->_Stream, $item);
	}

}


class EngineSaveXml extends EngineDumpXml {

	protected $_Stream;

	public function preRun()
	{
		// http://php.net/manual/en/function.fopen.php
		$this->_Stream = fopen($this->_Target->getFilePath(), 'w+');

		$this->_Date = date('Y-m-d');
		$this->write($this->renderHead());
	}

	public function push($item)
	{
		$this->write($this->renderItem($item));
	}

	public function postRun()
	{
		$this->write($this->renderTail());

		fclose($this->_Stream);
	}

	protected function write($item)
	{
		fwrite($this->_Stream, $item);
	}

}
