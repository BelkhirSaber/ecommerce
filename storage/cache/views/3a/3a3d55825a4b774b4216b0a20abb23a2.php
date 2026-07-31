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

/* admin/partials/scripts.twig */
class __TwigTemplate_2f52ef5de8776d93986b4ec63ca6764d extends Template
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
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield (string) $this->env->getFunction('vite_client')->getCallable()();
        yield "

<script
    type=\"module\"
    src=\"";
        // line 5
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('vite_asset')->getCallable()("admin-bundle.js"), "html", null, true);
        yield "\"
></script>

";
        // line 8
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        yield from [];
    }

    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/partials/scripts.twig";
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
        return array (  57 => 8,  51 => 5,  44 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{{ vite_client()|raw }}

<script
    type=\"module\"
    src=\"{{ vite_asset(\x27admin-bundle.js\x27) }}\"
></script>

{% block javascripts %}{% endblock %}
", "admin/partials/scripts.twig", "C:\\xampp\\htdocs\\ecommerce\\Views\\admin\\partials\\scripts.twig");
    }
}
