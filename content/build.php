<?php

require __DIR__ . '/../vendor/autoload.php';

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\CommonMark\Node\Block\FencedCode;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use Symfony\Component\Yaml\Yaml;

const REPO     = 'https://github.com/xtompie/dx/blob/master/';
const BASE_URL = 'https://xtompie.github.io/dx/';
const SITE     = 'DX';
const DESC     = 'Build modular, scalable frontends in plain HTML and JavaScript. No framework, no npm, no build step.';

$ROOT = dirname(__DIR__);
$OUT  = "$ROOT/docs";
$NAV  = require "$ROOT/content/nav.php";
$MD   = make_md();

rmrf($OUT);
@mkdir($OUT, 0777, true);

foreach (array_merge(["$ROOT/index.md"], glob("$ROOT/content/*.md")) as $file) {
    [$fm, $md] = frontmatter(file_get_contents($file));
    $name = pathinfo($file, PATHINFO_FILENAME);           // file name is the URL
    $body = includes($MD->convert($md)->getContent(), $ROOT);
    file_put_contents("$OUT/$name.html", page($fm, $body, "$name.html", $NAV));
}

copy_into("$ROOT/assets", $OUT);
echo "built → docs/\n";

// Run the layout template against a page's variables and capture its output.
function page(array $fm, string $body, string $current, array $nav): string
{
    $title   = $fm['title'] ?? SITE;
    $desc    = $fm['description'] ?? DESC;
    $landing = ($fm['layout'] ?? '') === 'landing';
    $next    = nav_next($nav, $current);
    ob_start();
    include __DIR__ . '/page.php';
    return ob_get_clean();
}

// Flatten the nav in order and return the entry after the current page, or null.
function nav_next(array $nav, string $current): ?array
{
    $flat = [];
    foreach ($nav as $items) {
        foreach ($items as [$title, $href]) $flat[] = ['title' => $title, 'href' => $href];
    }
    foreach ($flat as $i => $entry) {
        if ($entry['href'] === $current) return $flat[$i + 1] ?? null;
    }
    return null;
}

// Sidebar html from the nav.php array.
function nav_html(array $nav, string $current): string
{
    $out = '';
    foreach ($nav as $group => $items) {
        $out .= '<div class="nav-group">';
        if ($group !== '') $out .= '<div class="nav-title">' . htmlspecialchars($group) . '</div>';
        foreach ($items as [$title, $href]) {
            $active = $href === $current ? ' class="active"' : '';
            $out .= "<a$active href=\"" . htmlspecialchars($href) . '">' . htmlspecialchars($title) . '</a>';
        }
        $out .= '</div>';
    }
    return $out;
}

// Resolve the include comments left untouched by the markdown pass.
//   <!-- include:      path --> → the file's code, highlighted, as a plain block
//   <!-- source:       path --> → just a link to the source
//   <!-- include-html: path --> → the file's contents, raw, so it renders live on the page
//   <!-- include-js:   path --> → the file wrapped in <script>, so it runs
//   <!-- include-css:  path --> → the file wrapped in <style>, so it applies
// The specific -html/-js/-css forms run before the plain include: so it never eats them.
function includes(string $html, string $root): string
{
    $html = preg_replace_callback('/<!--\s*include-html:\s*(\S+)\s*-->/', fn($m) => raw_file($m[1], $root), $html);
    $html = preg_replace_callback('/<!--\s*include-js:\s*(\S+)\s*-->/',   fn($m) => wrap_file($m[1], $root, 'script'), $html);
    $html = preg_replace_callback('/<!--\s*include-css:\s*(\S+)\s*-->/',  fn($m) => wrap_file($m[1], $root, 'style'), $html);
    $html = preg_replace_callback('/<!--\s*include:\s*(\S+)\s*-->/',      fn($m) => include_code($m[1], $root), $html);
    $html = preg_replace_callback('/<!--\s*source:\s*(\S+)\s*-->/',       fn($m) => source_link($m[1], $root), $html);
    return $html;
}

// Raw file contents (rendered live). Wrapped file contents (runs / applies).
function raw_file(string $path, string $root): string
{
    $path = ltrim($path, '/');
    return is_file("$root/$path") ? file_get_contents("$root/$path") : '<!-- include-html not found: ' . htmlspecialchars($path) . ' -->';
}

