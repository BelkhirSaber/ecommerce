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

/* components/admin/footer.twig */
class __TwigTemplate_fca19c02b8c3622648ddd4ea9d4fe550 extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<footer class=\"main-footer\">

    <strong>

        Copyright &copy; 2024

        <a href=\"#\">
            B3S Store
        </a>.

    </strong>

    All rights reserved.


    <div class=\"float-right d-none d-sm-inline-block\">

        <b>Version</b>

        ";
        // line 20
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("appVersion", $context)) ? (Twig\Extension\CoreExtension::default(($context["appVersion"] ?? null), "1.0.0")) : ("1.0.0")), "html", null, true);
        yield "

    </div>

</footer>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "components/admin/footer.twig";
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
        return array (  64 => 20,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<footer class=\"main-footer\">

    <strong>

        Copyright &copy; 2024

        <a href=\"#\">
            B3S Store
        </a>.

    </strong>

    All rights reserved.


    <div class=\"float-right d-none d-sm-inline-block\">

        <b>Version</b>

        {{ appVersion|default(\x271.0.0\x27) }}

    </div>

</footer>", "components/admin/footer.twig", "C:\\xampp\\htdocs\\ecommerce\\Views\\components\\admin\\footer.twig");
    }
}
