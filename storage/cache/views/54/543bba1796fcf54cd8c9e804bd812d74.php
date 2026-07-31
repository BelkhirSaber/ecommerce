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

/* admin/partials/head.twig */
class __TwigTemplate_570bdb2affbf6bfc46907f1198c47a28 extends Template
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
            'stylesheets' => [$this, 'block_stylesheets'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

<title>
    ";
        // line 5
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("pageTitle", $context)) ? (Twig\Extension\CoreExtension::default(($context["pageTitle"] ?? null), "Admin Dashboard")) : ("Admin Dashboard")), "html", null, true);
        yield " | B3S Store
</title>

";
        // line 8
        yield (string) $this->env->getFunction('vite_css')->getCallable()("admin-bundle.js");
        yield "

";
        // line 10
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        yield from [];
    }

    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/partials/head.twig";
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
        return array (  61 => 10,  56 => 8,  50 => 5,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

<title>
    {{ pageTitle|default(\x27Admin Dashboard\x27) }} | B3S Store
</title>

{{ vite_css(\x27admin-bundle.js\x27)|raw }}

{% block stylesheets %}{% endblock %}
", "admin/partials/head.twig", "C:\\xampp\\htdocs\\ecommerce\\Views\\admin\\partials\\head.twig");
    }
}
