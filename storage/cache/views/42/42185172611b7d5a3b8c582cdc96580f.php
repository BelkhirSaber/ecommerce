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

/* components/admin/header.twig */
class __TwigTemplate_a6014c660b4b01eda1a8c33ad6c749bd extends Template
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
        yield "<nav class=\"main-header navbar navbar-expand navbar-white navbar-light\">

    ";
        // line 4
        yield "
    <ul class=\"navbar-nav\">

        <li class=\"nav-item\">

            <a
                class=\"nav-link\"
                data-widget=\"pushmenu\"
                href=\"#\"
                role=\"button\"
            >
                <i class=\"fas fa-bars\"></i>
            </a>

        </li>


        <li class=\"nav-item d-none d-sm-inline-block\">

            <a
                href=\"";
        // line 24
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/dashboard\"
                class=\"nav-link\"
            >
                Dashboard
            </a>

        </li>


        <li class=\"nav-item d-none d-sm-inline-block\">

            <a
                href=\"/\"
                target=\"_blank\"
                class=\"nav-link\"
            >
                Voir le site
            </a>

        </li>

    </ul>


    ";
        // line 49
        yield "
    <ul class=\"navbar-nav ml-auto\">

        ";
        // line 53
        yield "
        <li class=\"nav-item dropdown\">

            <a
                class=\"nav-link\"
                data-toggle=\"dropdown\"
                href=\"#\"
            >

                <i class=\"far fa-bell\"></i>

                <span class=\"badge badge-warning navbar-badge\">
                    ";
        // line 65
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("notificationCount", $context)) ? (Twig\Extension\CoreExtension::default(($context["notificationCount"] ?? null), 0)) : (0)), "html", null, true);
        yield "
                </span>

            </a>


            <div class=\"dropdown-menu dropdown-menu-lg dropdown-menu-right\">

                <span class=\"dropdown-item dropdown-header\">

                    ";
        // line 75
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("notificationCount", $context)) ? (Twig\Extension\CoreExtension::default(($context["notificationCount"] ?? null), 0)) : (0)), "html", null, true);
        yield "
                    Notifications

                </span>


                <div class=\"dropdown-divider\"></div>


                <a
                    href=\"";
        // line 85
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/orders\"
                    class=\"dropdown-item\"
                >

                    <i class=\"fas fa-shopping-cart mr-2\"></i>

                    2 nouvelles commandes

                </a>

            </div>

        </li>


        ";
        // line 101
        yield "
        <li class=\"nav-item dropdown\">

            <a
                class=\"nav-link\"
                data-toggle=\"dropdown\"
                href=\"#\"
            >

                <i class=\"far fa-user\"></i>

            </a>


            <div class=\"dropdown-menu dropdown-menu-lg dropdown-menu-right\">

                <a
                    href=\"";
        // line 118
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/profile\"
                    class=\"dropdown-item\"
                >

                    <i class=\"fas fa-user mr-2\"></i>

                    Mon profil

                </a>


                <div class=\"dropdown-divider\"></div>


                <a
                    href=\"";
        // line 133
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/logout\"
                    class=\"dropdown-item\"
                >

                    <i class=\"fas fa-sign-out-alt mr-2\"></i>

                    Déconnexion

                </a>

            </div>

        </li>

    </ul>

</nav>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "components/admin/header.twig";
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
        return array (  196 => 133,  178 => 118,  159 => 101,  141 => 85,  128 => 75,  115 => 65,  101 => 53,  96 => 49,  69 => 24,  47 => 4,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<nav class=\"main-header navbar navbar-expand navbar-white navbar-light\">

    {# Left navbar links #}

    <ul class=\"navbar-nav\">

        <li class=\"nav-item\">

            <a
                class=\"nav-link\"
                data-widget=\"pushmenu\"
                href=\"#\"
                role=\"button\"
            >
                <i class=\"fas fa-bars\"></i>
            </a>

        </li>


        <li class=\"nav-item d-none d-sm-inline-block\">

            <a
                href=\"{{ base_path }}/admin/dashboard\"
                class=\"nav-link\"
            >
                Dashboard
            </a>

        </li>


        <li class=\"nav-item d-none d-sm-inline-block\">

            <a
                href=\"/\"
                target=\"_blank\"
                class=\"nav-link\"
            >
                Voir le site
            </a>

        </li>

    </ul>


    {# Right navbar links #}

    <ul class=\"navbar-nav ml-auto\">

        {# Notifications #}

        <li class=\"nav-item dropdown\">

            <a
                class=\"nav-link\"
                data-toggle=\"dropdown\"
                href=\"#\"
            >

                <i class=\"far fa-bell\"></i>

                <span class=\"badge badge-warning navbar-badge\">
                    {{ notificationCount|default(0) }}
                </span>

            </a>


            <div class=\"dropdown-menu dropdown-menu-lg dropdown-menu-right\">

                <span class=\"dropdown-item dropdown-header\">

                    {{ notificationCount|default(0) }}
                    Notifications

                </span>


                <div class=\"dropdown-divider\"></div>


                <a
                    href=\"{{ base_path }}/admin/orders\"
                    class=\"dropdown-item\"
                >

                    <i class=\"fas fa-shopping-cart mr-2\"></i>

                    2 nouvelles commandes

                </a>

            </div>

        </li>


        {# User Menu #}

        <li class=\"nav-item dropdown\">

            <a
                class=\"nav-link\"
                data-toggle=\"dropdown\"
                href=\"#\"
            >

                <i class=\"far fa-user\"></i>

            </a>


            <div class=\"dropdown-menu dropdown-menu-lg dropdown-menu-right\">

                <a
                    href=\"{{ base_path }}/admin/profile\"
                    class=\"dropdown-item\"
                >

                    <i class=\"fas fa-user mr-2\"></i>

                    Mon profil

                </a>


                <div class=\"dropdown-divider\"></div>


                <a
                    href=\"{{ base_path }}/logout\"
                    class=\"dropdown-item\"
                >

                    <i class=\"fas fa-sign-out-alt mr-2\"></i>

                    Déconnexion

                </a>

            </div>

        </li>

    </ul>

</nav>", "components/admin/header.twig", "C:\\xampp\\htdocs\\ecommerce\\Views\\components\\admin\\header.twig");
    }
}
