<?php

/**
 * A class for working with templates
 *
 * @author Fellipe Sanches <fellipes@yahoo.com.br>
 */

namespace Fellipe\Classes;

class Templates
{
    public $template_rendered;

    function renderTemplate($template_name, $variables) 
    {
        $template = file_get_contents($template_name);
        foreach ($variables as $key => $value) {
            $template = str_replace('{{ ' . $key . ' }}', $value, $template);
        }
        $this->template_rendered = $template;
    }
}