function wrap_file(string $path, string $root, string $tag): string
{
    $path = ltrim($path, '/');
    if (!is_file("$root/$path")) return "<!-- include-$tag not found: " . htmlspecialchars($path) . ' -->';
    return "<$tag>\n" . rtrim(file_get_contents("$root/$path"), "\n") . "\n</$tag>";
}

function include_code(string $path, string $root): string
{
    $path = ltrim($path, '/');
    if (!is_file("$root/$path")) return '<pre><code class="hljs">// include not found: ' . htmlspecialchars($path) . '</code></pre>';
    return highlight(ext_lang($path), rtrim(file_get_contents("$root/$path"), "\n"));
}

function source_link(string $path, string $root): string
{
    $path = ltrim($path, '/');
    if (!is_file("$root/$path")) return '<p class="code-src">source not found: ' . htmlspecialchars($path) . '</p>';
    $name = basename($path);
    return '<p class="code-src">Source: <a href="' . htmlspecialchars(REPO . $path) . '" target="_blank" rel="noopener">' . htmlspecialchars($name) . '</a></p>';
}

// Highlight language from a file extension.
function ext_lang(string $path): string
{
    return ['js' => 'javascript', 'php' => 'php', 'html' => 'xml', 'css' => 'css', 'json' => 'json'][strtolower(pathinfo($path, PATHINFO_EXTENSION))] ?? '';
}

// Build-time syntax highlighting, shared by fenced blocks and includes.
function highlight(string $lang, string $code): string
{
    static $hl = null;
    $hl ??= new \Highlight\Highlighter();
    try {
        $r = $lang
            ? $hl->highlight($lang, $code)
            : $hl->highlightAuto($code, ['javascript', 'xml', 'css', 'json', 'php', 'bash']);
        return '<pre><code class="hljs language-' . $r->language . '">' . $r->value . '</code></pre>';
    } catch (\Throwable $e) {
        return '<pre><code class="hljs">' . htmlspecialchars($code, ENT_QUOTES) . '</code></pre>';
    }
}

// Markdown: CommonMark, headings get slug ids, fenced code gets highlighted.
function make_md(): MarkdownConverter
{
    $env = new Environment();
    $env->addExtension(new CommonMarkCoreExtension());
    $env->addRenderer(FencedCode::class, new class implements NodeRendererInterface {
        private array $map = ['js' => 'javascript', 'html' => 'xml', 'sh' => 'bash', 'shell' => 'bash'];
        public function render(Node $node, ChildNodeRendererInterface $c): string
        {
            if (!$node instanceof FencedCode) return '';
            $info = $node->getInfoWords()[0] ?? '';
            return highlight($this->map[$info] ?? $info, rtrim($node->getLiteral(), "\n"));
        }
    });
    $env->addRenderer(Heading::class, new class implements NodeRendererInterface {
        public function render(Node $node, ChildNodeRendererInterface $c): string
        {
            if (!$node instanceof Heading) return '';
            $l = $node->getLevel();
            $inner = $c->renderNodes($node->children());
            $slug = trim(preg_replace('/[^a-z0-9]+/', '-', strtolower(html_entity_decode(strip_tags($inner), ENT_QUOTES))), '-');
            if ($slug === '') return "<h$l>$inner</h$l>";
            $s = htmlspecialchars($slug);
            return "<h$l id=\"$s\">$inner<a class=\"anchor\" href=\"#$s\" aria-hidden=\"true\">#</a></h$l>";
        }
    });
    return new MarkdownConverter($env);
}

// Split a "--- yaml ---" front matter block from the markdown body.
function frontmatter(string $raw): array
{
    if (preg_match('/^---\R(.*?)\R---\R?(.*)$/s', $raw, $m)) {
        return [Yaml::parse($m[1]) ?: [], $m[2]];
    }
    return [[], $raw];
}

function rmrf(string $p): void
{
    if (!file_exists($p)) return;
    if (!is_dir($p)) { @unlink($p); return; }
    foreach (scandir($p) as $f) if ($f !== '.' && $f !== '..') rmrf("$p/$f");
    @rmdir($p);
}

function copy_into(string $src, string $dst): void
{
    if (!is_dir($src)) return;
    @mkdir($dst, 0777, true);
    foreach (scandir($src) as $f) {
        if ($f === '.' || $f === '..') continue;
        is_dir("$src/$f") ? copy_into("$src/$f", "$dst/$f") : copy("$src/$f", "$dst/$f");
    }
}
