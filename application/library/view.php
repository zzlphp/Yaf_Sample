<?php
/**
 * 视图引擎定义
 *
 * @author  ziliang
 * @date    2015-07-21 15:00
 * @version $Id$
 */

// 基础模板类，被视图引擎引用
class dwzTemplate extends Blitz
{
    public function __construct()
    {
        parent::__construct();
        //construct class
    }
}

// 视图引擎实现类
class View implements Yaf_View_Interface
{
    /**
     * template object
     * @var template
     */
    public $_T;

    /**
     * template path
     * @var string
     */
    protected $_P;

    /**
     * Constructor
     *
     * @param   string      $tmplPath
     * @param   array       $extraParams
     * @return  void
     */
    public function __construct($tmplPath = null, $extraParams = array())
    {
        $this->_T = new dwzTemplate();
        $this->_P = '';

        if (null !== $tmplPath)
        {
            $this->setScriptPath($tmplPath);
        }

        if (!empty($extraParams))
        {
            $this->assign($extraParams);
        }
    }

    /**
     * Assign variables to the template
     *
     * Allows setting a specific key to the specified value, OR passing
     * an array of key => value pairs to set en masse.
     *
     * @param   string|array    $spec   The assignment strategy to use
     * @param   mixed           $value  (Optional)
     * @return  void
     */
    public function assign($spec, $value = null)
    {
        if (is_array($spec))
        {
            $this->_T->set($spec);
        }
        else if (null !== $value)
        {
            $this->_T->set(array($spec => $value));
        }
    }

    /**
     * Processes a template and returns the output.
     *
     * @param   string          $view_file
     * @param   array           $tpl_vars  (Optional)
     * @return  string
     */
    public function render($view_file, $tpl_vars = null)
    {
        if (file_exists($this->_P . $view_file))
        {
            $body = file_get_contents($this->_P . $view_file);
            $body = str_replace('/VIEW_PATH/', $this->_P, $body);
            $this->_T->load($body);

            if (is_array($tpl_vars))
            {
                $this->_T->set($tpl_vars);
            }

            //$this->_T->parse();
            $this->_T->display();

            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Processes a template and display the output.
     *
     * @param   string          $view_file
     * @param   array           $tpl_vars  (Optional)
     * @return  string
     */
    public function display($view_file, $tpl_vars = null)
    {
        if (file_exists($this->_P . $view_file))
        {
            $body = file_get_contents($this->_P . $view_file);
            $body = str_replace('/VIEW_PATH/', $this->_P, $body);

            $this->_T->load($body);

            if (is_array($tpl_vars))
            {
                $this->_T->set($tpl_vars);
            }

            $this->_T->display();
        }
    }

    /**
     * setting the path of template.
     *
     * @param   string          $view_directory
     * @return  boolean
     */
    public function setScriptPath($view_directory)
    {
        if ('' !== $this->_P)
        {
            return true;
        }
        else if (is_dir($view_directory))
        {
            if ('/' === substr($view_directory, -1))
            {
                $this->_P = $view_directory;
            }
            else
            {
                $this->_P = $view_directory . '/';
            }
            //$this->_T->set(array('view_path' => $this->_P));
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * return the path of template.
     *
     * @param   void
     * @return  string
     */
    public function getScriptPath()
    {
        return $this->_P;
    }

}
