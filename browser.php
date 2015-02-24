<?php
/*****************************************************************

	File name: browser.php
	Author: Armando "FL3R" Fiore
	Last modified: February 2015

	**************************************************************

	Copyright (C) Armando "FL3R" Fiore

	**************************************************************

	Browser e Sistemi Operativi
	
	Attraverso la richiesta HTTP_USER_AGENT richiama OS, browser e versione

	Utilizzo:
	require_once($_SERVER['DOCUMENT_ROOT'].'/include/browser.php');
		$br = new Browser;
		echo "$br->Platform, $br->Name version $br->Version";

*****************************************************************/

	class Browser{

		public $Name = "Unknown";
		public  $Version = "";
		public $Platform = "Unknown";
		public $Pver = "";
		public $Agent = "Not reported";
		public $AOL = false;
		public $Image = "";
		public $Architecture = "";

		public function Browser($agent){
		

			// initialize properties
			$bd['platform'] = "Unknown";
			$bd['pver'] = "";
			$bd['browser'] = "Unknown";
			$bd['version'] = "";
			$this->Agent = $agent;

			// fl3r: sistemi operativi
			
			if (stripos($agent,'win'))
			{
				$bd['platform'] = "Windows";
				if(stripos($agent,'Windows 3.1'))
					$val = '3.1';
				elseif(stripos($agent,'Win16'))
					$val = '3.11';
				elseif(stripos($agent,'Windows 95'))
					$val = '95';
				elseif(stripos($agent,'Win95'))
					$val = '95';
				elseif(stripos($agent,'Windows_95'))
					$val = '95';
				elseif(stripos($agent,'Windows 98'))
					$val = '98';
				elseif(stripos($agent,'Win98'))
					$val = '98';
				elseif(stripos($agent,'Windows ME'))
					$val = 'ME';
				elseif(stripos($agent,'Windows NT 4.0'))
					$val = 'NT';
				elseif(stripos($agent,'WinNT4.0'))
					$val = 'NT';
				elseif(stripos($agent,'WinNT'))
					$val = 'NT';
				//elseif(stripos($agent,'Windows NT'))
					//$val = 'NT';
				elseif(stripos($agent,'Windows 2000'))
					$val = '2000';
				elseif(stripos($agent,'Windows NT 5.1'))
					$val = 'XP';
				elseif(stripos($agent,'Windows XP'))
					$val = 'XP';
				elseif(stripos($agent,'Windows NT 5.2'))
					$val = 'Server 2003';
				elseif(stripos($agent,'NT 5.2'))
					$val = 'Server 2003';
				elseif(stripos($agent,'Windows NT 6.0'))
					$val = 'Vista';
				elseif(stripos($agent,'Windows NT 6.1'))
					$val = '7';
				elseif(stripos($agent,'Windows NT 6.2'))
					$val = '8';
				elseif(stripos($agent,'Windows NT 6.3'))
					$val = '8.1';
				elseif(stripos($agent,'Windows NT 6.4'))
					$val = '10';
			elseif(stripos($agent,'Windows CE'))
				$val = 'CE';
			elseif(stripos($agent,'Windows CE 5.1'))
				$val = 'CE';
			elseif(stripos($agent,'WCE'))
				$val = 'Mobile';
			elseif(stripos($agent,'Windows Mobile'))
				$val = 'Mobile';
			elseif(stripos($agent,'Windows Phone'))
				$val = 'Phone';
				$bd['pver'] = $val;
			}
			
			// ios (os e browser)			
			elseif(preg_match('/iPad/i', $agent)){
				$bd['browser']= 'Safari';
				$bd['platform']="iPad";
				if(preg_match('/CPU\ OS\ ([._0-9a-zA-Z]+)/i', $agent, $regmatch))
					$bd['pver']=" iOS ".str_replace("_", ".", $regmatch[1]);
			}elseif(preg_match('/iPod/i', $agent)){
				$bd['browser']= 'Safari';
				$bd['platform']="iPod";
				if(preg_match('/iPhone\ OS\ ([._0-9a-zA-Z]+)/i', $agent, $regmatch))
					$bd['pver']=" iOS ".str_replace("_", ".", $regmatch[1]);
			}elseif(preg_match('/iPhone/i', $agent)){
				$bd['browser']= 'Safari';
				$bd['platform']="iPhone";
				if(preg_match('/iPhone\ OS\ ([._0-9a-zA-Z]+)/i', $agent, $regmatch))
					$bd['pver']=" iOS ".str_replace("_", ".", $regmatch[1]);
			}
			
			// amiga os
			elseif (stripos($agent,'Amiga-AWeb'))
				$bd['platform'] = "Amiga OS";
			elseif (stripos($agent,'AmigaOS'))
				$bd['platform'] = "Amiga OS";

			// aix
			elseif (stripos($agent,'AIX'))
				$bd['platform'] = "AIX";

			// android
			elseif(stripos($agent,'Android')) {
				$val = explode(" ",stristr($agent,"android"));
				$bd['platform'] = $val[0];
				$bd['pver'] = $val[1];
			}
			
			// aros
			elseif (stripos($agent,'AROS'))
				$bd['platform'] = "AROS";

			// bada
			elseif (stripos($agent,'Bada'))
				$bd['platform'] = "Bada";
			
			// beos
			elseif (stripos($agent,'BeOS'))
				$bd['platform'] = "BeOS";
			
			// blackberry
			elseif (stripos($agent,'Blackberry'))
				$bd['platform'] = "BlackBerry OS";
			elseif (stripos($agent,'BB10'))
				$bd['platform'] = "BlackBerry OS";
			elseif (stripos($agent,'RIM Tablet OS 1.0.0'))
				$bd['platform'] = "BlackBerry Tablet OS 1";
			elseif (stripos($agent,'RIM Tablet OS 2.1.0'))
				$bd['platform'] = "BlackBerry Tablet OS 2";

			// brew
			elseif (stripos($agent,'Brew'))
				$bd['platform'] = "Brew";
			
			// chrome os
			elseif (stripos($agent,'CrOS'))
				$bd['platform'] = "Chrome OS";
			
			// cos
			elseif (stripos($agent,'COS'))
				$bd['platform'] = "China Operating System";
			
			// danger os
			elseif (stripos($agent,'Danger hiptop'))
				$bd['platform'] = "DangerOS";
			
			// dragonfly bsd
			elseif (stripos($agent,'Dragonfly'))
				$bd['platform'] = "Dragonfly BSD";
			
			// fire os
			elseif (stripos($agent,'AFTB Build'))
				$bd['platform'] = "Fire OS";
			elseif (stripos($agent,'KFOT Build'))
				$bd['platform'] = "Fire OS";

			// freebsd
			elseif (stripos($agent,'FreeBSD amd64'))
				$bd['platform'] = "FreeBSD";
			elseif (stripos($agent,'FreeBSD i386'))
				$bd['platform'] = "FreeBSD";
			
			// linux
			elseif (stripos($agent,'GNU'))
				$bd['platform'] = "Linux";
				
			// haiku os
			elseif (stripos($agent,'Haiku BePC'))
				$bd['platform'] = "Haiku OS";
			
			// hp-ux
			elseif (stripos($agent,'HP-UX 9000'))
				$bd['platform'] = "Hewlett Packard UniX";
			
			// inferno os
			elseif (stripos($agent,'inferno'))
				$bd['platform'] = "Inferno OS";
			
			// ios ipad
			elseif (stripos($agent,'CPU OS 3_2 like Mac OS X'))
				$bd['platform'] = "iPad iOS 3";
			elseif (stripos($agent,'CPU OS 4_0 like Mac OS X'))
				$bd['platform'] = "iPad iOS 4";
			elseif (stripos($agent,'CPU OS 5_0 like Mac OS X'))
				$bd['platform'] = "iPad iOS 5";
			elseif (stripos($agent,'CPU OS 6_0 like Mac OS X'))
				$bd['platform'] = "iPad iOS 6";
			elseif (stripos($agent,'CPU OS 7_0 like Mac OS X'))
				$bd['platform'] = "iPad iOS 7";
			elseif (stripos($agent,'CPU OS 8_0 like Mac OS X'))
				$bd['platform'] = "iPad iOS 8";
			
			// ios iphone
			elseif (stripos($agent,'CPU iPhone OS 3_2 like Mac OS X'))
				$bd['platform'] = "iPhone iOS 3";
			elseif (stripos($agent,'CPU iPhone OS 4_0 like Mac OS X'))
				$bd['platform'] = "iPhone iOS 4";
			elseif (stripos($agent,'CPU iPhone OS 5_0 like Mac OS X'))
				$bd['platform'] = "iPhone iOS 5";
			elseif (stripos($agent,'CPU iPhone OS 6_0 like Mac OS X'))
				$bd['platform'] = "iPhone iOS 6";
			elseif (stripos($agent,'CPU iPhone OS 7_0 like Mac OS X'))
				$bd['platform'] = "iPhone iOS 7";
			elseif (stripos($agent,'CPU iPhone OS 8_0 like Mac OS X'))
				$bd['platform'] = "iPhone iOS 8";
			
			// jvm
			elseif(stripos($agent,'HotJava')){
				$bd['browser'] = 'Java';
				$bd['platform'] = 'Java Virtual Machine';
			}
			elseif(stripos($agent,'Java')){
				$bd['browser'] = 'Java';
				$bd['platform'] = 'Java Virtual Machine';
			}
			elseif(stripos($agent,'JRE')){
				$bd['browser'] = 'Java';
				$bd['platform'] = 'Java Virtual Machine';
			}
			
			// jvm platform micro edition
			elseif(stripos($agent,'J2ME')){
				$bd['browser'] = 'Java';
				$bd['platform'] = 'Java Micro Machine';
			}
			
			// linux
			elseif (stripos($agent,'Linux i686'))
				$bd['platform'] = "Linux";
			
			// linux arch
			elseif (stripos($agent,'Arch Linux i686'))
				$bd['platform'] = "Arch Linux";
			elseif (stripos($agent,'Arch Linux x86_x64'))
				$bd['platform'] = "Arch Linux";
			
			// linux gentoo
			elseif (stripos($agent,'Gentoo i686'))
				$bd['platform'] = "Gentoo";
			
			// linux mageia
			elseif (stripos($agent,'Mageia'))
				$bd['platform'] = "Mageia";
				
			// linux slackware
			elseif (stripos($agent,'Konqueror'))
				$bd['platform'] = "Slackware";
			
			// livearea (play station vita)				
			elseif(stripos($agent,'Playstation Vita')){
				$bd['platform'] = 'PlayStation Vita';
			}
			
			// macos
			elseif (stripos($agent,'MacOS'))
				$bd['platform'] = "Mac OS";
			
			// maemo
			elseif (stripos($agent,'Maemo'))
				$bd['platform'] = "Maemo";
			
			// meego
			elseif (stripos($agent,'MeeGo'))
				$bd['platform'] = "MeeGo";
			
			// minix
			elseif (stripos($agent,'Minix 3'))
				$bd['platform'] = "Minix 3";
			
			// morphos
			elseif (stripos($agent,'MorphOS'))
				$bd['platform'] = "MorphOS";
			
			// msn tv
			elseif (stripos($agent,'WebTV'))
				$bd['platform'] = "MSN TV";
			
			// netbsd
			elseif (stripos($agent,'NetBSD'))
				$bd['platform'] = "NetBSD";
			
			// nintendo ds
			elseif (stripos($agent,'Nintendo DS')){
				$bd['platform'] = "Nintendo DS";
				$bd['browser'] = "Bunjalloo";
				}
			
			// nintendo dsi
			elseif (stripos($agent,'Nintendo DSi')){
				$bd['platform'] = "Nintendo DSi";
				$bd['browser'] = "Nintendo DSi Browser";
				}
			
			// nintendo 3ds
			elseif (stripos($agent,'Nintendo 3DS')){
				$bd['platform'] = "Nintendo 3DS";
				$bd['browser'] = "Internet Browser";
			}
			
			// openbsd
			elseif (stripos($agent,'OpenBSD'))
				$bd['platform'] = "OpenBSD";
			
			// openvms
			elseif (stripos($agent,'OpenVMS'))
				$bd['platform'] = "OpenVMS";
			
			// orbis OS (playstation 4)
			elseif (stripos($agent,'PlayStation 4'))
				$bd['platform'] = "PlayStation 4";
			
			// os x
			elseif (stripos($agent,'Intel Mac OS X'))
				$bd['platform'] = "MacOS X";

			// os/2
			elseif (stripos($agent,'OS/2'))
				$bd['platform'] = "OS2";
			elseif (stripos($agent,'Warp 4'))
				$bd['platform'] = "OS2 Warp";
			elseif (stripos($agent,'Warp 4.5'))
				$bd['platform'] = "OS2 Warp";
			
			// palm OS
			elseif (stripos($agent,'Palm OS'))
				$bd['platform'] = "Palm OS";
			elseif (stripos($agent,'Palm OS 5.4.9'))
				$bd['platform'] = "Palm OS";
			
			// pc linux os
			elseif (stripos($agent,'PCLinuxOS'))
				$bd['platform'] = "PCLinuxOS";
				
			// qnx
			elseif (stripos($agent,'QNX x86px'))
				$bd['platform'] = "QNX";
			
			// risc os
			elseif (stripos($agent,'RISC OS'))
				$bd['platform'] = "RISC OS";
			
			// sailfish
			elseif (stripos($agent,'Sailfish'))
				$bd['platform'] = "Sailfish OS";
			
			// solaris
			elseif (stripos($agent,'SunOS'))
				$bd['platform'] = "Solaris";
				
			// syllable
			elseif (stripos($agent,'Syllable'))
				$bd['platform'] = "Syllable";
			
			// symbian os
			elseif (stripos($agent,'SymbOS'))
				$bd['platform'] = "Symbian OS";
				
			// tizen
			elseif (stripos($agent,'Tizen/1.0 like Android'))
				$bd['platform'] = "Tizen 1";
			elseif (stripos($agent,'Tizen 2.0'))
				$bd['platform'] = "Tizen 2";
			elseif (stripos($agent,'Tizen 2.1'))
				$bd['platform'] = "Tizen";
			elseif (stripos($agent,'Tizen 2.2'))
				$bd['platform'] = "Tizen";
			elseif (stripos($agent,'Tizen 2.3'))
				$bd['platform'] = "Tizen";
			
			// ubuntu
			elseif (stripos($agent,'Ubuntu'))
				$bd['platform'] = "Ubuntu";
			
			// webos
			elseif (stripos($agent,'webOS'))
				$bd['platform'] = "WebOS";
			
			// wii os (nintendo wii)
			elseif (stripos($agent,'Nintendo Wii'))
				$bd['platform'] = "Nintendo Wii";
			elseif (stripos($agent,'wii'))
				$bd['platform'] = "Nintendo Wii";	
			
			// wii u os (nintendo wii u)
			elseif (stripos($agent,'Nintendo WiiU')){
				$bd['platform'] = "Nintendo Wii U";
				$bd['browser'] = "NetFront Browser";
			}
			// wordpress
			elseif (stripos($agent,'wordpress'))
				$bd['platform'] = 'XML-RPC';
					
			// xbox
			elseif(stripos($agent,'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0; Xbox)'))
				$bd = 'Xbox 360';
			elseif(stripos($agent,'Mozilla/5.0 (compatible; MSIE 9.0; Windows Phone OS 7.5; Trident/5.0; IEMobile/9.0; Xbox)'))
				$bd = 'Xbox 360';
			elseif(stripos($agent,'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; Trident/3.1; Xbox)'))
				$bd = 'Xbox 360';
			elseif(stripos($agent,'Mozilla/4.0 (compatible; MSIE 7.0; Windows Phone OS 7.5; Trident/3.1; IEMobile/7.0; Xbox)'))
				$bd = 'Xbox 360';
			elseif(stripos($agent,'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0; Xbox; Xbox One)'))
				$bd = 'Xbox One';
			
			// xmb (playstation portable e playstation 3)
			elseif (stripos($agent,'PSP'))
				$bd['platform'] = "PlayStation Portable";
			elseif (stripos($agent,'PlayStation Portable'))
				$bd['platform'] = "PlayStation Portable";
			elseif (stripos($agent,'PLAYSTATION 3'))
				$bd['platform'] = "PlayStation 3";
			
			// fedora
			if(stripos($agent,'fedora'))
			{
				$val = explode(" ",stristr($agent,"fc"));
				$val = explode("fc",$val[0]);
				$bd['platform'] = 'Fedora '.$val[0];
				$bd['pver'] = $val[1];
			}
			
			// ubuntu
			if(stripos($agent,'ubuntu'))
			{
				$val = explode(" ",stristr($agent,"Ubuntu"));
				$val = explode("/",$val[0]);
				$bd['platform'] = $val[0];
				$bd['pver'] = $val[1];
			}
			
			// gentoo
			if(stripos($agent,'gentoo'))
				$bd['platform'] = 'Gentoo';
			
			// mint
			if(stripos($agent,'mint')) {
				$val = explode(" ",stristr($agent,"mint"));
				$val = explode("/",$val[0]);
				$bd['platform'] = 'Linux '.$val[0];
				$bd['pver'] = $val[1];
			}

//////////////////////////////////////////////////////////////////////////////
			
			// fl3r: browser
			// safari per ios si trova in os sotto windows

			// opera        
			if (stripos($agent,'opera') === 0){
				if(stristr($agent,'opera mini')){ // test for Opera Mini
					$bd['browser'] = "Opera Mini";
					$val = explode('Mini',$agent);
					$val = explode('.',$val[1]);
					$bd['version'] = $val[0].'.'.$val[1];
					}else{
					if(stripos($agent,'version/1')){ // test for Opera > 9
					$val = stristr($agent, "version/1");
					$val = explode("/",$val);
					$bd['browser'] = 'Opera';
					$bd['version'] = $val[1];
					}else{
				$val = stristr($agent, "opera");
					$val = explode("/",$val);
					$bd['browser'] = $val[0];
					$val = explode(" ",$val[1]);
					$bd['version'] = $val[0];
					}
				}
			}
			
			// k-meleon
			elseif(stripos($agent,'k-meleon')){
				$bd['browser'] = 'K-Meleon';
				$val = explode('K-Meleon',$agent);
				$bd['version'] = $val[1];
			}
			
			// shiira
			elseif(stripos($agent,'shiira')){
				$bd['browser'] = 'Shiira';
				$val = explode('Shiira',$agent);
				$val = explode(" ",$val[1]);
				$bd['version'] = $val[0];
			}
			
			// silk (amazon)
			elseif(stripos($agent,'sil')){
				$bd['browser'] = 'Silk';
				$val = explode('Silk',$agent);
				$val = explode(" ",$val[1]);
				$bd['version'] = $val[0];
			}
			
			// galeon
			elseif(stripos($agent,'galeon')){
				$bd['browser'] = "Galeon";
				$val = explode('Galeon',$agent);
				$val = explode(" ",$val[1]);
				$bd['version'] = $val[0];
			}
			
			// epiphany
			elseif(stripos($agent,'epiphany')){
				$bd['browser'] = 'Epiphany';
				$val = explode('Epiphany',$agent);
				$val = explode(" ",$val[1]);
				$bd['version'] = $val[0];
			}
			
			// camino
			elseif(stripos($agent,'camino')){
				$bd['browser'] = 'Camino';
				$val = explode('Camino',$agent);
				$val = explode(' ',$val[1]);
				$bd['version'] = $val[0];
			}
			
			// avant browser
			elseif(stripos($agent,'avant')){
				$bd['browser'] = 'Avant';
				$bd['version'] = 'Browser';
			}
			
			// acoo browser
			elseif(stripos($agent,'Acoo Browser')){
				$bd['browser'] = 'Acoo Browser';
				$val = explode('Acoo Browser',$agent);
				$val = explode(' ',$val[1]);
				$bd['version'] = $val[0];
			}
			
			// beonex
			elseif(stripos($agent,'Beonex')){
				$bd['browser'] = 'Beonex';
				$val = explode('Beonex',$agent);
				$val = explode(' ',$val[1]);
				$bd['version'] = $val[0];
			}
			
			// bon echo
			elseif(stripos($agent,'BonEcho')){
				$bd['browser'] = 'Bon Echo';
				$val = explode('Bon Echo',$agent);
				$val = explode(' ',$val[1]);
				$bd['version'] = $val[0];
			}
			
			// maxthon
			elseif(stripos($agent,'maxthon')){
			$bd['browser'] = 'Maxthon';
			$val = explode('MAXTHON',$agent);
			$val = explode(";",$val[1]);
			$bd['version'] = $val[0];
		}
		
			// flock
			elseif(stripos($agent,'Flock')){
				$bd['browser'] = 'Flock';
				$val = explode('Flock',$agent);
				$bd['version'] = $val[1];
			}
			
			// lunascape
			elseif(stripos($agent,'lunascape')){
				$bd['browser'] = 'Lunascape';
				$val = explode("lunascape",strtolower($agent));
				$bd['version'] = $val[1];
			}
			
			// konqueror
			elseif(stripos($agent,'konqueror')){
				$bd['browser'] = "Konqueror";
				$val = explode('Konqueror',$agent);
				$val = explode(";",$val[1]);
				$bd['version'] = $val[0];
			}
			
			// orca
			elseif(stripos($agent,'orca')){
				$bd['browser'] = 'Orca';
				$val = explode('Orca',$agent);
				$bd['version'] = $val[1];
			}
			
			// webtv
			elseif(stripos($agent,'webtv')){
				$val = explode("/",stristr($agent,"webtv"));
				$bd['browser'] = $val[0];
				$bd['version'] = $val[1];
			}
			
			// internet explorer 1
			elseif(stripos($agent,'microsoft internet explorer')){
				$bd['browser'] = "Internet Explorer";
				$bd['version'] = "1.0";
				$var = stristr($agent, "/");
				if (ereg("308|425|426|474|0b1", $var)){
					$bd['version'] = "1.5";
				}
			}
			
			// netpositive beos
			elseif(stripos($agent,'NetPositive')){
				$val = explode("/",stristr($agent,"NetPositive"));
				$bd['platform'] = "BeOS";
				$bd['browser'] = $val[0];
				$bd['version'] = $val[1];
			}
			
			// internet explorer
			elseif(stripos($agent,'msie') && !stripos($agent,'opera')){
				$val = explode(" ",stristr($agent,"msie"));
				$bd['browser'] = $val[0];
				$bd['version'] = $val[1];
			}
			
			// internet explorer mobile
			elseif(stripos($agent,'mspie') || stripos($agent,'pocket')){
				$val = explode(" ",stristr($agent,"mspie"));
				$bd['browser'] = "Internet Explorer";
				$bd['platform'] = "Windows CE";
				if (stripos($agent,'mspie'))
					$bd['version'] = $val[1];
				else {
					$val = explode('/',$agent);
					$bd['version'] = $val[1];
				}
			}
			// galeon
			elseif(stripos($agent,'galeon')){
				$val = explode(" ",stristr($agent,"galeon"));
				$val = explode("/",$val[0]);
				$bd['browser'] = $val[0];
				$bd['version'] = $val[1];
			}
			
			// konqueror
			elseif(stripos($agent,'Konqueror')){
				$val = explode(" ",stristr($agent,"Konqueror"));
				$val = explode("/",$val[0]);
				$bd['browser'] = $val[0];
				$bd['version'] = $val[1];
			}
			
			//icab
			elseif(stripos($agent,'icab')){
				$val = explode(" ",stristr($agent,"icab"));
				$bd['browser'] = $val[0];
				$bd['version'] = $val[1];
				
			}
			
			// omniweb
			elseif(stripos($agent,'omniweb')){
				$val = explode("/",stristr($agent,"omniweb"));
				$bd['browser'] = $val[0];
				$bd['version'] = $val[1];
			}
			
			// chrome
			elseif(stripos($agent,'chrome')){
				if(stripos($agent,'linux')){
				$bd['browser'] = 'Chromium';
				}else{
				$bd['browser'] = "Chrome";
				}
				$val = explode('Chrome',$agent);
				$val = explode(" ",$val[1]);
				$bd['version'] = $val[0];
			}
			
			// chromium
			
				elseif(stripos($agent,'chrome')){
				if(stripos($agent,'linux')){
				$bd['browser'] = 'Chromium';
				}else{
				$bd['browser'] = "Chromium";
				}
				$val = explode('Chromium',$agent);
				$val = explode(" ",$val[1]);
				$bd['version'] = $val[0];
			}
			
			// phoenix
			elseif(stripos($agent,'Phoenix')){
				$bd['browser'] = "Phoenix";
				$val = explode("/", stristr($agent,"Phoenix/"));
				$bd['version'] = $val[1];
			}
			
			// firebird
			elseif(stripos($agent,'firebird')){
				$bd['browser']="Firebird";
				$val = stristr($agent, "Firebird");
				$val = explode("/",$val);
				$bd['version'] = $val[1];
			}
			
			// mozilla firefox
			elseif(stripos($agent,'Firefox')){
				$bd['browser']="Firefox";
				$val = stristr($agent, "Mozilla Firefox");
				$val = explode("/",$val);
				$bd['version'] = $val[1];
			}
			
			// mozilla firefox nightly builds
			elseif(stripos($agent,'mozilla') && 
				stripos($agent,'rv:[0-9].[0-9][a-b]') && !stripos($agent,'netscape')){
				$bd['browser'] = "Mozilla Firefox Nightly Builds";
				$val = explode(" ",stristr($agent,"rv:"));
				stripos($agent,'rv:[0-9].[0-9][a-b]',$val);
				$bd['version'] = str_replace("rv:","",$val[0]);
			}
			
			// mozilla firefox stable
			elseif(stripos($agent,'mozilla') &&
				stripos($agent,'rv:[0-9]\.[0-9]') && !stripos($agent,'netscape')){
				$bd['browser'] = "Mozilla Firefox";
				$val = explode(" ",stristr($agent,"rv:"));
				stripos($agent,'rv:[0-9]\.[0-9]\.[0-9]',$val);
				$bd['version'] = str_replace("rv:","",$val[0]);
			}
			
			// linx e amaya
			elseif(stripos($agent,'libwww')){
				if (stripos($agent,'amaya')){
					$val = explode("/",stristr($agent,"amaya"));
					$bd['browser'] = "Amaya";
					$val = explode(" ", $val[1]);
					$bd['version'] = $val[0];
				} else {
					$val = explode('/',$agent);
					$bd['browser'] = "Lynx";
					$bd['version'] = $val[1];
				}
			}
			
			// safari
			elseif(stripos($agent,'safari')){
				$bd['browser'] = "Safari";
				$bd['version'] = "";
			}
			
			// ncsa mosaic
			elseif(stripos($agent,'NCSA Mosaic')){
				$bd['browser'] = "Mosaic";
				$bd['version'] = "";
			}
			elseif(stripos($agent,'NCSA_Mosaic')){
				$bd['browser'] = "Mosaic";
				$bd['version'] = "";
			}
			
			// netscape
			elseif(stripos($agent,'netscape')){
				$val = explode(" ",stristr($agent,"netscape"));
				$val = explode("/",$val[0]);
				$bd['browser'] = $val[0];
				$bd['version'] = $val[1];
			}elseif(stripos($agent,'mozilla') && !stripos($agent,'rv:[0-9]\.[0-9]\.[0-9]')){
				$val = explode(" ",stristr($agent,"mozilla"));
				$val = explode("/",$val[0]);
				$bd['browser'] = "Netscape Navigator";
				$bd['version'] = $val[1];
			}
			elseif(stripos($agent,'navigator')){
				$bd['browser'] = "Netscape Navigator";
				$bd['version'] = "";
			}
			
			// clean up extraneous garbage that may be in the name
			$bd['browser'] = ereg_replace("[^a-z,A-Z,-]", "", $bd['browser']);
			// clean up extraneous garbage that may be in the version        
			$bd['version'] = ereg_replace("[^0-9,.,a-z,A-Z]", "", $bd['version']);
			
			// aol explorer
			if (stripos($agent,'AOL')){
				$var = stristr($agent, "AOL");
				$var = explode(" ", $var);
				$bd['aol'] = ereg_replace("[^0-9,.,a-z,A-Z]", "", $var[1]);
			}
			
			// wordpress
			if (stripos($agent,'wordpress'))
			{
				$val = stristr($agent, "wordpress");
				$val = explode("/",$val);
				$var = explode(" ", $var);
				$bd['browser'] = $val[0];
				$bd['version'] = $val[1];
			}
			
			// snoopy
			if (stripos($agent,'Snoopy') === 0)
			{
				$val = stristr($agent, "Snoopy");
				$val = explode("v",$val);
				$var = explode(" ", $var);
				$bd['browser'] = $val[0];
				$bd['version'] = $val[1];
			}
			
//////////////////////////////////////////////////////////////////////////////

			// fl3r: spider, bot, crawler
			
			// google bot
			elseif(stripos($agent,'GoogleBot')){
				$bd['browser'] = 'GoogleBot';
				$bd['platform'] = 'Google';
				$val = explode('GoogleBot',$agent);
				$val = explode(' ',$val[1]);
				$bd['version'] = $val[0];
			}
			elseif(stripos($agent,'http://www.googlebot.com/bot.html')){
				$bd['browser'] = 'GoogleBot';
				$bd['platform'] = 'Google';
				$val = explode('GoogleBot',$agent);
				$val = explode(' ',$val[1]);
				$bd['version'] = $val[0];
			}
			elseif(stripos($agent,'http://www.google.com/bot.html')){
				$bd['browser'] = 'GoogleBot';
				$bd['platform'] = 'Google';
				$val = explode('GoogleBot',$agent);
				$val = explode(' ',$val[1]);
				$bd['version'] = $val[0];
			}
			
			// bing bot
			elseif(stripos($agent,'BingBot')){
				$bd['browser'] = 'BingBot';
				$bd['platform'] = 'Bing';
				$val = explode('BingBot',$agent);
				$val = explode(' ',$val[1]);
				$bd['version'] = $val[0];
			}
			
			// yahoo slurp bot
			elseif(stripos($agent,'Yahoo! Slurp')){
				$bd['browser'] = 'Yahoo! Slurp';
				$bd['platform'] = 'Yahoo!';
				$val = explode('Yahoo! Slurp',$agent);
			}
			
			// yandex bot
			elseif(stripos($agent,'YandexBot')){
				$bd['browser'] = 'YandexBot';
				$bd['platform'] = 'Yandex';
				$val = explode('YandexBot',$agent);
			}
			
//////////////////////////////////////////////////////////////////////////////				

			// architettura x86/x64
			if(stripos($agent,'x86_64')) {
				$bd['architecture'] = "x86_64";
			}
			
			// finally assign our properties
			$this->Name = $bd['browser'];
			$this->Version = $bd['version'];
			$this->Platform = $bd['platform'];
			$this->Pver = $bd['pver'];
			$this->AOL = $bd['aol'];
			$this->Architecture = $bd['architecture'];

			
			// fl3r: assegna immagini browser
			
			$this->BrowserImage = strtolower($this->Name);
			if($this->BrowserImage == "msie")
				$this->BrowserImage .=  '-'.$this->Version;
			
			// snoopy
			elseif(stripos($this->BrowserImage, "snoopy") === 0)
				$this->BrowserImage = 'other';
			
			
			// fl3r: assegna immagini os
			
			$this->PlatformImage = strtolower($this->Platform);
			
			if($this->PlatformImage == "linux mint")
				$this->PlatformImage = "linux-mint";
			if($this->PlatformImage == "fedora ")
				$this->PlatformImage = "fedora";	
			if($this->PlatformImage == "windows")
				$this->PlatformImage .=  '-'.strtolower($this->Pver);
			
		}
	}
?>
