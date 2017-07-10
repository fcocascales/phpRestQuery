<?php // Proinf.net — 2017

	class URL {

		//---------------------------------------------
		// MAKE

		public static function make(string $server, string $uri="", array $query=array()): string {
			$url = self::absolute($server);
			if (!empty($uri)) {
				if (is_array($uri)) $url .= '/'.implode('/', $uri);
				else $url .= '/'.trim($uri, '/');
			}
			if (!empty($query)) $url .= '?'.http_build_query($query);
			return $url;
		}

		//---------------------------------------------
		// ABSOLUTE

		/*
			If it's necessary add protocol, domain and directory to file
				'FILE' --> 'http://domain/directory/FILE'
				'subdir/FILE' --> 'http://domain/directory/subdir/FILE'
				'/folder/FILE' --> 'http://domain/folder/FILE'
				'http://domain/directory/FILE' --> http://domain/directory/FILE
		*/
		public static function absolute(string $file): string {
			if (self::starts_with($file, 'http://','https://','//')) {
				return $file;
			}
			$domain = self::protocol().self::domain();
			if (self::starts_with($file, '..')) {
				$file = self::strip_parents($file);
				////echo "<li>DIR=".self::directory()."</li>";
				////echo "<li>FILE=$file</li>";
				return self::suffix_slash($domain).trim($file, '/');
			}
			else {
				$directory = self::starts_with($file, '/')? '' : self::directory();
				return self::suffix_slash($domain).self::suffix_slash($directory).trim($file, '/');
			}
		}

		/*
			Strip references to parent directory
				'file',              'dir1/dir2/dir3' --> 'dir1/dir2/dir3/file'
				'../file',           'dir1/dir2/dir3' --> 'dir1/dir2/file'
				'../../file',        'dir1/dir2/dir3' --> 'dir1/file'
				'../folder/file',    'dir1/dir2/dir3' --> 'dir1/dir2/folder/file'
				'../../folder/file', 'dir1/dir2/dir3' --> 'dir1/folder/file'
				'/file',             'dir1/dir2/dir3' --> '/file'
				'/folder/file',      'dir1/dir2/dir3' --> '/folder/file'
		*/
		static function strip_parents(string $file, string $directory=""): string {
			if (empty($directory)) $directory = self::directory();
			if (self::starts_with($file, '/')) {
				return $file;
			}
			if (self::starts_with($file, '..')) {
				$dirs = explode('/', trim($directory, '/'));
				$items = explode('/', $file);
				$upperDir = count($dirs)-1;
				$upperItem = count($items)-1;
				for ($i=0; $i<=$upperItem; $i++) {
					if ($items[$i] == '..') {
						if ($i <= $upperDir) unset($dirs[$upperDir-$i]);
						unset($items[$i]);
					}
					else break;
				}
				return self::suffix_slash(implode('/', $dirs)).implode('/', $items);
			}
			return self::suffix_slash($directory).$file;
		}

		/*
			Finalize with slash only if no empty
				'' --> '';
				'/'--> '';
				'dir' --> 'dir/';
				'dir/' --> 'dir/';
		*/
		static function suffix_slash(string $dir): string {
			$dir = trim($dir, '/');
			if (!empty($dir)) $dir .= '/';
			return $dir;
		}

		/*
			Add protocol, domain and directory to file.
				'file' --> 'http://domain/directory/file'
		*/
		public static function get(string $file): string {
			$uri = dirname($_SERVER['REQUEST_URI']);
			return self::protocol().self::domain()."$uri/$file";
		}

		/*
			Get base url
		*/
		public static function base(): string {
			$uri = dirname($_SERVER['REQUEST_URI']);
			$file = basename($_SERVER["SCRIPT_FILENAME"]);
			return self::protocol().self::domain()."$uri/$file";
		}

		/*
			Get directory:
		 		'http://domain/dir1/dir2/file.php' --> '/dir1/dir2'
		*/
		public static function directory(): string {
			$directory = dirname($_SERVER['REQUEST_URI']);
			return $directory;
		}
		/*
			Get domain:
				'http://domain/dir1/dir2/file.php' --> 'domain'
		*/
		public static function domain(): string {
	    $domain = $_SERVER['HTTP_HOST'];
	    return $domain;
		}
		/*
			Get protocol:
				'http://domain/dir1/dir2/file.php' --> 'http://'
		*/
		public static function protocol(): string {
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'
				|| $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			return $protocol;
		}

		//---------------------------------------------
		// MISC

		static function starts_with(string $string, ...$prefixes): bool {
			foreach($prefixes as $prefix) {
				if (substr($string, 0, strlen($prefix)) === $prefix) return true;
			}
			return false;
		}
		static function contains(string $haystack, ...$needles): bool {
			foreach($needles as $needle) {
				if (strpos($haystack, $needle) !== false) return true;
			}
			return false;
		}



	}
