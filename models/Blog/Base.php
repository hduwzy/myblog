<?php
class Blog_Base
{
	public static function test()
	{
		var_dump(Config::get('blog.test.*'));
	}
}