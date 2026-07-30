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
class __TwigTemplate_fb534dc0aeace943f73f7e40cf93fbb8 extends Template
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
            style=\"opacity: .8\"
            onerror=\"this.style.display=\x27none\x27\"
        >

        <span class=\"brand-text font-weight-light\">
            B3S Store Admin
        </span>

    </a>


    ";
        // line 26
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
        // line 42
        yield "
                <li class=\"nav-item\">

                    <a
                        href=\"";
        // line 46
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/dashboard\"
                        class=\"nav-link
                            ";
        // line 48
        yield (string) (((is_string($_v0 = ($context["currentPath"] ?? null)) && is_string($_v1 = "/admin/dashboard") && str_starts_with($_v0, $_v1))) ? ("active") : (""));
        // line 51
        yield "\"
                    >

                        <i class=\"nav-icon fas fa-tachometer-alt\"></i>

                        <p>
                            Dashboard
                        </p>

                    </a>

                </li>


                ";
        // line 68
        yield "
                ";
        // line 69
        $context["catalogueActive"] = ((is_string($_v2 =         // line 70
($context["currentPath"] ?? null)) && is_string($_v3 = "/admin/products") && str_starts_with($_v2, $_v3)) || (is_string($_v4 =         // line 71
($context["currentPath"] ?? null)) && is_string($_v5 = "/admin/categories") && str_starts_with($_v4, $_v5)));
        // line 73
        yield "

                <li
                    class=\"nav-item
                        ";
        // line 77
        yield (string) (((($tmp = ($context["catalogueActive"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) ? ("menu-open") : (""));
        yield "\"
                >

                    <a
                        href=\"#\"
                        class=\"nav-link
                            ";
        // line 83
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
        // line 104
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/products\"
                                class=\"nav-link
                                    ";
        // line 106
        yield (string) (((is_string($_v6 = ($context["currentPath"] ?? null)) && is_string($_v7 = "/admin/products") && str_starts_with($_v6, $_v7))) ? ("active") : (""));
        // line 109
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
        // line 126
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/categories\"
                                class=\"nav-link
                                    ";
        // line 128
        yield (string) (((is_string($_v8 = ($context["currentPath"] ?? null)) && is_string($_v9 = "/admin/categories") && str_starts_with($_v8, $_v9))) ? ("active") : (""));
        // line 131
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
        // line 152
        yield "
                <li class=\"nav-item\">

                    <a
                        href=\"";
        // line 156
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/orders\"
                        class=\"nav-link
                            ";
        // line 158
        yield (string) (((is_string($_v10 = ($context["currentPath"] ?? null)) && is_string($_v11 = "/admin/orders") && str_starts_with($_v10, $_v11))) ? ("active") : (""));
        // line 161
        yield "\"
                    >

                        <i class=\"nav-icon fas fa-shopping-cart\"></i>

                        <p>

                            Commandes

                            <span class=\"badge badge-info right\">
                                ";
        // line 171
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("ordersCount", $context)) ? (Twig\Extension\CoreExtension::default(($context["ordersCount"] ?? null), 0)) : (0)), "html", null, true);
        yield "
                            </span>

                        </p>

                    </a>

                </li>


                ";
        // line 184
        yield "
                <li class=\"nav-item\">

                    <a
                        href=\"";
        // line 188
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/customers\"
                        class=\"nav-link
                            ";
        // line 190
        yield (string) (((is_string($_v12 = ($context["currentPath"] ?? null)) && is_string($_v13 = "/admin/customers") && str_starts_with($_v12, $_v13))) ? ("active") : (""));
        // line 193
        yield "\"
                    >

                        <i class=\"nav-icon fas fa-users\"></i>

                        <p>
                            Clients
                        </p>

                    </a>

                </li>


                ";
        // line 210
        yield "
                <li class=\"nav-item\">

                    <a
                        href=\"";
        // line 214
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/coupons\"
                        class=\"nav-link
                            ";
        // line 216
        yield (string) (((is_string($_v14 = ($context["currentPath"] ?? null)) && is_string($_v15 = "/admin/coupons") && str_starts_with($_v14, $_v15))) ? ("active") : (""));
        // line 219
        yield "\"
                    >

                        <i class=\"nav-icon fas fa-tags\"></i>

                        <p>
                            Coupons
                        </p>

                    </a>

                </li>


                ";
        // line 236
        yield "
                <li class=\"nav-item\">

                    <a
                        href=\"";
        // line 240
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/analytics\"
                        class=\"nav-link
                            ";
        // line 242
        yield (string) (((is_string($_v16 = ($context["currentPath"] ?? null)) && is_string($_v17 = "/admin/analytics") && str_starts_with($_v16, $_v17))) ? ("active") : (""));
        // line 245
        yield "\"
                    >

                        <i class=\"nav-icon fas fa-chart-line\"></i>

                        <p>
                            Analytics
                        </p>

                    </a>

                </li>


                ";
        // line 262
        yield "
                <li class=\"nav-item\">

                    <a
                        href=\"";
        // line 266
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/settings\"
                        class=\"nav-link
                            ";
        // line 268
        yield (string) (((is_string($_v18 = ($context["currentPath"] ?? null)) && is_string($_v19 = "/admin/settings") && str_starts_with($_v18, $_v19))) ? ("active") : (""));
        // line 271
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
        return array (  357 => 271,  355 => 268,  350 => 266,  344 => 262,  328 => 245,  326 => 242,  321 => 240,  315 => 236,  299 => 219,  297 => 216,  292 => 214,  286 => 210,  270 => 193,  268 => 190,  263 => 188,  257 => 184,  244 => 171,  232 => 161,  230 => 158,  225 => 156,  219 => 152,  199 => 131,  197 => 128,  192 => 126,  173 => 109,  171 => 106,  166 => 104,  142 => 83,  133 => 77,  127 => 73,  125 => 71,  124 => 70,  123 => 69,  120 => 68,  104 => 51,  102 => 48,  97 => 46,  91 => 42,  76 => 26,  59 => 11,  51 => 6,  47 => 4,  43 => 1,);
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
            style=\"opacity: .8\"
            onerror=\"this.style.display=\x27none\x27\"
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
