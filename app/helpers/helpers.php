<?php

function render($view, $values = [])
    {
        // if view exists, render it

        if (file_exists($_SERVER['DOCUMENT_ROOT']."/views/{$view}"))
        {
            
            // extract variables into local scope
            extract($values);

           // $title = 'ahmed'

            // render view (between header and footer)
           // require("/views/$view.php");
            require("/views/{$view}");
          // require("/views/footer.php");
            exit;
        }

    }

?>