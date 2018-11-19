<?php

/* @Installation/welcome.twig */
class __TwigTemplate_9d02d4400052ae57ab2f01df8a42c8f56c17d06494b44c57c6614588664b2321 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Installation/layout.twig", "@Installation/welcome.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Installation/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "
    <h2>";
        // line 5
        echo \Piwik\piwik_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_Welcome")), "html", null, true);
        echo "</h2>

    ";
        // line 7
        echo call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_WelcomeHelp", ($context["totalNumberOfSteps"] ?? $this->getContext($context, "totalNumberOfSteps"))));
        echo "

    <script type=\"text/javascript\">
        <!--
        \$(function () {
            // client-side test for broken tracker (e.g., mod_security rule)
            \$('.next-step').hide();
            \$.ajax({
                url: 'piwik.php',
                data: 'url=http://example.com',
                complete: function () {
                    \$('.next-step').show();
                },
                error: function (req) {
                    \$('.next-step a').attr('href', \$('.next-step a').attr('href') + '&trackerStatus=' + req.status);
                }
            });
        });
        //-->
    </script>

    ";
        // line 28
        if ( !($context["showNextStep"] ?? $this->getContext($context, "showNextStep"))) {
            // line 29
            echo "        <p class=\"next-step\">
            <a href=\"";
            // line 30
            echo \Piwik\piwik_escape_filter($this->env, ($context["url"] ?? $this->getContext($context, "url")), "html", null, true);
            echo "\">";
            echo \Piwik\piwik_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_RefreshPage")), "html", null, true);
            echo " &raquo;</a>
        </p>
    ";
        }
        // line 33
        echo "
";
    }

    public function getTemplateName()
    {
        return "@Installation/welcome.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 33,  68 => 30,  65 => 29,  63 => 28,  39 => 7,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends '@Installation/layout.twig' %}

{% block content %}

    <h2>{{ 'Installation_Welcome'|translate }}</h2>

    {{ 'Installation_WelcomeHelp'|translate(totalNumberOfSteps)|raw }}

    <script type=\"text/javascript\">
        <!--
        \$(function () {
            // client-side test for broken tracker (e.g., mod_security rule)
            \$('.next-step').hide();
            \$.ajax({
                url: 'piwik.php',
                data: 'url=http://example.com',
                complete: function () {
                    \$('.next-step').show();
                },
                error: function (req) {
                    \$('.next-step a').attr('href', \$('.next-step a').attr('href') + '&trackerStatus=' + req.status);
                }
            });
        });
        //-->
    </script>

    {% if not showNextStep %}
        <p class=\"next-step\">
            <a href=\"{{ url }}\">{{ 'General_RefreshPage'|translate }} &raquo;</a>
        </p>
    {% endif %}

{% endblock %}
", "@Installation/welcome.twig", "/Applications/AMPPS/www/Appaloosa-Books/webroot/matomo/plugins/Installation/templates/welcome.twig");
    }
}
