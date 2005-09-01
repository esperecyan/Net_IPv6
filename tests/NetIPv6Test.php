<?php
//
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2003 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Alexander Merz <alexander.merz@web.de>				  |
// +----------------------------------------------------------------------+
//
// $Id$

require_once "Net/IPv6.php";
require_once "PHPUnit2/Framework/TestCase.php";

/**
* This testcases tests for several bugs and general topics
*
* @author  Alexander Merz <alexander.merz@t-online.de>
* @package Net_IPv6
* @version $Id$
* @access  public
*/
class NetIPv6Test extends PHPUnit2_Framework_TestCase {

/**
* this testcase handles an addition to Bug 3405
* which covers the problem with compressing 0000
*
*/
public function testBug3405_2() {
    $testip = "2001:0618:0400:1c85:0999:0999:0999:0999";
    $is = Net_IPv6::compress($testip);
    $this->assertEquals( "2001:618:400:1c85:999:999:999:999", $is);
}

/**
* this testcase handles an addition to Bug 3405
* which covers the problem with compressing 0000
*
*/
public function testBug3405_3() {
    $testip = "3ffe:02e0:0123:0123:0123:0123:0123:0123";
    $is = Net_IPv6::compress($testip);
    $this->assertEquals( "3ffe:2e0:123:123:123:123:123:123", $is);
}

/**
* this testcase handles an addition to Bug 3405
* which covers the problem with compressing 0000
*
*/
public function testBug3405_4() {
    $testip = "fe80:0000:0250:8dff:0001:0002:0003:0004";
    $is = Net_IPv6::compress($testip);
    $this->assertEquals( "fe80::250:8dff:1:2:3:4", $is);
}




/**
* this testcase handles an addition to Bug 3405
* which covers the problem with compressing 0000
*
*/
public function testBug3405_1() {
    $testip = "2001:0760:0202:f265:0001:0002:0003:0025";
    $is = Net_IPv6::compress($testip);
    $this->assertEquals( "2001:760:202:f265:1:2:3:25", $is);
}


/**
* this testcase handles Bug 4977
* which covers the problem with wrong compressing where nothing is to
* compress and zeros are replaced by ':'
*
*/
public function testBug4977() {
    $testip = "2001:ec8:1:1:1:1:1:1";
    $is = Net_IPv6::compress($testip);
    $this->assertEquals( "2001:ec8:1:1:1:1:1:1", $is);
}

/**
* this testcase handles Bug 3851
* which covers the problem with uncompressing with an IPv4 part
* in the ip
*
*/
public function testBug3851() {
    $testip = "ffff::FFFF:129.144.52.38";
    $is = Net_IPv6::uncompress($testip);
    $this->assertEquals( "ffff:0:0:0:0:FFFF:129.144.52.38", $is);
}

/**
* this testcase handles Bug 3405
* which covers the problem with compressing 0000
* in the ip
*
*/
public function testBug3405() {
    $testip = "2010:0588:0000:faef:1428:0000:0000:57ab";
    $is = Net_IPv6::compress($testip);
    $this->assertEquals( "2010:588:0:faef:1428::57ab", $is);
}

/**
* this testcase handles Bug 2802
* which covers the problem with compressing 0000
* in the ip
*
*/
public function testBug2802() {
    $testip = "0000:0000:0000:588:0000:FAEF:1428:57AB";
    $is = Net_IPv6::compress($testip);
    $this->assertEquals( "::588:0:faef:1428:57ab", $is);
}

/**
* this testcase handles Bug 2803
* which covers the problem adding a unnec. colon at the end
* in the ip
*
*/
public function testBug2803() {
    $testip = "0:0:0:0588:0:FAEF:1428:57AB";
    $is = Net_IPv6::compress($testip);
    $this->assertEquals( "::588:0:faef:1428:57ab", $is);
}

/**
* this testcase handles compress
*
*/
public function testCompress1() {
    $testip = "FF01:0:0:0:0:0:0:101";
    $is = Net_IPv6::compress($testip);
    $this->assertEquals( "ff01::101", $is);
}

/**
* this testcase handles compress
*
*/
public function testCompress2() {
    $testip = "0:0:0:0:0:0:0:1";
    $is = Net_IPv6::compress($testip);
    $this->assertEquals( "::1", $is);
}

/**
* this testcase handles compress
*
*/
public function testCompress3() {
    $testip = "1:0:0:0:0:0:0:0";
    $is = Net_IPv6::compress($testip);
    $this->assertEquals( "1::", $is);
}

/**
* this testcase handles uncompress
*
*/
public function testUncompress1() {
    $testip = "ff01::101";
    $is = Net_IPv6::uncompress($testip);
    $this->assertEquals( "ff01:0:0:0:0:0:0:101", $is);
}

/**
* this testcase handles uncompress
*
*/
public function testUncompress2() {
    $testip = "::1";
    $is = Net_IPv6::uncompress($testip);
    $this->assertEquals( "0:0:0:0:0:0:0:1", $is);
}

/**
* this testcase handles uncompress
*
*/
public function testUncompress3() {
    $testip = "1::";
    $is = Net_IPv6::uncompress($testip);
    $this->assertEquals( "1:0:0:0:0:0:0:0", $is);
}

}
