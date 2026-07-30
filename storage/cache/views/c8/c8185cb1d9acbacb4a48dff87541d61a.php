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

/* admin/dashboard.twig */
class __TwigTemplate_3fb9490d616f2a17c424daa07346c2c7 extends Template
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

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "admin/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 3
        $context["pageTitle"] = "Dashboard";
        // line 1
        $this->parent = $this->load("admin/layout.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 6
        yield "
    <!-- Info boxes -->
    <div class=\"row\">

        <div class=\"col-lg-3 col-6\">
            <div class=\"small-box bg-info\">
                <div class=\"inner\">
                    <h3>";
        // line 13
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("orders_today", $context)) ? (Twig\Extension\CoreExtension::default(($context["orders_today"] ?? null), 0)) : (0)), "html", null, true);
        yield "</h3>
                    <p>Commandes aujourd\x27hui</p>
                </div>

                <div class=\"icon\">
                    <i class=\"fas fa-shopping-cart\"></i>
                </div>

                <a
                    href=\"";
        // line 22
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/orders\"
                    class=\"small-box-footer\"
                >
                    Plus d\x27infos
                    <i class=\"fas fa-arrow-circle-right\"></i>
                </a>
            </div>
        </div>


        <div class=\"col-lg-3 col-6\">
            <div class=\"small-box bg-danger\">
                <div class=\"inner\">
                    <h3>";
        // line 35
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("orders_month", $context)) ? (Twig\Extension\CoreExtension::default(($context["orders_month"] ?? null), 0)) : (0)), "html", null, true);
        yield "</h3>
                    <p>Commandes ce mois</p>
                </div>

                <div class=\"icon\">
                    <i class=\"fas fa-shopping-cart\"></i>
                </div>

                <a
                    href=\"";
        // line 44
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/orders\"
                    class=\"small-box-footer\"
                >
                    Plus d\x27infos
                    <i class=\"fas fa-arrow-circle-right\"></i>
                </a>
            </div>
        </div>


        <div class=\"col-lg-3 col-6\">
            <div class=\"small-box bg-success\">
                <div class=\"inner\">
                    <h3>
                        ";
        // line 58
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber(((array_key_exists("total_revenue", $context)) ? (Twig\Extension\CoreExtension::default(($context["total_revenue"] ?? null), 0)) : (0)), 2, ".", ","), "html", null, true);
        yield "
                        ";
        // line 59
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("currency", $context)) ? (Twig\Extension\CoreExtension::default(($context["currency"] ?? null), "€")) : ("€")), "html", null, true);
        yield "
                    </h3>

                    <p>Chiffre d\x27affaires</p>
                </div>

                <div class=\"icon\">
                    <i class=\"fas fa-euro-sign\"></i>
                </div>

                <a
                    href=\"";
        // line 70
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/analytics\"
                    class=\"small-box-footer\"
                >
                    Plus d\x27infos
                    <i class=\"fas fa-arrow-circle-right\"></i>
                </a>
            </div>
        </div>


        <div class=\"col-lg-3 col-6\">
            <div class=\"small-box bg-warning\">
                <div class=\"inner\">
                    <h3>";
        // line 83
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("total_client", $context)) ? (Twig\Extension\CoreExtension::default(($context["total_client"] ?? null), 0)) : (0)), "html", null, true);
        yield "</h3>
                    <p>Clients</p>
                </div>

                <div class=\"icon\">
                    <i class=\"fas fa-users\"></i>
                </div>

                <a
                    href=\"";
        // line 92
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/customers\"
                    class=\"small-box-footer\"
                >
                    Plus d\x27infos
                    <i class=\"fas fa-arrow-circle-right\"></i>
                </a>
            </div>
        </div>

    </div>


    <!-- DataTable - Last 10 orders -->
    <div class=\"row\">
        <div class=\"col-md-12\">

            <table id=\"admin-dashboard\" class=\"display\">

                <thead>
                    <tr>
                        <th>Column 1</th>
                        <th>Column 2</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>

            </table>

        </div>
    </div>


    <!-- Chart -->
    <div class=\"row\">

        <div class=\"col-md-12\">

            <div class=\"card\">

                <div class=\"card-header\">
                    <h3 class=\"card-title\">
                        Ventes mensuelles
                    </h3>
                </div>

                <div class=\"card-body\">

                    <canvas
                        id=\"salesChart\"
                        style=\"height: 300px;\"
                    ></canvas>

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
        return "admin/dashboard.twig";
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
        return array (  174 => 92,  162 => 83,  146 => 70,  132 => 59,  128 => 58,  111 => 44,  99 => 35,  83 => 22,  71 => 13,  62 => 6,  55 => 5,  50 => 1,  48 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"admin/layout.twig\" %}

{% set pageTitle = \"Dashboard\" %}

{% block content %}

    <!-- Info boxes -->
    <div class=\"row\">

        <div class=\"col-lg-3 col-6\">
            <div class=\"small-box bg-info\">
                <div class=\"inner\">
                    <h3>{{ orders_today|default(0) }}</h3>
                    <p>Commandes aujourd\x27hui</p>
                </div>

                <div class=\"icon\">
                    <i class=\"fas fa-shopping-cart\"></i>
                </div>

                <a
                    href=\"{{ base_path }}/admin/orders\"
                    class=\"small-box-footer\"
                >
                    Plus d\x27infos
                    <i class=\"fas fa-arrow-circle-right\"></i>
                </a>
            </div>
        </div>


        <div class=\"col-lg-3 col-6\">
            <div class=\"small-box bg-danger\">
                <div class=\"inner\">
                    <h3>{{ orders_month|default(0) }}</h3>
                    <p>Commandes ce mois</p>
                </div>

                <div class=\"icon\">
                    <i class=\"fas fa-shopping-cart\"></i>
                </div>

                <a
                    href=\"{{ base_path }}/admin/orders\"
                    class=\"small-box-footer\"
                >
                    Plus d\x27infos
                    <i class=\"fas fa-arrow-circle-right\"></i>
                </a>
            </div>
        </div>


        <div class=\"col-lg-3 col-6\">
            <div class=\"small-box bg-success\">
                <div class=\"inner\">
                    <h3>
                        {{ total_revenue|default(0)|number_format(2, \x27.\x27, \x27,\x27) }}
                        {{ currency|default(\x27€\x27) }}
                    </h3>

                    <p>Chiffre d\x27affaires</p>
                </div>

                <div class=\"icon\">
                    <i class=\"fas fa-euro-sign\"></i>
                </div>

                <a
                    href=\"{{ base_path }}/admin/analytics\"
                    class=\"small-box-footer\"
                >
                    Plus d\x27infos
                    <i class=\"fas fa-arrow-circle-right\"></i>
                </a>
            </div>
        </div>


        <div class=\"col-lg-3 col-6\">
            <div class=\"small-box bg-warning\">
                <div class=\"inner\">
                    <h3>{{ total_client|default(0) }}</h3>
                    <p>Clients</p>
                </div>

                <div class=\"icon\">
                    <i class=\"fas fa-users\"></i>
                </div>

                <a
                    href=\"{{ base_path }}/admin/customers\"
                    class=\"small-box-footer\"
                >
                    Plus d\x27infos
                    <i class=\"fas fa-arrow-circle-right\"></i>
                </a>
            </div>
        </div>

    </div>


    <!-- DataTable - Last 10 orders -->
    <div class=\"row\">
        <div class=\"col-md-12\">

            <table id=\"admin-dashboard\" class=\"display\">

                <thead>
                    <tr>
                        <th>Column 1</th>
                        <th>Column 2</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>

            </table>

        </div>
    </div>


    <!-- Chart -->
    <div class=\"row\">

        <div class=\"col-md-12\">

            <div class=\"card\">

                <div class=\"card-header\">
                    <h3 class=\"card-title\">
                        Ventes mensuelles
                    </h3>
                </div>

                <div class=\"card-body\">

                    <canvas
                        id=\"salesChart\"
                        style=\"height: 300px;\"
                    ></canvas>

                </div>

            </div>

        </div>

    </div>

{% endblock %}", "admin/dashboard.twig", "C:\\xampp\\htdocs\\ecommerce\\Views\\admin\\dashboard.twig");
    }
}
