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

/* components/admin/sidebar.twig */
class __TwigTemplate_c3d7b88ab80f20b45d4aa861500ceb40 extends Template
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
        yield "<aside class=\"main-sidebar sidebar-dark-primary elevation-4\">

    ";
        // line 4
        yield "
    <a
        href=\"";
        // line 6
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/dashboard\"
        class=\"brand-link\"
    >

        <img
            src=\"";
        // line 11
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["IMG_URL"] ?? null), "html", null, true);
        yield "/admin_dash/default_admin_user.png\"
            alt=\"Logo\"
            class=\"brand-image img-circle elevation-3\"
        >

        <span class=\"brand-text font-weight-light\">
            B3S Store Admin
        </span>

    </a>


    ";
        // line 24
        yield "
    <div class=\"sidebar\">

        <nav class=\"mt-2\">

            <ul
                class=\"nav nav-pills nav-sidebar flex-column\"
                data-widget=\"treeview\"
                role=\"menu\"
                data-accordion=\"false\"
            >


                ";
        // line 40
        yield "
                <li class=\"nav-item\">

                    <a
                        href=\"";
        // line 44
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/dashboard\"
                        class=\"nav-link
                            ";
        // line 46
        yield (string) (((is_string($_v0 = ($context["currentPath"] ?? null)) && is_string($_v1 = "/admin/dashboard") && str_starts_with($_v0, $_v1))) ? ("active") : (""));
        // line 49
        yield "\"
                    >

                        <i class=\"nav-icon fas fa-tachometer-alt\"></i>

                        <p>
                            Dashboard
                        </p>

                    </a>

                </li>


                ";
        // line 66
        yield "
                ";
        // line 67
        $context["catalogueActive"] = ((is_string($_v2 =         // line 68
($context["currentPath"] ?? null)) && is_string($_v3 = "/admin/products") && str_starts_with($_v2, $_v3)) || (is_string($_v4 =         // line 69
($context["currentPath"] ?? null)) && is_string($_v5 = "/admin/categories") && str_starts_with($_v4, $_v5)));
        // line 71
        yield "

                <li
                    class=\"nav-item
                        ";
        // line 75
        yield (string) (((($tmp = ($context["catalogueActive"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("menu-open") : (""));
        yield "\"
                >

                    <a
                        href=\"#\"
                        class=\"nav-link
                            ";
        // line 81
        yield (string) (((($tmp = ($context["catalogueActive"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("active") : (""));
        yield "\"
                    >

                        <i class=\"nav-icon fas fa-box\"></i>

                        <p>

                            Catalogue

                            <i class=\"right fas fa-angle-left\"></i>

                        </p>

                    </a>


                    <ul class=\"nav nav-treeview\">

                        <li class=\"nav-item\">

                            <a
                                href=\"";
        // line 102
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/products\"
                                class=\"nav-link
                                    ";
        // line 104
        yield (string) (((is_string($_v6 = ($context["currentPath"] ?? null)) && is_string($_v7 = "/admin/products") && str_starts_with($_v6, $_v7))) ? ("active") : (""));
        // line 107
        yield "\"
                            >

                                <i class=\"far fa-circle nav-icon\"></i>

                                <p>
                                    Produits
                                </p>

                            </a>

                        </li>


                        <li class=\"nav-item\">

                            <a
                                href=\"";
        // line 124
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/categories\"
                                class=\"nav-link
                                    ";
        // line 126
        yield (string) (((is_string($_v8 = ($context["currentPath"] ?? null)) && is_string($_v9 = "/admin/categories") && str_starts_with($_v8, $_v9))) ? ("active") : (""));
        // line 129
        yield "\"
                            >

                                <i class=\"far fa-circle nav-icon\"></i>

                                <p>
                                    Catégories
                                </p>

                            </a>

                        </li>

                    </ul>

                </li>


                ";
        // line 150
        yield "
                <li class=\"nav-item\">

                    <a
                        href=\"";
        // line 154
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/orders\"
                        class=\"nav-link
                            ";
        // line 156
        yield (string) (((is_string($_v10 = ($context["currentPath"] ?? null)) && is_string($_v11 = "/admin/orders") && str_starts_with($_v10, $_v11))) ? ("active") : (""));
        // line 159
        yield "\"
                    >

                        <i class=\"nav-icon fas fa-shopping-cart\"></i>

                        <p>

                            Commandes

                            <span class=\"badge badge-info right\">
                                ";
        // line 169
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("ordersCount", $context)) ? (Twig\Extension\CoreExtension::default(($context["ordersCount"] ?? null), 0)) : (0)), "html", null, true);
        yield "
                            </span>

                        </p>

                    </a>

                </li>


                ";
        // line 182
        yield "
                <li class=\"nav-item\">

                    <a
                        href=\"";
        // line 186
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/customers\"
                        class=\"nav-link
                            ";
        // line 188
        yield (string) (((is_string($_v12 = ($context["currentPath"] ?? null)) && is_string($_v13 = "/admin/customers") && str_starts_with($_v12, $_v13))) ? ("active") : (""));
        // line 191
        yield "\"
                    >

                        <i class=\"nav-icon fas fa-users\"></i>

                        <p>
                            Clients
                        </p>

                    </a>

                </li>


                ";
        // line 208
        yield "
                <li class=\"nav-item\">

                    <a
                        href=\"";
        // line 212
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/coupons\"
                        class=\"nav-link
                            ";
        // line 214
        yield (string) (((is_string($_v14 = ($context["currentPath"] ?? null)) && is_string($_v15 = "/admin/coupons") && str_starts_with($_v14, $_v15))) ? ("active") : (""));
        // line 217
        yield "\"
                    >

                        <i class=\"nav-icon fas fa-tags\"></i>

                        <p>
                            Coupons
                        </p>

                    </a>

                </li>


                ";
        // line 234
        yield "
                <li class=\"nav-item\">

                    <a
                        href=\"";
        // line 238
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/analytics\"
                        class=\"nav-link
                            ";
        // line 240
        yield (string) (((is_string($_v16 = ($context["currentPath"] ?? null)) && is_string($_v17 = "/admin/analytics") && str_starts_with($_v16, $_v17))) ? ("active") : (""));
        // line 243
        yield "\"
                    >

                        <i class=\"nav-icon fas fa-chart-line\"></i>

                        <p>
                            Analytics
                        </p>

                    </a>

                </li>


                ";
        // line 260
        yield "
                <li class=\"nav-item\">

                    <a
                        href=\"";
        // line 264
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/settings\"
                        class=\"nav-link
                            ";
        // line 266
        yield (string) (((is_string($_v18 = ($context["currentPath"] ?? null)) && is_string($_v19 = "/admin/settings") && str_starts_with($_v18, $_v19))) ? ("active") : (""));
        // line 269
        yield "\"
                    >

                        <i class=\"nav-icon fas fa-cog\"></i>

                        <p>
                            Paramètres
                        </p>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</aside>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "components/admin/sidebar.twig";
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
        return array (  355 => 269,  353 => 266,  348 => 264,  342 => 260,  326 => 243,  324 => 240,  319 => 238,  313 => 234,  297 => 217,  295 => 214,  290 => 212,  284 => 208,  268 => 191,  266 => 188,  261 => 186,  255 => 182,  242 => 169,  230 => 159,  228 => 156,  223 => 154,  217 => 150,  197 => 129,  195 => 126,  190 => 124,  171 => 107,  169 => 104,  164 => 102,  140 => 81,  131 => 75,  125 => 71,  123 => 69,  122 => 68,  121 => 67,  118 => 66,  102 => 49,  100 => 46,  95 => 44,  89 => 40,  74 => 24,  59 => 11,  51 => 6,  47 => 4,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<aside class=\"main-sidebar sidebar-dark-primary elevation-4\">

    {# Brand Logo #}

    <a
        href=\"{{ base_path }}/admin/dashboard\"
        class=\"brand-link\"
    >

        <img
            src=\"{{ IMG_URL }}/admin_dash/default_admin_user.png\"
            alt=\"Logo\"
            class=\"brand-image img-circle elevation-3\"
        >

        <span class=\"brand-text font-weight-light\">
            B3S Store Admin
        </span>

    </a>


    {# Sidebar #}

    <div class=\"sidebar\">

        <nav class=\"mt-2\">

            <ul
                class=\"nav nav-pills nav-sidebar flex-column\"
                data-widget=\"treeview\"
                role=\"menu\"
                data-accordion=\"false\"
            >


                {# =====================
                   Dashboard
                   ===================== #}

                <li class=\"nav-item\">

                    <a
                        href=\"{{ base_path }}/admin/dashboard\"
                        class=\"nav-link
                            {{ currentPath starts with \x27/admin/dashboard\x27
                                ? \x27active\x27
                                : \x27\x27
                            }}\"
                    >

                        <i class=\"nav-icon fas fa-tachometer-alt\"></i>

                        <p>
                            Dashboard
                        </p>

                    </a>

                </li>


                {# =====================
                   Catalogue
                   ===================== #}

                {% set catalogueActive =
                    currentPath starts with \x27/admin/products\x27
                    or currentPath starts with \x27/admin/categories\x27
                %}


                <li
                    class=\"nav-item
                        {{ catalogueActive ? \x27menu-open\x27 : \x27\x27 }}\"
                >

                    <a
                        href=\"#\"
                        class=\"nav-link
                            {{ catalogueActive ? \x27active\x27 : \x27\x27 }}\"
                    >

                        <i class=\"nav-icon fas fa-box\"></i>

                        <p>

                            Catalogue

                            <i class=\"right fas fa-angle-left\"></i>

                        </p>

                    </a>


                    <ul class=\"nav nav-treeview\">

                        <li class=\"nav-item\">

                            <a
                                href=\"{{ base_path }}/admin/products\"
                                class=\"nav-link
                                    {{ currentPath starts with \x27/admin/products\x27
                                        ? \x27active\x27
                                        : \x27\x27
                                    }}\"
                            >

                                <i class=\"far fa-circle nav-icon\"></i>

                                <p>
                                    Produits
                                </p>

                            </a>

                        </li>


                        <li class=\"nav-item\">

                            <a
                                href=\"{{ base_path }}/admin/categories\"
                                class=\"nav-link
                                    {{ currentPath starts with \x27/admin/categories\x27
                                        ? \x27active\x27
                                        : \x27\x27
                                    }}\"
                            >

                                <i class=\"far fa-circle nav-icon\"></i>

                                <p>
                                    Catégories
                                </p>

                            </a>

                        </li>

                    </ul>

                </li>


                {# =====================
                   Commandes
                   ===================== #}

                <li class=\"nav-item\">

                    <a
                        href=\"{{ base_path }}/admin/orders\"
                        class=\"nav-link
                            {{ currentPath starts with \x27/admin/orders\x27
                                ? \x27active\x27
                                : \x27\x27
                            }}\"
                    >

                        <i class=\"nav-icon fas fa-shopping-cart\"></i>

                        <p>

                            Commandes

                            <span class=\"badge badge-info right\">
                                {{ ordersCount|default(0) }}
                            </span>

                        </p>

                    </a>

                </li>


                {# =====================
                   Clients
                   ===================== #}

                <li class=\"nav-item\">

                    <a
                        href=\"{{ base_path }}/admin/customers\"
                        class=\"nav-link
                            {{ currentPath starts with \x27/admin/customers\x27
                                ? \x27active\x27
                                : \x27\x27
                            }}\"
                    >

                        <i class=\"nav-icon fas fa-users\"></i>

                        <p>
                            Clients
                        </p>

                    </a>

                </li>


                {# =====================
                   Coupons
                   ===================== #}

                <li class=\"nav-item\">

                    <a
                        href=\"{{ base_path }}/admin/coupons\"
                        class=\"nav-link
                            {{ currentPath starts with \x27/admin/coupons\x27
                                ? \x27active\x27
                                : \x27\x27
                            }}\"
                    >

                        <i class=\"nav-icon fas fa-tags\"></i>

                        <p>
                            Coupons
                        </p>

                    </a>

                </li>


                {# =====================
                   Analytics
                   ===================== #}

                <li class=\"nav-item\">

                    <a
                        href=\"{{ base_path }}/admin/analytics\"
                        class=\"nav-link
                            {{ currentPath starts with \x27/admin/analytics\x27
                                ? \x27active\x27
                                : \x27\x27
                            }}\"
                    >

                        <i class=\"nav-icon fas fa-chart-line\"></i>

                        <p>
                            Analytics
                        </p>

                    </a>

                </li>


                {# =====================
                   Paramètres
                   ===================== #}

                <li class=\"nav-item\">

                    <a
                        href=\"{{ base_path }}/admin/settings\"
                        class=\"nav-link
                            {{ currentPath starts with \x27/admin/settings\x27
                                ? \x27active\x27
                                : \x27\x27
                            }}\"
                    >

                        <i class=\"nav-icon fas fa-cog\"></i>

                        <p>
                            Paramètres
                        </p>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</aside>", "components/admin/sidebar.twig", "C:\\xampp\\htdocs\\ecommerce\\Views\\components\\admin\\sidebar.twig");
    }
}
