<?php
class view
{
    const EXTENSION = ".php";

    function __construct()
    {
 
    }

    function display($data = array(), $files)
    {
        ob_start();
        $data = extract($data);
        $lang = lang();
        if (is_array($files)) {
            foreach ($files as $file) {
                //require __VIEWS__.'/'.$file.self::EXTENSION;
                $file =  __VIEWS__.'/'.$file.self::EXTENSION;
                require($file);
                //$this->tpl->render($file, ["lang" => $lang, $data]);
            }
        } else {
            //require __VIEWS__.'/'.$files.self::EXTENSION;
            $files =  __VIEWS__.'/'.$files.self::EXTENSION;
            require($files);
            //$this->tpl->render($files);
        }
        $content = ob_get_contents();
        ob_end_flush();
        return $content;
    }

}
?>
