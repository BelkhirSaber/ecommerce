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

/* admin/partials/breadcrumbs.twig */
class __TwigTemplate_f3500db8afd5c26c60fdd35fb693a20a extends Template
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
        yield "<div class=\"content-header\">
    <div class=\"container-fluid\">

        <div class=\"row mb-2\">

            <div class=\"col-sm-6\">
                <h1 class=\"m-0\">
                    ";
        // line 8
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("pageTitle", $context)) ? (Twig\Extension\CoreExtension::default(($context["pageTitle"] ?? null), "Dashboard")) : ("Dashboard")), "html", null, true);
        yield "
                </h1>
            </div>

            <div class=\"col-sm-6\">

                <ol class=\"breadcrumb float-sm-right\">

                    <li class=\"breadcrumb-item\">
                        <a href=\"";
        // line 17
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/dashboard\">
                            Home
                        </a>
                    </li>

                    <li class=\"breadcrumb-item active\">
                        ";
        // line 23
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("pageTitle", $context)) ? (Twig\Extension\CoreExtension::default(($context["pageTitle"] ?? null), "Dashboard")) : ("Dashboard")), "html", null, true);
        yield "
                    </li>

                </ol>

            </div>

        </div>

    </div>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/partials/breadcrumbs.twig";
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
        return array (  73 => 23,  64 => 17,  52 => 8,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<div class=\"content-header\">
    <div class=\"container-fluid\">

        <div class=\"row mb-2\">

            <div class=\"col-sm-6\">
                <h1 class=\"m-0\">
                    {{ pageTitle|default(\x27Dashboard\x27) }}
                </h1>
            </div>

            <div class=\"col-sm-6\">

                <ol class=\"breadcrumb float-sm-right\">

                    <li class=\"breadcrumb-item\">
                        <a href=\"{{ base_path }}/admin/dashboard\">
                            Home
                        </a>
                    </li>

                    <li class=\"breadcrumb-item active\">
                        {{ pageTitle|default(\x27Dashboard\x27) }}
                    </li>

                </ol>

            </div>

        </div>

    </div>
</div>
", "admin/partials/breadcrumbs.twig", "C:\\xampp\\htdocs\\ecommerce\\Views\\admin\\partials\\breadcrumbs.twig");
    }
}
