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
            'stylesheets' => [$this, 'block_stylesheets'],
            'content' => [$this, 'block_content'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">

<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

    <title>
        ";
        // line 9
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("pageTitle", $context)) ? (Twig\Extension\CoreExtension::default(($context["pageTitle"] ?? null), "Admin Dashboard")) : ("Admin Dashboard")), "html", null, true);
        yield " | B3S Store
    </title>

    <!-- Google Font -->
    <link
        rel=\"stylesheet\"
        href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback\"
    >

    <!-- Font Awesome -->
    <link
        rel=\"stylesheet\"
        href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css\"
    >

    <!-- AdminLTE -->
    <link
        rel=\"stylesheet\"
        href=\"https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css\"
    >

    <!-- Vite CSS -->
    ";
        // line 31
        yield (string) $this->env->getFunction('vite_css')->getCallable()("admin-bundle.js");
        yield "

    ";
        // line 33
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 34
        yield "</head>

<body class=\"hold-transition sidebar-mini layout-fixed\">

<div class=\"wrapper\">

    ";
        // line 41
        yield "    ";
        yield from $this->load("components/admin/header.twig", 41)->unwrap()->yield($context);
        // line 42
        yield "
    ";
        // line 44
        yield "    ";
        yield from $this->load("components/admin/sidebar.twig", 44)->unwrap()->yield($context);
        // line 45
        yield "
    ";
        // line 47
        yield "    <div class=\"content-wrapper\">

        ";
        // line 50
        yield "        <div class=\"content-header\">
            <div class=\"container-fluid\">

                <div class=\"row mb-2\">

                    <div class=\"col-sm-6\">
                        <h1 class=\"m-0\">
                            ";
        // line 57
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("pageTitle", $context)) ? (Twig\Extension\CoreExtension::default(($context["pageTitle"] ?? null), "Dashboard")) : ("Dashboard")), "html", null, true);
        yield "
                        </h1>
                    </div>

                    <div class=\"col-sm-6\">

                        <ol class=\"breadcrumb float-sm-right\">

                            <li class=\"breadcrumb-item\">
                                <a href=\"";
        // line 66
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["base_path"] ?? null), "html", null, true);
        yield "/admin/dashboard\">
                                    Home
                                </a>
                            </li>

                            <li class=\"breadcrumb-item active\">
                                ";
        // line 72
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((array_key_exists("pageTitle", $context)) ? (Twig\Extension\CoreExtension::default(($context["pageTitle"] ?? null), "Dashboard")) : ("Dashboard")), "html", null, true);
        yield "
                            </li>

                        </ol>

                    </div>

                </div>

            </div>
        </div>

        ";
        // line 85
        yield "        <section class=\"content\">

            <div class=\"container-fluid\">

                ";
        // line 89
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 90
        yield "
            </div>

        </section>

    </div>

    ";
        // line 98
        yield "    ";
        yield from $this->load("components/admin/footer.twig", 98)->unwrap()->yield($context);
        // line 99
        yield "
</div>


<!-- Vite Client -->
";
        // line 104
        yield (string) $this->env->getFunction('vite_client')->getCallable()();
        yield "

<!-- Admin Bundle -->
<script
    type=\"module\"
    src=\"";
        // line 109
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('vite_asset')->getCallable()("admin-bundle.js"), "html", null, true);
        yield "\"
></script>

<!-- Admin Main JS -->
<script
    type=\"module\"
    src=\"";
        // line 115
        yield (string) $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getFunction('vite_asset')->getCallable()("admin/main.js"), "html", null, true);
        yield "\"
></script>

";
        // line 118
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 119
        yield "
</body>
</html>";
        yield from [];
    }

    // line 33
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 89
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    // line 118
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
        return array (  236 => 118,  226 => 89,  216 => 33,  209 => 119,  207 => 118,  201 => 115,  192 => 109,  184 => 104,  177 => 99,  174 => 98,  165 => 90,  163 => 89,  157 => 85,  142 => 72,  133 => 66,  121 => 57,  112 => 50,  108 => 47,  105 => 45,  102 => 44,  99 => 42,  96 => 41,  88 => 34,  86 => 33,  81 => 31,  56 => 9,  46 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">

<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

    <title>
        {{ pageTitle|default(\x27Admin Dashboard\x27) }} | B3S Store
    </title>

    <!-- Google Font -->
    <link
        rel=\"stylesheet\"
        href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback\"
    >

    <!-- Font Awesome -->
    <link
        rel=\"stylesheet\"
        href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css\"
    >

    <!-- AdminLTE -->
    <link
        rel=\"stylesheet\"
        href=\"https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css\"
    >

    <!-- Vite CSS -->
    {{ vite_css(\x27admin-bundle.js\x27)|raw }}

    {% block stylesheets %}{% endblock %}
</head>

<body class=\"hold-transition sidebar-mini layout-fixed\">

<div class=\"wrapper\">

    {# Header / Navbar #}
    {% include \x27components/admin/header.twig\x27 %}

    {# Sidebar #}
    {% include \x27components/admin/sidebar.twig\x27 %}

    {# Main Content #}
    <div class=\"content-wrapper\">

        {# Page Header #}
        <div class=\"content-header\">
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

        {# Page Content #}
        <section class=\"content\">

            <div class=\"container-fluid\">

                {% block content %}{% endblock %}

            </div>

        </section>

    </div>

    {# Footer #}
    {% include \x27components/admin/footer.twig\x27 %}

</div>


<!-- Vite Client -->
{{ vite_client()|raw }}

<!-- Admin Bundle -->
<script
    type=\"module\"
    src=\"{{ vite_asset(\x27admin-bundle.js\x27) }}\"
></script>

<!-- Admin Main JS -->
<script
    type=\"module\"
    src=\"{{ vite_asset(\x27admin/main.js\x27) }}\"
></script>

{% block javascripts %}{% endblock %}

</body>
</html>", "admin/layout.twig", "C:\\xampp\\htdocs\\ecommerce\\Views\\admin\\layout.twig");
    }
}
