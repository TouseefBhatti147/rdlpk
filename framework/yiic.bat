@echo off

rem -------------------------------------------------------------
rem  Yii command line script for Windows.
rem
rem  This is the bootstrap script for running yiic on Windows.
rem
rem  @author Qiang Xue <qiang.xue@gmail.com>
rem  @link http://www.yiiframework.com/
rem  @copyright 2008 Yii Software LLC
rem  @license http://www.yiiframework.com/license/
rem  @version $Id$
rem -------------------------------------------------------------

@setlocal

set YII_PATH=%~dp0

if "%PHP_COMMAND%" == "" set PHP_COMMAND=D://wamp/bin/php/php5.4.12/php.exe

"%PHP_COMMAND%" "%YII_PATH%yiic" %*

@endlocal