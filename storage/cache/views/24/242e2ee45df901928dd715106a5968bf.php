<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Sandbox\SecurityNotAllowedTestError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* admin/layout.twig */
class __TwigTemplate_64c8d620d009e9501ec8b80dc1dfaca9 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">

<head>
    ";
        // line 5
        yield from $this->load("admin/partials/head.twig", 5)->unwrap()->yield($context);
        // line 6
        yield "</head>

";
        // line 8
        $context["base_path"] = (((($tmp = Twig\Extension\CoreExtension::constant("RACINE")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? (("/" . Twig\Extension\CoreExtension::constant("RACINE"))) : (""));
        // line 9
        yield "
<body class=\"hold-transition sidebar-mini layout-fixed\">

<div class=\"wrapper\">

    ";
        // line 14
        yield from $this->load("components/admin/header.twig", 14)->unwrap()->yield($context);
        // line 15
        yield "    ";
        yield from $this->load("components/admin/sidebar.twig", 15)->unwrap()->yield($context);
        // line 16
        yield "
    <div class=\"content-wrapper\">

        ";
        // line 19
        yield from $this->load("admin/partials/breadcrumbs.twig", 19)->unwrap()->yield($context);
        // line 20
        yield "
        <section class=\"content\">
            <div class=\"container-fluid\">
                ";
        // line 23
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 24
        yield "            </div>
        </section>

    </div>

    ";
        // line 29
        yield from $this->load("components/admin/footer.twig", 29)->unwrap()->yield($context);
        // line 30
        yield "
</div>

";
        // line 33
        yield from $this->load("admin/partials/scripts.twig", 33)->unwrap()->yield($context);
        // line 34
        yield "
</body>
</html>
";
        yield from [];
    }

    // line 23
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/layout.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  108 => 23,  100 => 34,  98 => 33,  93 => 30,  91 => 29,  84 => 24,  82 => 23,  77 => 20,  75 => 19,  70 => 16,  67 => 15,  65 => 14,  58 => 9,  56 => 8,  52 => 6,  50 => 5,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">

<head>
    {% include \x27admin/partials/head.twig\x27 %}
</head>

{% set base_path = constant(\x27RACINE\x27) ? \x27/\x27 ~ constant(\x27RACINE\x27) : \x27\x27 %}

<body class=\"hold-transition sidebar-mini layout-fixed\">

<div class=\"wrapper\">

    {% include \x27components/admin/header.twig\x27 %}
    {% include \x27components/admin/sidebar.twig\x27 %}

    <div class=\"content-wrapper\">

        {% include \x27admin/partials/breadcrumbs.twig\x27 %}

        <section class=\"content\">
            <div class=\"container-fluid\">
                {% block content %}{% endblock %}
            </div>
        </section>

    </div>

    {% include \x27components/admin/footer.twig\x27 %}

</div>

{% include \x27admin/partials/scripts.twig\x27 %}

</body>
</html>
", "admin/layout.twig", "C:\\xampp\\htdocs\\ecommerce\\Views\\admin\\layout.twig");
    }
}
