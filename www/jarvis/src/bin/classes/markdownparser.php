<?php

class markdownparser {
	private static $patterns = [
		'/^# (.+)/m' => '<h1>$1</h1>',
		'/^## (.+)/m' => '<h2>$1</h2>',
		'/^### (.+)/m' => '<h3>$1</h3>',
		'/(\*\*|__)(.*?)\1/' => '<strong>$2</strong>',
		'/(\*|_)(.*?)\1/' => '<em>$2</em>',
		'/~~(.*?)~~/' => '<del>$1</del>',
		'/^\*(.*)$/m' => '<li>$1</li>',
		'/^(?<!<\/li>)\n(?!\s*$)/m' => '</ul><ul>',
		'/^\d\.(.*)$/m' => '<li>$1</li>',
		'/```(.+?)```/s' => '<code class="command">$1</code>',
		'/`(.+?)`/' => '<code>$1</code>',
		'/\[(.*?)\]\((.*?)\)/' => '<a href="$2">$1</a>',
		'/!\[(.*?)\]\((.*?)\)/' => '<img src="$2" alt="$1">',
	];

    public static function render($text) {
		$replacements = array_values(self::$patterns);
        $patterns = array_keys(self::$patterns);
        return '<div class="card">' . preg_replace($patterns, $replacements, $text) . '</div>';
    }
}